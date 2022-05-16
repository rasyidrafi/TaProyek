<?php
session_start();
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
if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "kasir") {
    $q = "SELECT transaksi.*, username  FROM `transaksi` LEFT JOIN users on pegawai_id = users.id";
    if ($_SESSION['role'] == 'kasir') {
        $q .= " where status != 'menunggu' AND kasir_id = '" . $_SESSION['id'] . "'";
    }
    $result = mysqli_query($conn, $q);
    if ($result && mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
} else {
    $result = mysqli_query($conn, "SELECT transaksi.*, username  FROM `transaksi` LEFT JOIN users on pegawai_id = users.id WHERE pegawai_id = " . $_SESSION['id']);
    if ($result && mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
}

?>

<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
<script src="../plugins/table/datatable/datatables.js"></script>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">

            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-12">
                        <?php if ($_SESSION['role'] == "pegawai-2") {
                        ?>
                            <a href="../pegawai/add-transaksi.php" class="btn btn-primary my-2">Tambah Transaksi</a>
                        <?php
                        } ?>
                        <div class="table-responsive mb-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Pembeli</th>
                                        <?php if ($_SESSION["role"] == "admin" || $_SESSION['role'] == "kasir") { ?>
                                            <th>Nama Pegawai</th>
                                        <?php } ?>
                                        <th>Tanggal Transaksi</th>
                                        <th>Total Harga</th>
                                        <th>Total Bayar</th>
                                        <th>Jumlah Beli</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= $value['nama_pembeli'] ?></td>
                                            <?php if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "kasir") { ?>
                                                <td><?= $value['username'] ?></td>
                                            <?php } ?>
                                            <td><?= date("d/m/Y", strtotime($value['created_at'])); ?></td>
                                            <td>
                                                <script>
                                                    document.write(formatRupiah(`<?= $value['total_harga'] ?>`));
                                                </script>
                                            </td>
                                            <td>
                                                <script>
                                                    document.write(`<?= $value['total_bayar'] ?>`);
                                                </script>
                                            </td>
                                            <td><?= $value['total_jumlah_pesanan'] ?></td>
                                            <td class="text-capitalize"><?= $value['status'] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                    <?php if ($_SESSION["role"] == "admin") {
                                                    ?>
                                                        <svg style="cursor: pointer;" onclick="hapusTransaksi(`<?= $value['id'] ?>`)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    <?php
                                                    } ?>

                                                    <a class="d-inline" href="../pegawai/detail-transaksi.php?id=<?= $value['id'] ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in">
                                                            <circle cx="11" cy="11" r="8"></circle>
                                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                            <line x1="11" y1="8" x2="11" y2="14"></line>
                                                            <line x1="8" y1="11" x2="14" y2="11"></line>
                                                        </svg>
                                                    </a>
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

    const hapusTransaksi = (id) => {
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