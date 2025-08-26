<div class="container" style="margin-top: 8vh; margin-bottom: 10vh;">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow bg-blur2">
                <div class="card-header">
                    <div class="h3">
                        <?= $title ?>
                        <div class="float-end">
                            <button type="button" class="btn btn-info"><i class="fa-solid fa-rotate"></i> Reload</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-resposive">
                        <table class="table table-hover" id="tableAksesRole" width="100%" style="border-radius: 10px !important;">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%; vertical-align: middle;" rowspan="2" class="bg-table">#</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="bg-table">Menu</th>
                                    <th colspan="<?= count($role) ?>" style="vertical-align: middle; width: <?= count($role) * 15 ?>%" class="bg-table">Role</th>
                                </tr>
                                <tr>
                                    <?php foreach ($role as $r) : ?>
                                        <th class="bg-table" style="vertical-align: middle; width: 15%;"><?= $r->keterangan ?></th>
                                    <?php endforeach ?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tableAksesRole').DataTable({
        "destroy": true,
        "processing": true,
        "responsive": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": '<?= site_url() ?>Access_role/list',
            "type": "POST",
        },
        "scrollCollapse": false,
        "paging": true,
        "language": {
            "emptyTable": "<div class='text-center'>Data Kosong</div>",
            "infoEmpty": "",
            "infoFiltered": "",
            "search": "",
            "searchPlaceholder": "Cari data...",
            "info": " Jumlah _TOTAL_ Data (_START_ - _END_)",
            "lengthMenu": "_MENU_ Baris",
            "zeroRecords": "<div class='text-center'>Data Kosong</div>",
            "paginate": {
                "previous": "Sebelumnya",
                "next": "Berikutnya"
            }
        },
        "lengthMenu": [
            [10, 25, 50, 75, 100, -1],
            [10, 25, 50, 75, 100, "Semua"]
        ],
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        }],
    });
</script>