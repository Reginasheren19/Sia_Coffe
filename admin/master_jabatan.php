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
        <title>Jabatan - SIA COFFE SHOP</title>
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
                    <h1 class="mt-4">Master Data Jabatan</h1>
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
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addJabatanModal">
                                    Add Data
                                </button>
                            </div>

                            <!-- Tabel Data Jabatan -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Jabatan</th>
                                            <th>Nama Jabatan</th>
                                            <th>Gaji Pokok</th>
                                            <th>Tunjangan</th>
                                            <th>Upah Lembur</th>
                                            <th>Potongan</th>
                                            <th>Jam Kerja</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_jabatan">
                                        <?php
                                        // Query data jabatan dari database
                                        $result = mysqli_query($koneksi, "SELECT * FROM master_jabatan");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$row['id_jabatan']}</td>
                                                <td>{$row['nama_jabatan']}</td>
                                                <td>{$row['gaji_pokok']}</td>
                                                <td>{$row['tunjangan']}</td>
                                                <td>{$row['upah_lembur']}</td>
                                                <td>{$row['potongan']}</td>
                                                <td>{$row['jam_kerja']}</td>
                                                <td>
                                                    <button class='btn btn-primary btn-sm btn-update'>Update</button>
                                                    <a href='delete_jabatan.php?id_jabatan={$row['id_jabatan']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this jabatan?')\">Delete</a>
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

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="addJabatanModal" tabindex="-1" aria-labelledby="addJabatanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="add_jabatan.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addJabatanModalLabel">Tambah Data Jabatan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                    <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tunjangan" class="form-label">Tunjangan</label>
                                    <input type="number" class="form-control" id="tunjangan" name="tunjangan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="upah_lembur" class="form-label">Upah Lembur</label>
                                    <input type="number" class="form-control" id="upah_lembur" name="upah_lembur" required>
                                </div>
                                <div class="mb-3">
                                    <label for="potongan" class="form-label">Potongan</label>
                                    <input type="number" class="form-control" id="potongan" name="potongan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_kerja" class="form-label">Jam Kerja</label>
                                    <input type="number" class="form-control" id="jam_kerja" name="jam_ kerja" required>
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

            <!-- Modal Edit Data Jabatan -->
            <div class="modal fade" id="editJabatanModal" tabindex="-1" aria-labelledby="editJabatanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="update_jabatan.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editJabatanModalLabel">Edit Data Jabatan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_jabatan" id="editIdJabatan">
                                <div class="mb-3">
                                    <label for="editNamaJabatan" class="form-label">Nama Jabatan</label>
                                    <input type="text" class="form-control" id="editNamaJabatan" name="nama_jabatan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editGajiPokok" class="form-label">Gaji Pokok</label>
                                    <input type="number" class="form-control" id="editGajiPokok" name="gaji_pokok" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editTunjangan" class="form-label">Tunjangan</label>
                                    <input type="number" class="form-control" id="editTunjangan" name="tunjangan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editUpahLembur" class="form-label">Upah Lembur</label>
                                    <input type="number" class="form-control" id="editUpahLembur" name="upah_lembur" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editPotongan" class="form-label">Potongan</label>
                                    <input type="number" class="form-control" id="editPotongan" name="potongan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editJamKerja" class="form-label">Jam Kerja</label>
                                    <input type="number" class="form-control" id="editJamKerja" name="jam_kerja" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update</button>
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
                    const id_jabatan = row.cells[0].innerText;
                    const nama_jabatan = row.cells[1].innerText;
                    const gaji_pokok = row.cells[2].innerText;
                    const tunjangan = row.cells[3].innerText;
                    const upah_lembur = row.cells[4].innerText;
                    const potongan = row.cells[5].innerText;
                    const jam_kerja = row.cells[6].innerText;

                    // Isi modal dengan data yang diambil
                    document.getElementById('editIdJabatan').value = id_jabatan;
                    document.getElementById('editNamaJabatan').value = nama_jabatan;
                    document.getElementById('editGajiPokok').value = gaji_pokok;
                    document.getElementById('editTunjangan').value = tunjangan;
                    document.getElementById('editUpahLembur').value = upah_lembur;
                    document.getElementById('editPotongan').value = potongan;
                    document.getElementById('editJamKerja').value = jam_kerja;

                    // Tampilkan modal
                    var editModal = new bootstrap.Modal(document.getElementById('editJabatanModal'));
                    editModal.show();
                });
            });
            </script>
        </body>
    </html>