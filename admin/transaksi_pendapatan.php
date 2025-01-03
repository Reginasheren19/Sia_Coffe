<?php
include("../config/koneksi_mysql.php");

$sql = mysqli_query($koneksi,"SELECT * FROM transaksi_pendapatan");

?>

<?php
error_reporting(0)
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
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">SIA Coffee Shop</a>
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
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
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
                            <a class="nav-link" href="transaksi_pengeluaran.php">
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
                            Tabel Transaksi Pendapatan
                        </div>
                        <div class="card-body">
                    <!-- Tombol Tambah Data -->
                <div class="mb-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransaksiPendapatanModal">
                        Add Pendapatan
                    </button>
                </div>

                

<!-- Tabel Data Transaksi Pen -->
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Id Customer</th>
                <th>Nama Customer</th>
                <th>Id Produk</th>
                <th>Nama Produk</th>
                <th>Kuantitas</th>
                <th>Harga Satuan</th>
                <th>Total Pendapatan</th>
                <th>Id Metode</th>
                <th>Id Jenis Pendapatan</th>
                <th>Nama Jenis Pendapatan</th>
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Status Transaksi</th>
                <th>Catatan Transaksi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="data_pendapatan">
            <?php
            // Query untuk mengambil data transaksi_pendapatan
            $result = mysqli_query($koneksi, "
                SELECT tp.id_transaksi, 
                        tp.tanggal_transaksi, 
                        tp.id_customer, 
                        mc.nama_customer, 
                        tp.id_produk, 
                        mp.nama_produk,
                        tp.kuantitas, 
                        tp.harga_satuan, 
                        tp.kuantitas * tp.harga_satuan AS total_pendapatan, 
                        tp.id_metode_pembayaran, 
                        mpb.nama_metode, 
                        tp.id_jenis_pendapatan, 
                        jp.nama_jenis_pendapatan, 
                        tp.id_karyawan, 
                        k.nama_karyawan, 
                        tp.status_transaksi, 
                        tp.catatan_transaksi 
                FROM transaksi_pendapatan tp
                JOIN master_customer mc ON tp.id_customer = mc.id_customer
                JOIN master_produk mp ON tp.id_produk = mp.id_produk
                JOIN master_metode_pembayaran mpb ON tp.id_metode_pembayaran = mpb.id_metode_pembayaran
                JOIN jenis_pendapatan jp ON tp.id_jenis_pendapatan = jp.id_jenis_pendapatan
                JOIN karyawan k ON tp.id_karyawan = k.id_karyawan            
                ");

            // Tampilkan data transaksi
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['id_transaksi']}</td>
                    <td>{$row['tanggal_transaksi']}</td>
                    <td>{$row['id_customer']}</td>
                    <td>{$row['nama_customer']}</td>
                    <td>{$row['id_produk']}</td>
                    <td>{$row['nama_produk']}</td>
                    <td>{$row['kuantitas']}</td>
                    <td>" . number_format($row['harga_satuan'], 2) . "</td>
                    <td>" . number_format($row['total_pendapatan'], 2) . "</td>
                    <td>{$row['id_metode_pembayaran']}</td>
                    <td>{$row['nama_metode']}</td>
                    <td>{$row['id_jenis_pendapatan']}</td>
                    <td>{$row['nama_jenis_pendapatan']}</td>
                    <td>{$row['id_karyawan']}</td>
                    <td>{$row['nama_karyawan']}</td>
                    <td>{$row['status_transaksi']}</td>
                    <td>{$row['catatan_transaksi']}</td>
                    <td>
                        <a href='delete_transaksi_pendapatan.php?transaksi={$row['id_transaksi']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this transaction?')\">Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<!-- Modal Tambah Transaksi Pendapatan -->
<div class="modal fade" id="addTransaksiPendapatanModal" tabindex="-1" aria-labelledby="addTransaksiPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="add_transaksi_pendapatan.php">
        <div class="modal-header">
            <h5 class="modal-title" id="addTransaksiPendapatanModalLabel">Tambah Transaksi Pendapatan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="id_customer" class="form-label">ID Customer</label>
                <select class="form-select" id="id_customer" name="id_customer" required>
                    <?php
                    $customers = mysqli_query($koneksi, "SELECT id_customer, nama_customer FROM master_customer");
                    while ($customer = mysqli_fetch_assoc($customers)) {
                        echo "<option value='{$customer['id_customer']}'>{$customer['nama_customer']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_produk" class="form-label">ID Produk</label>
                <select class="form-select" id="id_produk" name="id_produk" required>
                    <?php
                    $products = mysqli_query($koneksi, "SELECT id_produk, nama_produk FROM master_produk");
                    while ($product = mysqli_fetch_assoc($products)) {
                        echo "<option value='{$product['id_produk']}'>{$product['nama_produk']}</option>";
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
                <input type="number" step="0.01" class="form-control" id="harga_satuan" name="harga_satuan" required>
            </div>
            <div class="mb-3">
                <label for="id_metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="id_metode_pembayaran" name="id_metode_pembayaran" required>
                    <?php
                    $methods = mysqli_query($koneksi, "SELECT id_metode_pembayaran, nama_metode FROM master_metode_pembayaran");
                    while ($method = mysqli_fetch_assoc($methods)) {
                        echo "<option value='{$method['id_metode_pembayaran']}'>{$method['nama_metode']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_jenis_pendapatan" class="form-label">Jenis Pendapatan</label>
                <select class="form-select" id="id_jenis_pendapatan" name="id_jenis_pendapatan" required>
                    <?php
                    $types = mysqli_query($koneksi, "SELECT id_jenis_pendapatan, nama_jenis_pendapatan FROM jenis_pendapatan");
                    while ($type = mysqli_fetch_assoc($types)) {
                        echo "<option value='{$type['id_jenis_pendapatan']}'>{$type['nama_jenis_pendapatan']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_karyawan" class="form-label">ID Karyawan</label>
                <select class="form-select" id="id_karyawan" name="id_karyawan" required>
                    <?php
                    $employees = mysqli_query($koneksi, "SELECT id_karyawan, nama_karyawan FROM karyawan");
                    while ($employee = mysqli_fetch_assoc($employees)) {
                        echo "<option value='{$employee['id_karyawan']}'>{$employee['nama_karyawan']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="status_transaksi" class="form-label">Status Transaksi</label>
                <select class="form-select" id="status_transaksi" name="status_transaksi" required>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="catatan_transaksi" class="form-label">Catatan Transaksi</label>
                <textarea class="form-control" id="catatan_transaksi" name="catatan_transaksi"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                </body>

