<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Catatan Keuangan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- DataTables + Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            background-color: #f5f7f8;
        }
        .navbar-custom {
            background-color: #198754; /* Hijau Bootstrap */
        }
        .navbar-custom .nav-link, .navbar-custom .navbar-brand {
            color: #fff;
        }
        .btn-hijau {
            background-color: #198754;
            color: white;
        }
        .btn-hijau:hover {
            background-color: #157347;
        }
        
        .table-success th {
            background-color: #198754; /* Hijau Bootstrap */
            color: white;
        }
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('dashboard') ?>">
            <i class="fas fa-book"></i> Catatan Keuangan
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('dashboard') ?>">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('transaksi') ?>">
                        <i class="fas fa-exchange-alt"></i> Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/logout') ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container py-4">
