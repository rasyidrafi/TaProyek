<?php
session_start();

// jika ada user yang berusaha masuk tanpa melalui login
if (!isset($_SESSION["role"])) {
  header("Location: ../login.php"); // alihkan ke halaman login
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../component/_head.php"; ?>

  <style>
    /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
    /*.navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }*/
    .layout-px-spacing {
      min-height: calc(100vh - 140px) !important;
    }
  </style>

  <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
</head>

<body class="sidebar-noneoverflow">


  <!--  BEGIN NAVBAR  -->
  <?php include "../component/_navbar.php" ?>
  <!--  END NAVBAR  -->

  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <?php include "../component/_sidebar.php"; ?>

    <!-- CONTENT AREA -->

    <?php include "../pages/data-menu.php"; ?>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <?php include "../component/_script.php"; ?>
</body>

</html>