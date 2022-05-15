<?php
$conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

// cek koneksi database
if (!$conn) {
?>
    <script>
        alert('<?php echo mysqli_connect_error(); ?>')
    </script>
<?php
}

$data = [];
$result = mysqli_query($conn, " SELECT * FROM bahan");
if ($result && mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

?>

<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
<script src="../plugins/table/datatable/datatables.js"></script>

<script>
    let setBahanSaatIni = (id, nama, stok) => {
        $("#id_bahan").val(id);
        $(".nama_bahan").val(nama);
        $(".stok_sekarang").val(stok);
    }

    let hapusBahan = (id) => {
        swal({
            title: 'Anda Yakin?',
            text: "Aksi ini tidak dapat dibatalkan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $("#id-hapus").val(id);
                $("#hapus-form").submit();
            }
        })
    }
</script>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">

            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-12">
                        <p class="mt-4">Jumlah tambahan stok akan direset setiap 1 bulan</p>
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary my-2">Tambah Bahan</button>
                        <div class="table-responsive my-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Bahan</th>
                                        <th>Stok Awal</th>
                                        <th>Jumlah Terpakai</th>
                                        <th>Jumlah Tambahan</th>
                                        <th>Stok Sekarang</th>
                                        <th>Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $key => $value) {
                                    ?>

                                        <tr>
                                            <td><?= $value['nama'] ?></td>
                                            <td><?= $value['stok_awal'] ?></td>
                                            <td><?= $value['jumlah_terpakai'] ?></td>
                                            <td><?= $value['jumlah_tambahan'] ?></td>
                                            <td><?= ($value['stok_awal'] + $value['jumlah_tambahan']) - $value['jumlah_terpakai'] ?></td>
                                            <td class="text-capitalize"><?= $value['satuan'] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                    <?php if ($_SESSION["role"] == "admin") {
                                                    ?>
                                                        <svg style="cursor: pointer;" onclick="hapusBahan(`<?= $value['id'] ?>`)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    <?php
                                                    } ?>

                                                    <div style="cursor: pointer;" data-toggle="modal" data-target="#addStokModal" onclick="setBahanSaatIni(`<?= $value['id'] ?>`, `<?= $value['nama'] ?>`, `<?= ($value['stok_awal'] + $value['jumlah_tambahan']) - $value['jumlah_terpakai'] ?>`)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!--  END CONTENT AREA  -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="../pages/add-bahan.php" method="POST">
                        <div class="form-group mb-3">
                            <input required type="text" class="form-control" id="sEmail" aria-describedby="emailHelp1" placeholder="Nama Bahan" name="nama">
                        </div>
                        <div class="form-group mb-3">
                            <input oninput="event.target.value = event.target.value.replace(/[^0-9]/g,'');" required type="number" min="0" class="form-control" id="sPassword" placeholder="Stok Awal" name="stok_awal">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="sEmail" aria-describedby="emailHelp1" placeholder="Satuan" name="satuan">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Tambah Stok Modal -->
    <div class="modal fade" id="addStokModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="../pages/edit-bahan.php" method="POST">
                        <input type="hidden" id="id_bahan" name="id_bahan">
                        <div class="form-group mb-3">
                            <small class="form-text text-muted">Nama Bahan</small>
                            <input readonly class="nama_bahan form-control" placeholder="Nama">
                        </div>
                        <div class="form-group mb-3">
                            <small class="form-text text-muted">Stok Sekarang</small>
                            <input readonly class="stok_sekarang form-control" placeholder="Stok Sekarang">
                        </div>
                        <div class="form-group mb-3">
                            <input required type="number" min="0" oninput="event.target.value = event.target.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Stok Tambahan" name="stok_tambahan">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="hapus-form" method="POST" action="../pages/hapus-bahan.php" class="d-none">
    <input type="number" name="id_bahan" id="id-hapus">
</form>

<script>
    let renderDataTable = () => {
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    }

    const hapusBahan = (id) => {
        swal({
            title: 'Anda Yakin?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {

            }
        })
    }

    // renderDataTable on document ready
    $(document).ready(() => renderDataTable());
</script>