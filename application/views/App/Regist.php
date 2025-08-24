<form id="formLogin">
    <div class="row min-vh-100 align-items-center">
        <div class="col-md-6 col-12">
            <div class="card shadow border-top-primary border-bottom-warning p-3">
                <div class="card-header text-center">
                    <img src="<?= base_url('assets/image/web/') . $this->data['logo'] ?>" alt="logo" class="img-fluid" style="max-width: 200px; width: 100%; height: auto; object-fit: contain;">
                </div>
                <div class="card-body">
                    <div class="row mb-4 text-center">
                        <div class="col-md-12 col-12">
                            <span class="fw-bold text-warning"><?= $title ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="mb-3">
                                <label for="email" class="form-label mandatory">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label mandatory">Nama</label>
                                <input type="email" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="mb-3">
                                <label for="nohp" class="form-label mandatory">No Hp</label>
                                <input type="text" class="form-control" id="nohp" name="nohp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="mb-3">
                                <label for="tmpLahir" class="form-label">Tempat Lahir</label>
                                <input type="email" class="form-control" id="tmpLahir" name="tmpLahir">
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="mb-3">
                                <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" id="tglLahir" name="tglLahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender" class="select2_global" data-placeholder="Pilih Gender">
                                    <option value="">Pilih Gender</option>
                                    <option value="1">Pria</option>
                                    <option value="0">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Profil</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="justify-content-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="<?= site_url('App') ?>" type="button" class="btn btn-primary w-100">Sudah Punya Akun</a>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-warning w-100" onclick="daftarProses()">Bergabung</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="floating">
        <a href="https://wa.me/<?= $this->data['wa'] ?>" target="_blank" class="floating-button">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
</form>