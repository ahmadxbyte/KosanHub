    <div class="floating">
        <a href="https://wa.me/<?= $this->data['wa'] ?>" target="_blank" class="floating-button">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

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

    </div>

    <!-- Bootstrap 5.3 -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>

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
        });

        // inisial aos animasi
        AOS.init();

        // untuk Toast
        const toastLiveExample = document.getElementById('liveToast') //variable id toast
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample) // trigger dari bootstrap

        // function Toast
        function Toast(msg, msg2) {
            $('#titleToast').html(msg) // berikan judulnya email
            $('#msgToast').text(msg2)
            toastBootstrap.show()
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
                    setTimeout(function() { // jalankan selama 700
                        const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                        if (modalInstance) { // jika modal ada
                            modalInstance.hide(); // sembunyikan
                        }

                        // hapus backdrop
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }, 700);

                    var ttl = result.title
                    var psn = result.msg
                    var tipe = result.tipe
                    var kfr = 'Ya'
                    var ccl = 'Tidak'
                    var param = 0
                    var posisi = 'center'
                    var tujuan = result.tujuan

                    sweet(ttl, psn, tipe, kfr, ccl, param, posisi, tujuan)
                },
                error: function() {
                    setTimeout(function() { // jalankan selama 700
                        const modalInstance = bootstrap.Modal.getInstance(loadingModalEl);
                        if (modalInstance) { // jika modal ada
                            modalInstance.hide(); // sembunyikan
                        }

                        // hapus backdrop
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }, 700);

                    var tujuan = window.location.href;

                    sweet('Error', 'An error occurred while processing your request. Please try again.', 'error', '', '', 0, 'center', tujuan)
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

        function sweet(ttl, psn, tipe, kfr, ccl, param, posisi, tujuan) {
            if (param == 0) {
                Swal.fire({
                    position: posisi,
                    icon: tipe,
                    text: ttl + ', ' + psn,
                    showConfirmButton: false,
                    timer: 1500
                }).then((value) => {
                    window.location.href = '<?= site_url() ?>' + tujuan;
                });
            } else if (param == 1) {
                Swal.fire({
                    title: ttl,
                    text: psn,
                    icon: tipe,
                    confirmButtonText: kfr
                });
            } else {
                Swal.fire({
                    title: ttl,
                    text: psn,
                    icon: tipe,
                    confirmButtonText: kfr,
                    cancelButtonText: ccl
                });
            }
        }
    </script>
    </body>

    </html>