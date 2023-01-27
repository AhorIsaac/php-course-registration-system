<?php
session_start();
require_once("../classes/Student.php"); 

$registration_number = ""; 
$password = "";

function check_if_empty($input)
{
    if(empty($input))
    {
        $_SESSION['input_error'] = TRUE;
        header('location: ../index.php');
        exit();
    }
}

function validate_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function valid_user($registration_number)
{
    $student = new Student(); 
    $valid = $student->valid_registration_number($registration_number); 
    if($valid)
    {
        return TRUE;
    }else
    {
        $_SESSION['invalid_user'] = TRUE;
        header('location: ../index.php');
        exit();
    }
}

function login($registration_number, $passwordEncrypt)
{
    $student = new Student(); 
    $login = $student->login($registration_number, $passwordEncrypt);

    if($login)
    {
        $_SESSION["id"] = $login["id"];
        $_SESSION["fullname"] = $login['fullname'];
        $_SESSION["level"] = $login["level"];
        $_SESSION["dob"] = $login["dob"]; 
        $_SESSION["reg_num"] = $login["reg_num"];

        $_SESSION["login_success"] = TRUE;
        header("location: ../views/student.php");
        exit();
    }
    else 
    {
        $_SESSION["wrong_password"] = TRUE;
        header("location: ../index.php");
        exit();
    }

}

if(isset($_POST['student_login']) && $_SERVER["REQUEST_METHOD"] == "POST")
{
    $registration_number = $_POST['registration_number'];
    $password = $_POST['password'];
    $passwordEncrypt = md5($password);

    check_if_empty($registration_number);
    check_if_empty($password);

    $registration_number = validate_input($registration_number); 
    valid_user($registration_number);
    login($registration_number, $passwordEncrypt);
}
