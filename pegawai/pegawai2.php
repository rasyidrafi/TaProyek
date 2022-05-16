<?php
    session_start();

    // // jika ada user yang berusaha masuk tanpa melalui login
    // if (!isset($_SESSION["login"])) {
    //     header("Location: ../login.php"); // alihkan ke halaman login
    //     exit;
    // }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
    />
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link
      href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="../bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
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
    <div class="header-container fixed-top">
      <header class="header navbar navbar-expand-sm">
        <ul class="navbar-nav theme-brand flex-row text-center">
          <li class="nav-item theme-logo">
            <a href="Dashboard.html">
              <img
                src="../assets/img/90x90.jpg"
                class="navbar-logo"
                alt="logo"
              />
            </a>
          </li>
          <li class="nav-item theme-text">
            <a href="Dashboard.html" class="nav-link"> CORK </a>
          </li>
          <li class="nav-item toggle-sidebar">
            <a
              href="javascript:void(0);"
              class="sidebarCollapse"
              data-placement="bottom"
              ><svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-list"
              >
                <line x1="8" y1="6" x2="21" y2="6"></line>
                <line x1="8" y1="12" x2="21" y2="12"></line>
                <line x1="8" y1="18" x2="21" y2="18"></line>
                <line x1="3" y1="6" x2="3" y2="6"></line>
                <line x1="3" y1="12" x2="3" y2="12"></line>
                <line x1="3" y1="18" x2="3" y2="18"></line></svg>
              </a>
          </li>
        </ul>

        <ul class="navbar-item flex-row navbar-dropdown ml-auto">
          <li
            class="nav-item dropdown user-profile-dropdown order-lg-0 order-1"
          >
            <a
              href="javascript:void(0);"
              class="nav-link dropdown-toggle user"
              id="userProfileDropdown"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-settings"
              >
                <circle cx="12" cy="12" r="3"></circle>
                <path
                  d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"
                ></path>
              </svg>
            </a>
            <div
              class="dropdown-menu position-absolute"
              aria-labelledby="userProfileDropdown"
            >
              <div class="user-profile-section">
                <div class="media mx-auto">
                  <img
                    src="../assets/img/90x90.jpg"
                    class="img-fluid mr-2"
                    alt="avatar"
                  />
                  <div class="media-body">
                    <h5>Sonia Shaw</h5>
                    <p>Project Leader</p>
                  </div>
                </div>
              </div>
              <div class="dropdown-item">
                <a href="user_profile.html">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-user"
                  >
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                  <span>My Profile</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="apps_mailbox.html">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-inbox"
                  >
                    <polyline
                      points="22 12 16 12 14 15 10 15 8 12 2 12"
                    ></polyline>
                    <path
                      d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"
                    ></path>
                  </svg>
                  <span>My Inbox</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="auth_lockscreen.html">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-lock"
                  >
                    <rect
                      x="3"
                      y="11"
                      width="18"
                      height="11"
                      rx="2"
                      ry="2"
                    ></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                  </svg>
                  <span>Lock Screen</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="javascript:middleware.logout()">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-log-out"
                  >
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                  </svg>
                  <span>Log Out</span>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
      <div class="overlay"></div>
      <div class="search-overlay"></div>

      <!--  BEGIN SIDEBAR  -->
      <div class="sidebar-wrapper sidebar-theme">
        <nav id="sidebar">
          <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
              <img src="../assets/img/90x90.jpg" alt="avatar" />
              <h6 class="">Sonia Shaw</h6>
              <p class="">Project Leader</p>
            </div>
          </div>
          <div class="shadow-bottom"></div>
          <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu active">
              <a
                href="javascript:void(0);"
                aria-expanded="true"
                class="dropdown-toggle"
              >
                <div class="">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-home"
                  >
                    <path
                      d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                    ></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                  </svg>
                  <span> Dashboard</span>
                </div>
              </a>
            </li>

            <li class="menu">
              <a
                href="#submenu"
                data-toggle="collapse"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-airplay"
                  >
                    <path
                      d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"
                    ></path>
                    <polygon points="12 15 17 21 7 21 12 15"></polygon>
                  </svg>
                  <span> Menu 2</span>
                </div>
              </a>
            </li>

            <li class="menu">
              <a
                href="#submenu2"
                data-toggle="collapse"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-file"
                  >
                    <path
                      d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"
                    ></path>
                    <polyline points="13 2 13 9 20 9"></polyline>
                  </svg>
                  <span> Menu 3</span>
                </div>
                <div>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-chevron-right"
                  >
                    <polyline points="9 18 15 12 9 6"></polyline>
                  </svg>
                </div>
              </a>
              <ul
                class="collapse submenu list-unstyled"
                id="submenu2"
                data-parent="#accordionExample"
              >
                <li>
                  <a href="javascript:void(0);"> Submenu 1 </a>
                </li>
                <li>
                  <a
                    href="#sm2"
                    data-toggle="collapse"
                    aria-expanded="false"
                    class="dropdown-toggle"
                  >
                    Submenu 2
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-chevron-right"
                    >
                      <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                  </a>
                  <ul
                    class="collapse list-unstyled sub-submenu"
                    id="sm2"
                    data-parent="#submenu2"
                  >
                    <li>
                      <a href="javascript:void(0);"> Sub-Submenu 1 </a>
                    </li>
                    <li>
                      <a href="javascript:void(0);"> Sub-Submenu 2 </a>
                    </li>
                    <li>
                      <a href="javascript:void(0);"> Sub-Submenu 3 </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>

            <li class="menu">
              <a
                href="#starter-kit"
                data-toggle="collapse"
                aria-expanded="falser"
                class="dropdown-toggle"
              >
                <div class="">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-terminal"
                  >
                    <polyline points="4 17 10 11 4 5"></polyline>
                    <line x1="12" y1="19" x2="20" y2="19"></line>
                  </svg>
                  <span>Starter Kit</span>
                </div>
                <div>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-chevron-right"
                  >
                    <polyline points="9 18 15 12 9 6"></polyline>
                  </svg>
                </div>
              </a>
              <ul
                class="collapse submenu recent-submenu mini-recent-submenu list-unstyled"
                id="starter-kit"
                data-parent="#accordionExample"
              >
                <li class="">
                  <a href="starter_kit_blank_page.html"> Blank Page </a>
                </li>
                <li>
                  <a href="starter_kit_boxed.html"> Boxed </a>
                </li>
                <li>
                  <a href="starter_kit_collapsible_menu.html"> Collapsible </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
      <!--  END SIDEBAR  -->

      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
        <div class="layout-px-spacing">
          <!-- CONTENT AREA -->

          <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
              <div class="widget widget-content-area br-4">
                <div class="widget-one">
                  <div class="col-12">
                  <?php

                //mengenalkan variabel teks
                $SqlPeriode = "";
                $awalTgl = "";
                $akhirTgl = "";
                $tglAwal = "";
                $tglAkhir = "";

                if(isset($_POST['btnTampil'])) {
                    $tglAwal =isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-y');
                    $tglAkhir =isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-y');
                    $SqlPeriode = " where A.tglpesanan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'";
                }
                else{
                    $awalTgl = "01-".date('m-y');
                    $akhirTgl = date('d-m-y');

                    $SqlPeriode = " where A.tglpesanan BETWEEN '".$awalTgl."' AND '".$akhirTgl."'";
                }

                ?>

                <main class="page shopping-cart-page">
                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Data Pemesanan</h3>
                        <h4>Periode Tanggal <b><?php echo ($tglAwal); ?></b> s/d <b><?php echo ($tglAkhir); ?></b></h4>
                        <div class="card shadow">
                            <div class="card-header py=3">
                    </div>
                    <div class="card-body">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" nama="form10" target="_self">

                        <div class="row">
                        <div class="col-lg-3">
                            <input name="txtTglAwal" type="date" class="form-control" value="<?php echo $awalTgl; ?>" size="10" />
                        </div>
                        <div class="col-lg-3">
                            <input name="txtTglAkhir" type="date" class="form-control" value="<?php echo $akhirTgl; ?>" size="10" />
                        </div>
                        <div class="col-lg-3">
                            <input name="btnTampil" class="btn btn-success" type="submit" value="Tampilkan"/>
                        </div>
                    </div>

                        </form>

                        <div class="table=responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table dataTable my-0" id="dataTable1">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>No Pesanan</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Nama Member</th>
                                        <th>Metode Bayar</th>
                                        <th>Status Bayar</th>
                                        <th>Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>


                            </tbody>

                        </table>
                    </div>

        <div class="row">
            <div class="col-lg-3">
                <a href="../modul/mod_cetak/cetak.php?awal=<?php echo $tglAwal; ?>&&akhir=<?php echo $tglAkhir; ?>" target="_blank" alt="Edit Data" class="btn btn-primary">Cetak Laporan</a>                   
                        </div>
                    </div>

                        </div>
                    </div>
                </div>
        </main>

                  </div>
                </div>
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
      $(document).ready(function () {
        App.init();
      });
    </script>
    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="../plugins/table/datatable/datatables.js"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });
    </script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
  </body>
</html>


