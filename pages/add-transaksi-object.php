<?php
session_start();
if (isset($_POST['total_harga'])) {
    $total_harga = $_POST['total_harga'];
    $total_jumlah_pesanan = $_POST['total_jumlah_pesanan'];
    $pegawai_id = $_SESSION['id'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $pembayaran = $_POST['pembayaran'];
    $pajak = $_POST['pajak'];
    $diskon = $_POST['diskon'];
    $tipe = $_POST['tipe'];
    $ongkir = $_POST['ongkir'] ?? 0;
    $lokasi_pembeli = $_POST['lokasi_pembeli'] ?? "";
    $menu = json_decode($_POST['menu']);

    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    if (!$conn) {
?>
        <script>
            alert('<?php echo mysqli_connect_error(); ?>')
        </script>
        <?php
    } else {
        $q = "INSERT into transaksi (total_harga, total_jumlah_pesanan, nama_pembeli, pembayaran, pajak, diskon, tipe, ongkir, lokasi_pembeli, pegawai_id) VALUES ('$total_harga', '$total_jumlah_pesanan', '$nama_pembeli', '$pembayaran', '$pajak', '$diskon', '$tipe', '$ongkir', '$lokasi_pembeli', '$pegawai_id')";
        $result = mysqli_query($conn, $q);

        if (!$result) {
        ?>
            <script>
                alert('<?php echo mysqli_error($conn); ?>')
            </script>
        <?php
            die;
        }

        $last_id = mysqli_insert_id($conn);

        foreach ($menu as $key => $value) {
            $q2 = "INSERT into transaksi_detail (id_transaksi, id_menu, jumlah) VALUES ('$last_id', '$value->id', '$value->jumlah')";
            $result = mysqli_query($conn, $q2);
        }

        if (!$result) {
        ?>
            <script>
                alert('<?php echo mysqli_error($conn); ?>')
            </script>
<?php
            die;
        }

        if ($result) {
            header("Location: ../pegawai/add-transaksi.php");
        }
    }
} else header("Location: ../pegawai/add-transaksi.php");
