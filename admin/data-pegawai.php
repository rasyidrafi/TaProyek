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
  <?php include"../component/_head.php"; ?>

  <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
</head>

<body class="sidebar-noneoverflow">

  <!-- BEGIN LOADER -->
  <div id="load_screen">
        <div class="loader"> 
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

  <!--  BEGIN NAVBAR  -->
  <?php include "../component/_navbar.php" ?>
  <!--  END NAVBAR  -->

  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <?php include "../component/_sidebar.php"; ?>

    <!-- CONTENT AREA -->

   <?php include "../pages/data-pegawai.php"; ?>
    <!-- END MAIN CONTAINER -->

    <?php include"../component/_script.php"; ?>
</body>

</html>