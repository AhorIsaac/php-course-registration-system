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
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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

    <div class="jumbotron text-center bg-transparent shadow mt-5">
      <h3 class="course-heading"> Lorem ipsum dolor sit amet consectetur. </h3>
      <p class="justify-content-center">
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Perspiciatis ipsam animi aliquid ipsum! Dolorum numquam
        perspiciatis ducimus veniam? Perspiciatis eligendi laudantium itaque amet
        temporibus blanditiis tempora dignissimos laboriosam explicabo quisquam?
        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
        Veritatis animi illum rerum magnam laudantium quis aut consequatur
        sed nostrum, repellendus suscipit tempora quasi maxime quas. Voluptatem
        dolore corrupti repellat voluptatibus unde ut possimus deserunt vel nostrum,
        suscipit natus temporibus. Sunt, dolorem rerum?
        Minima dignissimos, maiores adipisci distinctio corporis quo quod!
      </p>
      <div class="text-center">
        <a href="admin-login.php" class="btn btn-outline-success btn-lg">
          <i class="fa fa-user-tie fa-1x"></i>
          Administrators
        </a>
        <a href="index.php" class="btn btn-outline-success btn-lg">
          <i class="fa fa-user-graduate fa-1x"></i>
          Students
        </a>
      </div>
      <p class="justify-content-center">
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Perspiciatis ipsam animi aliquid ipsum! Dolorum numquam
        perspiciatis ducimus veniam? Perspiciatis eligendi laudantium itaque amet
        temporibus blanditiis tempora dignissimos laboriosam explicabo quisquam?
        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
        Veritatis animi illum rerum magnam laudantium quis aut consequatur
        sed nostrum, repellendus suscipit tempora quasi maxime quas. Voluptatem
        dolore corrupti repellat voluptatibus unde ut possimus deserunt vel nostrum,
        suscipit natus temporibus. Sunt, dolorem rerum?
        Minima dignissimos, maiores adipisci distinctio corporis quo quod!
      </p>
    </div>


    <div class="jumbotron text-center fixed-bottom p-1 mt-2">
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