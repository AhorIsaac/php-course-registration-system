<?php
session_start();

if (!$_SESSION["secret_number"]) {
    header('location: admin-login.php');
}

require_once("../classes/Student.php");
require_once("../classes/Course.php");
require_once("../classes/CourseRegistration.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title> Course Registration System </title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../public/css/cosmo-bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="../public/css/style-5.css" type="text/css" rel="stylesheet">
    <link href="../public/font-awesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/font-awesome/css/fontawesome.css" type="text/css" rel="stylesheet">
    <link href="../public/jAlert/index-assets/css/style.css" rel="stylesheet">
    <link href="../public/jAlert/index-assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../public/jAlert/index-assets/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="../public/jAlert/src/jAlert.css" rel="stylesheet">
    <!-- scripts -->
    <!--- css files --->
    <!-- internal css --->
    <style>
        body {
            background: #f8f9fa;
            font-weight: bold;
            font-family: Klavika;
        }

        /* .card-body 
            {
                background: linear-gradient(90deg, 
                rgba(1, 1, 1, 0.1)0%,
                rgba(1, 1, 1, 0.1)30%,
                rgba(1, 1, 1, 0.1)70%,
                rgba(1, 1, 1, 0.1)100% ); 
            } */
    </style>
</head>

<body>
    <!-- onload="return hide_frames();" -->
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-success">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-outline-success">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>

            <div class="p-4">
                <h1>
                    <img src="../public/images/admin.jpeg" alt="admin" style="width: 150px; height: 150px; border-radius: 75px;" />
                    <a href="#" class="logo">
                        Administrator
                    </a>
                </h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active" onclick="return ShowCourseRegistration();">
                        <a href="#">
                            <span class="fa fa-pen-alt mr-3"></span> Registration
                        </a>
                    </li>
                    <li onclick="return ShowCourses();">
                        <a href="#"><span class="fa fa-list-alt mr-3"></span> Courses </a>
                    </li>
                    <li onclick="return ShowAddStudentFrame();">
                        <a href="#">
                            <span class="fa fa-user-graduate mr-3"></span> Add Student
                        </a>
                    </li>
                    <li onclick="return ShowStudentsFrame();">
                        <a href="#"><span class="fa fa-users mr-3"></span> Students </a>
                    </li>
                    <li>
                        <a href="../controllers/AdminLogoutController.php"><span class="fa fa-power-off mr-3"></span> Logout </a>
                    </li>
                </ul>

                <div class="footer">
                    <p>
                        &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved
                    </p>
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-1"> University </h2>

            <div class="mr-5 ml-5 justify-content-center">
                <?php
                if (isset($_SESSION["student_reg_success"])) {
                ?>
                    <div class="alert alert-success text-center alert-dismissible fade show" style="font-family: monospace; display: inline-block;">
                        <button class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6 class="alert-heading">
                            <i class="fa fa-user-graduate fa-2x"></i>
                            <i class="fa fa-check-circle fa-2x"></i>
                        </h6>
                        <p class=""> Student Registration Success! </p>
                    </div>

                <?php
                }
                unset($_SESSION["student_reg_success"]);
                ?>

            </div>

            <div class="m-auto justify-content-center">
                <?php
                if (isset($_SESSION["course_added_already"])) {
                ?>
                    <div class="alert alert-warning text-center alert-dismissible fade show" style="font-family: monospace; display: inline-block;">
                        <button class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6 class="alert-heading">
                            <i class="fa fa-book fa-1x"></i>
                            <i class="fa fa-check-circle fa-1x"></i>
                        </h6>
                        <p class=""> Course Already Added! </p>
                    </div>

                <?php
                }
                unset($_SESSION["course_added_already"]);
                ?>

                <?php
                if (isset($_SESSION["add_course_success"])) {
                ?>
                    <div class="alert alert-success text-center alert-dismissible fade show" style="font-family: monospace; display: inline-block;">
                        <button class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class=""> Course Added Successfully! </p>
                    </div>

                <?php
                }
                unset($_SESSION["add_course_success"]);
                ?>
            </div>


            <div class="row justify-content-center mt-4" id="add_student" style="display: none;">
                <div class="col-sm-6 col-md-6 mt-4">
                    <div class="card mt-5 shadow bg-transparent">
                        <div class="card-header bg-success">
                            <h3 class="course-heading"> Add Student </h3>
                        </div>
                        <div class="card-body">
                            <form action="../controllers/StudentController.php" method="POST">
                                <div class="form-group">
                                    <label for="reg_num"> Fullname </label>
                                    <input type="text" class="form-control border" id="fullname" name="fullname" placeholder="input students fullname" required />
                                </div>
                                <div class="form-group">
                                    <label for="reg_num"> Level </label>
                                    <select class="form-control border" id="level" name="level" required>
                                        <option value="" selected> Choose Level </option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reg_num"> Date of Birth </label>
                                    <input type="date" class="form-control border" id="dob" name="dob" required />
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-outline-dark btn-md" type="reset" name="reset" value="Reset" />
                                    <input class="btn btn-success btn-md" type="submit" name="add_student" value="Add" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shadow bg-white" id="students_frame" style="display: none;">
                <h3> <i class="fa fa-users fa-1x text-success"></i> Students </h3>
                <table class="table table-striped table-hover">
                    <thead class="bg-success">
                        <tr>
                            <th> Registration Number </th>
                            <th> Fullname </th>
                            <th> Date of Birth </th>
                            <th> Level </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $student = new Student();
                        $students = $student->students();

                        if (($students != false) || ($students != null)) {
                            foreach ($students as $std) {
                        ?>
                                <tr>
                                    <td> <?php echo $std->reg_num; ?> </td>
                                    <td> <?php echo $std->fullname; ?> </td>
                                    <td> <?php echo $std->dob; ?> </td>
                                    <td> <?php echo $std->level; ?> </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>


            <div class="jumbotron shadow bg-white" id="cos_reg_frame" style="display: none;">
                <h3> <i class="fa fa-users fa-1x text-success"></i> Students </h3>
                <table class="table table-striped table-hover">
                    <thead class="bg-success">
                        <tr>
                            <th> Registration Number </th>
                            <th> Fullname </th>
                            <th> Level </th>
                            <th> Details </th>
                            <th> Action </th>
                            <th> Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $course_registration = new CourseRegistration();
                        $course_registrations = $course_registration->course_registrations();

                        if (($course_registrations != false) || ($course_registrations != null)) {
                            foreach ($course_registrations as $course_registration) {
                        ?>
                                <tr>
                                    <td> <?php echo $course_registration->cos_reg_num; ?> </td>
                                    <td> <?php echo $course_registration->cos_reg_fullname; ?> </td>
                                    <td> <?php echo $course_registration->cos_reg_level; ?> </td>
                                    <td>
                                        <a href='#' class="btn btn-info btn-sm" id="get_course_reg_details" value="<?php echo $course_registration->stud_id; ?>">
                                            Details
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if ($course_registration->cos_reg_stat == 0) {
                                        ?>
                                            <a href='#' class="btn btn-info btn-sm" id="approve_course_reg" value="<?php echo $course_registration->cos_reg_id; ?>">
                                                Approve
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href='#' class="btn btn-success btn-sm disabled">
                                                Approved
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <span class="text-warning font-weight-bodld">
                                            <?php
                                            echo $course_registration->cos_reg_date
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>


            <div class="" id="courses" style="display: block">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="card mt-5 shadow bg-transparent">
                            <div class="card-header bg-success">
                                <h3 class="course-heading"> Add Course </h3>
                            </div>
                            <div class="card-body">
                                <form action="../controllers/CourseController.php" method="POST">
                                    <div class="form-group">
                                        <label for="reg_num"> Course Title </label>
                                        <input type="text" class="form-control border" id="title" name="title" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_num"> Course Code </label>
                                        <input type="text" class="form-control border" id="code" name="code" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_num"> Credit Unit </label>
                                        <input type="text" class="form-control border" id="unit" name="unit" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_num"> Lecturer </label>
                                        <input type="text" class="form-control border" id="lecturer" name="lecturer" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_num"> Level </label>
                                        <select class="form-control border" id="level" name="level" required>
                                            <option value="" selected> Choose Level </option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="300">300</option>
                                            <option value="400">400</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-outline-dark btn-md" type="reset" name="reset" value="Reset" />
                                        <input class="btn btn-success btn-md" type="submit" name="add_course" value="Add" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-8 col-lg-8">
                        <div class="card mt-5 shadow bg-transparent">
                            <div class="card-header bg-success">
                                <h3 class="course-heading"> List of all courses </h3>
                            </div>
                            <div class="card-body" style="overflow-y: scroll; height: 540px;">
                                <table class="table table-striped table-hover">
                                    <thead class="bg-secondary">
                                        <tr>
                                            <th> Title </th>
                                            <th> Code </th>
                                            <th> Unit </th>
                                            <th> Lecturer </th>
                                            <th> Level </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $course = new Course();
                                        $courses = $course->courses();

                                        if (($courses != false) || ($courses != null)) {
                                            foreach ($courses as $cs) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $cs->title; ?> </td>
                                                    <td> <?php echo $cs->code; ?> </td>
                                                    <td> <?php echo $cs->unit; ?> </td>
                                                    <td> <?php echo $cs->lecturer; ?> </td>
                                                    <td> <?php echo $cs->level; ?> </td>
                                                    <td>
                                                        <a href="#" id="cs_vw" class="btn btn-info btn-sm m-1" value="<?php echo $cs->id; ?>">
                                                            View
                                                        </a>
                                                        <a href="#" id="cs_upd" class="btn btn-warning btn-sm m-1" value="<?php echo $cs->id; ?>">
                                                            Update
                                                        </a>
                                                        <a href="#" id="cs_del" class="btn btn-danger btn-sm m-1 cs_del" value="<?php echo $cs->id; ?>">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- show course modal -->
            <div class="modal fade" id="show_course_modal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                <div class="modal-dialog bg-white">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="courseModalLabel"> Course Information </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="course-heading"> Course Title </h5>
                            <p class='text-success' id="title_"></p>

                            <h5 class="course-heading"> Course Code </h5>
                            <p class='text-success' id="code_"></p>

                            <h5 class="course-heading"> Course Unit </h5>
                            <p class='text-success' id="unit_"></p>

                            <h5 class="course-heading"> Course Lecturer </h5>
                            <p class='text-success' id="lecturer_"></p>

                            <h5 class="course-heading"> Level </h5>
                            <p class='text-success' id="level_"></p>


                        </div>
                    </div>
                </div>
            </div>
            <!-- end of show course modal -->

            <!--  update course modal -->
            <div class="modal fade" id="show_update_course_modal" tabindex="-1" aria-labelledby="updateCourseModalLabel" aria-hidden="true">
                <div class="modal-dialog bg-white">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="updateCourseModalLabel"> Update Course Information </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../controllers/CourseController.php" method="POST">
                                <input type="hidden" id="id_up" />
                                <div class="form-group">
                                    <label for="reg_num"> Course Title </label>
                                    <input type="text" class="form-control border" id="title_up" name="title_up" required />
                                </div>
                                <div class="form-group">
                                    <label for="reg_num"> Course Code </label>
                                    <input type="text" class="form-control border" id="code_up" name="code_up" required />
                                </div>
                                <div class="form-group">
                                    <label for="reg_num"> Credit Unit </label>
                                    <input type="text" class="form-control border" id="unit_up" name="unit_up" required />
                                </div>
                                <div class="form-group">
                                    <label for="reg_num"> Lecturer </label>
                                    <input type="text" class="form-control border" id="lecturer_up" name="lecturer_up" required />
                                </div>
                                <div class="form-group">
                                    <label for="reg_num"> Level </label>
                                    <input type="text" class="form-control border" id="level_up" name="level_up" required />
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-outline-success btn-md" type="submit" name="update_course" id="update_course" value="Update" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of update course modal -->


            <!--  course registration details modal -->
            <div class="modal fade" id="show_course_registration_details" tabindex="-1" aria-labelledby="updateCourseModalLabel" aria-hidden="true">
                <div class="modal-dialog bg-white">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="updateCourseModalLabel"> Course Registration Information </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="get_c_details">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end of show course registration details modal -->


        </div>
    </div>
    <!-- js scripts -->
    <script src="../public/scripts/jquery-3.5.1.js"> </script>
    <script src="../public/scripts/popper.min.js"> </script>
    <script src="../public/scripts/bootstrap.min.js"> </script>
    <script src="../public/scripts/util.js"> </script>
    <script src="../public/scripts/modal.js"> </script>
    <script src="../public/scripts/collapse.js"> </script>
    <script src="../public/scripts/tooltip.js"> </script>
    <script src="../public/scripts/popover.js"> </script>
    <script src="../public/scripts/modal-support.js"> </script>
    <script src="../public/font-awesome/js/all.js"> </script>
    <script src="../public/font-awesome/js/fontawesome.js"> </script>
    <script src="../public/scripts/main-5.js"></script>
    <script src="../public/jAlert/index-assets/js/google-code-prettify/prettify.js"></script>
    <script src="../public/jAlert/index-assets/js/respond.js"></script>
    <script src="../public/jAlert/src/jAlert.js"></script>
    <script src="../public/jAlert/src/jAlert-functions.js"></script>
    <script>
        function hide_frames() {
            $("#add_student").hide();
            $("#students_frame").hide();
            $("#cos_reg_frame").hide();
        };

        const ShowAddStudentFrame = () => {
            $("#add_student").show();
            $("#students_frame").hide();
            $("#courses").hide();
            $("#cos_reg_frame").hide();
            return;
        };

        const ShowStudentsFrame = () => {
            $("#add_student").hide();
            $("#students_frame").show();
            $("#courses").hide();
            $("#cos_reg_frame").hide();
            return;
        };

        const ShowCourses = () => {
            $("#add_student").hide();
            $("#students_frame").hide();
            $("#courses").show();
            $("#cos_reg_frame").hide();
            return;
        };

        const ShowCourseRegistration = () => {
            $("#add_student").hide();
            $("#students_frame").hide();
            $("#courses").hide();
            $("#cos_reg_frame").show();
            return;
        };
    </script>
    <script>
        $(document).on("click", "#cs_vw", function(e) {
            e.preventDefault();
            let course_id = $(this).attr("value");
            let cs_view = true;

            $.ajax({
                url: "../controllers/CourseController.php",
                type: "POST",
                data: {
                    cs_view: cs_view,
                    course_id: course_id
                },
                success: function(data) {
                    let data_decode = JSON.parse(data);
                    console.log(data);
                    $("#title_").html(`${data_decode.title}`);
                    $("#unit_").html(`${data_decode.unit}`);
                    $("#code_").html(`${data_decode.code}`);
                    $("#lecturer_").html(`${data_decode.lecturer}`);
                    $("#level_").html(`${data_decode.level}`);
                    $("#show_course_modal").modal("show");
                }
            });

        });
    </script>
    <script>
        $(document).on("click", "#cs_upd", function(e) {
            e.preventDefault();
            let course_id = $(this).attr("value");
            let cs_view = true;

            $.ajax({
                url: "../controllers/CourseController.php",
                type: "POST",
                data: {
                    cs_view: cs_view,
                    course_id: course_id
                },
                success: function(data) {
                    let data_decode = JSON.parse(data);
                    console.log(data);
                    $("#id_up").attr("value", `${data_decode.id}`);
                    $("#title_up").attr("value", `${data_decode.title}`);
                    $("#unit_up").attr("value", `${data_decode.unit}`);
                    $("#code_up").attr("value", `${data_decode.code}`);
                    $("#lecturer_up").attr("value", `${data_decode.lecturer}`);
                    $("#level_up").attr("value", `${data_decode.level}`);
                    $("#show_update_course_modal").modal("show");
                }
            });

        });
    </script>
    <script>
        $('.cs_del').on('click', function(e) {
            let course_id = $(this).attr("value");
            let cs_del = true;
            e.preventDefault();

            confirm(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "../controllers/CourseController.php",
                        type: "POST",
                        data: {
                            course_id: course_id,
                            cs_del: cs_del
                        },
                        success: function(data) {
                            let data_decode = JSON.parse(data);
                            if (data_decode.statusCode == 203) {
                                $("#courses").load('../includes/courses.php');
                                successAlert('Course Deleted Succesfully!');
                            }
                        }
                    });
                },
                function() {
                    errorAlert('Denied');
                });
            return false;
        });
    </script>
    <script>
        $(document).on("click", "#update_course", function(event) {
            event.preventDefault();
            let id = $("#id_up").val();
            let title = $("#title_up").val();
            let unit = $("#unit_up").val();
            let code = $("#code_up").val();
            let lecturer = $("#lecturer_up").val();
            let level = $("#level_up").val();
            let update_course = true;

            $.ajax({
                url: "../controllers/CourseController.php",
                type: "POST",
                data: {
                    id: id,
                    title: title,
                    unit: unit,
                    code: code,
                    lecturer: lecturer,
                    level: level,
                    update_course: update_course
                },
                success: function(data) {
                    let data_decode = JSON.parse(data);
                    if (data_decode.statusCode == 201) {
                        $("#courses").load('../includes/courses.php');
                        $.jAlert({
                            'title': 'Success!',
                            'content': 'Course successfully updated.',
                            'theme': 'green',
                            'closeOnClick': true
                        });
                    }

                    $("#id_up").attr("value", "");
                    $("#title_up").attr("value", "");
                    $("#unit_up").attr("value", "");
                    $("#code_up").attr("value", "");
                    $("#lecturer_up").attr("value", "");
                    $("#level_up").attr("value", "");
                    $("#show_update_course_modal").modal("hide");
                }
            });

        });
    </script>
    <script>
        $('#approve_course_reg').on('click', function(e) {
            let course_reg_id = $(this).attr("value");
            let approve_course = true;
            e.preventDefault();

            confirm(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "../controllers/CourseRegistrationController.php",
                        type: "POST",
                        data: {
                            course_reg_id: course_reg_id,
                            approve_course: approve_course
                        },
                        success: function(data) {
                            let data_decode = JSON.parse(data);
                            if (data_decode.statusCode == 203) {
                                $("#cos_reg_frame").load('../includes/course_registrations.php');
                                successAlert('Course Registration Approved Succesfully!');
                            }
                        }
                    });
                },
                function() {
                    errorAlert('Denied');
                });
            return false;
        });
    </script>
    <script>
        $('#get_course_reg_details').on('click', function(e) {
            $("#show_course_registration_details").modal('hide');
            e.preventDefault();
            let id = $(this).attr("value");

            $.ajax({
                url: "../includes/single_course_registration.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    let data_decode = JSON.parse(data);
                    console.log(data_decode);
                    $("#get_c_details").html(`${data_decode.output}`);
                    $("#show_course_registration_details").modal('show');
                }
            });

        });
    </script>
</body>

</html>