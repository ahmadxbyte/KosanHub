<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="<?= base_url('assets/image/web/') . $this->data['logo'] ?>" style="width: 5vw;"></a>
        <div class="float-end">
            <button type="button" class="btn">
                <span><?= $this->data['nama'] ?></span> <img src="<?= base_url('assets/image/user/') . $this->data['gambar'] ?>" style="width: 2vw; border-radius: 50%;">
            </button>
        </div>
    </div>
</nav>