<?php
    session_start();

    // jika ada user yang berusaha masuk tanpa melalui login
    if (!isset($_SESSION["login"])) {
        header("Location: ../login.php"); // alihkan ke halaman login
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>Selamat datang di halaman data pegawai admin</h4>
</body>
</html>
