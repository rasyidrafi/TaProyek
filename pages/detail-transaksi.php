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

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <span id="all-menu" class="d-none"><?= json_encode($data_menu); ?></span>
    <div class="layout-px-spacing" id="root">
        <div class="row invoice layout-top-spacing layout-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="doc-container">

                    <div class="row">
                        <div class="col-12">

                            <div class="invoice-content">

                                <div class="invoice-detail-body">

                                    <div class="invoice-detail-header">

                                        <div class="row justify-content-between">
                                            <div class="col-12 invoice-address-client">

                                                <h4>Data Transaksi:</h4>

                                                <div class="invoice-address-client-fields">
                                                    <div class="form-group row mb-4">
                                                        <label class="col-sm-3 col-form-label col-form-label-sm">Tipe Pembelian</label>
                                                        <div class="col-sm-9">
                                                            <span class="d-flex align-items-center form-control form-contorl-sm text-capitalize">
                                                                <?= $transaksi['tipe']; ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="invoice-address-client-fields">
                                                    <div class="form-group row">
                                                        <label for="nama_pembeli" class="col-sm-3 col-form-label col-form-label-sm">
                                                            <?php
                                                            if ($transaksi['tipe'] == 'online') {
                                                                echo 'Nama Pembeli';
                                                            } else {
                                                                echo 'Nomor Meja';
                                                            }
                                                            ?>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <span class="d-flex align-items-center form-control form-contorl-sm">
                                                                <?= $transaksi['nomor_meja']; ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>

                                    <div class="invoice-detail-terms">

                                        <div class="row d-flex">

                                            <div class="col-md-3">

                                                <div class="form-group mb-4">
                                                    <label for="number">ID Transaksi</label>
                                                    <span class="d-flex align-items-center form-control form-control-sm">
                                                        <?= $transaksi['id']; ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group mb-4">
                                                    <label for="number">Tgl Transaksi</label>
                                                    <span class="d-flex align-items-center form-control form-control-sm">
                                                        <?= date("d-m-Y", strtotime($transaksi['created_at'])) ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <div class="form-group mb-4">
                                                    <label for="number">Status Transaksi</label>
                                                    <span class="d-flex align-items-center form-control form-control-sm text-capitalize">
                                                        <?= $transaksi['status'] ?>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="invoice-detail-items">
                                        <div class="table-responsive">
                                            <table class="table table-bordered item-table">
                                                <thead>
                                                    <tr>
                                                        <th>Menu</th>
                                                        <th class="">Harga</th>
                                                        <th class="">Jumlah</th>
                                                        <th class="text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($detail_transaksi as $key => $value) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <span class="form-control form-control-sm d-flex align-items-center">
                                                                    <?= $value['nama']; ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="form-control form-control-sm d-flex align-items-center">
                                                                    <?= $value['harga']; ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="form-control form-control-sm d-flex align-items-center">
                                                                    <?= $value['jumlah']; ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="form-control form-control-sm d-flex align-items-center">
                                                                    <?php
                                                                    $total = (int)str_replace(".", "", $value['harga']) * (int)$value['jumlah'];
                                                                    echo "<script>
                                                                    document.write(formatRupiah('$total'))
                                                                </script>";
                                                                    ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
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