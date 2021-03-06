<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="profile-info" id="profile-info-panel">
            <div class="user-info py-0 h-100 pt-4">
                <h6 class=""><?php echo $_SESSION["email"] ?></h6>
                <p class=""><?php echo $_SESSION["role"] ?></p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <!-- BEGIN SIDEBAR ADMIN -->
        <script>
            let calculateHeight = () => {
                let windowHeight = $(window).height();
                let headerHeight = $("#header-nav").height();
                let profileIndoHeight = $("#profile-info-panel").height();
                let sidebarHeight = windowHeight - headerHeight - profileIndoHeight;
                return sidebarHeight;
            }

            $(document).ready(function() {
                let allNav = document.getElementsByClassName("menu-categories");
                for (let i = 0; i < allNav.length; i++) {
                    allNav[i].style.height = calculateHeight() + "px";
                }

                window.addEventListener("resize", function() {
                    let allNav = document.getElementsByClassName("menu-categories");
                    for (let i = 0; i < allNav.length; i++) {
                        allNav[i].style.height = calculateHeight() + "px";
                    }
                });
            })
        </script>
        <?php if ($_SESSION["role"] == "admin") { ?>
            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu">
                    <a href="../admin/data-restoran.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span> Profil Restoran</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="../admin/data-bahan.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span> Data Bahan</span>
                        </div>
                    </a>
                </li>
                <li class="menu">
                    <a href="../admin/data-menu.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span> Data Menu</span>
                        </div>
                    </a>
                </li>
                <li class="menu">
                    <a href="../admin/data-pegawai.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span> Data Pegawai</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                            <span> Penjualan</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="submenu2" data-parent="#accordionExample">
                        <li>
                            <a href="../kasir/index.php"> Histori Penjualan </a>
                        </li>
                        <li>
                            <a href="../admin/laporan-keuangan.php"> Laporan Tahunan </a>
                        </li>
                        <li>
                            <a href="../admin/laporan-keuangan-hari.php"> Laporan Bulanan </a>
                        </li>
                    </ul>
                </li>
            </ul>
        <?php } ?>
        <!-- END SIDEBAR ADMIN -->

        <!-- BEGIN SIDEBAR PEGAWAI -->
        <?php if ($_SESSION["role"] == "pegawai-1") {
        ?>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu">
                    <a href="../admin/data-bahan.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span>Stok Bahan</span>
                        </div>
                    </a>
                </li>
            </ul>
        <?php

        } ?>

        <!-- BEGIN SIDEBAR PEGAWAI -->
        <?php if ($_SESSION["role"] == "waiters") {
        ?>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu">
                    <a href="../pegawai/index.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span>Transaksi</span>
                        </div>
                    </a>
                </li>
            </ul>
        <?php

        } ?>
        <!-- END SIDEBAR PEGAWAI -->


        <!-- BEGIN SIDEBAR PEGAWAI -->
        <?php if ($_SESSION["role"] == "kasir") {
        ?>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu">
                    <a href="../pegawai/index.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span>Perlu Diproses</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="../kasir/index.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span>History Transaksi</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="../admin/laporan-keuangan-hari.php" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg>
                            <span>Laporan Harian</span>
                        </div>
                    </a>
                </li>
            </ul>
        <?php

        } ?>
        <!-- END SIDEBAR PEGAWAI -->

    </nav>
</div>
<!--  END SIDEBAR  -->