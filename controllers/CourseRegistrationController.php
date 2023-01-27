<?php
require_once("../classes/CourseRegistration.php");
session_start();
$ids = '';

if (isset($_POST['register_courses']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["id"];
    if (isset($_POST["courses"])) {
        foreach ($_POST["courses"] as $chk) {
            $ids .= $chk . ",";
        }

        $status = 0;

        $fields = [
            "student_id" => $user_id,
            "course_ids" => $ids,
            "status" => $status
        ];

        $course_registration = new CourseRegistration();
        $registration = $course_registration->store($fields);

        if ($registration) {
            $_SESSION["course_registration_success"] = true;
            header("location: ../views/student.php");
        }
    }
}

if (isset($_POST["approve_course"])) {
    $id = $_POST["course_reg_id"];

    $fields = [
        "status" => 1
    ];

    $course_reg = new CourseRegistration();
    $update = $course_reg->update($fields, $id);

    if ($update == True) {
        $output = [
            "statusCode" => 203
        ];
        echo json_encode($output);
    }
}
