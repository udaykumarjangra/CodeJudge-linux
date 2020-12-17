<?php
    session_start();
    require_once("backend/dbconn.php");
    if (isset($_SESSION["valid"])) {
        unset($_SESSION["valid"]);
        unset($_SESSION["uid"]);
    }
        session_destroy();
        header("Location:./login.php");
?>