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
        $total_bayar = $_POST['total_bayar'];

        $detail_transaksi = [];
        $qd = "SELECT * FROM `transaksi_detail` LEFT JOIN menu on id_menu = menu.id where id_transaksi = '$id'";
        $resultd = mysqli_query($conn, $qd);
        if ($resultd && mysqli_num_rows($resultd)) {
            while ($row = mysqli_fetch_assoc($resultd)) {
                $detail_transaksi[] = $row;
            }
        }

        // Kelompokkan Semua Menu yg Ada dan hitung jumlah yg dibutuhkan
        $bahan_needed = [];
        foreach ($detail_transaksi as $key => $value) {
            if (!isset($bahan_needed[$value['id_menu']])) {
                $bahan_needed[$value['id_menu']] = $value['jumlah'];
            } else {
                $bahan_needed[$value['id_menu']] += $value['jumlah'];
            }
        }

        // Hitung apakah stok masih ada
        $list_all_bahan = [];
        foreach ($bahan_needed as $key => $value) {
            $all_bahan = [];
            $qb = "SELECT * FROM `menu_detail` LEFT JOIN bahan on id_bahan = bahan.id where id_menu = '$key'";
            $resultb = mysqli_query($conn, $qb);
            if ($resultb && mysqli_num_rows($resultb)) {
                while ($row = mysqli_fetch_assoc($resultb)) {
                    $all_bahan[] = $row;
                }
            }

            $jumlah_menu = $value;
            // jadikan satu semua bahan
            foreach ($all_bahan as $key2 => $bahan) {
                if (isset($list_all_bahan[$bahan['id_bahan']])) {
                    $list_all_bahan[$bahan['id_bahan']] += $bahan['jumlah'] * $jumlah_menu;
                } else {
                    $list_all_bahan[$bahan['id_bahan']] = $bahan['jumlah'] * $jumlah_menu;
                }
            }
        }

        foreach ($list_all_bahan as $id_bahan => $dibutuhakan) {
            $qbhn = "SELECT * FROM `bahan` where id = '$id_bahan'";
            $resultbhn = mysqli_query($conn, $qbhn);
            if ($resultbhn && mysqli_num_rows($resultbhn)) {
                $bahan = mysqli_fetch_assoc($resultbhn);
                $isNotEnaugh = (($bahan['stok_awal'] + $bahan['jumlah_tambahan']) - $bahan['jumlah_terpakai']) <= $dibutuhakan;
                if ($isNotEnaugh) {
        ?>
                    <script>
                        alert('<?php echo "Stok Bahan " . $bahan['nama'] . " Tidak Mencukupi"; ?>')
                    </script>
                <?php
                    header("Location: ../pegawai/index.php");
                    die();
                }
            }
        }

        foreach ($list_all_bahan as $id_bahan => $dibutuhakan) {
            $updtq = "UPDATE bahan set jumlah_terpakai = jumlah_terpakai + '$dibutuhakan' where id = '$id_bahan'";
            $updtqr = mysqli_query($conn, $updtq);

            if (!$updtqr) {
                ?>
                <script>
                    alert('<?php echo mysqli_error($conn); ?>')
                </script>
<?php
                header("Location: ../pegawai/index.php");
                die();
            }
        }

        $donequery = "UPDATE transaksi set status = 'selesai', total_bayar = '$total_bayar', total_kembali = '$total_bayar' - total_harga, kasir_id = '$_SESSION[id]' where id = '$id'";
        $doneresult = mysqli_query($conn, $donequery);

        if ($doneresult) {
            header("Location: ../pegawai/index.php");
        } else {
            echo "<scrip>
                alert('Gagal mengubah status transaksi');
            </script>";
            header("Location: ../pegawai/index.php");
        }
    }
} else {
    header('Location: ../pegawai/index.php');
}
?>