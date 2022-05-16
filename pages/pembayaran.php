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
                        <div class="col-xl-9">

                            <div class="invoice-content">

                                <div class="invoice-detail-body">

                                    <div class="invoice-detail-header">

                                        <div class="row justify-content-between">
                                            <div class="col-12 invoice-address-client">

                                                <h4>Data Customer:</h4>

                                                <div class="invoice-address-client-fields">
                                                    <div class="form-group row">
                                                        <label for="nama_pembeli" class="col-sm-3 col-form-label col-form-label-sm">Nama Pembeli</label>
                                                        <div class="col-sm-9">
                                                            <span class="d-flex align-items-center form-control form-contorl-sm">
                                                                <?= $transaksi['nama_pembeli']; ?>
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

                                            <div class="col-md-3">
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


                                    <div class="invoice-detail-total">

                                        <div class="row">

                                            <div class="col-md-6">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="totals-row">
                                                    <div class="invoice-totals-row invoice-summary-subtotal">

                                                        <div class="invoice-summary-label">Subtotal</div>

                                                        <div class="invoice-summary-value">
                                                            <div class="subtotal-amount">
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
                                                            </div>
                                                        </div>

                                                    </div>



                                                    <div class="invoice-totals-row invoice-summary-total">

                                                        <div class="invoice-summary-label">Discount</div>

                                                        <div class="invoice-summary-value">
                                                            <div class="total-amount">
                                                                -
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="invoice-totals-row invoice-summary-tax">

                                                        <div class="invoice-summary-label">Pajak</div>

                                                        <div class="invoice-summary-value">
                                                            <div class="tax-amount">
                                                                <span>10%</span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="invoice-totals-row invoice-summary-balance-due">

                                                        <div class="invoice-summary-label">Total</div>

                                                        <div class="invoice-summary-value">
                                                            <div class="balance-due-amount">
                                                                <?php
                                                                $total = 0;
                                                                foreach ($detail_transaksi as $key => $value) {
                                                                    $harga = str_replace(".", "", $value['harga']);
                                                                    $total = $total + (int)$harga * (int)$value['jumlah'];
                                                                }
                                                                $totalPlusTax = $total + ($total * 0.1);
                                                                echo "<script>
                                                                document.write(formatRupiah('$totalPlusTax'))
                                                            </script>";
                                                                ?>
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

                            <div class="invoice-actions">

                                <div class="invoice-action-tax mt-0 pt-0">

                                    <h5>Pajak</h5>

                                    <div class="invoice-action-tax-fields">

                                        <div class="row">

                                            <div class="col-6">

                                                <div class="form-group mb-0">
                                                    <label for="type">Type</label>

                                                    <div class="dropdown selectable-dropdown invoice-tax-select">
                                                        <a class="dropdown-toggle">
                                                            <span class="selectable-text">Total</span>
                                                        </a>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-6">
                                                <div class="form-group mb-0 tax-rate-deducted">
                                                    <label for="rate">Rate (%)</label>
                                                    <input readonly type="number" class="form-control input-rate" id="rate" placeholder="Rate" value="10" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="invoice-action-discount">

                                    <h5>Pembayaran</h5>

                                    <div class="invoice-action-discount-fields">

                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group mb-0">
                                                    <span class="form-control form-control-sm d-flex align-items-center">
                                                        <?= $transaksi['pembayaran'] ?>
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="invoice-action-discount">

                                    <h5>Tipe Pembelian</h5>

                                    <div class="invoice-action-discount-fields">

                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group mb-0">
                                                    <span class="form-control form-control-sm d-flex align-items-center">
                                                        <?= $transaksi['tipe'] ?>
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php if ($transaksi['tipe'] == "online") {
                                ?>
                                    <div>

                                        <div class="invoice-action-discount">

                                            <h5>Lokasi Pembeli</h5>

                                            <div class="invoice-action-discount-fields">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group mb-0">
                                                            <span class="form-control form-control-sm d-flex align-items-center">
                                                                <?= $transaksi['lokasi_pembeli'] ?>
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="invoice-action-discount">

                                            <h5>Ongkir</h5>

                                            <div class="invoice-action-discount-fields">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group mb-0">
                                                            <span class="form-control form-control-sm d-flex align-items-center">
                                                                <script>
                                                                    document.write(formatRupiah(`<?= $transaksi['ongkir'] ?>`))
                                                                </script>
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                <?php
                                } ?>


                            </div>

                            <div class="invoice-actions-btn">
                                <div class="invoice-action-btn">

                                    <div class="row">
                                        <div class="col-xl-12 col-md-4">
                                            <a href="javascript:void(0);" onclick="proses()" class="btn btn-success btn-send">Proses</a>
                                        </div>

                                        <div class="col-xl-12 col-md-4">
                                            <a href="javascript:void(0);" onclick="nota()" class="btn btn-primary btn-send">Nota</a>
                                        </div>

                                        <div class="col-xl-12 col-md-4">
                                            <a href="javascript:void(0);" onclick="really()" class="btn btn-danger btn-send">Tolak</a>
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

<form id="batal-form" class="d-none" action="../pages/batal-transaksi.php" method="POST">
    <input type="text" value="<?= $transaksi['id'] ?>" name="id">
    <button type="submit" id="submit-batal"></button>
</form>

<form id="proses-form" class="d-none" action="../pages/proses-transaksi.php" method="POST">
    <input type="text" value="<?= $transaksi['id'] ?>" name="id">
    <input type="text" id="uang-pembeli" name="total_bayar">
</form>

<script>
    let really = () => {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda akan membatalkan transaksi ini!",
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                $("#submit-batal").click();
            }
        })
    }

    let proses = () => {
        let status = "<?= $transaksi['tipe'] ?>";
        status = status.trim();

        if (status == "bayar ditempat") {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Transaksi akan langsung diproses!",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {

                    let minimal = `
                    <?php
                    $total = 0;
                    foreach ($detail_transaksi as $key => $value) {
                        $harga = str_replace(".", "", $value['harga']);
                        $total = $total + (int)$harga * (int)$value['jumlah'];
                    }
                    $totalPlusTax = $total + ($total * 0.1);
                    echo $totalPlusTax;
                    ?>
                    `;
                    minimal = minimal.trim();

                    Swal.fire({
                        title: `Masukkan Uang Pembeli - Minimal ${formatRupiah(minimal)}`,
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off',
                            autocomplete: 'off',
                            min: minimal,
                            type: 'number'
                        },
                        showCancelButton: true,
                        showLoaderOnConfirm: true,
                        preConfirm: (inputVal) => {
                            inputVal = inputVal.replace(/[^0-9]/g, '');
                            if (inputVal < minimal) {
                                return Swal.showValidationError(
                                    `Uang pembeli kurang dari ${formatRupiah(minimal)}`
                                )
                            } else {
                                $("#uang-pembeli").val(parseInt(inputVal));
                                return true;
                            }
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            $("#proses-form").submit();
                        }
                    })
                }
            })
        }
    }
</script>