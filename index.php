<?php 
  session_start();

  /* File ini hanya digunakan untuk membedakan apakah user yang login seorang admin, pegawai, atau seorang kasir */

  // jika ada user yang login sebagai admin
  if ($_COOKIE["nama"] == "admin@gmail.com") {
    
    header("Location: admin/index.php"); // alihkan ke halaman index admin
    exit;

  // jika ada user yang login sebagai pegawai 1 atau pegawai 2
  } elseif ($_COOKIE["nama"] == "pegawai1@gmail.com" || $_COOKIE["nama"] == "pegawai2@gmail.com") {

    header("Location: pegawai/index.php"); // alihkan ke halaman index pegawai
    exit;

  // jika ada user yang login sebagai selain admin atau pegawai
  } else {

    header("Location: kasir/index.php"); // alihkan ke halaman index kasir
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
    />
    <title>Proyek TA</title>
  </head>
  <body>
    <script src="./middleware/index.js"></script>
    <!-- <script>
      middleware.mustLogin();
    </script> -->
  </body>
</html>