<?php
include("../config/koneksi_mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $id_transaksi_pembayaran = $_POST['id_transaksi_pembayaran'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $id_customer = $_POST['id_customer'];
    $id_produk = $_POST['id_produk'];
    $kuantitas = $_POST['kuantitas'];
    $harga_satuan = $_POST['harga_satuan'];
    $total_pendapatan = $_POST['total_pendapatan'];
    $saldo_piutang = $_POST['saldo_piutang'];
    $id_metode = $_POST['id_metode'];
    $id_akun = $_POST['id_akun'];
    $id_jenis_pendapatan = $_POST['id_jenis_pendapatan'];
    $status_transaksi = $_POST['status_transaksi'];

 // Query untuk menyimpan data ke database
 $query = "
 INSERT INTO transaksi_pendapatan (
     id_transaksi, id_transaksi_pembayaran, tanggal_transaksi, 
     id_customer, id_produk, kuantitas, harga_satuan, total_pendapatan, 
     saldo_piutang, id_metode, id_akun, id_jenis_pendapatan, status_transaksi
 ) VALUES (
     '$id_transaksi', '$id_transaksi_pembayaran', '$tanggal_transaksi', 
     '$id_customer', '$id_produk', '$kuantitas', '$harga_satuan', '$total_pendapatan', 
     '$saldo_piutang', '$id_metode', '$id_akun', '$id_jenis_pendapatan', '$status_transaksi'
 )
";
    if (mysqli_query($koneksi, $query)) {
        header("Location: transaksi_pendapatan.php?success=1"); // Redirect dengan pesan sukses
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
        exit();
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
            <h1 class="mb-4">Form Transaksi Pendapatan</h1>
            <form method="POST" action="add_transaksi_pendapatan.php">
                <div class="mb-3">
                    <label for="id_transaksi_pembayaran" class="form-label">ID Transaksi Pembayaran</label>
                    <input type="text" class="form-control" id="id_transaksi_pembayaran" name="id_transaksi_pembayaran" required>
                </div> 
                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
                </div>
                <div class="mb-3">
                    <label for="id_customer" class="form-label">Nama Customer</label>
                    <select class="form-select" id="id_customer" name="id_customer" required>
                        <option value="">Pilih Customer</option>
                        <?php
                        $customers = mysqli_query($koneksi, "SELECT id_customer, nama_customer FROM master_customer");
                        while ($customer = mysqli_fetch_assoc($customers)) {
                            echo "<option value='{$customer['id_customer']}'>{$customer['nama_customer']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_produk" class="form-label">Nama Produk</label>
                    <select class="form-select" id="id_produk" name="id_produk" required onchange="updateHargaSatuan()">
                        <option value="">Pilih Produk</option>
                        <?php
                        $produk = mysqli_query($koneksi, "SELECT id_produk, nama_produk, harga_satuan FROM master_produk");
                        while ($prod = mysqli_fetch_assoc($produk)) {
                            echo "<option value='{$prod['id_produk']}' data-harga='{$prod['harga_satuan']}'>{$prod['nama_produk']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kuantitas" class="form-label">Kuantitas</label>
                    <input type="number" class="form-control" id="kuantitas" name="kuantitas" required>
                </div>
                <div class="mb-3">
                    <label for="harga_satuan" class="form-label">Harga Satuan</label>
                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required readonly>
                </div>
                <div class="mb-3">
                    <label for="total_pendapatan" class="form-label">Total Pendapatan</label>
                    <input type="number" class="form-control" id="total_pendapatan" name="total_pendapatan" required readonly>
                </div>
                <div class="mb-3">
                    <label for="saldo_piutang" class="form-label">Saldo Piutang</label>
                    <input type="number" class="form-control" id="saldo_piutang" name="saldo_piutang" required readonly>
                </div>
                <div class="mb-3">
                    <label for="id_metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" id="id_metode_pembayaran" name="id_metode_pembayaran" required>
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
                    <label for="kode_akun" class="form-label">Nama Akun</label>
                    <select class="form-select" id="kode_akun" name="kode_akun" required>
                        <option value="">Pilih Akun</option>
                        <?php
                        $akun = mysqli_query($koneksi, "SELECT kode_akun, nama_akun FROM master_akun");
                        while ($ak = mysqli_fetch_assoc($akun)) {
                            echo "<option value='{$ak['kode_akun']}'>{$ak['nama_akun']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_jenis_pendapatan" class="form-label">Jenis Pendapatan</label>
                    <select class="form-select" id="id_jenis_pendapatan" name="id_jenis_pendapatan" required>
                        <option value="">Pilih Jenis</option>
                        <?php
                        $jenis = mysqli_query($koneksi, "SELECT id_jenis_pendapatan, nama_jenis_pendapatan FROM master_jenis_pendapatan");
                        while ($jen = mysqli_fetch_assoc($jenis)) {
                            echo "<option value='{$jen['id_jenis_pendapatan']}'>{$jen['nama_jenis_pendapatan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status_transaksi" class="form-label">Status Transaksi</label>
                    <select class="form-select" id="status_transaksi" name="status_transaksi" required>
                        <option value="">Pilih Status</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="transaksi.pendapatan.php" class="btn btn-secondary">Kembali</a>
            </form>

            <script>
                // Fungsi untuk memperbarui harga satuan berdasarkan produk yang dipilih
                function updateHargaSatuan() {
                    var produkSelect = document.getElementById('id_produk');
                    var hargaSatuanInput = document.getElementById('harga_satuan');
                    var selectedOption = produkSelect.options[produkSelect.selectedIndex];
                    var hargaSatuan = selectedOption.getAttribute('data-harga');
                    hargaSatuanInput.value = hargaSatuan;
                }
                // Fungsi untuk menghitung total pendapatan
                function updateTotalPendapatan() {
                    var kuantitas = document.getElementById('kuantitas').value;
                    var hargaSatuan = document.getElementById('harga_satuan').value;
                    var totalPendapatanInput = document.getElementById('total_pendapatan');
                    
                    if (kuantitas && hargaSatuan) {
                        totalPendapatanInput.value = (kuantitas * hargaSatuan).toFixed(2);
                    } else {
                        totalPendapatanInput.value = 0;
                    }
                    updateSaldoPiutang();
                }
                 // Fungsi untuk menghitung saldo piutang berdasarkan DP dan status transaksi
                function updateSaldoPiutang() {
                    var totalPendapatan = document.getElementById('total_pendapatan').value;
                    var dp = document.getElementById('dp').value;
                    var saldoPiutangInput = document.getElementById('saldo_piutang');
                    var statusTransaksi = document.getElementById('status_transaksi').value;

                    if (statusTransaksi === "Lunas") {
                        saldoPiutangInput.value = 0; // Saldo Piutang 0 jika Lunas
                    } else if (statusTransaksi === "Booking") {
                        var saldoPiutang = (totalPendapatan - dp);
                        saldoPiutangInput.value = saldoPiutang > 0 ? saldoPiutang.toFixed(2) : 0; // Menghitung saldo piutang
                    }
                }
            </script>
                </div>
            </main>
            </body>
            </html>
