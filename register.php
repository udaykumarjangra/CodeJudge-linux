<?php
session_start();
require_once("backend/dbconn.php");
if (isset($_SESSION["valid"])) {
    header("Location:./index.php");
}

if (filter_has_var(INPUT_POST, 'register')) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $password = password_hash($pass, PASSWORD_BCRYPT);

    $sql = "INSERT INTO `user`(`username`, `password`, `email`) VALUES (?,?,?);";
    $conn->prepare($sql)->execute([$username, $password, $email]);
    header("Location:./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeJudge | Register</title>
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
        </div>
        <div class="col-12 col-md-4 col-lg-2">
        </div>
        <div class="col-12 col-md-5 col-lg-6 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="mr-3 mt-1">
                Not Logged In
            </div>
        </div>
    </nav>
    <div class="container my-auto full">
        <div class="row">
            <main class="col-md-10 col-lg-12 my-auto px-md-4 py-4" style="height:100%;">
                <div class="row">
                    <div class="col-6 col-xl-6 mx-auto">
                        <h5>Register</h5>
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                            </div>
                            <br />
                            <button type="submit" name="register" class="btn btn-primary">Register</button>

                            <small id="emailHelp" style="float:right;" class="form-text text-muted ">Already Registered? <a href="login.php">Login</a></small>
                        </form>
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