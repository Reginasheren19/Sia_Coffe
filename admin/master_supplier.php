<?php
include("../config/koneksi_mysql.php");

$sql = mysqli_query($koneksi,"SELECT * FROM master_supplier");

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
        <title>Supplier - SIA COFFE SHOP</title>
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
                    <h1 class="mt-4">Master Supplier</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data Supplier</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Supplier Data Table
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah Data -->
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                                    Add Data
                                </button>
                            </div>

                            <!-- Tabel Data Supplier -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Supplier</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_supplier">
                                        <?php
                                        // Query data supplier dari database
                                        $result = mysqli_query($koneksi, "SELECT * FROM master_supplier");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$row['id_supplier']}</td>
                                                <td>{$row['nama_supplier']}</td>
                                                <td>{$row['alamat_supplier']}</td>
                                                <td>{$row['no_telp_supplier']}</td>
                                                <td>{$row['email_supplier']}</td>
                                                <td>
                                                    <button class='btn btn-primary btn-sm btn-update'>Update</button>
                                                    <a href='delete_supplier.php?supplier={$row['id_supplier']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this data supplier?')\">Delete</a>
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
            <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="add_supplier.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSupplierModalLabel">Tambah Data Supplier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
                                    <textarea class="form-control" id="alamat_supplier" name="alamat_supplier" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp_supplier" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="no_telp_supplier" name="no_telp_supplier" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email_supplier" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email_supplier" name="email_supplier" required>
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

            <!-- Modal Edit Data Supplier -->
            <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="update_supplier.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSupplierModalLabel">Edit Data Supplier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_supplier" id="edit_id_supplier">
                                <div class="mb-3">
                                    <label for="editNamaSupplier" class="form-label">Nama Supplier</label>
                                    <input type="text" class="form-control " id="editNamaSupplier" name="nama_supplier" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editAlamatSupplier" class="form-label">Alamat Supplier</label>
                                    <textarea class="form-control" id="editAlamatSupplier" name="alamat_supplier" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editNoTelpSupplier" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="editNoTelpSupplier" name="no_telp_supplier" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editEmailSupplier" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="editEmailSupplier" name="email_supplier" required>
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
            <script>
            // Menangani klik tombol update
            document.querySelectorAll('.btn-update').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil data dari baris yang sesuai
                    const row = this.closest('tr');
                    const id_supplier = row.cells[0].innerText; // Ambil ID Supplier
                    const nama_supplier = row.cells[1].innerText;
                    const alamat_supplier = row.cells[2].innerText;
                    const no_telp_supplier = row.cells[3].innerText; // Indeks 3 untuk No Telepon
                    const email_supplier = row.cells[4].innerText; // Indeks 4 untuk Email

                    // Isi modal dengan data yang diambil
                    document.getElementById('edit_id_supplier').value = id_supplier; // Set ID Supplier
                    document.getElementById('editNamaSupplier').value = nama_supplier;
                    document.getElementById('editAlamatSupplier').value = alamat_supplier;
                    document.getElementById('editNoTelpSupplier').value = no_telp_supplier;
                    document.getElementById('editEmailSupplier').value = email_supplier;

                    // Tampilkan modal
                    var editModal = new bootstrap.Modal(document.getElementById('editSupplierModal'));
                    editModal.show();
                });
            });
            </script>
        </div>
    </div>
</body>
</html>
