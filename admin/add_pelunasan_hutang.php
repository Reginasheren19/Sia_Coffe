<?php
include("../config/koneksi_mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $nota_pelunasan = $_POST['nota_pelunasan'];
    $tanggal_pelunasan = $_POST['tanggal_pelunasan'];
    $id_supplier = $_POST['id_supplier'];
    $saldo_hutang_pl = $_POST['saldo_hutang_pl'];
    $total_pelunasan = $_POST['total_pelunasan'];

    // Query untuk menyimpan data ke database
    $query = "
        INSERT INTO pelunasan_hutang (id_transaksi, nota_pelunasan, tanggal_pelunasan, id_supplier, saldo_hutang_pl, total_pelunasan)
        VALUES ('$id_transaksi', '$nota_pelunasan', '$tanggal_pelunasan', '$id_supplier', '$saldo_hutang_pl', '$total_pelunasan')
    ";

    if (mysqli_query($koneksi, $query)) {
        header("Location: pelunasan_hutang.php"); // Redirect kembali ke halaman utama
    } else {
        echo "Error: " . mysqli_error($koneksi);
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
                <h1 class="mb-4">Form Pelunasan Hutang</h1>
                <form method="POST" action="add_pelunasan_hutang.php">
                    <div class="mb-3">
                        <label for="id_transaksi" class="form-label">No Nota</label>
                        <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nota_pelunasan" class="form-label">Nota Pelunasan</label>
                        <input type="text" class="form-control" id="nota_pelunasan" name="nota_pelunasan" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pelunasan" class="form-label">Tanggal Pelunasan</label>
                        <input type="date" class="form-control" id="tanggal_pelunasan" name="tanggal_pelunasan" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Nama Supplier</label>
                        <select class="form-select" id="id_supplier" name="id_supplier" required>
                            <option value="">Pilih Supplier</option>
                            <?php
                                // Mengambil data supplier
                                $suppliers = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier FROM master_supplier");
                                while ($supplier = mysqli_fetch_assoc($suppliers)) {
                                    echo "<option value='{$supplier['id_supplier']}'>{$supplier['nama_supplier']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="saldo_hutang_pl" class="form-label">Saldo Hutang</label>
                        <input type="text" class="form-control" id="saldo_hutang_pl" name="saldo_hutang_pl" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="total_pelunasan" class="form-label">Total Pelunasan</label>
                        <input type="number" class="form-control" id="total_pelunasan" name="total_pelunasan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="pelunasan_hutang.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
            </body>
            </html>
