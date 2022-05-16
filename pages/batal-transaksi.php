<?php
session_start();
if ($_POST['id']) {
    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    // cek koneksi database
    if (!$conn) {
?>
        <script>
            alert('<?php echo mysqli_connect_error(); ?>')
        </script>
<?php
    } else {
        $id = $_POST['id'];
        $query = "UPDATE transaksi set status = 'ditolak' where id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: ../pegawai/index.php");
        }
    }
} else {
    header('Location: ../pegawai/index.php');
}
?>