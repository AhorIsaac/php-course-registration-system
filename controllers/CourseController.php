<?php 
session_start(); 

require_once('../classes/Course.php');

if (isset($_POST["add_course"]))
{
    $title = $_POST["title"];
    $code = $_POST["code"];
    $unit = $_POST["unit"];
    $lecturer = $_POST["lecturer"];


    $fields = [
        "title" => $title,  
        "code" => $code,  
        "unit" => $unit, 
        "lecturer" => $lecturer
    ];

    $course = new Course(); 
    $course_added_already = $course->course_added_already($code); 
    
    if ($course_added_already->code == $code) 
    {
        $_SESSION["course_added_already"] = true; 
        header("location: ../views/admin.php");
    }
    else 
    {
        $add_course = $course->store($fields); 

        if ($add_course == truE) 
        {
            $_SESSION["add_course_success"] = true; 
            header("location: ../views/admin.php");
        }
    }
}


if (isset($_POST["cs_view"]))
{
    $course_id = $_POST["course_id"];  
    $course = new Course(); 
    $get_course = $course->course_($course_id); 
    $course_ = [ 
        "id" => $get_course->id,
        "title" => $get_course->title, 
        "code" => $get_course->code, 
        "unit" => $get_course->unit, 
        "lecturer" => $get_course->lecturer, 
        "level" => $get_course->level
    ]; 
    echo json_encode($course_); 
}

if (isset($_POST["update_course"]))
{
    $id = $_POST["id"];
    $title = $_POST['title']; 
    $unit = $_POST["unit"]; 
    $code = $_POST["code"]; 
    $lecturer = $_POST['lecturer']; 
    $level = $_POST["level"];

    $fields = [
        "title" => $title, 
        "unit" => $unit, 
        "code" => $code, 
        "lecturer" => $lecturer, 
        "level" => $level 
    ]; 

    $course = new Course(); 
    $update = $course->update($fields, $id); 

    if ($update == True) 
    {
        $output = [
            "statusCode" => 201 
        ]; 
        echo json_encode($output); 
    }
}

if (isset($_POST["cs_del"])) 
{
    $id = $_POST["course_id"]; 
    $course = new Course();  
    $delete = $course->delete($id); 

    if ($delete == tRUE) 
    {
        $output = [
            "statusCode" => 203
        ]; 
        echo json_encode($output);          
    } 
}

exit();
