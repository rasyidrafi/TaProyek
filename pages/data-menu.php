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
$result = mysqli_query($conn, " SELECT * FROM menu");
if ($result && mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}


$data_bahan = [];
$result = mysqli_query($conn, "SELECT kategori FROM `menu` GROUP BY kategori");
if ($result && mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_bahan[] = $row;
    }
}

?>

<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
<script src="../plugins/table/datatable/datatables.js"></script>

<script>
    let setMenuSaatIni = (id, nama, harga, kategori) => {
        $("#id_menu").val(id);
        $(".nama_menu").val(nama);
        $(".harga_menu").val(harga);
        $(".kategori_menu").val(kategori);
    }
</script>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing" id="cancel-row">

            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-12">
                        <a href="../pages/add-menu.php" class="btn btn-primary mb-2 mt-4">Tambah Menu</a>
                        <div class="table-responsive mb-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $key => $value) {
                                    ?>

                                        <tr>
                                            <td><?= $value['nama'] ?></td>
                                            <td><?= $value['harga'] ?></td>
                                            <td><?= $value['kategori'] ?></td>
                                            <td><?= date('d-m-Y H:i', strtotime($value['created_at'])) ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="../pages/detail-menu.php?id=<?= $value['id'] ?>">
                                                    Detail
                                                </a>

                                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editMenuModal" onclick="setMenuSaatIni(`<?= $value['id'] ?>`, `<?= $value['nama'] ?>`, `<?= $value['harga'] ?>`, `<?= $value['kategori'] ?>`)">
                                                    Edit
                                                </button>
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

<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="edit-menu-form" action="../pages/edit-menu.php" method="POST">
                    <input type="hidden" id="id_menu" name="id">
                    <div class="form-group mb-3">
                        <small class="form-text text-muted">Nama Menu</small>
                        <input name="nama" required class="nama_menu form-control" placeholder="Nama">
                    </div>
                    <div class="form-group mb-3">
                        <small class="form-text text-muted">Harga</small>
                        <input name="harga" required oninput="event.target.value = formatRupiah(event.target.value)" class="harga_menu form-control" placeholder="Harga">
                    </div>
                    <div class="form-group mb-3">
                        <small class="form-text text-muted">Kategori</small>
                        <select name="kategori" required class="kategori_menu form-control basic">
                            <?php
                            foreach ($data_bahan as $key => $value) {
                                echo "<option value='$value[kategori]'>$value[kategori]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
            "order": [[3, 'desc']],
        });
    }

    // renderDataTable on document ready
    $(document).ready(() => renderDataTable());
</script>