<?php
    session_start();

    // jika ada user yang berusaha masuk tanpa melalui login
    if (!isset($_SESSION["login"])) {
        header("Location: ../login.php"); // alihkan ke halaman login
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bahan Baku</title>
</head>
<body>
    <h4>Data Bahan Baku</h4>
    <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <div id="alter_pagination_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="alter_pagination_length">
                                <input type="Tambah Data" name="txt" class="mt-4 btn btn-primary">
                                    <thead>
                                        <tr role="row"><th class="sorting" tabindex="0" aria-controls="alter_pagination" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 57px;">Nama Bahan</th>
                                        <th class="sorting" tabindex="0" aria-controls="alter_pagination" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 79px;">Stok Awal</th>
                                        <th class="sorting" tabindex="0" aria-controls="alter_pagination" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 52px;">Jumlah Terpakai</th>
                                        <th class="sorting" tabindex="0" aria-controls="alter_pagination" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 28px;">Jumlah Tambahan</th>
                                        <th class="sorting" tabindex="0" aria-controls="alter_pagination" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 58px;">Stok Sekarang</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="alter_pagination" rowspan="1" colspan="1" aria-label="Salary: activate to sort column descending" aria-sort="ascending" style="width: 55px;">Satuan</th>
                                        <th class="text-center sorting" tabindex="0" aria-controls="alter_pagination" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 54px;">Action</th></tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row">
                                            <td class="">Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td class="sorting_1">$86,000</td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a>
                                            </td>
                                </tr>
                                        </tr></tbody>
                                    <tfoot>
                                    <tr><th rowspan="1" colspan="1">Nama Bahan</th>
                                        <th rowspan="1" colspan="1">Stok Awal</th>
                                        <th rowspan="1" colspan="1">Jumlah Terpakai</th>
                                        <th rowspan="1" colspan="1">Jumlah Tambahan</th>
                                        <th rowspan="1" colspan="1">Stok Sekarang</th>
                                        <th rowspan="1" colspan="1">Satuan</th>
                                        <th rowspan="1" colspan="1"></th></tr>
                                    </tfoot>
                                </table></div></div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5"><div class="dataTables_info" id="alter_pagination_info" role="status" aria-live="polite">Showing page 1 of 3</div></div>
                                    <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_full_numbers" id="alter_pagination_paginate"><ul class="pagination"><li class="paginate_button page-item first disabled" id="alter_pagination_first">
                                        <a href="#" aria-controls="alter_pagination" data-dt-idx="0" tabindex="0" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li><li class="paginate_button page-item previous disabled" id="alter_pagination_previous"><a href="#" aria-controls="alter_pagination" data-dt-idx="1" tabindex="0" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg></a></li><li class="paginate_button page-item active">
                                        <a href="#" aria-controls="alter_pagination" data-dt-idx="2" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item ">
                                        <a href="#" aria-controls="alter_pagination" data-dt-idx="3" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="alter_pagination" data-dt-idx="4" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item next" id="alter_pagination_next"><a href="#" aria-controls="alter_pagination" data-dt-idx="5" tabindex="0" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a></li><li class="paginate_button page-item last" id="alter_pagination_last">
                                        <a href="#" aria-controls="alter_pagination" data-dt-idx="6" tabindex="0" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li></ul></div></div></div></div>
                            </div>
                        </div>
</body>
</html>
