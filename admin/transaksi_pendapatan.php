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
    <title>TRANSAKSI PEMESAN - SIA COFFE SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard_admin.php">SIA Coffee Shop</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
                        <a class="nav-link" href="dashboard_admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Revenue Cycle</div>
                        <a class="nav-link" href="transaksi_pendapatan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pendapatan
                        </a>
                        <a class="nav-link" href="pelunasan_piutang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pelunasan Piutang
                        </a>
                        <a class="nav-link" href="transaksi_pendapatan_lain.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pendapatan Lain
                        </a>
                        <div class="sb-sidenav-menu-heading">Expenditure Cycle</div>
                        <a class="nav-link" href="transaksi_pengeluaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pengeluaran
                        </a>
                        <a class="nav-link" href="pelunasan_hutang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pelunasan Hutang
                        </a>
                        <a class="nav-link" href="transaksi_pengeluaran_lain.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pengeluaran Lain
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
                        <a class="nav-link" href="master_divisi.php">
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
                        <a class="nav-link" href="master_akun.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Akun
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Transaksi Pendapatan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data Pendapatan</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Pendapatan
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah Data -->
                            <div class="mb-3 d-flex justify-content-end">
                                <a href="add_transaksi_pendapatan.php" class="btn btn-success">
                                    Add Pendapatan
                                </a>
                            </div>
                            <!-- Table for Data Pendapatan -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Transaksi Pendapatan</th>
                                            <th>Nama Customer</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Subtotal</th>
                                            <th>Status Pembayaran</th>
                                            <th>Sisa Pembayaran</th>
                                            <th>Jumlah Di Bayar</th>
                                            <th>Nama Akun</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_transaksi_pendapatan">
                                        <?php
                                        // Koneksi ke database
                                        $koneksi = mysqli_connect("localhost", "root", "", "sia_coffeeshop");

                                        // Periksa koneksi
                                        if (!$koneksi) {
                                            die("Koneksi gagal: " . mysqli_connect_error());
                                        }

                                        // Query untuk mengambil data transaksi pendapatan
                                        $query = "
                                        SELECT 
                                            tp.id_transaksi_pendapatan,
                                            tp.tgl_transaksi,
                                            tp.jumlah_produk,
                                            tp.harga_satuan,
                                            (tp.jumlah_produk * tp.harga_satuan) AS subtotal,
                                            mc.nama_customer,
                                            mp.nama_produk,
                                            mm.nama_metode,
                                            tp.status_pembayaran,
                                            IF(tp.jumlah_dibayar < (tp.jumlah_produk * tp.harga_satuan), (tp.jumlah_produk * tp.harga_satuan) - tp.jumlah_dibayar, 0) AS sisa_pembayaran,
                                            tp.jumlah_dibayar,
                                            ma.nama_akun
                                        FROM 
                                            transaksi_pendapatan tp 
                                        LEFT JOIN 
                                            master_customer mc ON mc.id_customer = tp.id_customer
                                        LEFT JOIN 
                                            master_produk mp ON tp.id_produk = mp.id_produk
                                        LEFT JOIN 
                                            master_metode_pembayaran mm ON tp.id_metode = mm.id_metode
                                        JOIN master_akun ma ON tp.id_akun = ma.id_akun
                                        ";
                                                                                
                                

                                        // Eksekusi query
                                        $result = mysqli_query($koneksi, $query);

                                        // Periksa apakah query berhasil
                                        if ($result) {
                                            // Menampilkan data hasil query
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            // Menentukan status pembayaran
                                            //$statusPembayaran = ($row['status_pembayaran'] == 1) ? "Lunas" : "Belum Lunas"; // Misal 1 = Lunas, 0 = Belum Lunas
                                            // Menentukan sisa pembayaran
                                            //$sisaPembayaran = !empty($row['sisa_pembayaran']) && $row['sisa_pembayaran'] > 0 ? number_format($row['sisa_pembayaran'], 2) : "Lunas";
                                            echo "<tr>
                                            <td>{$row['id_transaksi_pendapatan']}</td>
                                            <td>{$row['nama_customer']}</td>
                                            <td>{$row['tgl_transaksi']}</td>
                                            <td>{$row['nama_metode']}</td>
                                            <td>{$row['nama_produk']}</td>
                                            <td>{$row['jumlah_produk']}</td>
                                            <td>" . number_format($row['harga_satuan'], 2) . "</td>
                                            <td>" . number_format($row['subtotal'], 2) . "</td>
                                            <td>{$row['status_pembayaran']}</td>
                                            <td>{$row['sisa_pembayaran']}</td>
                                            <td>{$row['jumlah_dibayar']}</td>
                                            <td>{$row['nama_akun']}</td>
                                        </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>Data tidak ditemukan atau query gagal dijalankan.</td></tr>";
                                        }

                                        // Tutup koneksi
                                        mysqli_close($koneksi);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>