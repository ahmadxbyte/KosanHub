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

        // Swal.fire({
        //     title: 'Berhasil!',
        //     text: 'Ini contoh SweetAlert2 😎',
        //     icon: 'success',
        //     confirmButtonText: 'Mantap'
        // });
    });

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
</script>
</body>

</html>