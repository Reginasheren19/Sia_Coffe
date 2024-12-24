<?php
include("../config/koneksi_mysql.php");

// Mengatur error reporting
error_reporting(E_ALL);
ini_set
('display_errors', 1);
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
                    <h1 class="mt-4">Master Data Transaksi Karyawan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
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
                                            <th>NIK</th>
                                            <th>Nama Karyawan</th>
                                            <th>ID Jabatan</th>
                                            <th>Nama Jabatan</th>
                                            <th>ID Divisi</th>
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
                                                    tk.NIK,
                                                    mk.nama_karyawan,
                                                    tk.id_jabatan,
                                                    mj.nama_jabatan,
                                                    tk.id_divisi,
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
                                                <td>{$row['NIK']}</td>
                                                <td>{$row['nama_karyawan']}</td>
                                                <td>{$row['id_jabatan']}</td>
                                                <td>{$row['nama_jabatan']}</td>
                                                <td>{$row['id_divisi']}</td>
                                                <td>{$row['nama_divisi']}</td>
                                                <td>{$row['status_karyawan']}</td>
                                                <td>
                                                    <button class='btn btn-primary btn-sm btn-update'>Update</button>
                                                    <a href='delete_transaksi_karyawan.php?id_transaksi={$row['id_transaksi_karyawan']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this transaction?')\">Delete</a>
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
                                    <select class="form-select" id="NIK" name="NIK" required>
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
                                    <select class="form-select" id="id_jabatan" name="id_jabatan" required>
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
                                    <select class="form-select" id="id_divisi" name="id_divisi" required>
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
            // Menangani klik tombol update
            document.querySelectorAll('.btn-update').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil data dari baris yang sesuai
                    const row = this.closest('tr');
                    const NIK = row.cells[0].innerText;
                    const nama_karyawan = row.cells[1].innerText;
                    const alamat_karyawan = row.cells[2].innerText;
                    const tgl_lahir = row.cells[3].innerText;
                    const jenis_kelamin = row.cells[4].innerText;
                    const no_telp = row.cells[5].innerText;
                    const email = row.cells[6].innerText;
                    const tgl_bergabung = row.cells[7].innerText;

                    // Isi modal dengan data yang diambil
                    document.getElementById('editNIK').value = NIK;
                    document.getElementById('editNama').value = nama_karyawan;
                    document.getElementById('editAlamat').value = alamat_karyawan;
                    document.getElementById('editTglLahir').value = tgl_lahir;
                    document.getElementById('editJenisKelamin').value = jenis_kelamin;
                    document.getElementById('editNoTelp').value = no_telp;
                    document.getElementById('editEmail'). value = email;
                    document.getElementById('editTglBergabung').value = tgl_bergabung;

                    // Tampilkan modal
                    var editModal = new bootstrap.Modal(document.getElementById('editKaryawanModal'));
                    editModal.show();
                });
            });
            </script>
        </body>
    </html>