<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Travel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="dashboard_admin.php">Travel System</a>
        <button class="btn btn-link btn-sm text-white order-1 order-lg-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../login.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard_admin.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="false" aria-controls="collapseMaster">
                    <i class="fas fa-columns"></i>
                    <span>Master Data</span>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="collapse" id="collapseMaster" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-dark py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Master Data:</h6>
                        <a class="collapse-item" href="data_sopir.php">Data Sopir</a>
                        <a class="collapse-item" href="data_mobil.php">Data Mobil</a>
                        <a class="collapse-item" href="data_rute.php">Data Rute</a>
                        <a class="collapse-item" href="data_jadwal.php">Data Jadwal</a>
                        <a class="collapse-item" href="data_customer.php">Data Customer</a>
                        <a class="collapse-item" href="data_metode_pembayaran.php">Metode Pembayaran</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseTransaksi">
                    <i class="fas fa-handshake"></i>
                    <span>Data Transaksi</span>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="collapse" id="collapseTransaksi" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-dark py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaksi:</h6>
                        <a class="collapse-item" href="transaksi_pemesanan.php">Transaksi Pemesanan</a>
                        <a class="collapse-item" href="transaksi_pembayaran.php">Transaksi Pembayaran</a>
                        <a class="collapse-item" href="transaksi_detail_pemesanan.php">Detail Pemesanan</a>
                        <a class="collapse-item" href="transaksi_pembatalan.php">Pembatalan Pemesanan</a>
                        <a class="collapse-item" href="transaksi_refund.php">Refund Dana</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLaporan">
                    <i class="fas fa-file-alt"></i>
                    <span>Laporan</span>
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="collapse" id="collapseLaporan" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-dark py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan:</h6>
                        <a class="collapse-item" href="laporan_pemesanan.php">Laporan Pemesanan</a>
                        <a class="collapse-item" href="laporan_pembayaran.php">Laporan Pembayaran</a>
                        <a class="collapse-item" href="laporan_pembatalan.php">Laporan Pembatalan & Refund</a>
                    </div>
                </div>
            </li>
        </ul>

        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="jumbotron text-center">
                            <h1 class="display-4">Hello, <b><?= $_SESSION['username'] ?></b></h1>
                            <p class="lead">Welcome! You are logged in as <b>Admin</b>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../admin/js/scripts.js"></script>
</body>
</html>
