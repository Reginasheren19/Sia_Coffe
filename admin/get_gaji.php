<?php
include("../config/koneksi_mysql.php");

// Inisialisasi variabel
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$data_gaji = [];

// Query untuk mendapatkan data transaksi karyawan yang terdaftar, lengkap dengan jabatan dan absensi
$query = "SELECT 
    tp.id_penggajian,
    tp.gaji_pokok,
    tp.tunjangan,
    tp.potongan,
    tp.gaji_lembur,
    tp.bonus,
    tp.gaji_bersih,
    mk.nama_karyawan,
    mj.nama_jabatan,
    md.nama_divisi
FROM 
    transaksi_penggajian tp
JOIN transaksi_karyawan tk ON tp.id_transaksi_karyawan = tk.id_transaksi_karyawan
JOIN master_karyawan mk ON tk.NIK = mk.NIK
JOIN master_jabatan mj ON tk.id_jabatan = mj.id_jabatan
JOIN master_divisi md ON tk.id_divisi = md.id_divisi
WHERE tp.bulan_gaji = '$bulan' AND tp.tahun_gaji = '$tahun'";

$result = mysqli_query($koneksi, $query);

    // Output hasil query dalam format HTML
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $data_gaji = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data_gaji[] = $row;
            }
        } else {
            $data_gaji = [];
        }
    } else {
        $data_gaji = null;
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
                            <div class="sb-nav-link-collapse-arrow"><i class="fas fa-angle-down"></i></div>
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
            <div class="container-fluid px-4">
                <h1 class="mt-4">Penggajian Karyawan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Penggajian Karyawan</li>
                </ol>
                <div class="mb-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#addGajiModal">
                        Generate Gaji
                    </button>
                </div>
                <!-- Form untuk memilih bulan dan tahun -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Data Gaji Karyawan
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
                                <button type="submit" class="btn btn-success" formaction="get_gaji.php?bulan=<?php echo $bulan_gaji; ?>&tahun=<?php echo $tahun_gaji; ?>">
                                    Tampilkan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Menampilkan data absensi -->
                <?php if ($data_gaji !== null): ?>
                    <div class="alert alert-info">
                        Menampilkan Data Penggajian Karyawan Bulan: <strong><?php echo $bulan; ?></strong> Tahun: <strong><?php echo $tahun; ?></strong>
                    </div>
                    <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Filter Data Gaji
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-gaji">
                            <thead>
                                <tr>
                                    <th>ID Gaji</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Divisi</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Potongan</th>
                                    <th>Lembur</th>
                                    <th>Bonus</th>
                                    <th>Gaji Bersih</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data_gaji): ?>
                                    <?php foreach ($data_gaji as $row): ?>
                                        <tr>
                                            <td><?php echo $row['id_penggajian']; ?></td>
                                            <td><?php echo $row['nama_karyawan']; ?></td>
                                            <td><?php echo $row['nama_jabatan']; ?></td>
                                            <td><?php echo $row['nama_divisi']; ?></td>
                                            <td><?php echo $row['gaji_pokok']; ?></td>
                                            <td><?php echo $row['tunjangan']; ?></td>
                                            <td><?php echo $row['potongan']; ?></td>
                                            <td><?php echo $row['gaji_lembur']; ?></td>
                                            <td><?php echo $row['bonus']; ?></td>
                                            <td><?php echo $row['gaji_bersih']; ?></td>
                                            <td>
                                                <a href="cetak_slip.php?id_penggajian=<?php echo $row['id_penggajian']; ?>" class="btn btn-primary btn-sm" target="_blank">Cetak Slip</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6">Data Gaji tidak ditemukan.</td></tr>
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
