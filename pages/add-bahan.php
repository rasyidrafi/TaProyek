<?php
if (isset($_POST['nama']) && isset($_POST['stok_awal']) && isset($_POST['satuan'])) {
    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    // cek koneksi database
    if (!$conn) {
?>
        <script>
            alert('<?php echo mysqli_connect_error(); ?>')
        </script>
<?php
    } else {
        $nama = $_POST['nama'];
        $stok_awal = $_POST['stok_awal'];
        $satuan = $_POST['satuan'];

        $query = "INSERT INTO bahan (nama, stok_awal, satuan) VALUES ('$nama', '$stok_awal', '$satuan')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: ../admin/data-bahan.php");
        }
    }
}
?>