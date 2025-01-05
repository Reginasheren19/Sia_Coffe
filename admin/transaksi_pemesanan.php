<?php
include("../config/koneksi_mysql.php");

$sql = mysqli_query($koneksi,"SELECT * FROM transaksi_pemesanan");

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
                    <h1 class="mt-4">Transaksi Pemesanan</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Transaksi Pemesanan
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah Data -->
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransaksiPemesananModal">
                                    Add Data
                                </button>
                            </div>

                            <!-- Tabel Data Transaksi Pemesanan -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Transaksi Pemesanan</th>
                                            <th>Nama Customer</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Nama produk</th>
                                            <th>Jumlah Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_transaksi_pemesanan">
                                        <?php
                                    // Query to fetch transaction data with related details (customer, payment method, account, product)
                                    $result = mysqli_query($koneksi,"
                                        SELECT tp.id_transaksi_pemesanan,
                                            c.nama_customer,
                                            tp.tgl_transaksi,
                                            mp.nama_metode,
                                            p.nama_produk,
                                            tp.jumlah_produk,
                                            tp.harga_satuan,
                                            tp.subtotal
                                        FROM transaksi_pemesanan tp
                                        JOIN master_customer c ON tp.id_customer = c.id_customer
                                        JOIN master_metode_pembayaran mp ON tp.id_metode = mp.id_metode
                                        JOIN master_produk p ON tp.id_produk = p.id_produk
                                    ");

                                    //Display transaction data

                                       while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$row['id_transaksi_pemesanan']}</td>
                                                <td>{$row['nama_customer']}</td>
                                                <td>" . date('d-m-Y', strtotime($row['tgl_transaksi'])) . "</td>
                                                <td>{$row['nama_metode_pembayaran']}</td>
                                                <td>{$row['nama_produk']}</td>
                                                <td>{$row['jumlah_produk']}</td>
                                                <td>" . number_format($row['harga_satuan'], 0, ',', '.') . "</td>
                                                <td>" . number_format($row['subtotal'], 0, ',', '.') . "</td>
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
                                <title>Transaksi Pemesanan</title>
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            </head>
                            <body>


                            <!-- Modal for Adding Transaksi Pemesanan -->
                            <div class="modal fade" id="addTransaksiPemesananModal" tabindex="-1" aria-labelledby="addTransaksiPemesananModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="add_transaksi_pemesanan.php">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addTransaksiPemesananModalLabel">Tambah Transaksi Pemesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                                <div class="mb-3">
                                                    <label for="nama_customer" class="form-label">Nama Customer</label>
                                                    <select class="form-select" id="id_customer" name="id_customer" required>
                                                        <option value="">Pilih Customer</option>
                                                        <?php
                                                        // Fetch customer data from the database
                                                        $customers = mysqli_query($koneksi, "SELECT id_customer, nama_customer FROM customer");
                                                        while ($customer = mysqli_fetch_assoc($customers)) {
                                                            echo "<option value='{$customer['id_customer']}'>{$customer['nama_customer']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="id_metode" class="form-label">Metode Pembayaran</label>
                                                        <select class="form-select" id="id_metode" name="id_metode" required>
                                                            <option value="">Pilih Metode Pembayaran</option>
                                                            <?php
                                                            $paymentMethods = mysqli_query($koneksi, "SELECT id_metode, nama_metode_pembayaran FROM master_smetode_pembayaran");
                                                            while ($method = mysqli_fetch_assoc($paymentMethods)) {
                                                                echo "<option value='{$method['id_metode']}'>{$method['nama_metode_pembayaran']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                    <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                                                    <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_produk" class="form-label">Nama Produk</label>
                                                    <select class="form-select" id="id_produk" name="id_produk" required>
                                                        <option value="">Pilih Produk</option>
                                                        <?php
                                                        $products = mysqli_query($koneksi, "SELECT id_produk, nama_produk FROM produk");
                                                        while ($product = mysqli_fetch_assoc($products)) {
                                                            echo "<option value='{$product['id_produk']}'>{$product['nama_produk']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                                                    <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="subtotal" class="form-label">Subtotal</label>
                                                    <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
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
                            // Mengisi subtotal otomatis berdasarkan jumlah produk dan harga satuan
                            $('#jumlah_produk, #harga_satuan').on('input', function() {
                                const jumlahProduk = parseInt($('#jumlah_produk').val()) || 0;
                                const hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
                                const subtotal = jumlahProduk * hargaSatuan;

                                // Menampilkan subtotal di kolom yang sesuai
                                $('#subtotal').val(subtotal.toFixed(0)); // Format angka tanpa desimal
                            });
                        </script>
                    </div>
                            <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Transaksi Pemesanan</title>
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            </head>
                            <body>

                        </div>
                    </div>
                </div>
            </main>

            </script>
        </body>
    </html>