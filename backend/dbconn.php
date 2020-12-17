<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$myDB = "codejudge";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>