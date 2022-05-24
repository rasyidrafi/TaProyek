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
$result = mysqli_query($conn, " SELECT * FROM users");
if ($result && mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

$data_role = [];
$res = mysqli_query($conn, "SELECT role FROM `users` GROUP by role");
if ($res && mysqli_num_rows($res)) {
    while ($row = mysqli_fetch_assoc($res)) {
        $data_role[] = $row;
    }
}

?>

<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
<script src="../plugins/table/datatable/datatables.js"></script>

<script>
    let hapusPegawai = (id) => {
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

    let resetPassword = (id) => {
        Swal.fire({
            title: 'Silahkan Masukkan Password Baru',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: (input) => {
                $.post({
                    url: "../pages/reset-pegawai.php",
                    data: {
                        id: id,
                        password: input
                    },
                    success: (res) => {
                        swal({
                            type: 'success',
                            title: 'Password berhasil diubah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: (err) => {
                        swal({
                            type: 'error',
                            title: 'Password gagal diubah',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }

    let setUserSaatIni = (id, username, role) => {
        if (role == 'admin') {
            $("#edit-role").addClass("d-none");
        } else {
            $("#edit-role").removeClass("d-none");
        }
        $("#id_user").val(id);
        $(".username_user").val(username);
        $(".role_user").val(role);
    }
</script>

<form id="hapus-form" method="POST" action="../pages/hapus-user.php" class="d-none">
    <input type="number" name="id" id="id-hapus">
</form>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing" id="cancel-row">

            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-12">
                        <?php if ($_SESSION['role'] == "admin") {
                        ?>
                            <button data-toggle="modal" data-target="#addUserModal" class="btn btn-primary mb-2 mt-4">Tambah User</button>
                        <?php
                        } ?>
                        <div class="table-responsive mb-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Akses</th>
                                        <th>Tgl Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $key => $value) {
                                    ?>

                                        <tr>
                                            <td><?= $value['username'] ?></td>
                                            <td><?= $value['email'] ?></td>
                                            <td class="text-capitalize"><?= $value['role'] ?></td>
                                            <td><?= date("d-m-Y H:i", strtotime($value['created_at'])) ?></td>
                                            <td>
                                                <?php if ($value['role'] != 'admin') {
                                                ?>
                                                    <button class="btn btn-sm btn-danger" onclick="hapusPegawai(`<?= $value['id'] ?>`)">
                                                        Hapus
                                                    </button>
                                                <?php
                                                } ?>

                                                <?php if ($_SESSION['role'] == 'admin' && $value['role'] != 'admin') {
                                                ?>
                                                    <button class="btn btn-sm" onclick="resetPassword(`<?= $value['id'] ?>`)">
                                                        Reset Password
                                                    </button>
                                                <?php
                                                } ?>

                                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editUserModal" onclick="setUserSaatIni(`<?= $value['id'] ?>`, `<?= $value['username'] ?>`, `<?= $value['role'] ?>`)">
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

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="edit-user-form" action="../pages/edit-user.php" method="POST">
                        <input type="hidden" id="id_user" name="id">
                        <div class="form-group mb-3">
                            <small class="form-text text-muted">Username</small>
                            <input name="username" required class="username_user form-control" placeholder="Username">
                        </div>
                        <div id="edit-role" class="form-group mb-3">
                            <small class="form-text text-muted">Akses</small>
                            <select name="role" required class="role_user form-control basic">
                                <?php
                                foreach ($data_role as $key => $value) {
                                    echo "<option value='$value[role]'>$value[role]</option>";
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

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="loginModalLabel">
                    <h4 class="modal-title">Tambah User Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg></button>
                </div>
                <div class="modal-body">
                    <form id="add-user-form" class="mt-0">
                        <div class="form-group">
                            <input required name="email" type="email" class="form-control mb-2" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input required name="username" type="text" class="form-control mb-2" id="exampleInputEmail1" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input required name="password" type="password" class="form-control mb-4" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <select name="akses" id="akses" class="form-control mb-4">
                                <option value="kasir">Kasir</option>
                                <option value="pegawai-1">Pegawai 1</option>
                                <option value="waiters">Waiters</option>
                            </select>
                        </div>
                        <button id="add-user-btn" type="submit" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                    </form>
                </div>
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
            "order": [
                [3, 'desc']
            ],
        });
    }

    $("#add-user-form").submit(e => {
        e.preventDefault();

        let formData = new FormData(e.target);
        $.post({
            url: "../pages/add-user.php",
            data: {
                email: formData.get("email"),
                username: formData.get("username"),
                password: formData.get("password")
            },
            beforeSend: () => {
                $("#add-user-btn").html(`
                    <div class="spinner-border spinner-border-reverse align-self-center loader-sm text-white">Loading...</div>
                `);
            },
            success: () => {
                // reset form
                $("#add-user-form").trigger("reset");
                $("#addUserModal").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'User berhasil ditambahkan',
                    timer: 1500
                });
                $("#add-user-btn").html(`Submit`);
                window.location.reload();
            },
            error: (err) => {
                $("#add-user-form").trigger("reset");
                $("#addUserModal").modal("hide");

                let errorData = JSON.parse(err.responseText);

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: errorData.reason,
                });
                $("#add-user-btn").html(`Submit`);
            },
        })
    })

    // renderDataTable on document ready
    $(document).ready(() => renderDataTable());
</script>