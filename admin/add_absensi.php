<?php
include("../config/koneksi_mysql.php");

// Inisialisasi variabel
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$data_karyawan = [];

// Query untuk mendapatkan data transaksi karyawan yang terdaftar, lengkap dengan jabatan dan absensi
$query_transaksi = "
    SELECT 
        mk.NIK, 
        mk.nama_karyawan, 
        mj.nama_jabatan, 
        tk.id_transaksi_karyawan, 
        IFNULL(ak.hadir, 0) AS hadir, 
        IFNULL(ak.sakit, 0) AS sakit, 
        IFNULL(ak.alpha, 0) AS alpha,
        IFNULL(ak.jam_lembur, 0) AS jam_lembur
    FROM 
        transaksi_karyawan tk
    JOIN 
        master_karyawan mk ON tk.NIK = mk.NIK
    JOIN 
        master_jabatan mj ON tk.id_jabatan = mj.id_jabatan
    LEFT JOIN 
        absensi_karyawan ak ON tk.id_transaksi_karyawan = ak.id_transaksi_karyawan 
        AND ak.bulan = '$bulan' AND ak.tahun = '$tahun'";
        
$result_transaksi = mysqli_query($koneksi, $query_transaksi);

    // Output hasil query dalam format HTML
    if ($result_transaksi) {
        if (mysqli_num_rows($result_transaksi) > 0) {
            $data_karyawan = [];
            while ($row = mysqli_fetch_assoc($result_transaksi)) {
                $data_karyawan[] = $row;
            }
        } else {
            $data_karyawan = [];
        }
    } else {
        $data_karyawan = null;
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
        <title>Dashboard - SIA COFFE SHOP</title>
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
                <h1 class="mt-4">Presensi Karyawan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Presensi Karyawan</li>
                </ol>
                <!-- Form untuk memilih bulan dan tahun -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Filter Data Absensi
                    </div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group mb-3">
                                <label for="bulan">Bulan</label>
                                <select class="form-control ml-3" name="bulan" id="bulan">
                                    <option value="">Pilih Bulan</option>
                                    <option value="01" <?php echo ($bulan == '01') ? 'selected' : ''; ?>>Januari</option>
                                    <option value="02" <?php echo ($bulan == '02') ? 'selected' : ''; ?>>Februari</option>
                                    <option value="03" <?php echo ($bulan == '03') ? 'selected' : ''; ?>>Maret</option>
                                    <option value="04" <?php echo ($bulan == '04') ? 'selected' : ''; ?>>April</option>
                                    <option value="05" <?php echo ($bulan == '05') ? 'selected' : ''; ?>>Mei</option>
                                    <option value="06" <?php echo ($bulan == '06') ? 'selected' : ''; ?>>Juni</option>
                                    <option value="07" <?php echo ($bulan == '07') ? 'selected' : ''; ?>>Juli</option>
                                    <option value="08" <?php echo ($bulan == '08') ? 'selected' : ''; ?>>Agustus</option>
                                    <option value="09" <?php echo ($bulan == '09') ? 'selected' : ''; ?>>September</option>
                                    <option value="10" <?php echo ($bulan == '10') ? 'selected' : ''; ?>>Oktober</option>
                                    <option value="11" <?php echo ($bulan == '11') ? 'selected' : ''; ?>>November</option>
                                    <option value="12" <?php echo ($bulan == '12') ? 'selected' : ''; ?>>Desember</option>
                                </select>
                            </div>
                            <div class="form-group mb-2 ml-5">
                                <label for="tahun">Tahun</label>
                                <select class="form-control ml-3" name="tahun" id="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <?php 
                                    $tahun_sekarang = date('Y');
                                    for ($i = 2023; $i <= $tahun_sekarang + 5; $i++) { ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($tahun == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    Tampilkan Data
                                </button>
                                <button type="submit" class="btn btn-success ms-2" formaction="add_absensi.php?bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>">
                                    Tambah Absensi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="alert alert-info">
                        Menambah Data Kehadiran Karyawan Bulan: <strong><?php echo $bulan; ?></strong> Tahun: <strong><?php echo $tahun; ?></strong>
                </div>
                <!-- Form untuk tambah absensi -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Tambah Absensi
                    </div>
                    <div class="card-body">
                        <form action="simpan_absensi.php" method="POST">
                            <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
                            <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Hadir</th>
                                        <th>Sakit</th>
                                        <th>Alpha</th>
                                        <th>Jam Lembur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_karyawan as $karyawan): ?>
                                        <tr>
                                            <td><?php echo $karyawan['nama_karyawan']; ?></td>
                                            <td><?php echo $karyawan['nama_jabatan']; ?></td>
                                            <td>
                                                <input type="number" name="hadir[<?php echo $karyawan['id_transaksi_karyawan']; ?>]" value="<?php echo $karyawan['hadir']; ?>" min="0">
                                            </td>
                                            <td>
                                                <input type="number" name="sakit[<?php echo $karyawan['id_transaksi_karyawan']; ?>]" value="<?php echo $karyawan['sakit']; ?>" min="0">
                                            </td>
                                            <td>
                                                <input type="number" name="alpha[<?php echo $karyawan['id_transaksi_karyawan']; ?>]" value="<?php echo $karyawan['alpha']; ?>" min="0">
                                            </td>
                                            <td>
                                                <input type="number" name="jam_lembur[<?php echo $karyawan['id_transaksi_karyawan']; ?>]" value="<?php echo $karyawan['jam_lembur']; ?>" min="0">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </form>
                    </div>
                </div>
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