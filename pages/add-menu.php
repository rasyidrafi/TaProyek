<?php
session_start();

$conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

$data_bahan = [];
$result = mysqli_query($conn, "SELECT * FROM bahan");
if ($result && mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_bahan[] = $row;
    }
}

// jika ada user yang berusaha masuk tanpa melalui login
if (!isset($_SESSION["role"])) {
    header("Location: ../login.php"); // alihkan ke halaman login
    exit;
}

if (isset($_POST['harga'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $allBahan = json_decode($_POST['bahan']);

    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    $query = "INSERT INTO menu (nama, harga, kategori) VALUES ('$nama', '$harga', '$kategori')";
    $result = mysqli_query($conn, $query);

    // get last inserted id
    $last_id = mysqli_insert_id($conn);

    foreach ($allBahan as $bahan) {
        $query = "INSERT INTO menu_detail (id_menu, id_bahan, jumlah) VALUES ('$last_id', '$bahan->id', '$bahan->jumlah')";
        $result = mysqli_query($conn, $query);
    }

    header("Location: ../admin/data-menu.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../component/_head.php"; ?>
</head>

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
                            <div class="widget-one">

                                <!-- START ================== -->
                                <button onclick="window.history.back();" class="btn btn-primary mb-4">Kembali</button>

                                <h3 class="d-block">Tambah Menu Baru</h3>
                                <form id="submit-menu-form" action="../pages/add-menu.php" method="POST" class="mb-4 row">
                                    <input type="hidden" id="bahan-input" name="bahan">

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
                                            <select required name="kategori" class="form-control basic">
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

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <span id="submit-menu" class="btn btn-primary mt-3">Submit</span>
                                        <button type="submit" class="d-none" id="submit-menu-real"></button>
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
                                <select id="id-nya" class="form-control basic">
                                    <?php
                                    foreach ($data_bahan as $key => $value) {
                                        echo "<option value='$value[id]'>$value[nama]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <script>
                                let handleInput = (event) => {
                                    event.target.value = event.target.value.replace(/[^0-9]/g,'')
                                    if (event.target.value.startsWith('0')) {
                                        event.target.value = event.target.value.substr(1)
                                    }
                                }
                            </script>
                            <div class="form-group mb-3">
                                <small class="form-text text-muted">Jumlah yg dibutuhkan</small>
                                <input id="jumlah-nya" value="1" id="jumlah_butuh" name="jumlah" oninput="handleInput(event)" class="jumlah_butuh form-control" placeholder="Jumlah">
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

            allBahan =  JSON.parse($("#data-bahan").html().trim());

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
                $("#submit-menu-real").click();
            });
        </script>

        <?php include "../component/_script.php"; ?>
</body>

</html>