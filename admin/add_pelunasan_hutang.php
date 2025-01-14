<?php
include("../config/koneksi_mysql.php");

// Query untuk mendapatkan ID transaksi terakhir
$result = mysqli_query($koneksi, "SELECT MAX(id_hutang) AS last_id FROM transaksi_hutang");
$row = mysqli_fetch_assoc($result);
$lastId = isset($row['last_id']) ? $row['last_id'] + 1 : 1; // Jika kosong, mulai dari 1

// Format no_nota
$nota_pelunasan = 'PLH-' . date('Ymd') . '-' . $lastId;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
    $nota_pelunasan = mysqli_real_escape_string($koneksi, $_POST['nota_pelunasan']);
    $tanggal_pelunasan = mysqli_real_escape_string($koneksi, $_POST['tanggal_pelunasan']);
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);
    $saldo_hutang_pl = mysqli_real_escape_string($koneksi, $_POST['saldo_hutang_pl']);
    $total_pelunasan = mysqli_real_escape_string($koneksi, $_POST['total_pelunasan']);

    // Validasi ID Transaksi
    $cekTransaksi = mysqli_query($koneksi, "SELECT id_transaksi FROM transaksi_pengeluaran WHERE id_transaksi = '$id_transaksi'");
    if (mysqli_num_rows($cekTransaksi) === 0) {
        echo "<script>alert('ID Transaksi tidak valid!'); window.location.href='pelunasan_hutang.php';</script>";
        exit;
    }

    // Periksa status transaksi sebelum update
    $checkStatus = mysqli_query($koneksi, "SELECT status FROM transaksi_pengeluaran WHERE id_transaksi = '$id_transaksi'");
    $statusRow = mysqli_fetch_assoc($checkStatus);

    if ($statusRow && $statusRow['status'] === 'Belum Lunas') {
        // Lanjutkan jika masih "Belum Lunas"
        $sql = "
            INSERT INTO transaksi_hutang (id_transaksi, nota_pelunasan, tanggal_pelunasan, id_supplier, saldo_hutang_pl, total_pelunasan)
            VALUES ('$id_transaksi', '$nota_pelunasan', '$tanggal_pelunasan', '$id_supplier', '$saldo_hutang_pl', '$total_pelunasan')
        ";

        // Eksekusi query pelunasan hutang
        if (mysqli_query($koneksi, $sql)) {
            // Update status transaksi menjadi "Lunas"
            $updateStatus = "UPDATE transaksi_pengeluaran SET status = 'Lunas' WHERE id_transaksi = '$id_transaksi'";
            if (mysqli_query($koneksi, $updateStatus)) {
                // Insert jurnal umum untuk pelunasan hutang
                // Debit Hutang (id_akun hutang) dan Kredit Kas (id_akun kas)
                $query_jurnal_debit = "
                    INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                    VALUES ('$tanggal_pelunasan', 'Hutang', '10', '$total_pelunasan', 0)
                ";

                $query_jurnal_kredit = "
                    INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                    VALUES ('$tanggal_pelunasan', 'Kas', '2', 0, '$total_pelunasan')
                ";

                // Eksekusi query jurnal umum
                if (mysqli_query($koneksi, $query_jurnal_debit) && mysqli_query($koneksi, $query_jurnal_kredit)) {
                    echo "<script>alert('Data berhasil ditambahkan dan jurnal umum tercatat!'); window.location.href='pelunasan_hutang.php';</script>";
                } else {
                    echo "<script>alert('Error mencatat jurnal umum: " . mysqli_error($koneksi) . "');</script>";
                }
            } else {
                echo "<script>alert('Error memperbarui status: " . mysqli_error($koneksi) . "');</script>";
            }
        } else {
            echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        echo "<script>alert('Transaksi sudah lunas!'); window.location.href='pelunasan_hutang.php';</script>";
    }
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
        <title>Pelunasan Hutang - SIA COFFE SHOP</title>
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
            <div class="container mt-5">
                <h1 class="mb-4">Form Pelunasan Hutang</h1>
                <form method="POST" action="add_pelunasan_hutang.php">
                    <div class="mb-3">
                        <label for="id_transaksi" class="form-label">ID Transaksi</label>
                        <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nota_pelunasan" class="form-label">Nota Pelunasan</label>
                        <input type="text" class="form-control" id="nota_pelunasan"  name="nota_pelunasan" value="<?php echo $nota_pelunasan; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pelunasan" class="form-label">Tanggal Pelunasan</label>
                        <input type="date" class="form-control" id="tanggal_pelunasan" name="tanggal_pelunasan" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Id Supplier</label>
                        <input type="text" class="form-control" id="id_supplier" name="id_supplier" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="saldo_hutang_pl" class="form-label">Saldo Hutang</label>
                        <input type="text" class="form-control" id="saldo_hutang_pl" name="saldo_hutang_pl" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="total_pelunasan" class="form-label">Total Pelunasan</label>
                        <input type="number" class="form-control" id="total_pelunasan" name="total_pelunasan" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="pelunasan_hutang.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    // Ketika dropdown id_transaksi berubah
                    $('#id_transaksi').on('change', function () {
                        let idTransaksi = $(this).val(); // Ambil nilai dari dropdown
                        if (idTransaksi !== '') {
                            // AJAX untuk mengambil data dari server
                            $.ajax({
                                url: 'get_supplier.php',
                                type: 'GET',
                                data: { id_transaksi: idTransaksi },
                                success: function (response) {
                                    let data = JSON.parse(response); // Parse response JSON
                                    
                                    if (data.id_supplier && data.nama_supplier && data.saldo_hutang_pl) {
                                        // Set nilai id_supplier dan saldo_hutang_pl
                                        $('#id_supplier').val(data.id_supplier);
                                        $('#saldo_hutang_pl').val(data.saldo_hutang_pl);
                                        
                                        // Otomatis set nilai total_pelunasan sama dengan saldo_hutang_pl
                                        $('#total_pelunasan').val(data.saldo_hutang_pl);
                                    } else {
                                        alert('ID Transaksi tidak valid!');
                                        
                                        // Kosongkan field jika data tidak valid
                                        $('#id_supplier').val('');
                                        $('#saldo_hutang_pl').val('');
                                        $('#total_pelunasan').val('');
                                    }
                                },
                                error: function () {
                                    alert('Terjadi kesalahan saat mengambil data!');
                                }
                            });
                        } else {
                            // Reset field jika tidak ada ID Transaksi yang dipilih
                            $('#id_supplier').val('');
                            $('#saldo_hutang_pl').val('');
                            $('#total_pelunasan').val('');
                        }
                    });
                });
            </script>
            </body>
            </html>
