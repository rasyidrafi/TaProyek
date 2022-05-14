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
  <?php include "../component/_navbar.php" ?>
  <!--  END NAVBAR  -->

  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <?php include "../component/_sidebar.php"; ?>

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

    <?php include "../component/_script.php"; ?>
</body>

</html>