<?php
include("../config/koneksi_mysql.php");

$sql = mysqli_query($koneksi,"SELECT * FROM transaksi_pengeluaran");

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
        <title>TRANSAKSI PENGELUARAN - SIA COFFE SHOP</title>
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
                    <h1 class="mt-4">Transaksi Pengeluaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data Pengeluaran</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Transaksi Pengeluaran
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah Data -->
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransaksiPengeluaranModal">
                                    Add Pengeluaran
                                </button>
                            </div>
<!-- Table for Data Transactions -->
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id Transaksi</th>
                <th>No Nota</th>
                <th>Kategori Pengeluaran</th>
                <th>Nama Supplier</th>
                <th>Nama Akun</th>
                <th>Tanggal Transaksi</th>
                <th>Harga</th>
                <th>Banyaknya</th>
                <th>Total</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="data_pengeluaran">
            <?php
            // Query to fetch transaction data and join master_supplier and master_akun
            $result = mysqli_query($koneksi, "
                SELECT tp.id_transaksi, 
                       tp.no_nota, 
                       tp.kategori_pengeluaran, 
                       ms.nama_supplier, 
                       ma.nama_akun, 
                       tp.tanggal_transaksi, 
                       tp.harga, 
                       tp.jumlah,
                       tp.harga * tp.jumlah AS total, 
                       tp.total_bayar, 
                       tp.status
                FROM transaksi_pengeluaran tp
                JOIN master_supplier ms ON tp.id_supplier = ms.id_supplier
                JOIN master_akun ma ON tp.id_akun = ma.id_akun
            ");

            // Display transaction data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['id_transaksi']}</td>
                    <td>{$row['no_nota']}</td>
                    <td>{$row['kategori_pengeluaran']}</td>
                    <td>{$row['nama_supplier']}</td>
                    <td>{$row['nama_akun']}</td>
                    <td>{$row['tanggal_transaksi']}</td>
                    <td>" . number_format($row['harga'], 2) . "</td>
                    <td>{$row['jumlah']}</td>
                    <td>" . number_format($row['total'], 2) . "</td>
                    <td>" . number_format($row['total_bayar'], 2) . "</td>
                    <td>{$row['status']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<!-- Modal for Adding Expense Transaction -->
<div class="modal fade" id="addTransaksiPengeluaranModal" tabindex="-1" aria-labelledby="addTransaksiPengeluaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add_transaksi_pengeluaran.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiPengeluaranModalLabel">Tambah Transaksi Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                            <label for="no_nota" class="form-label">No Nota</label>
                            <input type="text" class="form-control" id="no_nota" name="no_nota" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_pengeluaran" class="form-label">Kategori Pengeluaran</label>
                        <select class="form-select" id="kategori_pengeluaran" name="kategori_pengeluaran" required>
                            <option value="peralatan">Peralatan</option>
                            <option value="perlengkapan">Perlengkapan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Nama Supplier</label>
                        <select class="form-select" id="id_supplier" name="id_supplier">
                            <option value="">Pilih Supplier</option>
                            <?php
                            // Fetch supplier data from the database
                            $suppliers = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier, saldo_hutang FROM master_supplier");
                            while ($supplier = mysqli_fetch_assoc($suppliers)) {
                                echo "<option value='{$supplier['id_supplier']}' data-saldo='{$supplier['saldo_hutang']}'>{$supplier['nama_supplier']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Dropdown for Account Name -->
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
                        <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Banyaknya</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="total" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_bayar" class="form-label">Total Bayar</label>
                        <input type="number" class="form-control" id="total_bayar" name="total_bayar" required>
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

<script>
    // Mengisi total pengeluaran otomatis berdasarkan harga dan jumlah
    $('#harga, #jumlah').on('input', function() {
        const harga = parseFloat($('#harga').val()) || 0;
        const jumlah = parseInt($('#jumlah').val()) || 0;
        const total = harga * jumlah;

        // Menampilkan total pengeluaran di kolom yang sesuai
        $('#total').val(total);

        // Menentukan status setelah total bayar dihitung
        const totalBayar = parseFloat($('#total_bayar').val()) || 0;
        
        // Menentukan status berdasarkan perbandingan total bayar dan total pengeluaran
        if (totalBayar < total) {
            $('#status').val('Belum Lunas');
        } else {
            $('#status').val('Lunas');
        }
    });

    // Mengubah status secara otomatis saat total bayar dimasukkan
    $('#total_bayar').on('input', function() {
        const total = parseFloat($('#total').val()) || 0;
        const totalBayar = parseFloat($('#total').val()) || 0;

        // Menentukan status berdasarkan total bayar dan total pengeluaran
        if (totalBayar < total) {
            $('#status').val('Belum Lunas');
        } else {
            $('#status').val('Lunas');
        }
    });
</script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script>

