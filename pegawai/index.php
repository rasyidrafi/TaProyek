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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pegawai</title>
</head>
<body>
        <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
        </a>
    </div>
    </nav>
<!-- judul -->
    <div class="container">
        <h1 class="mt-4">Data Pegawai</h1>
        <figure class="text-end">
            <blockquote class="blockquote">
                <p>Berisi Data Pegawai</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
             </figure>
             <button type="button" class="btn btn-primary">
                 <i></i>
                 Tambah Data
                </button>
             <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></thd>
                    <td></td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm">
                            Ubah
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
