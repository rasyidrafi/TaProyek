<?php
if (isset($_POST['id_bahan']) && isset($_POST['stok_tambahan'])) {
    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    // cek koneksi database
    if (!$conn) {
?>
        <script>
            alert('<?php echo mysqli_connect_error(); ?>')
        </script>
<?php
    } else {
        $id = $_POST['id_bahan'];
        $stok_tambahan = $_POST['stok_tambahan'];

        $query = "UPDATE bahan SET jumlah_tambahan = jumlah_tambahan + '$stok_tambahan' WHERE id_bahan = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: ../admin/data-bahan.php");
        }
    }
} else header("Location: index.php");
?>