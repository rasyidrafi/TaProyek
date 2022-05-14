<?php
session_start();

$conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

// jika ada user yang berusaha masuk tanpa melalui login
if (!isset($_SESSION["role"])) {
    header("Location: ../login.php"); // alihkan ke halaman login
    exit;
}

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    $query = "INSERT INTO menu (nama, harga, kategori) VALUES ('$nama', '$harga', '$kategori')";
    $result = mysqli_query($conn, $query);

    header("Location: ../admin/data-menu.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../component/_head.php"; ?>
</head>
<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

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

                                <!-- START ================== -->

                                <h3 class="d-block">Tambah Menu Baru</h3>
                                <form action="../pages/add-menu.php" method="POST" class="mb-4 row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <small class="form-text text-muted">Nama Menu</small>
                                            <input name="nama" required type="nama" name="nama" class="form-control" placeholder="Nama Menu">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <small class="form-text text-muted">Harga</small>
                                            <input name="harga" required type="text" oninput="event.target.value = formatRupiah(event.target.value)" name="harga" class="form-control" placeholder="Harga">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <small class="form-text text-muted">Pilih Kategori</small>
                                            <select required name="kategori" class="form-control basic" multiple="multiple">
                                                <option>Makanan</option>
                                                <option>Minuman</option>
                                                <option>Snack</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <span data-toggle="modal" data-target="#addMenuModal" class="btn btn-success mb-4">Tambah Bahan</span>

                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 50px;">#</th>
                                                        <th>Nama Menu</th>
                                                        <th class="text-center" style="width: 100px;">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table">
                                                    <tr>
                                                        <td class="text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </td>
                                                        <td>Nasi Goreng</td>
                                                        <td class="text-center">320</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <button name="tambah" type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </div>

                                </form>

                                <!-- END ================== -->

                            </div>
                        </div>
                    </div>

                    <!-- CONTENT AREA -->
                </div>
            </div>
            <!--  END CONTENT AREA  -->
        </div>
        <!-- END MAIN CONTAINER -->

        <!-- Tambah Stok Modal -->
        <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="add-bahan-form">
                            <input type="hidden" id="id_bahan" name="id_bahan">
                            <div class="form-group mb-3">
                                <small class="form-text text-muted">Pilih Bahan</small>
                                <select class="form-control">
                                    <option selected="selected">Nasi Putih</option>
                                    <option>Bawang Merah</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <small class="form-text text-muted">Jumlah yg dibutuhkan</small>
                                <input value="1" id="jumlah_butuh" name="jumlah" oninput="event.target.value = event.target.value.replace(/[^0-9]/g,'')" class="jumlah_butuh form-control" placeholder="Jumlah">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var ss = $(".basic").select2({
                tags: true,
            });

            $("#add-bahan-form").submit(e => {
                e.preventDefault();


            })
        </script>

        <?php include "../component/_script.php"; ?>
</body>

</html>