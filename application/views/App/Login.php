<h1>Hello, world!</h1>

<div class="container mt-4">
    <label for="pilih" class="form-label">Pilih sesuatu:</label>
    <select id="pilih" class="form-select" style="width: 100%;">
        <option value="1">Opsi Satu</option>
        <option value="2">Opsi Dua</option>
        <option value="3">Opsi Tiga</option>
    </select>
</div>

<script>
    $(document).ready(function() {
        $('#pilih').select2({
            theme: 'bootstrap-5'
        });

        Swal.fire({
            title: 'Berhasil!',
            text: 'Ini contoh SweetAlert2 😎',
            icon: 'success',
            confirmButtonText: 'Mantap'
        });
    });
</script>