<?php
    session_start();
    require_once("../backend/dbconn.php");
    if (!isset($_SESSION["valid"]) || $_SESSION["type"]!="user") {
        header("Location:./login.php");
    }
    $uid = $_SESSION["uid"];
?>
<?php
    if(isset($_REQUEST["language"]) && isset($_REQUEST["code"]))
    {
        $id = $_REQUEST["id"];
        $language = $_REQUEST["language"];
        $code = $_REQUEST["code"];
        $result = 0;
        
        $sql = "SELECT * FROM `problems` WHERE `pid`=?;";
        $res = $conn->prepare($sql);
        $res->execute([$id]);
        $ans = $res->fetch(PDO::FETCH_ASSOC);
        
        $inputfile = fopen("input.txt", "w") or die("Unable to open file!");
        fwrite($inputfile, $ans['testcase_input1']);
        fclose($inputfile);

        $inputfile2 = fopen("input2.txt", "w") or die("Unable to open file!");
        fwrite($inputfile2, $ans['testcase_input2']);
        fclose($inputfile2);
        
        if($language == "Cpp")
        {
            $myfile = fopen("file.cpp", "w") or die("Unable to open file!");
            fwrite($myfile, $code);
            $exec = shell_exec('g++ file.cpp');
            $exec = shell_exec('g++ file.cpp 2> error.txt');
            if(0 != filesize('error.txt'))
                echo readfile('error.txt');
            else
            {
                $output1 = shell_exec('cat input.txt | ./a.out');
                $output2 = shell_exec('cat input2.txt | ./a.out');
                if($output1 == $ans['testcase_output1'] && $output2 == $ans['testcase_output2'])
                {
                    
                    echo "Success";
                    $result = 1;
                }
                else
                    echo "Test cases fail";
            }
            fclose($myfile);
        }
        elseif($language == "Python")
        {
            $myfile = fopen("file.py", "w") or die("Unable to open file!");
            fwrite($myfile, $code);
            exec('cat input.txt | python3 file.py 2> error.txt');
            if(0 != filesize('error.txt'))
                echo readfile('error.txt');
            else
            {
                $output1 = shell_exec('cat input.txt | python3 file.py');
                $output2 = shell_exec('cat input2.txt | python3 file.py');
                if($output1 == $ans['testcase_output1'] && $output2 == $ans['testcase_output2'])
                {
                    echo "Success";
                    $result = 1;
                }
                else
                    echo "Test cases fail";
            }
            fclose($myfile);
        }

        if($result == 1)
        {
            $sql = "INSERT INTO `problems_user`(`pid`, `uid`, `problem_answer`) VALUES (?,?,?);";
            $conn->prepare($sql)->execute([$id, $uid, $code]);
        }

        if(file_exists('file.cpp'))
            unlink('file.cpp');
        if(file_exists('file.py'))
            unlink('file.py');
        if(file_exists('input.txt'))
            unlink('input.txt');
        if(file_exists('input2.txt'))
            unlink('input2.txt');
        if(file_exists('error.txt'))
            unlink('error.txt');
        if(file_exists('a.out'))
            unlink('a.out');
    }
?>
