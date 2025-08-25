<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand bg-blur" href="<?= site_url('Home') ?>">
            <i class="fa-solid fa-home ms-2"></i>
            <img src="<?= base_url('assets/image/web/') . $this->data['logo'] ?>" style="width: 80px;">
        </a>
        <!-- <a class="navbar-brand bg-blur pr-3 pl-3" href="#">
            <?= str_replace('fa-2x', '', $this->data['uri']['icon']) . ' ' . $this->data['uri']['keterangan'] ?>
        </a> -->
        <a class="navbar-brand bg-blur2 p-2" href="#" style="background-color: #e78815; backdrop-filter: blur(10px);">
            <span id="time" style="font-size: 14px;"></span>
        </a>
        <div class="float-end">
            <button type="button" class="nav-link bg-blur">
                <a href="<?= site_url('Profile') ?>" class="text-decoration-none text-black p-1">
                    <span class="fw-bold me-2"><?= $this->data['nama'] ?></span> <img src="<?= base_url('assets/image/user/') . $this->data['gambar'] ?>" style="width: 25px; border-radius: 10px;">
                </a>
                <button type="button" data-bs-toggle="tooltip" data-bs-title="Tinggalkan sistem" class="btn btn-danger" style="margin-left: 10px; border-radius: 50%; width: 40px; height: 40px;" onmouseover="this.classList.replace('btn-danger', 'btn-success')" onmouseout="this.classList.replace('btn-success', 'btn-danger')" onclick="logout()"><i class="fa-solid fa-door-open"></i></button>
            </button>
        </div>
    </div>
</nav>