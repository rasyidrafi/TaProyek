<?php 
    session_start();

    if (isset($_POST['nama_restoran'])) {
        $nama_restoran = $_POST['nama_restoran'];
        $logo = $_POST['logo'];
        $alamat = $_POST['alamat'];
        $nomor = $_POST['nomor'];

        $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

        $sql = "UPDATE restoran SET nama_restoran = '$nama_restoran', logo = '$logo', alamat = '$alamat', nomor = '$nomor' WHERE id = 1";

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
