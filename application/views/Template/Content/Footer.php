<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="<?= site_url('assets/image/web/') . $this->data['logo'] ?>" class="rounded me-2" style="width: 5vw;">
        </div>
        <div class="toast-body">
            <span id="titleToast"></span>, <span id="msgToast"></span>
        </div>
    </div>
</div>

<div class="modal fade" id="loadingModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px);">
            <div class="modal-body d-flex justify-content-center align-items-center">
                <img src="<?= base_url('assets/image/web/') . $this->data['logo'] ?>" style="width: 30vw;" class="animate-bounce">
            </div>
        </div>
    </div>
</div>

<!-- My script -->
<script>
    $(document).ready(function() {
        $('.select2_global').select2({
            theme: 'bootstrap-5',
            width: '100%',
            allowClear: true,
        });

        // menyembunyikan id notsecure
        $('#notsecure').hide();
        $('#notsecure2').hide();

        // load modal
        const loadingModalEl = document.getElementById('loadingModal');
        const loadingModal = new bootstrap.Modal(loadingModalEl);
        loadingModal.show(); // tampilkan modal

        setTimeout(function() {
            const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
            if (modalInstance) {
                modalInstance.hide(); // sembunyikan modal
            }

            // hapus backdrop dan hapus modal-open
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        }, 700); // berikan time out 700
    });

    // inisial aos animasi
    AOS.init();

    // untuk Toast
    const toastLiveExample = document.getElementById('liveToast') //variable id toast
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample) // trigger dari bootstrap

    // tooltip
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // function Toast
    function Toast(msg, msg2) {
        $('#titleToast').html(msg) // berikan judulnya email
        $('#msgToast').text(msg2)
        toastBootstrap.show()
    }

    // fungsi untuk menjalankan ajax
    function send_postFile(url, form) {
        const loadingModalEl = document.getElementById('loadingModal');
        const loadingModal = new bootstrap.Modal(loadingModalEl);

        var formx = form[0];
        var data = new FormData(formx);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            beforeSend: function() {
                loadingModal.show();
            },
            success: function(result) {
                setTimeout(function() { // jalankan selama 500
                    const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                    if (modalInstance) { // jika modal ada
                        modalInstance.hide(); // sembunyikan
                    }

                    // hapus backdrop
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    // Call sweet function after success
                    var ttl = result.title
                    var psn = result.msg
                    var tipe = result.tipe
                    var param = result.param
                    var kfr = 'Ya'
                    var ccl = 'Tidak'
                    var posisi = 'center'
                    var tujuan = result.tujuan

                    sweet(ttl, psn, tipe, kfr, ccl, param, posisi, tujuan)
                }, 500);
            },
            error: function() {
                setTimeout(function() { // jalankan selama 500
                    const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                    if (modalInstance) { // jika modal ada
                        modalInstance.hide(); // sembunyikan
                    }

                    // hapus backdrop
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    sweet('Error', 'An error occurred while processing your request. Please try again.', 'error', 'OK', '', 1, 'center', '')
                }, 500);

            }
        })
    }

    // fungsi untuk menjalankan ajax
    function send_post(url, form) {
        const loadingModalEl = document.getElementById('loadingModal');
        const loadingModal = new bootstrap.Modal(loadingModalEl);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
            beforeSend: function() {
                loadingModal.show();
            },
            success: function(result) {
                setTimeout(function() { // jalankan selama 500
                    const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                    if (modalInstance) { // jika modal ada
                        modalInstance.hide(); // sembunyikan
                    }

                    // hapus backdrop
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    var ttl = result.title
                    var psn = result.msg
                    var tipe = result.tipe
                    var param = result.param
                    var kfr = 'Ya'
                    var ccl = 'Tidak'
                    var posisi = 'center'
                    var tujuan = result.tujuan

                    sweet(ttl, psn, tipe, kfr, ccl, param, posisi, tujuan)
                }, 500);
            },
            error: function() {
                setTimeout(function() { // jalankan selama 500
                    const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                    if (modalInstance) { // jika modal ada
                        modalInstance.hide(); // sembunyikan
                    }

                    // hapus backdrop
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    sweet('Error', 'An error occurred while processing your request. Please try again.', 'error', 'OK', '', 1, 'center', '')
                }, 500);

            }
        })
    }

    // fungsi untuk menjalankan ajax tanpa form
    function send_post_noform(url) {
        const loadingModalEl = document.getElementById('loadingModal');
        const loadingModal = new bootstrap.Modal(loadingModalEl);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function() {
                loadingModal.show();
            },
            success: function(result) {
                setTimeout(function() { // jalankan selama 500
                    const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                    if (modalInstance) { // jika modal ada
                        modalInstance.hide(); // sembunyikan
                    }

                    // hapus backdrop
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    var ttl = result.title
                    var psn = result.msg
                    var tipe = result.tipe
                    var param = result.param
                    var kfr = 'Ya'
                    var ccl = 'Tidak'
                    var posisi = 'center'
                    var tujuan = result.tujuan

                    sweet(ttl, psn, tipe, kfr, ccl, param, posisi, tujuan)
                }, 500);
            },
            error: function() {
                setTimeout(function() { // jalankan selama 500
                    const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                    if (modalInstance) { // jika modal ada
                        modalInstance.hide(); // sembunyikan
                    }

                    // hapus backdrop
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    sweet('Error', 'An error occurred while processing your request. Please try again.', 'error', 'OK', '', 1, 'center', '')
                }, 500);
            }
        })
    }

    // fungsi untuk mengubah tipe password menjadi text dan sebaliknya
    function cekSecure() {
        const passwordInput = document.getElementById('password'); // variable id password
        const secureIcon = $('#secure'); // variable id secure
        const notSecureIcon = $('#notsecure'); // variable id notsecure

        if (passwordInput.type === 'password') { // jika tipenya password
            passwordInput.type = 'text'; // ubah menjadi text
            secureIcon.hide(); // sembunyikan icon secure
            notSecureIcon.show(); // tampilkan icon notsecure
        } else { // jika tipenya bukan password
            passwordInput.type = 'password'; // ubah menjadi password
            secureIcon.show(); // tampilkan icon secure
            notSecureIcon.hide(); // sembunyikan icon notsecure
        }
    }

    // fungsi untuk mengubah tipe password menjadi text dan sebaliknya
    function cekSecure2() {
        const passwordInput = document.getElementById('password2'); // variable id password
        const secureIcon = $('#secure2'); // variable id secure
        const notSecureIcon = $('#notsecure2'); // variable id notsecure

        if (passwordInput.type === 'password') { // jika tipenya password
            passwordInput.type = 'text'; // ubah menjadi text
            secureIcon.hide(); // sembunyikan icon secure
            notSecureIcon.show(); // tampilkan icon notsecure
        } else { // jika tipenya bukan password
            passwordInput.type = 'password'; // ubah menjadi password
            secureIcon.show(); // tampilkan icon secure
            notSecureIcon.hide(); // sembunyikan icon notsecure
        }
    }

    // fungsi sweetaler
    function sweet(ttl, psn, tipe, kfr, ccl, param, posisi, tujuan) {
        if (param == 0) { // jika param 0
            Swal.fire({
                position: posisi,
                icon: tipe,
                html: ttl + ', ' + psn,
                showConfirmButton: false,
                timer: 1500
            }).then((value) => {
                window.location.href = '<?= site_url() ?>' + tujuan;
            });
        } else if (param == 1) { // jika param 1
            Swal.fire({
                title: ttl,
                html: psn,
                icon: tipe,
                confirmButtonText: kfr
            });
        } else if (param == 2) {
            Swal.fire({
                title: ttl,
                html: psn,
                icon: tipe,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: kfr,
                cancelButtonText: ccl,
            }).then((result) => {
                if (result.isConfirmed) {
                    send_post_noform(tujuan);
                }
            });
        } else { // selain 0 dan 1
            Swal.fire({
                title: ttl,
                html: psn,
                icon: tipe,
                confirmButtonText: kfr,
                cancelButtonText: ccl
            });
        }
    }

    // fungsi validasi email
    function validateEmail(email) {
        // Regular expression pattern untuk email validation
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (!emailPattern.test(email)) { // Jika email sesuai pattern
            // tampilkan pesan
            sweet('Invalid Email', 'Tolong masukan email yang valid', 'error', 'OK', '', 1, 'center', '')

            $('#email').val('')

            return false;
        }

        return true;
    }

    // fungsi untuk nama kaputal di depan
    function capitalizeWords(nama, forid) {
        // Replace tiap kata tanpa mengganggu spasi
        let str = nama.replace(/\b\w+/g, function(word) {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });

        $("#" + forid).val(str);
    }

    // fungsi logout
    function logout() {
        sweet('Tinggalkan Sistem', 'Yakin ingin meninggalkan sistem?', 'question', 'Ya, Tinggalkan', 'Tidak, tetap stay', 2, 'center', '<?= site_url("App/logout") ?> ')
    }

    // fungsi get url untuk redirect
    function getUrl(url) {
        window.location.href = '<?= site_url() ?>' + url
    }

    // waktu
    function startClock() {
        const el = document.getElementById('time');
        if (!el) return;

        const fmtTanggal = new Intl.DateTimeFormat('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        function pad(n) {
            return String(n).padStart(2, '0');
        }

        function tick() {
            const now = new Date();
            const tanggal = fmtTanggal.format(now); // contoh: "Senin, 28 Agustus 2025"
            // Format jam manual pakai ":" (bukan "." seperti default id-ID)
            const jam = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
            el.textContent = `${tanggal} | ${jam}`;
        }

        tick(); // tampil pertama kali
        setInterval(tick, 1000); // update tiap detik
    }

    // jalankan setelah DOM siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startClock);
    } else {
        startClock();
    }

    // reloading datatable
    function reloadTable() {
        table.DataTable().ajax.reload(null, false);
    }
</script>
</body>

</html>