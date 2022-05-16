<?php
if (isset($_POST['id']) && isset($_POST['nama'])) {
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
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $kategori = $_POST['kategori'];

        $query = "UPDATE menu SET nama = '$nama', harga = '$harga', kategori = '$kategori' WHERE id = '$id'";


        $result = mysqli_query($conn, $query);

        header("Location: ../admin/data-menu.php");
    }
} else echo "
<script>window.history.back();</script>
";
?>