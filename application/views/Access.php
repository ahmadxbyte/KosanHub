<div class="container" style="margin-top: 8vh; margin-bottom: 10vh;">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow bg-blur2">
                <div class="card-header">
                    <div class="h3">
                        <?= $title ?>
                        <div class="float-end">
                            <button type="button" class="btn btn-info" onclick="reloadTable()"><i class="fa-solid fa-rotate"></i> Reload</button>
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
    var table = $('#tableAksesRole')

    table.DataTable({
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

    // fungsi untuk mengubah akses, entah menambahkan ataupun mengapus
    function changeAkses(kmenu, kdrole, no, nor, nmenu, nrole, idmenu) {
        // berikan konfirmasi
        Swal.fire({
            title: "Kamu yakin?",
            html: "Menu <b>" + nmenu + "</b> untuk akses <b style='color: red;'>" + nrole + "</>!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, ubah!",
            cancelButtonText: "Tidak!"
        }).then((result) => {
            if (result.isConfirmed) { // jika yakin
                // jalankan fungsi
                send_post('<?= site_url("Access_role/changeMenu/?id_akses=") ?>' + kmenu + '&kdrole=' + kdrole + '&idmenu=' + idmenu, $('#formPengaturan'))
                // $.ajax({
                //     url: '<?= site_url() ?>Access_role/changeMenu/?id_akses=' + kmenu + '&kdrole=' + kdrole + '&idmenu=' + idmenu,
                //     type: 'POST',
                //     dataType: 'JSON',
                //     success: function(result) { // jika fungsi berjalan dengan baik
                //         if (result.status == 1) { // jika mendapatkan hasil 1
                //             Swal.fire("User " + nmenu, "Berhasil diubah aksesnya!", "success").then(() => {
                //                 reloadTable();
                //             });
                //         } else { // selain itu
                //             Swal.fire("User " + nmenu, "Gagal diubah aksesnya!, silahkan dicoba kembali", "info");
                //         }
                //     },
                //     error: function(result) { // jika fungsi error
                //         error_proccess();
                //     }
                // });
            } else if (result.dismiss == 'cancel') {
                document.getElementById('krole' + no + '_' + nor).checked = false
            } else {
                document.getElementById('krole' + no + '_' + nor).checked = false
            }
        });
    }
</script>