<?php
session_start();
require_once("backend/dbconn.php");
if (!isset($_SESSION["valid"]) || $_SESSION["type"] != "user") {
  header("Location:./login.php");
}
if (isset($_GET['pid'])) {
  $pid = $_GET['pid'];
  $sql2 = "SELECT `problem_title`, `problem_statement`, `testcase_input1`, `testcase_output1`, `testcase_input2`, `testcase_output2` FROM `problems` WHERE `pid`=?;";
  $res2 = $conn->prepare($sql2);
  $res2->execute([$pid]);
  $prob = $res2->fetch(PDO::FETCH_ASSOC);
  
  $uid = $_SESSION['uid'];
  $sql3 = "SELECT `problem_answer` FROM `problems_user` WHERE `pid`=? AND `uid`=?;";
  $res3 = $conn->prepare($sql3);
  $res3->execute([$pid,$uid]);
  $solu = $res3->fetch(PDO::FETCH_ASSOC);
} else {
  header("Location:./problems.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeJudge | Admin Dashboard</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/chartist.min.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <?php
  require_once("./navbar.php");
  ?>
  <div class="container full-problem">
    <div class="row" style="height:100%;">
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
              <a class="nav-link active" aria-current="page" href="problems.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                  <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                <span class="ml-2">Coding Problems</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main class="col-md-9 ml-sm-auto col-lg-10 py-5" style="height:100%;">
        <div class="row" style="height:100%;">

          <div class="col-6 col-xl-6 mb-4 mb-lg-0" style="border-right: 2px solid black;">
            <h1 class="h2"><?php echo $prob["problem_title"] ?></h1>
            <pre><?php echo $prob["problem_statement"] ?></pre>
          </div>
          <div class="col-6 col-xl-6 mb-4 mb-lg-0">
            <textarea class="text_area"><?php echo $solu["problem_answer"] ?></textarea>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
</body>

</html>