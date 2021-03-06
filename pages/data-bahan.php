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
    let setBahanSaatIni = (id, nama, porsi_saat_ini, satuan, satuan_porsi, porsi) => {
        $("#id_bahan").val(id);
        $(".nama_bahan").val(nama);
        $(".porsi_sekarang").val(porsi_saat_ini);
        $("#satuan-porsi").html(satuan_porsi);
        $(".satuan-bahan").html(satuan);
        $(".porsi").html(porsi);
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
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-2 mt-4">Tambah Bahan</button>
                        <div class="table-responsive mb-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Bahan</th>
                                        <th>Stok Awal</th>
                                        <th>Jumlah Tambahan</th>
                                        <th>Satuan</th>
                                        <th>1 Bahan Menghasilkan Porsi</th>
                                        <th>Porsi Terpakai</th>
                                        <th>Porsi Saat Ini</th>
                                        <th>Satuan Porsi</th>
                                        <th>Tgl Dibuat</th>
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
                                            <td><?= $value['jumlah_tambahan'] ?></td>
                                            <td class="text-capitalize"><?= $value['satuan'] ?></td>
                                            <td><?= $value['porsi'] ?></td>
                                            <td><?= $value['porsi_terpakai'] ?></td>
                                            <td><?= ($value['stok_awal'] + $value['jumlah_tambahan']) * $value['porsi'] ?></td>
                                            <td class="text-capitalize"><?= $value['satuan_porsi'] ?></td>
                                            <td><?= date("d-m-Y H:i", strtotime($value['created_at'])) ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                    <?php if ($_SESSION["role"] == "admin") {
                                                    ?>
                                                        <button onclick="hapusBahan(`<?= $value['id'] ?>`)" class="btn btn-danger btn-sm">
                                                            Hapus
                                                        </button>
                                                    <?php
                                                    } ?>

                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addStokModal" onclick="setBahanSaatIni(`<?= $value['id'] ?>`, `<?= $value['nama'] ?>`, `<?= ($value['stok_awal'] + $value['jumlah_tambahan']) * $value['porsi'] ?>`, `<?= $value['satuan'] ?>`, `<?= $value['satuan_porsi'] ?>`, `<?= $value['porsi'] ?>`)">
                                                        Edit
                                                    </button>
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
                            <input type="text" class="form-control" id="sEmail" aria-describedby="emailHelp1" placeholder="Satuan Bahan" name="satuan">
                        </div>

                        <div class="form-group mb-3">
                            <input type="number" class="form-control mb-1" id="porsi" aria-describedby="emailHelp1" placeholder="Porsi" name="porsi">
                            <span>1 Bahan dapat menghasilkan berapa porsi</span><br>
                            <span>Contoh: 1Kg daging menghasilkan 1000 Gram Daging</span><br>
                            <span>Contoh: 1Kg Kopi Bubuk menghasilkan 10 Bungkus</span>
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="sEmail" aria-describedby="emailHelp1" placeholder="Satuan Porsi" name="satuan_porsi">
                            <span>Contoh: Bungkus, Gram, Lapis</span><br>
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
                            <input name="nama" class="nama_bahan form-control" placeholder="Nama">
                        </div>
                        <div class="form-group mb-3">
                            <small class="form-text text-muted">Porsi Sekarang</small>
                            <div class="input-group">
                                <input readonly class="porsi_sekarang form-control" placeholder="Porsi Sekarang">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="satuan-porsi"></span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <input required type="number" min="0" oninput="event.target.value = event.target.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Stok Tambahan" name="stok_tambahan">
                                <div class="input-group-append">
                                    <span class="input-group-text satuan-bahan"></span>
                                </div>
                            </div>
                            <small>Setiap 1 <span class="satuan-bahan"></span> akan menambah sebanyak <span class="porsi"></span> Porsi</small>
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
            "pageLength": 10,
            "order": [
                [6, 'desc']
            ],
        });
    }

    // renderDataTable on document ready
    $(document).ready(() => renderDataTable());
</script>