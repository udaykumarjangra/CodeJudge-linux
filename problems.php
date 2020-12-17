<?php
session_start();
require_once("backend/dbconn.php");
if (!isset($_SESSION["valid"]) || $_SESSION["type"] != "user") {
  header("Location:./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeJudge | Problems</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/chartist.min.css">
  <link rel="stylesheet" href="css/main.css">
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
              <a class="nav-link" aria-current="page" href="index.php">
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
              <a class="nav-link active" href="problems.php">
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
      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <h1 class="h2">Problems</h1>
        <br />
        <div class="row">
          <div class="col-12 col-xl-12 mb-4 mb-lg-0">
            <div class="card">
              <h5 class="card-header">List of Problems</h5>

              <div class="card-body">
                <?php
                $sql2 = "SELECT * FROM problems where `pid` NOT IN (SELECT `pid` FROM `problems_user` WHERE `uid`=?);";
                $res2 = $conn->prepare($sql2);
                $res2->execute([$_SESSION["uid"]]);
                $ans2 = $res2->fetchAll(PDO::FETCH_ASSOC);
                foreach ($ans2 as $prob) :
                ?>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Problem ID</th>
                          <th scope="col">Problem Name</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th width="15%" scope="row"><?php echo $prob["pid"] ?></th>
                          <td><a href="view_problem.php?pid=<?php echo $prob["pid"] ?>"><?php echo $prob["problem_title"] ?></a></td>
                          <td width="5%">C++</td>
                          <td width="5%">Python</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-12 mb-4 mb-lg-0">
            <div class="card">
              <h5 class="card-header">Solved Problems</h5>

              <div class="card-body">
                <?php
                $sql3 = "SELECT * FROM problems where `pid` IN (SELECT `pid` FROM `problems_user` WHERE `uid`=?);";
                $res3 = $conn->prepare($sql3);
                $res3->execute([$_SESSION["uid"]]);
                $ans3 = $res3->fetchAll(PDO::FETCH_ASSOC);
                foreach ($ans3 as $sprob) :
                ?>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Problem ID</th>
                          <th scope="col">Problem Name</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th width="15%" scope="row"><?php echo $sprob["pid"] ?></th>
                          <td><a href="view_solution.php?pid=<?php echo $sprob["pid"] ?>"><?php echo $sprob["problem_title"] ?></a></td>
                          <td width="5%">Solved</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
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