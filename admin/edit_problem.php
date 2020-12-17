<?php
session_start();
require_once("../backend/dbconn.php");
if (!isset($_SESSION["valid"]) || $_SESSION["type"] != "admin") {
    header("Location:../login.php");
}

$pid = $_GET["pid"];

if (isset($_POST["editproblem"])) {
    $pt = $_POST['problemTitle'];
    $pd = $_POST['problemDescription'];
    $tci1 = $_POST['input1'];
    $tco1 = $_POST['output1'];
    $tci2 = $_POST['input2'];
    $tco2 = $_POST['output2'];

    try {
        $sql = "UPDATE `problems` SET `problem_title`=?,`problem_statement`=?,`testcase_input1`=?,`testcase_output1`=?,`testcase_input2`=?,`testcase_output2`=? WHERE `pid`=?;";
        $conn->prepare($sql)->execute([$pt, $pd, $tci1, $tco1, $tci2, $tco2, $pid]);
        echo '<script>alert("Succesfully Updated the Question!");</script>';
        header("Location:./index.php");
    } catch (Exception $e) {
        echo '<script>alert("Failed to update the Question:' . $e->getMessage() . ' ");</script>';
    }
}

$sql2 = "SELECT `problem_title`, `problem_statement`, `testcase_input1`, `testcase_output1`, `testcase_input2`, `testcase_output2` FROM `problems` WHERE `pid`=?;";
$res2 = $conn->prepare($sql2);
$res2->execute([$pid]);
$prob = $res2->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeJudge | Edit Problem</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/chartist.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php
    require_once("./navbar.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                                <span class="ml-2">Account Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                                <span class="ml-2">Edit Problem</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </nav>
                <h1 class="h2">Account Settings (Admin)</h1>


                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                        <form action="edit_problem.php?pid=<?php echo $pid ?>" method="POST">
                            <div class="form-group">
                                <label for="problemTitle">Problem Title</label>
                                <input type="text" value="<?php echo $prob["problem_title"] ?>" required name="problemTitle" class="form-control" id="problemTitle" />
                            </div>
                            <div class="form-group">
                                <label for="problemDescription">Problem Description with Sample Test Cases</label>
                                <textarea class="form-control" required name="problemDescription" id="problemDescription" rows="15"><?php echo $prob["problem_statement"] ?></textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="input1">Test Case 1 Input</label>
                                    <textarea class="form-control" required name="input1" id="input1" rows="5"><?php echo $prob["testcase_input1"] ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="output1">Test Case 1 Output</label>
                                    <textarea class="form-control" required name="output1" id="output1" rows="5"><?php echo $prob["testcase_output1"] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="input2">Test Case 2 Input</label>
                                    <textarea class="form-control" required name="input2" id="input2" rows="5"><?php echo $prob["testcase_input2"] ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="output2">Test Case 2 Output</label>
                                    <textarea class="form-control" required name="output2" id="output2" rows="5"><?php echo $prob["testcase_output2"] ?></textarea>
                                </div>
                            </div>
                            <br>
                            <button type="submit" required name="editproblem" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright - CodeJudge</span>
                    <ul class="nav m-0">
                        <li class="nav-item">
                            <a class="nav-link text-secondary" aria-current="page" href="#">Extra Button</a>
                        </li>
                    </ul>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
</body>

</html>