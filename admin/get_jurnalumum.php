<?php
include("../config/koneksi_mysql.php");

// Inisialisasi variabel
$bulan_jurnal = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun_jurnal = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$data = [];
$total_debit = 0;  // Variabel untuk menghitung total debit
$total_kredit = 0;

// Query untuk mendapatkan data transaksi karyawan yang terdaftar, lengkap dengan jabatan dan absensi
$query = "SELECT 
    ju.id_jurnal_umum,
    ju.tanggal,
    ma.nama_akun,
    ma.kode_akun,
    ju.debit,
    ju.kredit
FROM 
    jurnal_umum ju
JOIN 
    master_akun ma ON ju.id_akun = ma.id_akun
WHERE 
    MONTH(ju.tanggal) = '$bulan_jurnal' 
    AND YEAR(ju.tanggal) = '$tahun_jurnal'
ORDER BY 
    ju.id_jurnal_umum ASC";

$result = mysqli_query($koneksi, $query);

    // Output hasil query dalam format HTML
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $total_debit += $row['debit'];
                $total_kredit += $row['kredit'];
                $data[] = $row;
            }
        } else {
            $data = [];
        }
    } else {
        $data = null;
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
        <title>Jurnal Umum- SIA COFFE SHOP</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3">SIA Coffee Shop</a>
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
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                            <a class="nav-link" href="transaksi_karyawan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Kelola Karyawan
                            </a>
                            <a class="nav-link" href="transaksi_penggajian.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Penggajian
                            </a>
                            <a class="nav-link" href="absensi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Presensi Karyawan
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
                            <a class="nav-link" href="master_akun.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Akun
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
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Jurnal Umum</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jurnal Umum</li>
                </ol>

                <!-- Form untuk memilih bulan dan tahun -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Filter Data Jurnal Umum
                    </div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group mb-3">
                                <label for="bulan">Bulan</label>
                                <select class="form-control ml-3" name="bulan" id="bulan">
                                    <option value="">Pilih Bulan</option>
                                    <option value="01" <?php echo ($bulan_jurnal == '01') ? 'selected' : ''; ?>>Januari</option>
                                    <option value="02" <?php echo ($bulan_jurnal == '02') ? 'selected' : ''; ?>>Februari</option>
                                    <option value="03" <?php echo ($bulan_jurnal == '03') ? 'selected' : ''; ?>>Maret</option>
                                    <option value="04" <?php echo ($bulan_jurnal == '04') ? 'selected' : ''; ?>>April</option>
                                    <option value="05" <?php echo ($bulan_jurnal == '05') ? 'selected' : ''; ?>>Mei</option>
                                    <option value="06" <?php echo ($bulan_jurnal == '06') ? 'selected' : ''; ?>>Juni</option>
                                    <option value="07" <?php echo ($bulan_jurnal == '07') ? 'selected' : ''; ?>>Juli</option>
                                    <option value="08" <?php echo ($bulan_jurnal == '08') ? 'selected' : ''; ?>>Agustus</option>
                                    <option value="09" <?php echo ($bulan_jurnal == '09') ? 'selected' : ''; ?>>September</option>
                                    <option value="10" <?php echo ($bulan_jurnal == '10') ? 'selected' : ''; ?>>Oktober</option>
                                    <option value="11" <?php echo ($bulan_jurnal == '11') ? 'selected' : ''; ?>>November</option>
                                    <option value="12" <?php echo ($bulan_jurnal == '12') ? 'selected' : ''; ?>>Desember</option>
                                </select>
                            </div>
                            <div class="form-group mb-2 ml-5">
                                <label for="tahun">Tahun</label>
                                <select class="form-control ml-3" name="tahun" id="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <?php 
                                    $tahun_sekarang = date('Y');
                                    for ($i = 2023; $i <= $tahun_sekarang + 5; $i++) { ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($tahun_jurnal == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3
                             d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    Tampilkan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Menampilkan data absensi -->
                <?php if ($data !== null): ?>
                    <div class="alert alert-info">
                        Menampilkan Data Jurnal Umum Bulan: <strong><?php echo $bulan_jurnal; ?></strong> Tahun: <strong><?php echo $tahun_jurnal; ?></strong>
                    </div>
                    <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Filter Jurnal Umum
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-absensi">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data): ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr>
                                        <td><?php echo ($row['kredit'] > 0) ? '' : $row['tanggal']; ?></td> <!-- Tanggal hanya ditampilkan jika debit bukan 0 -->
                                        <td style="text-align: <?php echo ($row['kredit'] > 0) ? 'right' : 'left'; ?>;">
                                            <?php echo $row['nama_akun']; ?>
                                        </td>                                            <td><?php echo $row['kode_akun']; ?></td>
                                        <td><?php echo ($row['debit'] > 0) ? number_format($row['debit'], 2) : ''; ?></td> <!-- Kolom debit hanya diisi jika ada nilai debit -->
                                        <td><?php echo ($row['kredit'] > 0) ? number_format($row['kredit'], 2) : ''; ?></td> <!-- Kolom kredit hanya diisi jika ada nilai kredit -->
                                        </tr>
                                    <?php endforeach; ?>
                                        <!-- Baris total -->
                                        <tr>
                                            <td colspan="3" class="text-center"><strong>Total</strong></td>
                                            <td><strong><?php echo number_format($total_debit, 2); ?></strong></td>
                                            <td><strong><?php echo number_format($total_kredit, 2); ?></strong></td>
                                        </tr>
                                <?php else: ?>
                                    <tr><td colspan="6">Data Jurnal Umum tidak ditemukan.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>