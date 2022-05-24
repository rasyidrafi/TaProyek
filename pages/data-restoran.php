<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="general-info" class="section general-info">
                                <div class="">
                                    <h6 class="">Data Restoran</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-12 col-md-4">
                                                    <div class="upload mt-4 pr-md-4">
                                                        <input type="file" name="File" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />
                                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Logo Restoran</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Nama Restoran</label>
                                                                    <input type="text" name="nama_restoran" class="form-control mb-4" id="fullName" placeholder="Nama Restoran" value="<?= $_SESSION['restoran']['nama_restoran'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="dob-input">Nomor Telepon</label>
                                                                <input name="nomor" type="tel" class="form-control mb-4" id="nomor" placeholder="Nomor Restoran" value="<?= $_SESSION['restoran']['nomor'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="profession">Alamat Restoran</label>
                                                            <textarea placeholder="Alamat Restoran" name="alamat" class="form-control mb-4" id="profession" rows="10"><?= $_SESSION['restoran']['alamat'] ?></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pajak">Pajak Restoran</label>
                                                            <div class="input-group mb-5">
                                                                <input oninput="event.target.value = event.target.value.replace(/[^0-9]/g,'')" class="form-control" type="number" name="pajak" id="pajak" value="<?= $_SESSION['restoran']['pajak'] ?>">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon6">%</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="account-settings-footer mb-4">

                <div class="as-footer-container">

                    <button id="multiple-messages" class="btn btn-primary">Save Changes</button>
                </div>

            </div>
        </div>

    </div>
</div>

<form id="form-real" action="../pages/edit-restoran.php" class="d-none" method="POST">
    <input type="text" name="logo" id="logo-real" value="<?= $_SESSION['restoran']['logo'] ?>">
    <input type="hidden" name="nama_restoran" id="nama_restoran-real" value="">
    <input type="hidden" name="nomor" id="nomor-real"" value="">
    <input type=" hidden" name="alamat" id="alamat-real" value="">
    <input type="hidden" name="pajak" id="pajak-real" value="">
</form>

<script>
    const filesToBase64 = (files) => {
        return new Promise((resolve, reject) => {
            const filesArray = Array.from(files);
            const filesCount = filesArray.length;
            const filesResolve = [];

            if (!filesCount) {
                resolve([]);
            }

            filesArray.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = () => {
                    filesResolve.push(reader.result);
                    if (filesResolve.length === filesCount) {
                        resolve(filesResolve);
                    }
                };
                reader.readAsDataURL(file);
            });
        });
    };



    function resetPreview(src, fname = '') {
        let input = $(`#input-file-max-fs`);
        let wrapper = $('.dropify-wrapper');
        let preview = $('.dropify-preview');
        let filename = $('.dropify-filename-inner');
        let render = wrapper.find('.dropify-render').html('');

        input.val('').attr('title', fname);
        wrapper.removeClass('has-error').addClass('has-preview');
        filename.html(fname);

        render.append($('<img />').attr('src', src).css('max-height', input.data('height') || ''));
        preview.fadeIn();
    }


    $("#multiple-messages").click(() => {
        let file = document.getElementById("input-file-max-fs").files;
        filesToBase64(file).then((result) => {
            let logo = result[0];
            let nama_restoran = $("#fullName").val();
            let nomor = $("#nomor").val();
            let alamat = $("#profession").val();
            let pajak = $("#pajak").val();

            $("#logo-real").val(logo);
            $("#nama_restoran-real").val(nama_restoran);
            $("#nomor-real").val(nomor);
            $("#alamat-real").val(alamat);
            $("#pajak-real").val(pajak);

            $("#form-real").submit();
        });
    })
</script>

<?php
if (isset($_SESSION['restoran']['logo'])) {
?>
    <script>
        $(function() {
            resetPreview("<?= $_SESSION['restoran']['logo'] ?>",
                'logo.jpg');
        });
    </script>
<?php
}
?>