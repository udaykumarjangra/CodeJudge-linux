<?php
session_start();
require_once("backend/dbconn.php");
if (isset($_SESSION["valid"])) {
    header("Location:./index.php");
}

if (filter_has_var(INPUT_POST, 'login')) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT `uid`, `username`, `password`, `email` FROM `user` WHERE `email`=?";
    $res = $conn->prepare($sql);
    $res->execute([$email]);
    $ans = $res->fetch(PDO::FETCH_ASSOC);
    if (password_verify($pass, $ans["password"])) {
        $_SESSION["uid"] = $ans["uid"];
        $_SESSION["username"] = $ans["username"];
        $_SESSION["valid"] = true;
        if($email=="admin@admin.com"){
            $_SESSION["type"]="admin";
            header("Location:admin/index.php");
        }
        else{
            $_SESSION["type"] = "user";
            header("Location:./index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeJudge | Login</title>
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
                        <h5>Login</h5>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <br />
                            <button type="submit" name="login" class="btn btn-primary">Login</button>

                            <small id="emailHelp" style="float:right;" class="form-text text-muted ">New User? <a href="register.php">Register Now</a></small>
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