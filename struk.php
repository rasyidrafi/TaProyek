<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>struk</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico" />
   
    <link
      href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="./bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link href="./assets/css/plugins.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl">
                <br>
                <br>
            <center>
                <h5 class="text-center">JL Perusahan,No.20,Tanjungtirto,Singosari</h5>
                <p>Tanggal :<?=date('j F Y, G:i') ?></p>
                <p>Kasir   : sdcsdcscscsd </p>
            </center>
            <table  class="table table-bordered " style="width: 100%; ">
            <thead >
            <?php $no=1; ?>
            <tr>
				<td>No.</td>
				<td>Menu</td>
			    <td>Jumlah</td>
				<td>Total</td>
			</tr>
			<?php $no=1; ?>
			<tr>
				<td><?php echo $no;?></td>
				<td><?php ?></td>
				<td><?php ?></td>
				<td><?php ;?></td>
			</tr>
			<?php $no++; ?>
            </thead>
            </table>
            <div class="text-right">
                <br>
                <p>Total    :saxas</p>
                <p>Bayar    :ascas</p>
                <p>Kembali  asc:</p>
            </div>
            <div class="aksi">
                <a href=""><button class="btn btn-success">Print</button></a>
                <button class="btn btn-primary">Download</button>
            </div>
            </div>
        </div>
    </div>
        
</body>
</html>