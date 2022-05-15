<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
<title>Dashboard</title>
<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet" />
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/components/custom-modal.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<script src="../plugins/sweetalerts/promise-polyfill.js"></script>
<link href="../plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link href="../plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css">
<link href="../assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css">

<link href="../plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css">

<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="../plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="../plugins/sweetalerts/custom-sweetalert.js"></script>
<script src="../plugins/select2/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../plugins/select2/select2.min.css">

<style>
    .select2-dropdown.select2-dropdown--below {
        z-index: 2000 !important;
    }
</style>

<script>
    function formatRupiah(angka, prefix) {
        if (angka[0] == '0') {
            angka = angka.substr(1);
        }

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>