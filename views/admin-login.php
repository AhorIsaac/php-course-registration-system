<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title> Course Registration System </title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../public/css/cosmo-bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="../public/font-awesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/font-awesome/css/fontawesome.css" type="text/css" rel="stylesheet">
    <!--- css files --->
    <!-- internal css --->
    <style>
        body {
            background-image: url('../public/images/bg-1.jpg');
            background-size: cover;
            background-attachment: fixed;
            font-weight: bold;
            font-family: Klavika;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="#">University</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">News</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Faculties
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Science</a>
                            <a class="dropdown-item" href="#">Engineering</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Computer Science</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Arts</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>


        <div class="row justify-content-center mt-5">
            <div class="col-sm-6 col-md-6 mt-5">
                <div class="card mt-5 shadow bg-transparent">
                    <div class="card-header bg-success">
                        <h3 class="course-heading"> Administrator Login </h3>

                        <?php
                        if (isset($_SESSION['invalid_user'])) {
                        ?>
                            <div class='alert alert-warning alert-dismissible fade show d-inline-block' role="alert" id="msg_frame">
                                <button type='button' class="close" data-dismiss="alert">
                                    <i class='fa fa-times-circle fa-1x'></i>
                                </button>
                                <h6 class="alert-heading font-weight-bold"> Login Failed! </h6>
                                <p class="text-dark font-weight-bold">
                                    <i class="fa fa-user-times fa-1x"></i> Invalid Secret Number!
                                </p>
                            </div>
                        <?php
                        }
                        unset($_SESSION['invalid_user']);
                        ?>


                        <?php
                        if (isset($_SESSION['input_error'])) {
                        ?>
                            <div class='alert alert-danger alert-dismissible fade show d-inline-block' role="alert" id="msg_frame">
                                <button type='button' class="close" data-dismiss="alert">
                                    <i class='fa fa-times-circle fa-1x'></i>
                                </button>
                                <h6 class="alert-heading font-weight-bold"> All input fields are required! </h6>
                            </div>
                        <?php
                        }
                        unset($_SESSION['input_error']);
                        ?>

                        <?php
                        if (isset($_SESSION["wrong_password"])) {
                        ?>
                            <div class='alert alert-warning alert-dismissible fade show d-inline-block' role="alert" id="msg_frame">
                                <button type='button' class="close" data-dismiss="alert">
                                    <i class='fa fa-times-circle fa-1x'></i>
                                </button>
                                <h6 class="alert-heading font-weight-bold"> Login Failed! </h6>
                                <p class='text-dark font-weight-bold'>
                                    <i class="fa fa-user-shield fa-1x"></i> Invalid Password!
                                </p>
                            </div>
                        <?php
                        }
                        unset($_SESSION["wrong_password"]);
                        ?>


                    </div>
                    <div class="card-body">
                        <form method="POST" action="../controllers/AdminLoginController.php">
                            <div class="form-group">
                                <label for="reg_num"> Secret Number </label>
                                <input type="text" class="form-control" id="secret_number" name="secret_number" />
                            </div>
                            <div class="form-group">
                                <label for="reg_num"> Password </label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                            <div class="form-group">
                                <input class="btn btn-outline-dark btn-md" type="reset" name="reset" value="Reset" />
                                <input class="btn btn-success btn-md" type="submit" name="admin_login" value="Login" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="jumbotron text-center p-1 mt-2 fixed-bottom">
            <h2 class="text-success font-weight-bold">
                University
            </h2>
            <p class="">
                <i class="fab fa-facebook fa-2x m-2"></i>
                <i class="fab fa-whatsapp fa-2x m-2"></i>
                <i class="fab fa-twitter fa-2x m-2"></i>
                <i class="fab fa-linkedin fa-2x m-2"></i>
                <i class="fab fa-instagram fa-2x m-2"></i>
            </p>
            <p class="font-weight-bold">
                <script>
                    let date_ = new Date();
                    document.write(date_.getFullYear())
                </script>
            </p>
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
</body>

</html>