<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Bootstrap 5.3 -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>

    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <!-- JQuery -->
    <script src="<?= base_url() ?>assets/jquery/jquery-3.7.1.min.js"></script>

    <!-- JS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Sweetalert2 -->
    <link href="<?= base_url() ?>assets/css/sweetalert2.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/js/sweetalert2.all.min.js"></script>

    <!-- Fontawesome 6.7.2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Logo -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/image/web/') . $this->data['logo'] ?>">

    <!-- AOS Animation -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/aos.css" />
    <script src="<?= base_url() ?>assets/js/aos.js"></script>

    <!-- DataTables -->
    <!-- DataTables Bootstrap 5 Integration -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- my style -->
    <style>
        .bg-transparant {
            background-color: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
        }

        /* Dynamic border classes using Bootstrap colors */
        .border-top-primary {
            border-top: 4px solid var(--bs-primary);
        }

        .border-top-secondary {
            border-top: 4px solid var(--bs-secondary);
        }

        .border-top-success {
            border-top: 4px solid var(--bs-success);
        }

        .border-top-danger {
            border-top: 4px solid var(--bs-danger);
        }

        .border-top-warning {
            border-top: 4px solid var(--bs-warning);
        }

        .border-top-info {
            border-top: 4px solid var(--bs-info);
        }

        .border-bottom-primary {
            border-bottom: 4px solid var(--bs-primary);
        }

        .border-bottom-secondary {
            border-bottom: 4px solid var(--bs-secondary);
        }

        .border-bottom-success {
            border-bottom: 4px solid var(--bs-success);
        }

        .border-bottom-danger {
            border-bottom: 4px solid var(--bs-danger);
        }

        .border-bottom-warning {
            border-bottom: 4px solid var(--bs-warning);
        }

        .border-bottom-info {
            border-bottom: 4px solid var(--bs-info);
        }

        /* floating */
        .floating {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .floating-button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            background-color: rgb(211, 57, 37);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .floating-button i {
            font-size: 35px;
        }

        .floating-button:hover {
            background-color: #128C7E;
            color: white;
            transform: scale(1.1);
        }

        /* mandatory */
        .mandatory::after {
            content: ' *';
            color: var(--bs-danger);
            font-weight: bold;
        }

        /* Bouncing animation keyframes */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-bounce {
            animation: bounce 1s infinite ease-in-out;
        }

        /* filter saat menu di hover */
        .grayscale-card {
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }

        .grayscale-card:hover {
            filter: grayscale(0%);
        }

        /* background blur */
        .bg-blur {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            padding: 5px;
            display: inline-block;
            border-radius: 10px;
        }

        .bg-blur2 {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            padding: 5px;
            border-radius: 10px;
        }

        /* kelas aktiv */
        .active {
            background-color: #e18315 !important;
        }

        /* bg for table */
        .bg-table {
            background: rgba(255, 255, 255, 0.5) !important;
            backdrop-filter: blur(10px);
        }

        /* tr td */
        td,
        th {
            border: 1px solid rgba(0, 0, 0, 1) !important;
        }

        th {
            text-align: center !important;
        }
    </style>
</head>

<body style="max-width: 100%; overflow-x: hidden;">
    <!-- background -->
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; z-index: -1; overflow: hidden;">
        <img src="<?= base_url('assets/image/web/') . $this->data['latar_belakang'] ?>" style="width: 100%; height: 100%; object-fit: cover; filter: blur(10px); transform: scale(1.1);">
    </div>