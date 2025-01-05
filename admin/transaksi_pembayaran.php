<?php
include("../config/koneksi_mysql.php");

// Mengatur error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav -menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Revenue Cycle</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Pendapatan
                            </a>
                            <div class="sb-sidenav-menu-heading">Expenditure Cycle</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Pengeluaran
                            </a>


                            <div class="sb-sidenav-menu-heading">Payroll Cycle</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Kelola Karyawan
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Penggajian
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Rekap Presensi
                            </a>
                            <div class="sb-sidenav-menu-heading">Report Cycle</div>
                            <a class="nav-link" href="jurnal_umum.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Jurnal Umum
                            </a>
                            <a class="nav-link" href="buku_besar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Buku Besar
                            </a>

                            <div class="sb-sidenav-menu-heading">Mastering</div>
                            <a class="nav-link" href="master_karyawan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Karyawan
                            </a>
                            <a class="nav-link" href="master_jabatan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Jabatan
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Divisi
                            </a>
                            <a class="nav-link" href="master_produk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Produk
                            </a>
                            <a class="nav-link" href="master_jenis_pendapatan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Jenis Pendapatan
                            </a>
                            <a class="nav-link" href="master_metode_pembayaran.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Metode Pembayaran
                            </a>
                            <a class="nav-link" href="master_customer.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Customer
                            </a>
                            <a class="nav-link" href="master_supplier.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Supplier
                            </a>

                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Master Data Pembayaran</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah Data -->
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransaksiPembayaranModal">
                                    Add Data
                                </button>
                            </div>
                            <!-- Tabel Data Transaksi Pembayaran -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Transaksi Pembayaran</th>
                                            <th>Id Transaksi Pemesanan</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Jumlah Pembayaran</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Status Pembayaran</th>
                                            <th>Nama Akun</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_transaksi_pembayaran">
                                        <?php
                                    // Query untuk mendapatkan data transaksi pembayaran beserta data terkait dari transaksi_pemesanan, master_customer, master_metode_pembayaran, dan master_akun
                                    $result = mysqli_query($koneksi,"
                                        SELECT tp.id_transaksi_pembayaran,
                                            tpm.id_transaksi_pemesanan,  
                                            tp.tgl_pembayaran,
                                            tp.jumlah_pembayaran,
                                            mp.nama_metode,           
                                            tp.status,
                                            ma.nama_akun              
                                        FROM transaksi_pembayaran tp
                                        JOIN transaksi_pemesanan tpm ON tp.id_transaksi_pemesanan = tpm.id_transaksi_pemesanan  
                                        JOIN master_metode_pembayaran mp ON tp.id_metode = mp.id_metode  
                                        JOIN master_akun ma ON tp.id_akun = ma.id_akun  
                                    ");                                        
                                        // Display data transaksi pembayaran
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                            <td>{$row['id_transaksi_pembayaran']}</td>
                                            <td>{$row['id_transaksi_pemesanan']}</td>  
                                            <td>" . date('d-m-Y', strtotime($row['tgl_pembayaran'])) . "</td>
                                            <td>" . number_format($row['jumlah_pembayaran'], 0, ',', '.') . "</td>
                                            <td>{$row['nama_metode']}</td>    
                                            <td>{$row['status']}</td>
                                            <td>{$row['nama_akun']}</td>      
                                            
                                        </tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </main>

            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Transaksi Pembayaran</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                </head>
                <body>

            <!-- Modal untuk menambah transaksi pembayaran-->
            <div class="modal fade" id="addTransaksiPembayaranModal" tabindex="-1" aria-labelledby="addTransaksiPembayaranModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTransaksiPembayaranModalLabel">Tambah Transaksi Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan transaksi pembayaran -->
                            <form action="add_transaksi_pembayaran.php" method="POST">
                                <div class="form-group">
                                    <label for="id_transaksi_pemesanan">ID Transaksi Pemesanan:</label>
                                    <select name="id_transaksi_pemesanan" id="id_transaksi_pemesanan" class="form-control" required>
                                        <option value="" selected disabled>Pilih ID Pemesanan</option>
                                        <?php
                                        // Query untuk mendapatkan data transaksi pemesanan
                                        $pemesanan_result = mysqli_query($koneksi, "SELECT id_transaksi_pemesanan, total_pemesanan FROM transaksi_pemesanan");
                                        while ($pemesanan = mysqli_fetch_assoc($pemesanan_result)) {
                                            echo "<option value='{$pemesanan['id_transaksi_pemesanan']}' data-total='{$pemesanan['total_pemesanan']}'>
                                                {$pemesanan['id_transaksi_pemesanan']}
                                            </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pembayaran">Tanggal Pembayaran:</label>
                                    <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_pembayaran">Jumlah Pembayaran:</label>
                                    <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="id_metode">Metode Pembayaran:</label>
                                    <select name="id_metode" id="id_metode" class="form-control" required>
                                        <?php
                                        // Query untuk mendapatkan data metode pembayaran
                                        $metode_result = mysqli_query($koneksi, "SELECT id_metode, nama_metode FROM master_metode_pembayaran");
                                        while ($metode = mysqli_fetch_assoc($metode_result)) {
                                            echo "<option value='{$metode['id_metode']}'>{$metode['nama_metode']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status Pembayaran:</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_akun">Nama Akun:</label>
                                    <select name="id_akun" id="id_akun" class="form-control" required>
                                        <?php
                                        // Query untuk mendapatkan data akun
                                        $akun_result = mysqli_query($koneksi, "SELECT id_akun, nama_akun FROM master_akun");
                                        while ($akun = mysqli_fetch_assoc($akun_result)) {
                                            echo "<option value='{$akun['id_akun']}'>{$akun['nama_akun']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const idTransaksiPemesananSelect = document.getElementById('id_transaksi_pemesanan');
                    const jumlahPembayaranInput = document.getElementById('jumlah_pembayaran');

                    idTransaksiPemesananSelect.addEventListener('change', function () {
                        const selectedOption = this.options[this.selectedIndex];
                        const totalPemesanan = selectedOption.getAttribute('data-total');

                        if (totalPemesanan) {
                            jumlahPembayaranInput.value = totalPemesanan; // Isi otomatis jumlah pembayaran
                        } else {
                            jumlahPembayaranInput.value = ''; // Kosongkan jika tidak ada data
                        }
                    });
                });
            </script>
            </div>
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Transaksi Pembayaran</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                </head>

        
        </body>
    </html>