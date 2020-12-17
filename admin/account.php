<?php
session_start();
require_once("../backend/dbconn.php");
if (!isset($_SESSION["valid"]) || $_SESSION["type"] != "admin") {
  header("Location:../login.php");
}

if (isset($_POST["changename"])) {

  $sql = "SELECT `uid`, `username`, `password`, `email` FROM `user` WHERE `uid`=?";
  $res = $conn->prepare($sql);
  $res->execute([$_SESSION['uid']]);
  $ans = $res->fetch(PDO::FETCH_ASSOC);
  if (password_verify($_POST["pass"], $ans["password"])) {
    $sql = "UPDATE `user` SET `username`=? WHERE `uid`=?;";
    $conn->prepare($sql)->execute([$_POST["newname"], $_SESSION['uid']]);
    $_SESSION["username"]= $_POST["newname"];
    echo '<script>alert("Succesfully Updated the Username!");</script>';
  } else {
    echo '<script>alert("Wrong Password");</script>';
  }
}

if (isset($_POST["changepass"])) {

  $sql = "SELECT `uid`, `username`, `password`, `email` FROM `user` WHERE `uid`=?";
  $res = $conn->prepare($sql);
  $res->execute([$_SESSION['uid']]);
  $ans = $res->fetch(PDO::FETCH_ASSOC);
  if (password_verify($_POST["pass"], $ans["password"])) {
    $password = password_hash($_POST["newpass"], PASSWORD_BCRYPT);
    $sql = "UPDATE `user` SET `password`=? WHERE `uid`=?;";
    $conn->prepare($sql)->execute([$password, $_SESSION['uid']]);
    echo '<script>alert("Succesfully Updated the Password!");</script>';
  } else {
    echo '<script>alert("Wrong Password");</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeJudge | Account Settings Admin</title>
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
              <a class="nav-link active" aria-current="page" href="account.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                  <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                <span class="ml-2">Account Settings</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_problem.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                  <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                <span class="ml-2">Add Problem</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Account Settings (Admin)</li>
          </ol>
        </nav>
        <h1 class="h2">Account Settings</h1>
        <div class="row">
          <h5>Change Name</h5>
          <form action="account.php" method="POST">
            <div class="form-row align-items-center">
              <div class="col-sm-3 my-1">
                <label class="sr-only" for="newName">New Name</label>
                <input type="text" required name="newname" class="form-control" id="newName" placeholder="Name">
              </div>
              <div class="col-sm-3 my-1">
                <label class="sr-only" for="confirmPass1">Confirm Password</label>
                <div class="input-group">
                  <input type="password" required name="pass" class="form-control" id="confirmPass1" placeholder="Confirm Password">
                </div>
              </div>
              <div class="col-auto my-1">
                <button type="submit" name="changename" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>

        <hr />

        <div class="row">
          <h5>Change Password</h5>
          <form action="account.php" method="POST">
            <div class="form-row align-items-center">
              <div class="col-sm-3 my-1">
                <label class="sr-only" for="newPass">New Password</label>
                <input type="password" name="newpass" required class="form-control" id="inlineFormInputName" placeholder="New Password">
              </div>
              <div class="col-sm-3 my-1">
                <label class="sr-only" for="confirmPass2">Confirm Password</label>
                <div class="input-group">
                  <input type="password" name="pass" required class="form-control" id="confirmPass2" placeholder="Confirm Password">
                </div>
              </div>

              <div class="col-auto my-1">
                <button type="submit" name="changepass" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <hr />
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