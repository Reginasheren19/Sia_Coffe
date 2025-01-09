<?php
include("../config/koneksi_mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi_pemesanan = $_POST['id_transaksi_pemesanan'];
    $tgl_pembayaran = $_POST['tanggal_pembayaran'];
    $subtotal = $_POST['subtotal'];
    $total_bayar = $_POST['total_bayar'];
    $saldo_piutang = $_POST['saldo_piutang'];
    $id_metode = $_POST['id_metode'];
    $status = $_POST['status'];
    $id_akun = $_POST['id_akun'];

    // Pastikan semua field yang wajib terisi tidak kosong
    if ($id_transaksi_pemesanan && $tgl_pembayaran && $subtotal && $saldo_piutang && $id_metode && $status && $id_akun) {
        // Query untuk menyimpan data ke database
        $query = "
            INSERT INTO transaksi_pembayaran (
                id_transaksi_pemesanan, tgl_pembayaran, subtotal, saldo_piutang, id_metode, status, id_akun
            ) VALUES (
                '$id_transaksi_pemesanan', '$tgl_pembayaran', '$subtotal', '$saldo_piutang', '$id_metode', '$status', '$id_akun'
            )
        ";

        // Eksekusi query
        if (mysqli_query($koneksi, $query)) {
            header("Location: transaksi_pembayaran.php?success=1"); // Redirect dengan pesan sukses
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
            exit();
        }
    }
   
}
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
                            <nav class="sb-sidenav-menu-nested nav">
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
                        <a class="nav-link" href="transaksi_pemesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pemesanan
                        </a>
                        <a class="nav-link" href="transaksi_pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pembayaran
                        </a>
                        <div class="sb-sidenav-menu-heading">Expenditure Cycle</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pengeluaran
                        </a>
                        <a class="nav-link" href="pelunasan_hutang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pelunasan Hutang
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
            <div class="container mt-5">
            <h1 class="mb-4">Form Transaksi Pembayaran</h1>
            <form method="POST" action="add_transaksi_pembayaran.php">
                <div class="mb-3">
                    <label for="id_transaksi_pemesanan" class="form-label">Id Transaksi Pemesanan</label>
                    <select class="form-select" id="id_transaksi_pemesanan" name="id_transaksi_pemesanan" required onchange="loadPemesananDetails()">
                        <option value="">Pilih Transaksi Pemesanan</option>
                        <?php
                        $transaksiPemesanan = mysqli_query($koneksi, "SELECT id_transaksi_pemesanan FROM transaksi_pemesanan");
                        while ($row = mysqli_fetch_assoc($transaksiPemesanan)) {
                            echo "<option value='{$row['id_transaksi_pemesanan']}'>{$row['id_transaksi_pemesanan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_customer" class="form-label">Nama Customer</label>
                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" readonly>
                </div>
                <div class="mb-3">
                    <label for="produk" class="form-label">Produk</label>
                    <input type="text" class="form-control" id="produk" name="produk" readonly>
                </div>
                </div>
                <div class="mb-3">
                    <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                </div>
                <div class="mb-3">
                    <label for="id_metode" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" id="id_metode" name="id_metode" required>
                        <option value="">Pilih Metode</option>
                        <?php
                        $metode = mysqli_query($koneksi, "SELECT id_metode, nama_metode FROM master_metode_pembayaran");
                        while ($met = mysqli_fetch_assoc($metode)) {
                            echo "<option value='{$met['id_metode']}'>{$met['nama_metode']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="subtotal" class="form-label">Subtotal</label>
                    <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
                </div>
                <div class="mb-3">
                    <label for="total_bayar" class="form-label">Total Bayar</label>
                    <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly>
                </div>
                <div class="mb-3">
                    <label for="id_akun" class="form-label">Nama Akun</label>
                    <select class="form-select" id="id_akun" name="id_akun" required>
                        <option value="">Pilih Akun</option>
                        <?php
                        $akun = mysqli_query($koneksi, "SELECT id_akun, nama_akun FROM master_akun");
                        while ($row = mysqli_fetch_assoc($akun)) {
                            echo "<option value='{$row['id_akun']}'>{$row['nama_akun']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="transaksi_pembayaran.php" class="btn btn-secondary">Kembali</a>
            </form>

            <script>
                // Fungsi untuk memuat detail pemesanan (customer, produk, dan subtotal) berdasarkan id_transaksi_pemesanan
                function loadPemesananDetails() {
                    var idTransaksi = document.getElementById('id_transaksi_pemesanan').value;
                    if (idTransaksi) {
                        // Mengambil data customer, produk, dan subtotal dari id_transaksi_pemesanan
                        fetch('get_pemesanan_details.php?id_transaksi=' + idTransaksi)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('nama_customer').value = data.nama_customer;
                                document.getElementById('produk').value = data.nama_produk;
                                document.getElementById('subtotal').value = data.subtotal;
                                document.getElementById('total_bayar').value = data.total_bayar; // Update total bayar sesuai data
                            })
                            .catch(error => console.error('Error loading data:', error));
                    }
                }
            </script>
            </main>
        </div>
    </div>
</body>
</html>
