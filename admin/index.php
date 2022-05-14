<?php
session_start();

// jika ada user yang berusaha masuk tanpa melalui login
if (!isset($_SESSION["role"])) {
  header("Location: ../login.php"); // alihkan ke halaman login
} else {
  header("Location: data-menu.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
  <title>Dashboard</title>
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet" />
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

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
  <script src="./middleware/index.js"></script>

 <!--  BEGIN NAVBAR  -->
 <?php include"../component/_navbar.php" ?>
  <!--  END NAVBAR  -->

  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <?php include"../component/_sidebar.php"; ?>

    <!-- CONTENT AREA -->

    <div id="content" class="main-content">
      <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
          <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget widget-content-area br-4">
              <div class="widget-one">

              </div>
            </div>
          </div>

          <!-- CONTENT AREA -->
        </div>
      </div>
      <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script>
      $(document).ready(function() {
        App.init();
      });
    </script>
    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>