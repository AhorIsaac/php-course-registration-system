<?php
session_start();
require_once("../classes/Admin.php"); 

$secret_number = ""; 
$password = "";

function check_if_empty($input)
{
    if(empty($input))
    {
        $_SESSION['input_error'] = TRUE;
        header('location: ../views/admin-login.php');
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

function valid_user($secret_number)
{
    $admin = new Admin(); 
    $valid = $admin->valid_secret_number($secret_number); 
    if($valid)
    {
        return TRUE;
    }else
    {
        $_SESSION['invalid_user'] = TRUE;
        header('location: ../views/admin-login.php');
        exit();
    }
}

function login($secret_number, $passwordEncrypt)
{
    $admin = new Admin(); 
    $login = $admin->login($secret_number, $passwordEncrypt);

    if($login)
    {
        $_SESSION["admin_id"] = $login->id;
        $_SESSION["secret_number"] = $login->secret_number; 

        $_SESSION["login_success"] = TRUE;
        header("location: ../views/admin.php");
        exit();
    }
    else 
    {
        $_SESSION["wrong_password"] = TRUE;
        header("location: ../views/admin-login.php");
        exit();
    }

}

if(isset($_POST['admin_login']) && $_SERVER["REQUEST_METHOD"] == "POST")
{
    $secret_number = $_POST['secret_number'];
    $password = $_POST['password'];
    $passwordEncrypt = md5($password);

    check_if_empty($secret_number);
    check_if_empty($password);

    $secret_number = validate_input($secret_number); 
    valid_user($secret_number);
    login($secret_number, $passwordEncrypt);
}
