<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $myDB = "codejudge";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE DATABASE codejudge";
        $conn->exec($sql);
        echo "Database created successfully<br>";
    } 
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = "CREATE TABLE `problems` (
        `pid` int(11) NOT NULL AUTO_INCREMENT,
        `problem_title` varchar(100) NOT NULL,
        `problem_statement` varchar(2000) NOT NULL,
        `testcase_input1` varchar(500) NOT NULL,
        `testcase_output1` varchar(500) NOT NULL,
        `testcase_input2` varchar(500) NOT NULL,
        `testcase_output2` varchar(500) NOT NULL,
         PRIMARY KEY(pid)
      );";
        
    if ($conn->query($sql1) === TRUE) {
        echo "Table problems created successfully";
    } else {
        echo "Error creating table: ";
    }

    $sql2 = "CREATE TABLE `problems_user` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `pid` int(11) NOT NULL,
        `uid` int(11) NOT NULL,
        `problem_answer` varchar(2000) NOT NULL,
         PRIMARY KEY(id)
      );";
        
    if ($conn->query($sql2) === TRUE) {
        echo "Table problems_user created successfully";
    } else {
        echo "Error creating table: ";
    }

    $sql3 = "CREATE TABLE `user` (
        `uid` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(20) NOT NULL,
        `password` varchar(60) NOT NULL,
        `email` varchar(50) NOT NULL,
         PRIMARY KEY(uid)
      );";
        
    if ($conn->query($sql3) === TRUE) {
        echo "Table user created successfully";
    } else {
        echo "Error creating table: ";
    }
?>