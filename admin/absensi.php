<?php
include("../config/koneksi_mysql.php");

// Mengatur error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
                        ```php
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
                    <h1 class="mt-4">Presensi Karyawan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Presensi Karyawan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Filter Data Absensi
                        </div>
                        <div class="card-body">
                            <form class="form-inline">
                                <div class="form-group mb-3">
                                    <label for="bulan">Bulan</label>
                                    <select class="form-control ml-3" name="bulan" id="bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2 ml-5">
                                    <label for="tahun">Tahun</label>
                                    <select class="form-control ml-3" name="tahun" id="tahun">
                                        <option value="">Pilih Tahun</option>
                                        <?php 
                                        $tahun = date('Y');
                                        for ($i = 2023; $i <= $tahun + 5; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3 d-flex justify-content-end">
                                    <button type="button" id="tampildataabsen" class="btn btn-success">
                                        Tampilkan Data
                                    </button>
                                    <button type="button" id="editdataabsen" class="btn btn-success ms-2">
                                        Tambah Absensi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                        $bulan = $_GET['bulan'];
                        $tahun = $_GET['tahun'];
                        $bulantahun = $bulan . $tahun;
                    } else {
                        $bulan = date('m');
                        $tahun = date('Y');
                        $bulantahun = $bulan . $tahun;
                    }
                    ?>

                    <div class="alert alert-info" style="display:none;">
                        Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan; ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun; ?></span>
                    </div>
                    <div id="tampildataabsen" class="table-responsive" style="display:none;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Absensi</th>
                                    <th>Nama Karyawan</th>
                                    <th>Nama Jabatan</th>
                                    <th>Hadir</th>
                                    <th>Sakit</th>
                                    <th>Alpha</th>
                                </tr>
                            </thead>
                            <tbody id="absensi_karyawan">
                                <?php
                                // Query untuk mendapatkan data absensi karyawan
                                $query = "SELECT 
                                ak.id_absensi,
                                ak.hadir,
                                ak.sakit,
                                ak.alpha,
                                mk.nama_karyawan,
                                mj.nama_jabatan
                              FROM 
                                absensi_karyawan ak
                              JOIN transaksi_karyawan tk ON ak.id_transaksi_karyawan = tk.id_transaksi_karyawan
                              JOIN master_karyawan mk ON tk.NIK = mk.NIK
                              JOIN master_jabatan mj ON tk.id_jabatan = mj.id_jabatan
                              WHERE ak.bulan = '$bulan' AND ak.tahun = '$tahun'";
                                
                                $result = mysqli_query($koneksi, $query);
                                
                                // Debugging output query
                                if (!$result) {
                                    die('Error pada query: ' . mysqli_error($koneksi)); 
                                } else {
                                    echo 'Query berhasil dijalankan'; // Debugging
                                }
                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>{$row['id_absensi']}</td>
                                        <td>{$row['nama_karyawan']}</td>
                                        <td>{$row['nama_jabatan']}</td>
                                        <td>{$row['hadir']}</td>                         
                                        <td>{$row['sakit']}</td>
                                        <td>{$row['alpha']}</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Form untuk menambah dan mengedit absensi -->
                    <div id="formTambahAbsensi" style="display:none;">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah / Edit Absensi
                            </div>
                            <div class="card-body">
                                <form id="formAbsensi" method="POST" action="edit_absensi.php">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id Absensi</th>
                                                <th>NIK</th>
                                                <th>Nama Karyawan</th>
                                                <th>Nama Jabatan</th>
                                                <th>Hadir</th>
                                                <th>Sakit</th>
                                                <th>Alpha</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableAbsensiBody">
                                            <?php
                                            // Query untuk mendapatkan data semua karyawan
                                            $query = "SELECT 
                                                        ak.id_absensi,
                                                        mk.NIK
                                                        mk.nama_karyawan,
                                                        mj.nama_jabatan,
                                                        ak.hadir,
                                                        ak.sakit,
                                                        ak.alpha
                                                    FROM 
                                                        absensi_karyawan ak
                                                    JOIN transaksi_karyawan tk ON tk.id_transaksi_karyawan = tk.NIK
                                                    JOIN master_karyawan mk ON tk.NIK = mk.NIK
                                                    JOIN master_jabatan mj ON tk.id_jabatan = mj.id_jabatan";
                                            
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil
                                            if (!$result) {
                                                die('Error pada query: ' . mysqli_error($koneksi));
                                            }

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>
                                                        <td>{$row['nama_karyawan']}</td>
                                                        <td>{$row['nama_jabatan']}</td>
                                                        <td><input type='number' name='hadir[{$row['NIK']}]' class='form-control' value='0'></td>
                                                        <td><input type='number' name='sakit[{$row['NIK']}]' class='form-control' value='0'></td>
                                                        <td><input type='number' name='alpha[{$row['NIK']}]' class='form-control' value='0'></td>
                                                    </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mengatur event handler untuk tombol 'Tampilkan Data'
        $('#tampildataabsen').click(function() {
            var bulan = $('#bulan').val();  // Mengambil nilai bulan
            var tahun = $('#tahun').val();  // Mengambil nilai tahun

            if (bulan && tahun) {  // Memastikan bulan dan tahun dipilih
                $.ajax({
                    url: 'get_absensi.php',  // Menyambung ke file get_absensi.php
                    type: 'GET',
                    data: { bulan: bulan, tahun: tahun },  // Mengirimkan data bulan dan tahun
                    success: function(response) {
                        // Memasukkan data ke dalam elemen tabel
                        $('#absensi_karyawan').html(response);
                        $('#tampildataabsen').show();  // Menampilkan tabel setelah data diambil
                    },
                    error: function() {
                        alert('Terjadi kesalahan dalam pengambilan data.');
                    }
                });
            } else {
                alert('Pilih bulan dan tahun terlebih dahulu.');
            }
        });
    </script>
    <script>
        $('#editdataabsen').click(function() {
            $('#formTambahAbsensi').toggle(); // Menampilkan form untuk menambah atau mengedit absensi
            $('#tableContainer').hide(); // Sembunyikan tabel absensi lama
        });
    </script>
</body>
</html>