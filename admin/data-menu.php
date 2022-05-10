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
        <!-- CONTENT AREA -->

        <div class="row layout-top-spacing">
          <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget widget-content-area br-4">
              <div class="widget-one">
                <div class="container">
                  <a href="#" class="btn btn-success mt-3">TAMBAH DAFTAR MENU</a>
                  <div class="row mt-3">
                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Bakso Urat</h5>
                          <label class="card-text harga">Rp. 13.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Mie Ayam</h5>
                          <label class="card-text">Rp. 13.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Nasi Goreng</h5>
                          <label class="card-text">Rp. 10.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Mie Ayam Bakso</h5>
                          <label class="card-text">Rp. 15.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Lele Bakar</h5>
                          <label class="card-text">Rp. 12.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Teh Obeng</h5>
                          <label class="card-text">Rp. 5.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Jus Alpukat</h5>
                          <label class="card-text">Rp. 10.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Es Jeruk</h5>
                          <label class="card-text">Rp. 8.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-3 mb-5">
                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Air Minum Sanford</h5>
                          <label class="card-text">Rp. 5.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark ">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Nasi Putih</h5>
                          <label class="card-text">Rp. 3.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Jus Mangga</h5>
                          <label class="card-text">Rp. 8.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="card border-dark">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Ayam Bakar</h5>
                          <label class="card-text">Rp. 17.000</label><br>
                          <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                          <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CONTENT AREA -->
      </div>
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <?php include"../component/_script.php"; ?>
</body>

</html>