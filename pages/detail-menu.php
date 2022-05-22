<?php
session_start();


// jika ada user yang berusaha masuk tanpa melalui login
if (!isset($_SESSION["role"])) {
    header("Location: ../login.php"); // alihkan ke halaman login
    exit;
}

$conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

$detail_menu_id = $_GET['id'];

$menu_data;

$get_menu = mysqli_query($conn, "SELECT * FROM menu WHERE id = '$detail_menu_id'");
if ($get_menu && mysqli_num_rows($get_menu)) {
    $menu_data = mysqli_fetch_assoc($get_menu);
}

// get detail menu all bahan
$detail_menu_bahan = [];
$res = mysqli_query($conn, "SELECT * FROM menu_detail LEFT JOIN bahan on id_bahan = bahan.id WHERE id_menu = '$detail_menu_id'");

if ($res && mysqli_num_rows($res)) {
    while ($row = mysqli_fetch_assoc($res)) {
        $detail_menu_bahan[] = $row;
    }
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
    <span class="d-none" id="data-bahan"><?= json_encode($data_bahan); ?></span>

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
                            <div class="widget-one border-0">

                                <!-- START ================== -->

                                <button onclick="window.history.back();" class="btn btn-primary mb-4">Kembali</button>

                                <h3 class="d-block">Detail Menu</h3>
                                <form id="submit-menu-form" action="../admin/data-menu.php" method="POST" class="mb-4 row">
                                    <input type="hidden" id="bahan-input" name="bahan">

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <small class="form-text text-muted">Nama Menu</small>
                                            <span class="form-control text-capitalize">
                                                <?= $menu_data['nama'] ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <small class="form-text text-muted">Harga</small>
                                            <span class="form-control text-capitalize">
                                                <script>
                                                    document.write(formatRupiah("<?= $menu_data['harga'] ?>"))
                                                </script>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <small class="form-text text-muted">Kategori</small>
                                            <span class="form-control text-capitalize">
                                                <?= $menu_data['kategori'] ?>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 50px;">#</th>
                                                        <th>Daftar Bahan</th>
                                                        <th class="text-center" style="width: 100px;">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table">
                                                    <?php 
                                                        foreach ($detail_menu_bahan as $key => $value) {
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $key + 1 ?></td>
                                                                    <td>
                                                                        <?= $value['nama'] ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?= $value['jumlah'] ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
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
                            <div class="form-group mb-3">
                                <input type="hidden" id="nama-nya">
                                <small class="form-text text-muted">Pilih Bahan</small>
                                <select required id="id-nya" class="form-control">
                                    <?php
                                    foreach ($data_bahan as $key => $value) {
                                        echo "<option value='$value[id]'>$value[nama]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <small class="form-text text-muted">Jumlah yg dibutuhkan</small>
                                <input required id="jumlah-nya" value="1" id="jumlah_butuh" name="jumlah" oninput="event.target.value = event.target.value.replace(/[^0-9]/g,'')" class="jumlah_butuh form-control" placeholder="Jumlah">
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

            let deleteBahan = (id) => {
                $(`#${id}`).remove();
            }

            allBahan = JSON.parse($("#data-bahan").html().trim());

            $("#add-bahan-form").submit(e => {
                e.preventDefault();


                let id = $("#id-nya").val();
                let jumlah = $("#jumlah-nya").val();
                let nama = allBahan.find(item => item.id == id).nama;

                $("#table").append(`
                <tr id='bahan-${id}'>
                    <td class="text-center" onclick="deleteBahan('bahan-${id}')" style="cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                    </td>
                    <td>${nama}</td>
                    <td class="text-center jumlah-butuh">${jumlah}</td>
                </tr>
                `);

                $("#addMenuModal").modal("hide");
            })

            $("#submit-menu").click(e => {
                // get all bahan
                let allBahanSubmit = [];
                $("#table tr").each(function() {
                    let id = $(this).attr("id").split("-")[1];
                    let jumlah = parseInt($(this).find(".jumlah-butuh").text()) == NaN ? 0 : parseInt($(this).find(".jumlah-butuh").text());
                    allBahanSubmit.push({
                        id: id,
                        jumlah: jumlah
                    });
                });

                $("#bahan-input").val(JSON.stringify(allBahanSubmit));
                $("#submit-menu-form").submit();
            });
        </script>

        <?php include "../component/_script.php"; ?>
</body>

</html>