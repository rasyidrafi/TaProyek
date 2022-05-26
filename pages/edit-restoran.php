<?php 
    session_start();

    if (isset($_POST['nama_restoran'])) {
        $nama_restoran = $_POST['nama_restoran'];
        $logo = $_POST['logo'];
        $qris = $_POST['qris'];
        $alamat = $_POST['alamat'];
        $nomor = $_POST['nomor'];
        $pajak = $_POST['pajak'];
        $rekening_restoran = $_POST['rekening_restoran'];
        $nama_bank = $_POST['nama_bank'];

        $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

        $sql = "UPDATE restoran SET nama_restoran = '$nama_restoran', alamat = '$alamat', nomor = '$nomor', pajak = '$pajak', rekening_restoran = '$rekening_restoran', nama_bank = '$nama_bank'";

        if ($logo != '') {
            $sql = $sql . ", logo = '$logo'";
        }

        if ($qris != '') {
            $sql = $sql . ", qris = '$qris'";
        }

        $sql = $sql . " WHERE id = 1";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../admin/data-restoran.php");
        } else {
            echo "<script>
                alert('Data gagal diubah');
                window.location.assign('../admin/data-restoran.php');    
            </script>";
        }
    }
