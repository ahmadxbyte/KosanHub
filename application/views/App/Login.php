<form id="formLogin">
    <div class="row min-vh-100 align-items-center">
        <div class="col-md-4 col-12">
            <div class="card shadow border-top-primary border-bottom-warning p-3">
                <div class="card-header text-center">
                    <img src="<?= base_url('assets/image/web/') . $this->data['logo'] ?>" alt="logo" class="img-fluid" style="max-width: 200px; width: 100%; height: auto; object-fit: contain;">
                    <br>
                    <span class="mb-5">Selamat Datang Kembali</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Sandi</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                </div>
                <hr>
                <div class="justify-content-center">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100">Masuk</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-warning w-100">Daftar</button>
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

<!-- <div class="container mt-4">
    <label for="pilih" class="form-label">Pilih sesuatu:</label>
    <select id="pilih" class="form-select" style="width: 100%;">
        <option value="1">Opsi Satu</option>
        <option value="2">Opsi Dua</option>
        <option value="3">Opsi Tiga</option>
    </select>
</div> -->