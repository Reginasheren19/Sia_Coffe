<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
require_once $_SERVER['DOCUMENT_ROOT'] . "/Sia_Coffe/config/koneksi_mysql.php";

// Periksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Variabel pesan untuk notifikasi (hanya akan digunakan jika ada POST)
$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_transaksi_pendapatan = $_POST['id_transaksi_pendapatan'] ?? null;
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'] ?? null;
    $id_customer = $_POST['id_customer'] ?? null;
    $saldo_piutang = $_POST['saldo_piutang'] ?? null;
    $total_pembayaran_piutang = $_POST['total_pembayaran_piutang'] ?? null;

    // Validasi input
    if ($id_transaksi_pendapatan && $tanggal_pembayaran && $id_customer && $saldo_piutang && $total_pembayaran_piutang) {
        if (!is_numeric($id_transaksi_pendapatan) || !is_numeric($id_customer)) {
            $errorMessage = "ID Transaksi Pendapatan dan ID Customer harus berupa angka.";
        } elseif (!is_numeric($saldo_piutang) || !is_numeric($total_pembayaran_piutang)) {
            $errorMessage = "Saldo piutang dan total pembayaran harus berupa angka.";
        } else {
            $date = DateTime::createFromFormat('Y-m-d', $tanggal_pembayaran);
            if (!$date || $date->format('Y-m-d') !== $tanggal_pembayaran) {
                $errorMessage = "Format tanggal tidak valid.";
            } else {
                // Query prepared statement
                $stmt = $koneksi->prepare("
                    INSERT INTO transaksi_piutang (
                        id_transaksi_pendapatan, tanggal_pembayaran, id_customer, saldo_piutang, total_pembayaran_piutang
                    ) VALUES (?, ?, ?, ?, ?)
                ");
                if ($stmt) {
                    $stmt->bind_param(
                        "issdd",
                        $id_transaksi_pendapatan,
                        $tanggal_pembayaran,
                        $id_customer,
                        $saldo_piutang,
                        $total_pembayaran_piutang
                    );

                    if ($stmt->execute()) {
                        $successMessage = "Transaksi berhasil disimpan.";
                    } else {
                        $errorMessage = "Kesalahan eksekusi query: " . $stmt->error;
                    }
                } else {
                    $errorMessage = "Kesalahan saat menyiapkan query: " . $koneksi->error;
                }
            }
        }
    } else {
        $errorMessage = "Semua field wajib diisi.";
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
                        <a class="nav-link" href="transaksi_pendapatan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pendapatan
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
                    <h1 class="mb-4">Form Pelunasan Piutang</h1>

                    <!-- Form -->
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="id_transaksi_pendapatan" class="form-label">Pilih Transaksi Pendapatan</label>
                            <select class="form-select" id="id_transaksi_pendapatan" name="id_transaksi_pendapatan" onchange="getCustomerDetails()" required>
                                <option value="">Pilih ID Transaksi Pendapatan</option>
                                <?php
                                $transaksiPendapatan = mysqli_query($koneksi, "SELECT id_transaksi_pendapatan, id_customer, sisa_pembayaran FROM transaksi_pendapatan");
                                while ($transaksi = mysqli_fetch_assoc($transaksiPendapatan)) {
                                    echo "<option value='{$transaksi['id_transaksi_pendapatan']}' data-id_customer='{$transaksi['id_customer']}' data-sisa_pembayaran='{$transaksi['sisa_pembayaran']}'>
                                {$transaksi['id_transaksi_pendapatan']}
                              </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_customer" class="form-label">ID Customer</label>
                            <input type="text" class="form-control" id="id_customer" name="id_customer" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="saldo_piutang" class="form-label">Saldo Piutang</label>
                            <input type="number" step="0.01" class="form-control" id="saldo_piutang" name="saldo_piutang" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="total_pembayaran_piutang" class="form-label">Total Pembayaran Piutang</label>
                            <input type="number" step="0.01" class="form-control" id="total_pembayaran_piutang" name="total_pembayaran_piutang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    </form>
                </div>
                <script>
                    function getCustomerDetails() {
                        const selectElement = document.getElementById("id_transaksi_pendapatan");
                        const selectedOption = selectElement.options[selectElement.selectedIndex];

                        const idCustomer = selectedOption.getAttribute("data-id_customer");
                        const sisaPembayaran = selectedOption.getAttribute("data-sisa_pembayaran");

                        document.getElementById("id_customer").value = idCustomer || "";
                        document.getElementById("saldo_piutang").value = sisaPembayaran || 0;
                    }
                </script>
            </main>
        </div>
    </div>
</body>

</html>