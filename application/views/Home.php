<div class="container mt-3">
    <div class="row">
        <?php foreach ($menu as $m) : ?>
            <div class="col-md-3 col-6 mb-3" onclick="getUrl('<?= $m->url ?>')">
                <div class="card shadow h-100 grayscale-card <?= str_replace('bg-', 'bg-opacity-50 bg-', $m->warnaLatar) ?>" style="border-radius: 20px; backdrop-filter: blur(5px); background-color: rgba(255, 255, 255, 0.5);">
                    <div class="card-body text-center">
                        <span style="width: 100%; font-size: 50px; height: 100%;"><?= $m->icon ?></span>
                        <br>
                        <span style="font-size: 50px;" class="fw-bold"><?= $m->keterangan ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>