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
        $pembayaran = $_POST['pembayaran'];
        $diskon = $_POST['diskon'];
        $pajak = $_POST['pajak'];
        $lokasi_pembeli = $_POST['lokasi_pembeli'];
        $ongkir = $_POST['ongkir'];
        $tipe = $_POST['tipe'];

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
                $isNotEnaugh = ((($bahan['stok_awal'] + $bahan['jumlah_tambahan']) * $bahan['porsi'] ) - $bahan['porsi_terpakai']) <= $dibutuhakan;
                if ($isNotEnaugh) {
        ?>
                    <script>
                        alert('<?php echo "Porsi Bahan " . $bahan['nama'] . " Tidak Mencukupi"; ?>')
                        window.location.assign('../pegawai/index.php');
                    </script>
                <?php
                    // header("Location: ../pegawai/index.php");
                    die();
                }
            }
        }

        foreach ($list_all_bahan as $id_bahan => $dibutuhakan) {
            $updtq = "UPDATE bahan set porsi_terpakai = porsi_terpakai + '$dibutuhakan' where id = '$id_bahan'";
            $updtqr = mysqli_query($conn, $updtq);

            if (!$updtqr) {
                ?>
                <script>
                    alert('<?php echo mysqli_error($conn); ?>')
                    window.location.assign('../pegawai/index.php');
                </script>
<?php
                // header("Location: ../pegawai/index.php");
                die();
            }
        }

        $statusnya = 'selesai';

        if ($tipe == 'online') {
            $statusnya = "perlu dikirim";
        }

        $minimum = $_POST['minimum'];
        $total_kembali = (int)$total_bayar - (int)$minimum;

        $donequery = "UPDATE transaksi set status = '$statusnya', total_bayar = '$total_bayar', pembayaran = '$pembayaran', diskon = '$diskon', pajak = '$pajak', lokasi_pembeli = '$lokasi_pembeli', ongkir = '$ongkir', kasir_id = '$_SESSION[id]', total_kembali = '$total_kembali' where id = '$id'";
        $doneresult = mysqli_query($conn, $donequery);

        if ($doneresult) {
            header("Location: ../pegawai/index.php");
        } else {
            echo "<scrip>
                alert('Gagal mengubah status transaksi');
                window.location.assign('../pegawai/index.php');
            </script>";
            // header("Location: ../pegawai/index.php");
        }
    }
} else {
    header('Location: ../pegawai/index.php');
}
?>