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
</head>

<body class="sidebar-noneoverflow">

  <!--  BEGIN NAVBAR  -->
  <?php include"../component/_navbar.php" ?>
  <!--  END NAVBAR  -->

  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <?php include"../component/_sidebar.php"; ?>

    <!-- CONTENT AREA -->
    <?php include"../pages/data-transaksi-history.php"; ?>
    <!-- END MAIN CONTAINER -->

    <?php include "../component/_script.php"; ?>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>