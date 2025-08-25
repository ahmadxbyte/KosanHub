<form id="formProfile">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="card shadow bg-blur2">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 col-12">
                                <img id="preview_img" src="<?= base_url('assets/image/user/') . $this->data['gambar'] ?>" class="w-100" style="border-radius: 10px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12 text-center">
                                <span class="fw-bold" style="color:rgb(0, 0, 0); font-size: 18px; border: 2px solid rgb(0, 0, 0); padding: 5px 10px; border-radius: 5px;"><?= getData('ms_role', ['kodeRole' => $profile['kodeRole']])['keterangan'] ?></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table>
                                        <tr>
                                            <th style="padding: 5px;" width="38%">Nama</th>
                                            <td style="padding: 5px;" width="5%"></td>
                                            <td style="padding: 5px;" width="57%"><?= $profile['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px;" width="38%">Gender</th>
                                            <td style="padding: 5px;" width="5%"></td>
                                            <td style="padding: 5px;" width="57%"><?= (($profile['gender']) == '0' ? 'Wanita' : 'Laki-laki') ?></td>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px;" width="38%">Tempat Lahir</th>
                                            <td style="padding: 5px;" width="5%"></td>
                                            <td style="padding: 5px;" width="57%"><?= $profile['tmpLahir'] ?></td>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px;" width="38%">Tanggal Lahir</th>
                                            <td style="padding: 5px;" width="5%"></td>
                                            <td style="padding: 5px;" width="57%"><?= tglIndo($profile['tglLahir']) ?></td>
                                        </tr>
                                        <tr>
                                            <th style="padding: 5px;" width="38%">Tanggal Join</th>
                                            <td style="padding: 5px;" width="5%"></td>
                                            <td style="padding: 5px;" width="57%"><?= $profile['waktuBergabung'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="card shadow bg-blur2">
                    <div class="card-body">
                        <input type="hidden" name="fortab" id="fortab" value="0">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link text-decoration-none text-black active" aria-current="page" href="#" id="btnProfile" onclick="selectTab(0)">Data Diri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-decoration-none text-black" href="#" id="btnUbahPassword" onclick="selectTab(1)">Ubah Sandi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-decoration-none text-black" href="#" id="btnHistoriBayar" onclick="selectTab(2)">Histori Pembayaran</a>
                            </li>
                        </ul>
                        <hr>
                        <div id="profile">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="gambar" name="gambar">
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label mandatory">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $profile['nama'] ?>" onchange="capitalizeWords(this.value, 'nama')">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="mb-3">
                                        <label for="nohp" class="form-label mandatory">No Hp</label>
                                        <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $profile['nohp'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label mandatory">Gender</label>
                                        <select name="gender" id="gender" class="form-control select2_global" data-placeholder="Pilih Gender">
                                            <option value="">Pilih Gender</option>
                                            <option value="1" <?= (($profile['gender']) == 1 ? 'selected' : '') ?>>Laki-laki</option>
                                            <option value="0" <?= (($profile['gender']) == 0 ? 'selected' : '') ?>>Wanita</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="mb-3">
                                        <label for="tmpLahir" class="form-label mandatory">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tmpLahir" name="tmpLahir" value="<?= $profile['tmpLahir'] ?>" onchange="capitalizeWords(this.value, 'tmpLahir')">
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="mb-3">
                                        <label for="tglLahir" class="form-label mandatory">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tglLahir" name="tglLahir" value="<?= date('Y-m-d', strtotime($profile['tglLahir'])) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" rows="2" onchange="capitalizeWords(this.value, 'alamat')"><?= $profile['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ubahPassword">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="password" class="form-label mandatory">Sandi</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="password" name="password" aria-describedby="basic-addon2">
                                            <span class="input-group-text" id="basic-addon2" onclick="cekSecure()">
                                                <i class="fa-solid fa-eye-slash text-success" id="secure"></i>
                                                <i class="fa-solid fa-eye text-danger" id="notsecure"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="password2" class="form-label mandatory">Ulangi Sandi</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="password2" name="password2" aria-describedby="basic-addon2">
                                            <span class="input-group-text" id="basic-addon2" onclick="cekSecure2()">
                                                <i class="fa-solid fa-eye-slash text-success" id="secure2"></i>
                                                <i class="fa-solid fa-eye text-danger" id="notsecure2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="historiBayar">x</div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <button type="button" class="btn btn-warning" onclick="proses()"><i class="fa fa-fw fa-solid fa-save"></i> Proses</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    selectTab(0)

    function selectTab(param) {
        // berikan parameter untuk value tab
        $('#fortab').val(param)

        if (param == 0) {
            // menampilkan dan menyembunyikan id yg diperlukan
            $('#profile').show()
            $('#ubahPassword').hide()
            $('#historiBayar').hide()

            // aktifkan tombol
            $('#btnProfile').addClass('active')
            $('#btnUbahPassword').removeClass('active')
            $('#btnHistoriBayar').removeClass('active')

            $('.card-footer').show()
        } else if (param == 1) {
            // menampilkan dan menyembunyikan id yg diperlukan
            $('#profile').hide()
            $('#ubahPassword').show()
            $('#historiBayar').hide()

            // aktifkan tombol
            $('#btnProfile').removeClass('active')
            $('#btnUbahPassword').addClass('active')
            $('#btnHistoriBayar').removeClass('active')

            $('.card-footer').show()
        } else {
            // menampilkan dan menyembunyikan id yg diperlukan
            $('#profile').hide()
            $('#ubahPassword').hide()
            $('#historiBayar').show()

            // aktifkan tombol
            $('#btnProfile').removeClass('active')
            $('#btnUbahPassword').removeClass('active')
            $('#btnHistoriBayar').addClass('active')

            $('.card-footer').hide()
        }
    }

    // perubahan gambar
    $("#gambar").change(function() {
        readURL(this); // jalankan fungsi readUrl
    });

    // preview gambar
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview_img').attr('src', '');
        }
    }

    // fungsi proses update profile
    function proses() {
        var password = $('#password').val() // variable id password
        var password2 = $('#password2').val() // variable id password2
        var nama = $('#nama').val() // variable id nama
        var nohp = $('#nohp').val() // variable id nohp
        var tmpLahir = $('#tmpLahir').val() // variable id tmpLahir
        var tglLahir = $('#tglLahir').val() // variable id tglLahir
        var gender = $('#gender').val() // variable id gender
        var fortab = $('#fortab').val() // variable id fortab

        if (fortab == 1) {
            if (password == '') { // jika password kosong
                var msg = '<span class="text-danger fw-bold">Sandi</span>' // bariable msg
                var msg2 = 'Tidak boleh kosong!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }

            if (password2 == '') { // jika password2 kosong
                var msg = '<span class="text-danger fw-bold">Ulangi Sandi</span>' // bariable msg
                var msg2 = 'Tidak boleh kosong!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }

            if (password != password2) {
                var msg = '<span class="text-danger fw-bold">Kata Sandi</span>' // bariable msg
                var msg2 = 'Berbeda, ulangi lagi!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }
        }

        if (fortab == 0) {
            if (nama == '') { // jika nama kosong
                var msg = '<span class="text-danger fw-bold">Nama</span>' // bariable msg
                var msg2 = 'Tidak boleh kosong!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }

            if (nohp == '') { // jika nohp kosong
                var msg = '<span class="text-danger fw-bold">No Hp</span>' // bariable msg
                var msg2 = 'Tidak boleh kosong!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }

            if (tmpLahir == '') { // jika tmpLahir kosong
                var msg = '<span class="text-danger fw-bold">Tempat Lahir</span>' // bariable msg
                var msg2 = 'Tidak boleh kosong!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }

            if (tglLahir == '') { // jika tglLahir kosong
                var msg = '<span class="text-danger fw-bold">Tanggal Lahir</span>' // bariable msg
                var msg2 = 'Tidak boleh kosong!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }

            if (gender == '') { // jika gender kosong
                var msg = '<span class="text-danger fw-bold">Gender</span>' // bariable msg
                var msg2 = 'Tidak boleh kosong!' // bariable msg2

                Toast(msg, msg2) // jalankan funstion Toast dengan 2 parameter (msg, msg2)

                return
            }
        }

        send_postFile('<?= site_url("Profile/updateProses") ?>', $('#formProfile'))
    }
</script>