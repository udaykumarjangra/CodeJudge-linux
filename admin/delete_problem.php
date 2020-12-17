<?php
session_start();
require_once("../backend/dbconn.php");
if (!isset($_SESSION["valid"]) || $_SESSION["type"] != "admin") {
  header("Location:../login.php");
}
$pid = $_GET["pid"];
$sql = "DELETE FROM `problems` WHERE `pid`=?";
$conn->prepare($sql)->execute([$pid]);
header("Location:./index.php");
?>