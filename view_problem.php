<?php
    session_start();
    require_once("backend/dbconn.php");
    if (!isset($_SESSION["valid"]) || $_SESSION["type"]!="user") {
        header("Location:./login.php");
    }
    $uid = $_SESSION["uid"];
    $sql = "SELECT `uid`, `username`, `password`, `email` FROM `user` WHERE `uid`=?";
    $res = $conn->prepare($sql);
    $res->execute([$uid]);
    $ans = $res->fetch(PDO::FETCH_ASSOC);

    $sql2 = "SELECT * FROM problems where pid=?";
    $res2 = $conn->prepare($sql2);
    $res2->execute([$_REQUEST['pid']]);
    $ans2 = $res2->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeJudge | View Problem</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/chartist.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
                CodeJudge
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-4 col-lg-2">
        </div>
        <div class="col-12 col-md-5 col-lg-6 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="mr-3 mt-1">
              <?php echo $ans["username"] ?>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="account.php">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
              </div>
        </div>
    </nav>
    <div class="container full-problem">
        <div class="row" style="height:100%;">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="index.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span class="ml-2">Dashboard</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="account.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                            <span class="ml-2">Account Settings</span>
                          </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="problems.php">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                              <span class="ml-2">Coding Problems</span>
                            </a>
                        </li>
                      </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 py-5" style="height:100%;">
                <div class="row" style="height:100%;">
                    
                    <div class="col-6 col-xl-6 mb-4 mb-lg-0" style="border-right: 2px solid black;">
                        <?php
                          echo '
                            <h1 class="h2">'.$ans2["problem_title"].'</h1>
                            <br/><pre>'
                            .$ans2["problem_statement"].'</pre>';
                        ?>
                    </div>
                    <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                        <textarea class="text_area" id="source_code" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"></textarea>
                        <button type="submit" class="btn btn-primary" id="execute" value=<?php echo $ans2['pid']; ?>>Submit</button>
                        <form style="float: right;">
                            <div class="form-group">
                              <label for="languageSelect">Select Language</label>
                              <select class="form-control" id="languageSelect">
                                <option value="Cpp">C++ g++14</option>
                                <option value="Python">Python</option>
                              </select>
                            </div>
                          </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script src="execute.js"></script>
</body>
</html>
