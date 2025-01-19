<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Debugging untuk melihat data yang dikirimkan dari form
echo '<pre>';
print_r($_POST);
echo '</pre>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi setiap field dari form
    $nama_kategori = isset($_POST['nama_kategori']) ? mysqli_real_escape_string($koneksi, $_POST['nama_kategori']) : null;
    $id_akun = isset($_POST['id_akun']) ? mysqli_real_escape_string($koneksi, $_POST['id_akun']) : null;
    $tanggal_pendapatan_lain = isset($_POST['tanggal_pendapatan_lain']) ? mysqli_real_escape_string($koneksi, $_POST['tanggal_pendapatan_lain']) : null;
    $total = isset($_POST['total']) ? (float)$_POST['total'] : null;

    // Pastikan semua field yang wajib terisi tidak kosong
    if ($nama_kategori && $id_akun && $tanggal_pendapatan_lain && $total) {
        // Query untuk mendapatkan nama akun
        $query_akun = "SELECT nama_akun FROM master_akun WHERE id_akun = '$id_akun'";
        $result_akun = mysqli_query($koneksi, $query_akun);
        $nama_akun = '';
        
        if ($result_akun && mysqli_num_rows($result_akun) > 0) {
            $row_akun = mysqli_fetch_assoc($result_akun);
            $nama_akun = $row_akun['nama_akun'];
        }

        // Query untuk menyimpan data ke database
        $query = "INSERT INTO transaksi_pendapatan_lain (
            nama_kategori, id_akun, tanggal_pendapatan_lain, total
        ) VALUES (
            '$nama_kategori', '$id_akun', '$tanggal_pendapatan_lain', '$total'
        )";

        // Eksekusi query transaksi pendapatan lain
        if (mysqli_query($koneksi, $query)) {
            // Insert jurnal umum (debit: kas, kredit: pendapatan lain)
            $query_jurnal_debit = "INSERT INTO jurnal_umum (
                tanggal, keterangan, id_akun, debit, kredit
            ) VALUES (
                '$tanggal_pendapatan_lain', 'Kas', '2', '$total', 0
            )";

            $query_jurnal_kredit = "INSERT INTO jurnal_umum (
                tanggal, keterangan, id_akun, debit, kredit
            ) VALUES (
                '$tanggal_pendapatan_lain', '$nama_akun', '$id_akun', 0, '$total'
            )";

            if (mysqli_query($koneksi, $query_jurnal_debit) && mysqli_query($koneksi, $query_jurnal_kredit)) {
                header("Location: transaksi_pendapatan_lain.php?success=1");
                exit();
            } else {
                echo "Error: " . mysqli_error($koneksi) . "<br>";
                echo "Query Jurnal: $query_jurnal_debit<br>";
                exit();
            }
        } else {
            echo "Error: " . mysqli_error($koneksi) . "<br>";
            echo "Query: $query<br>";
            exit();
        }
    } else {
        echo "Semua field wajib diisi.";
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
    <title>Transaksi Pendapatan Lain - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">SIA Coffe Shop</a>
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
                    Admin
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-5">
                    <h1 class="mb-4">Form Transaksi Pendapatan Lain</h1>
                    <form method="POST" action="add_transaksi_pendapatan_lain.php">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <select class="form-select" id="nama_kategori" name="nama_kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Sewa Tempat">Sewa Tempat</option>
                                <option value="Workshop">Workshop</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_akun" class="form-label">Nama Akun</label>
                            <select class="form-select" id="id_akun" name="id_akun" required>
                                <option value="">Pilih Akun</option>
                                <?php
                                $accounts = mysqli_query($koneksi, "SELECT id_akun, nama_akun FROM master_akun");
                                while ($account = mysqli_fetch_assoc($accounts)) {
                                    echo "<option value='{$account['id_akun']}'>{$account['nama_akun']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pendapatan_lain" class="form-label">Tanggal Pendapatan</label>
                            <input type="date" class="form-control" id="tanggal_pendapatan_lain" name="tanggal_pendapatan_lain" required>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" step="0.01" class="form-control" id="total" name="total" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    </form>

                    <!-- Table to display transactions -->
                    
                </div>
            </main>
        </div>
    </div>
</body>
</html>