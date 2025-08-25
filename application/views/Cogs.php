<form id="formPengaturan">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow bg-blur2">
                    <div class="card-header">
                        <h3><?= $title ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label mandatory">Nama Website</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $web['nama'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="wa" class="form-label mandatory">WA/No Hp</label>
                                    <input type="text" class="form-control" id="wa" name="wa" value="<?= $web['wa'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="github" class="form-label mandatory">Github</label>
                                    <input type="text" class="form-control" id="github" name="github" value="<?= $web['github'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label mandatory">Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $web['instagram'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="smtp" class="form-label">Kode SMTP</label>
                                    <input type="password" class="form-control" id="smtp" name="smtp" value="<?= $web['smtp'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label mandatory">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $web['email'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img id="preview_logo" src="<?= base_url('assets/image/web/') . $this->data['logo'] ?>" class="w-100" style="border-radius: 10px;">
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" id="logo" name="logo" value="<?= $web['logo'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="loading" class="form-label">Loading</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img id="preview_loading" src="<?= base_url('assets/image/web/') . $this->data['loading'] ?>" class="w-100" style="border-radius: 10px;">
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" id="loading" name="loading" value="<?= $web['loading'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="latar_belakang" class="form-label">Latar Belakang</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img id="preview_latar_belakang" src="<?= base_url('assets/image/web/') . $this->data['latar_belakang'] ?>" class="w-100" style="border-radius: 10px;">
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" id="latar_belakang" name="latar_belakang" value="<?= $web['latar_belakang'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="favicon" class="form-label">Favicon</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img id="preview_favicon" src="<?= base_url('assets/image/web/') . $this->data['favicon'] ?>" class="w-100" style="border-radius: 10px;">
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" id="favicon" name="favicon" value="<?= $web['favicon'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label mandatory">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="3" onchange="capitalizeWords(this.value, 'alamat')"><?= $web['alamat'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <button type="button" class="btn btn-warning" onclick="proses()"><i class="fa fa-solid fa-fw fa-save"></i> Proses</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    // perubahan favicon
    $("#favicon").change(function() {
        readURLFavicon(this); // jalankan fungsi readUrlFavicon
    });

    // preview favicon
    function readURLFavicon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_favicon').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview_favicon').attr('src', '');
        }
    }

    // perubahan logo
    $("#logo").change(function() {
        readURLLogo(this); // jalankan fungsi readUrlLogo
    });

    // preview logo
    function readURLLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview_logo').attr('src', '');
        }
    }

    // perubahan loading
    $("#loading").change(function() {
        readURLLoading(this); // jalankan fungsi readUrlLoading
    });

    // preview loading
    function readURLLoading(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_loading').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview_loading').attr('src', '');
        }
    }

    // perubahan latar_belakang
    $("#latar_belakang").change(function() {
        readURLLatarBelakang(this); // jalankan fungsi readUrlLatarBelakang
    });

    // preview latar_belakang
    function readURLLatarBelakang(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_latar_belakang').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview_latar_belakang').attr('src', '');
        }
    }

    // fungsi proses update pengaturan web
    function proses() {
        var nama = $('#nama').val() // variable id nama
        var wa = $('#wa').val() // variable id wa
        var github = $('#github').val() // variable id github
        var instagram = $('#instagram').val() // variable id instagram
        var email = $('#email').val() // variable id email
        var alamat = $('#alamat').val() // variable id alamat
        var favicon = $('#favicon').val() // variable id favicon
        var logo = $('#logo').val() // variable id logo
        var loading = $('#loading').val() // variable id loading
        var latar_belakang = $('#latar_belakang').val() // variable id latar_belakang

        if (nama == '') { // jika nama kosong
            var msg = '<span class="text-danger fw-bold">Nama Website</span>' // bariable msg
            var msg2 = 'Tidak boleh kosong!' // bariable msg2

            Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

            return
        }

        if (wa == '') { // jika wa kosong
            var msg = '<span class="text-danger fw-bold">WA/No Hp</span>' // bariable msg
            var msg2 = 'Tidak boleh kosong!' // bariable msg2

            Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

            return
        }

        if (github == '') { // jika github kosong
            var msg = '<span class="text-danger fw-bold">Github</span>' // bariable msg
            var msg2 = 'Tidak boleh kosong!' // bariable msg2

            Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

            return
        }

        if (instagram == '') { // jika instagram kosong
            var msg = '<span class="text-danger fw-bold">Instagram</span>' // bariable msg
            var msg2 = 'Tidak boleh kosong!' // bariable msg2

            Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

            return
        }

        if (email == '') { // jika email kosong
            var msg = '<span class="text-danger fw-bold">Email</span>' // bariable msg
            var msg2 = 'Tidak boleh kosong!' // bariable msg2

            Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

            return
        }

        if (alamat == '') { // jika alamat kosong
            var msg = '<span class="text-danger fw-bold">Alamat</span>' // bariable msg
            var msg2 = 'Tidak boleh kosong!' // bariable msg2

            Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

            return
        }

        send_postFile('<?= site_url("Cogs/updateProses") ?>', $('#formPengaturan'))
    }
</script>