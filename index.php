<?php
session_start();

/* File ini hanya digunakan untuk membedakan apakah user yang login seorang admin, pegawai, atau seorang kasir */


// jika ada user yang berusaha masuk tanpa melalui login
if (isset($_SESSION["role"]) != 1) {
  header("Location: login.php"); // alihkan ke halaman login
  // exit;
}

// jika ada user yang login sebagai admin
if ($_SESSION["role"] == "admin") {
  header("Location: admin/index.php"); // alihkan ke halaman index admin
  exit;

  // jika ada user yang login sebagai pegawai 1 atau Waiters
} elseif ($_SESSION["role"] == "waiters") {
  header("Location: pegawai/index.php"); // alihkan ke halaman index pegawai
  exit;
  // jika ada user yang login sebagai selain admin atau pegawai
} elseif ($_SESSION["role"] == "pegawai-1") {
  header("Location: admin/data-bahan.php"); // alihkan ke halaman index kasir
  exit;
} else {
  header("Location: pegawai/index.php"); 
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

</body>

</html>
