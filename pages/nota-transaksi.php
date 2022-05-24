<?php
session_start();

$conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

$data_menu = [];
$result = mysqli_query($conn, "SELECT * FROM menu");
if ($result && mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_menu[] = $row;
    }
}

$transaksi;
$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = '$id'");
if ($res && mysqli_num_rows($res)) {
    $transaksi = mysqli_fetch_assoc($res);
}

$detail_transaksi = [];
$res = mysqli_query($conn, "SELECT * FROM transaksi_detail LEFT JOIN menu on id_menu = menu.id WHERE id_transaksi = '$id'");
if ($res && mysqli_num_rows($res)) {
    while ($row = mysqli_fetch_assoc($res)) {
        $detail_transaksi[] = $row;
    }
}

// jika ada user yang berusaha masuk tanpa melalui login
if (!isset($_SESSION["role"])) {
    header("Location: ../login.php"); // alihkan ke halaman login
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../component/_head.php"; ?>
</head>

<body class="sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
    <?php include "../component/_navbar.php" ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <?php include "../component/_sidebar.php"; ?>

        <!-- CONTENT AREA -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row invoice layout-top-spacing layout-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="doc-container">

                            <div class="row">

                                <div class="col-xl-9">

                                    <div class="invoice-container">
                                        <div class="invoice-inbox">

                                            <div id="ct" class="">

                                                <div class="invoice-00001">
                                                    <div class="content-section">

                                                        <div class="inv--head-section inv--detail-section">

                                                            <div class="row">

                                                                <div class="col-sm-6 col-12 mr-auto">
                                                                    <div class="d-flex">
                                                                        <img class="company-logo" src="<?= $_SESSION['restoran']['logo'] ?>" alt="logo restoran">
                                                                        <h3 class="in-heading align-self-center"><?= $_SESSION['restoran']['nama_restoran'] ?></h3>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 text-sm-right">
                                                                    <p class="inv-list-number"><span class="inv-title">Nota : </span> <span class="inv-number">#<?= $_GET['id'] ?></span></p>
                                                                </div>

                                                                <div class="col-sm-6 align-self-center mt-3">
                                                                    <p class="inv-street-addr"><?= $_SESSION['restoran']['alamat'] ?></p>
                                                                    <!-- <p class="inv-email-address">info@company.com</p> -->
                                                                    <p class="inv-email-address"><?= $_SESSION['restoran']['nomor'] ?></p>
                                                                </div>

                                                                <div class="col-sm-6 align-self-center mt-3 text-sm-right">
                                                                    <p class="inv-created-date"><span class="inv-title">Tanggal : </span> <span class="inv-date">
                                                                            <?= date('d-m-Y', strtotime($transaksi['created_at'])) ?>
                                                                        </span></p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="inv--detail-section inv--customer-detail-section">

                                                            <div class="row">

                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                    <p class="inv-to">Nota untuk</p>
                                                                </div>

                                                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 inv--payment-info">
                                                                    <h6 class=" inv-title">Pembayaran:</h6>
                                                                </div>

                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                    <p class="inv-customer-name text-capitalize">
                                                                        <?php
                                                                        if ($transaksi['tipe'] == 'online') {
                                                                            echo "Nama Pembeli";
                                                                        } else {
                                                                            echo "Nomor Meja";
                                                                        }

                                                                        ?>
                                                                        <?= $transaksi['nomor_meja'] ?>
                                                                    </p>
                                                                </div>

                                                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1">
                                                                    <div class="inv--payment-info">
                                                                        <p>
                                                                            <span class="inv-subtitle text-capitalize">
                                                                                <?= $transaksi['pembayaran'] ?>
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="inv--product-table-section">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="">
                                                                        <tr>
                                                                            <th scope="col">No</th>
                                                                            <th scope="col">Menu</th>
                                                                            <th class="text-right" scope="col">Harga</th>
                                                                            <th class="text-right" scope="col">Jumlah</th>
                                                                            <th class="text-right" scope="col">Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        foreach ($detail_transaksi as $key => $value) {
                                                                            $menu = $value['nama'];
                                                                            $harga = $value['harga'];
                                                                            $jumlah = $value['jumlah'];
                                                                            $hargaRaw = str_replace('.', '', $harga);
                                                                            $total = $hargaRaw * $jumlah;

                                                                        ?>

                                                                            <tr>
                                                                                <td><?= $key + 1 ?></td>
                                                                                <td><?= $menu ?></td>
                                                                                <td class="text-right">Rp. <?= $harga ?></td>
                                                                                <td class="text-right"><?= $jumlah ?></td>
                                                                                <td class="text-right">
                                                                                    Rp. <span>
                                                                                        <script>
                                                                                            document.write(formatRupiah(`<?= $total ?>`))
                                                                                        </script>
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="inv--total-amounts">

                                                            <div class="row mt-4">
                                                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                                </div>
                                                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                                    <div class="text-sm-right">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-7">
                                                                                <p class="">Sub Total: </p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p class="">
                                                                                    <?php
                                                                                    $total = 0;
                                                                                    foreach ($detail_transaksi as $key => $value) {
                                                                                        $harga = str_replace(".", "", $value['harga']);
                                                                                        $total = $total + (int)$harga * (int)$value['jumlah'];
                                                                                    }
                                                                                    echo "<script>
                                                                        document.write(formatRupiah('$total'))
                                                                    </script>";
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-sm-8 col-7">
                                                                                <p class="">Pajak <?= $transaksi['pajak'] ?>%:</p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p class="">
                                                                                    <?php
                                                                                    $total = 0;
                                                                                    foreach ($detail_transaksi as $key => $value) {
                                                                                        $harga = str_replace(".", "", $value['harga']);
                                                                                        $total = $total + (int)$harga * (int)$value['jumlah'];
                                                                                        $total = ($total * ($transaksi['pajak'] / 100));
                                                                                    }
                                                                                    echo "<script>
                                                                        document.write(formatRupiah('$total'))
                                                                    </script>";
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-sm-8 col-7">
                                                                                <p class=" discount-rate">Discount:</p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p class=""><?= $transaksi['diskon'] ?></p>
                                                                            </div>
                                                                            <!--  -->
                                                                            <?php if ($transaksi['tipe'] == 'online') {
                                                                            ?>
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class=" discount-rate">Ongkir:</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class=""><?= $transaksi['ongkir'] ?></p>
                                                                                </div>
                                                                            <?php
                                                                            } ?>
                                                                            <!--  -->
                                                                            <div class="col-sm-8 col-7 grand-total-title">
                                                                                <h4 class="">Grand Total : </h4>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5 grand-total-amount">
                                                                                <h4 class="">
                                                                                    <?php
                                                                                    $total = 0;
                                                                                    foreach ($detail_transaksi as $key => $value) {
                                                                                        $harga = str_replace(".", "", $value['harga']);
                                                                                        $total = $total + (int)$harga * (int)$value['jumlah'];
                                                                                    }
                                                                                    $subtotal = $total - $transaksi['diskon'];
                                                                                    $real = $subtotal + ($subtotal * ($transaksi['pajak'] / 100));
                                                                                    $total = $real + $transaksi['ongkir'];
                                                                                    echo "<script>
                                                                        document.write(formatRupiah('$total'))
                                                                    </script>";
                                                                                    ?>
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div>

                                <div class="col-xl-3">

                                    <div class="invoice-actions-btn">

                                        <div class="invoice-action-btn">

                                            <div class="row">
                                                <div class="col-xl-12 col-md-3 col-sm-6">
                                                    <?php if ($transaksi['status'] != 'selesai' && $transaksi['status'] != "perlu dikirim") {
                                                    ?>
                                                        <a href="javascript:void(0);" class="disabled  mb-0 btn btn-secondary btn-print  action-print">Print</a>
                                                        <span class="text-danger text-center d-block">perlu diproses terlebih dahulu</span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!--  END CONTENT AREA  -->

        <?php include "../component/_script.php"; ?>
</body>

</html>