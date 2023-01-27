<?php 
session_start(); 

require_once('../classes/Student.php');

if (isset($_POST["add_student"]))
{
    $fullname = $_POST["fullname"];
    $dob = $_POST["dob"];
    $level = $_POST["level"];

    $random_number = mt_rand(10000, 99999);

    if ($level == 100) 
    {
        $reg_num = "20/" . (string)$random_number . "/UE"; 
    }
    else if ($level == 200) 
    {
        $reg_num = "19/" . (string)$random_number . "/UE";
    }
    else if ($level == 300)
    {
        $reg_num = "18/" . (string)$random_number . "/UE";
    }
    else if ($level == 400) 
    {
        $reg_num = "17/" . (string)$random_number . "/UE";
    }

    $fields = [
        "fullname" => $fullname,  
        "level" => $level, 
        "dob" => $dob, 
        "reg_num" => $reg_num, 
        "password" => md5($reg_num)
    ];

    $student = new Student(); 
    $add_student = $student->store($fields); 

    if ($add_student == truE) 
    {
        $_SESSION["student_reg_success"] = true; 
        header("location: ../views/admin.php");
    }
}


exit();
