<?php
session_start();

if (!$_SESSION["reg_num"]) {
    header('location: index.php');
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
    <!--- css files --->
    <!-- internal css --->
    <style>
        body {
            /* background-image: url('../public/images/bg-1.jpg'); */
            background-size: cover;
            background-attachment: fixed;
            font-weight: bold;
            font-family: Klavika;
        }

        #register_course_frame {
            background: linear-gradient(90deg,
                    rgba(1, 1, 1, 0.1)0%,
                    rgba(1, 1, 1, 0.1)30%,
                    rgba(1, 1, 1, 0.1)70%,
                    rgba(1, 1, 1, 0.1)100%);
        }
    </style>
</head>

<body onload="return hide_frames();">
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
                    <img src="../public/images/student.jpeg" alt="student" style="width: 150px; height: 150px; border-radius: 75px;" />
                    <a href="#" class="logo">
                        <?php echo $_SESSION["fullname"]; ?>
                    </a>
                </h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active" onclick="return ShowRegisterCoursesFrame();">
                        <a href="#"><span class="fa fa-check-circle mr-3"></span> Register Courses </a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-list-alt mr-3"></span> Profile </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-newspaper mr-3"></span> News
                        </a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-pen-alt mr-3"></span> Examination </a>
                    </li>
                    <li>
                        <a href="../controllers/StudentLogoutController.php"><span class="fa fa-power-off mr-3"></span> Logout </a>
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
            <h2 class="mb-4"> University </h2>


            <div class="mr-5 ml-5 justify-content-center">
                <?php
                if (isset($_SESSION["course_registration_success"])) {
                ?>
                    <div class="alert alert-success text-center alert-dismissible fade show" style="font-family: monospace; display: inline-block;">
                        <button class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6 class="alert-heading">
                            <i class="fa fa-user-graduate fa-2x"></i>
                            <i class="fa fa-check-circle fa-2x"></i>
                        </h6>
                        <p class=""> Course Registration Success! </p>
                    </div>

                <?php
                }
                unset($_SESSION["course_registration_success"]);
                ?>
            </div>


            <div class="row justify-content-center mt-4 jumbotron-fluid border shadow" id="register_course_frame">
                <div class="col-sm-4 col-md-4 mt-4">
                    <img src="../public/images/student.jpeg" alt="student" style="width: 150px; height: 150px; border-radius: 75px;" />
                    <h3 class="course-heading text-info">
                        <?php echo $_SESSION["fullname"]; ?>
                    </h3>
                    <p class="font-weight-bold">
                        Level:
                        <?php echo $_SESSION["level"]; ?>
                    </p>
                    <p class="font-weight-bold">
                        Registration Number:
                        <?php echo $_SESSION["reg_num"]; ?>
                    </p>
                    <p class="font-weight-bold">
                        Programme: Degree.
                    </p>
                    <p class="font-weight-bold">
                        Duration: 4 Years.
                    </p>
                    <p class="font-weight-bold">
                        Course Option: Lorem, ipsum
                    </p>
                    <?php
                    $course_registration = new CourseRegistration();
                    $my_course_registration = $course_registration->my_registration($_SESSION["id"]);
                    if (($my_course_registration != false) && ($my_course_registration != null)) {
                        foreach ($my_course_registration as $cos_reg) {
                            if ($cos_reg->status == 0) {
                    ?>
                                <a href="#" class="btn btn-info btn-md">
                                    Your course registration is yet to be approved!
                                </a>
                            <?php
                            } else {
                            ?>
                                <a href="#" class="btn btn-success btn-md">
                                    Your course registration has been approved!
                                    <i class="fa fa-certificate fa-1x"></i>
                                </a>
                            <?php
                            }
                            ?>
                            <p class="font-weight-bold mt-4 text-secondary text-center">
                                <i class="fa fa-clock fa-1x"></i>
                                <?php
                                echo $cos_reg->date
                                ?>
                            </p>
                    <?php

                        }
                    }
                    ?>
                </div>

                <?php
                $course_registration = new CourseRegistration();
                $my_course_registration = $course_registration->my_registration($_SESSION["id"]);
                //$my_course_registration = true;  

                if ($my_course_registration == false) {
                ?>

                    <div class="col-sm-6 col-md-6 mt-1 mb-2">
                        <div class="card mt-3 bg-transparent">
                            <div class="card-header bg-success">
                                <h3 class="course-heading"> Course Registration </h3>
                            </div>
                            <div class="card-body" style="overflow-y: scroll; height: 450px;">
                                <form action="../controllers/CourseRegistrationController.php" method="POST">
                                    <table class="table table-striped table-hover">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th>
                                                    <label class="mr-3">
                                                        <input type="checkbox" class="mr-1" name="" id="select_all" onclick="return SelectAll();" />
                                                    </label>
                                                </th>
                                                <th> SN </th>
                                                <th> Code </th>
                                                <th> Title </th>
                                                <th> Unit </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $course = new Course();
                                            $my_courses = $course->my_courses($_SESSION["level"]);

                                            if (($my_courses != false) || ($my_courses != null)) {
                                                $num = 1;
                                                $total = 0;
                                                foreach ($my_courses as $cs) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <label class="mr-3">
                                                                <input type="checkbox" class="mr-1 ck_bx" name="courses[]" value="<?php echo $cs->id; ?>" />
                                                            </label>
                                                        </td>
                                                        <td> <?php echo $num; ?> </td>
                                                        <td> <?php echo $cs->code; ?> </td>
                                                        <td>
                                                            <?php echo $cs->title; ?>
                                                            <br />
                                                            <span class='text-warning'>
                                                                <?php echo $cs->lecturer; ?>
                                                            </span>
                                                        </td>
                                                        <td> <?php echo $cs->unit; ?> </td>
                                                    </tr>
                                                <?php
                                                    $num++;
                                                    $total = $total + (int)$cs->unit;
                                                }
                                            } else {
                                                ?>
                                                <h2 class="course-heading text-warning">
                                                    Your courses have not been uploaded!
                                                </h2>
                                            <?php
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-right"> Total </td>
                                                <td>
                                                    <?php echo $total; ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="form-group">
                                        <input class="btn btn-dark btn-sm" type="reset" name="reset" value="Reset" />
                                        <input class="btn btn-success btn-sm" type="submit" name="register_courses" value="Register" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-sm-6 col-md-6 mt-3 mb-2">
                        <h3 class="course-heading">
                            Course Registration Details
                            <i class="fa fa-check-circle text-success fa-1x"></i>
                        </h3>


                        <table class="table table-striped table-hover">
                            <thead class="bg-secondary">
                                <tr>
                                    <th> SN </th>
                                    <th> Code </th>
                                    <th> Title </th>
                                    <th> Unit </th>
                                </tr>
                            </thead>
                            <tbody style="overflow-y: scroll; height: 400px;">
                                <?php
                                $course_registration = new CourseRegistration();
                                $my_courses = $course_registration->my_registration($_SESSION["id"]);

                                if (($my_courses != false) || ($my_courses != null)) {
                                    foreach ($my_courses as $my_course) {
                                        $course_ids = chop((string)$my_course->course_ids, ",");
                                        $ids = explode(",", $course_ids);

                                        $num = 1;
                                        $total = 0;
                                        foreach ($ids as $id) {
                                            $course = new Course();
                                            $cs = $course->course_($id); ?>
                                            <tr>
                                                <td> <?php echo $num; ?> </td>
                                                <td> <?php echo $cs->code; ?> </td>
                                                <td>
                                                    <?php echo $cs->title; ?>
                                                    <br />
                                                    <span class='text-danger'>
                                                        <?php echo $cs->lecturer; ?>
                                                    </span>
                                                </td>
                                                <td> <?php echo $cs->unit; ?> </td>
                                            </tr>
                                <?php
                                            $num++;
                                            $total = $total + (int)$cs->unit;
                                        }
                                    }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right"> Total </td>
                                    <td>
                                        <?php echo $total; ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php
                }
                ?>

            </div>

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
        }

        const ShowAddStudentFrame = () => {
            $("#add_student").show();
            $("#students_frame").hide();
            $("#courses").hide();
            return;
        };

        const ShowStudentsFrame = () => {
            $("#add_student").hide();
            $("#students_frame").show();
            $("#courses").hide();
            return;
        };

        const ShowCourses = () => {
            $("#add_student").hide();
            $("#students_frame").hide();
            $("#courses").show();
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
                    $("#show_course_modal").modal("show");
                }
            })

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
                    $("#show_update_course_modal").modal("show");
                }
            })

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
                    $("#show_update_course_modal").modal("hide");
                }
            });

        })
    </script>
    <script>
        const SelectAll = () => {
            $(".ck_bx").click();
        };
    </script>
</body>

</html>