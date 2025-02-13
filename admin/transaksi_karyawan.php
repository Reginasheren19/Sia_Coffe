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
        <title>Transaksi Karyawan - SIA COFFE SHOP</title>
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
                    <h1 class="mt-4">Master Data Karyawan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard_admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Karyawan</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Employee Data Table
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah Data -->
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransaksiKaryawanModal">
                                    Add Data
                                </button>
                            </div>

                            <!-- Tabel Data Transaksi Karyawan -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi Karyawan</th>
                                            <th>Nama Karyawan</th>
                                            <th>Nama Jabatan</th>
                                            <th>Nama Divisi</th>
                                            <th>Status Karyawan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_transaksi_karyawan">
                                        <?php
                                        // Query untuk mendapatkan data transaksi karyawan
                                        $query = "SELECT 
                                                    tk.id_transaksi_karyawan,
                                                    mk.nama_karyawan,
                                                    mj.nama_jabatan,
                                                    md.nama_divisi,
                                                    tk.status_karyawan
                                                FROM 
                                                    transaksi_karyawan tk
                                                JOIN master_karyawan mk ON tk.NIK = mk.NIK
                                                JOIN master_jabatan mj ON tk.id_jabatan = mj.id_jabatan
                                                JOIN master_divisi md ON tk.id_divisi = md.id_divisi";
                                        
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$row['id_transaksi_karyawan']}</td>
                                                <td>{$row['nama_karyawan']}</td>
                                                <td>{$row['nama_jabatan']}</td>
                                                <td>{$row['nama_divisi']}</td>
                                                <td>{$row['status_karyawan']}</td>
                                                <td>
                                                    <button class='btn btn-primary btn-sm btn-update'>Update</button>
                                                    <a href='delete_transaksi_karyawan.php?transaksi_karyawan={$row['id_transaksi_karyawan']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this transaction?')\">Delete</a>                                                
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

            <!-- Modal Tambah Data Transaksi Karyawan -->
            <div class="modal fade" id="addTransaksiKaryawanModal" tabindex="-1" aria-labelledby="addTransaksiKaryawanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="add_transaksi_karyawan.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTransaksiKaryawanModalLabel">Tambah Data Transaksi Karyawan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="NIK" class="form-label">NIK</label>
                                    <select class="form-select" id="NIK" name="NIK" required onchange="updateKaryawanInfo()">
                                        <option value="">Pilih NIK</option>
                                        <?php
                                        // Ambil data karyawan untuk dropdown
                                        $karyawan = mysqli_query($koneksi, "SELECT NIK, nama_karyawan FROM master_karyawan");
                                        while ($row = mysqli_fetch_assoc($karyawan)) {
                                            echo "<option value='{$row['NIK']}'>{$row['NIK']} - {$row['nama_karyawan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="id_jabatan" class="form-label">ID Jabatan</label>
                                    <select class="form-select" id="id_jabatan" name="id_jabatan" required onchange="updateJabatanInfo()">
                                        <option value="">Pilih Jabatan</option>
                                        <?php
                                        // Ambil data jabatan untuk dropdown
                                        $jabatan = mysqli_query($koneksi, "SELECT id_jabatan, nama_jabatan FROM master_jabatan");
                                        while ($row = mysqli_fetch_assoc($jabatan)) {
                                            echo "<option value='{$row['id_jabatan']}'>{$row['id_jabatan']} - {$row['nama_jabatan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="id_divisi" class="form-label">ID Divisi</label>
                                    <select class="form-select" id="id_divisi" name="id_divisi" required onchange="updateDivisiInfo()">
                                        <option value="">Pilih Divisi</option>
                                        <?php
                                        // Ambil data divisi untuk dropdown
                                        $divisi = mysqli_query($koneksi, "SELECT id_divisi, nama_divisi FROM master_divisi");
                                        while ($row = mysqli_fetch_assoc($divisi)) {
                                            echo "<option value='{$row['id_divisi']}'>{$row['id_divisi']} - {$row['nama_divisi']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status_karyawan" class="form-label">Status Karyawan</label>
                                    <select class="form-select" id="status_karyawan" name="status_karyawan" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Cuti">Cuti</option>
                                        <option value="Resign">Resign</option>
                                    </select>
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