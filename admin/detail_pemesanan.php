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
                            <nav class="sb-sidenav -menu-nested nav">
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
                    <h1 class="mt-4">Detail Pemesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Detail Pemesanan</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                             Detail Pemesanan
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah Data -->
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDetailPemesananModal">
                                    Add Data
                                </button>
                            </div>
                            <!-- Tabel Data Detail Pemesanan -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Detail Pemesanan</th>
                                            <th>Id Transakasi Pemesanan</th>
                                            <th>Id Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Diskon</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_transaksi_pemesanan">
                                        <?php
                                        // Query untuk mendapatkan data transaksi pemesanan dengan data terkait
                                        $query = "SELECT 
                                                    tp.id_transaksi_pemesanan,
                                                    mc.nama_customer,
                                                    tp.tanggal_transaksi,
                                                    tp.total_harga,
                                                    mm.nama_metode,
                                                    ma.nama_akun
                                                  FROM 
                                                    transaksi_pemesanan tp
                                                  JOIN 
                                                    master_customer mc ON tp.id_customer = mc.id_customer
                                                  JOIN 
                                                    master_metode_pembayaran mm ON tp.id_metode = mm.id_metode
                                                  JOIN
                                                    master_akun ma ON tp.kode_akun = ma.kode_akun";
                                        
                                        //$result = mysqli_query($koneksi, $query); masalah ini masalah

                                        if (!$result) {
                                            die("Query failed: " . mysqli_error($koneksi));
                                        }
                                        
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$row['id_transaksi_pemesanan']}</td>
                                                <td>{$row['nama_customer']}</td>
                                                <td>{$row['tanggal_transaksi']}</td>
                                                <td>{$row['total_harga']}</td>
                                                <td>{$row['nama_metode']}</td>
                                                <td>{$row['nama_akun']}</td>
                                                    <button class='btn btn-primary btn-sm btn-update'>Update</button>
                                                    <a href='delete_transaksi_pemesanan.php?penggajian={$row['id_transaksi_pemesanan']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this transaksi?')\">Delete</a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal -->
            <div class="modal fade" id="gajiModal" tabindex="-1" aria-labelledby="gajiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gajiModalLabel">Tambah Penggajian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambahkan penggajian -->
                    <form action="add_transaksi_penggajian.php" method="POST">
                    <div class="form-group">
                        <label for="id_transaksi_karyawan">ID Transaksi Karyawan:</label>
                        <input type="text" name="id_transaksi_karyawan" id="id_transaksi_karyawan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="periode_gaji">Periode Gaji (Bulan/Tahun):</label>
                        <input type="month" name="periode_gaji" id="periode_gaji" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gaji_pokok">Gaji Pokok:</label>
                        <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tunjangan">Tunjangan:</label>
                        <input type="number" name="tunjangan" id="tunjangan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="potongan">Potongan:</label>
                        <input type="number" name="potongan" id="potongan" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Tambah Penggajian</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="js/datatables-simple-demo.js"></script>
            <script>
            function updateKaryawanInfo() {
                const nik = document.getElementById('NIK').value;
                if (nik) {
                    fetch(`get_karyawan_info.php?NIK=${ nik}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('nama_karyawan').value = data.nama_karyawan;
                            document.getElementById('alamat_karyawan').value = data.alamat_karyawan;
                            document.getElementById('tgl_lahir').value = data.tgl_lahir;
                            document.getElementById('jenis_kelamin').value = data.jenis_kelamin;
                            document.getElementById('no_telp').value = data.no_telp;
                            document.getElementById('email').value = data.email;
                            document.getElementById('tgl_bergabung').value = data.tgl_bergabung;
                        })
                        .catch(error => console.error('Error fetching karyawan info:', error));
                } else {
                    // Clear fields if no NIK is selected
                    document.getElementById('nama_karyawan').value = '';
                    document.getElementById('alamat_karyawan').value = '';
                    document.getElementById('tgl_lahir').value = '';
                    document.getElementById('jenis_kelamin').value = '';
                    document.getElementById('no_telp').value = '';
                    document.getElementById('email').value = '';
                    document.getElementById('tgl_bergabung').value = '';
                }
            }

            function updateJabatanInfo() {
                const idJabatan = document.getElementById('id_jabatan').value;
                if (idJabatan) {
                    fetch(`get_jabatan_info.php?id_jabatan=${idJabatan}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('nama_jabatan').value = data.nama_jabatan;
                        })
                        .catch(error => console.error('Error fetching jabatan info:', error));
                } else {
                    document.getElementById('nama_jabatan').value = '';
                }
            }

            function updateDivisiInfo() {
                const idDivisi = document.getElementById('id_divisi').value;
                if (idDivisi) {
                    fetch(`get_divisi_info.php?id_divisi=${idDivisi}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('nama_divisi').value = data.nama_divisi;
                        })
                        .catch(error => console.error('Error fetching divisi info:', error));
                } else {
                    document.getElementById('nama_divisi').value = '';
                }
            }
            </script>
        </body>
    </html>