<form id="formLogin">
    <div class="row min-vh-100 align-items-center">
        <div class="col-md-4 col-12">
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
                        <div class="col-md-12 col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12-col-12">
                            <div class="mb-3">
                                <label for="password" class="form-label">Sandi</label>
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
                </div>
                <hr>
                <div class="justify-content-center">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100" onclick="masukProses()">Masuk</button>
                        </div>
                        <div class="col-6">
                            <a href="<?= site_url('App/regist') ?>" type="button" class="btn btn-warning w-100">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>