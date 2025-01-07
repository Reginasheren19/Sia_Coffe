<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $tanggal_transaksi = mysqli_real_escape_string($koneksi, $_POST['tanggal_transaksi']);
    $id_customer = mysqli_real_escape_string($koneksi, $_POST['id_customer']);
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $jumlah_produk = (int)$_POST['jumlah_produk'];
    $harga_satuan = (int)$_POST['harga_satuan'];
    $subtotal = $jumlah_produk * $harga_satuan;
    $id_metode = mysqli_real_escape_string($koneksi, $_POST['id_metode']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $jenis_pendapatan = mysqli_real_escape_string($koneksi, $_POST['jenis_pendapatan']);

    // Query untuk menyimpan data transaksi
    $query_insert = "
        INSERT INTO transaksi_pendapatan
        (tgl_transaksi, id_customer, id_produk, jumlah_produk, harga_satuan, subtotal, id_metode, id_akun, jenis_pendapatan)
        VALUES 
        ('$tanggal_transaksi', '$id_customer', '$id_produk', '$jumlah_produk', '$harga_satuan', '$subtotal', '$id_metode', '$id_akun', '$jenis_pendapatan');
    ";

    if (mysqli_query($koneksi, $query_insert)) {
        echo "Data transaksi berhasil disimpan.";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
<h1 class="mt-4">Transaksi Pendapatan</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tabel Transaksi Pendapatan
    </div>
    <div class="card-body">
        <!-- Tombol Tambah Data -->
        <div class="mb-3 d-flex justify-content-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransaksiPendapatanModal">
                Add Data
            </button>
        </div>

        <!-- Tabel Data Transaksi Pendapatan -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id Transaksi Pendapatan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Customer</th>
                        <th>Nama Produk</th>
                        <th>Kuantitas</th>
                        <th>Harga Satuan</th>
                        <th>Total Pendapatan</th>
                        <th>Metode Pembayaran</th>
                        <th>Nama Akun</th>
                        <th>Jenis Pendapatan</th>
                    </tr>
                </thead>
                <tbody id="data_transaksi_pendapatan">
                    <?php
                    // Query to fetch transaction data with related details 
                    $result = mysqli_query($koneksi,"
                        SELECT tp.id_transaksi,
                            c.nama_customer,
                            tp.tgl_transaksi,
                            mp.nama_metode AS nama_metode_pembayaran,
                            p.nama_produk,
                            tp.jumlah_produk,
                            tp.harga_satuan,
                            tp.subtotal,
                            ma.nama_akun,
                            tp.jenis_pendapatan
                        FROM transaksi_pendapatan tp
                        JOIN master_customer c ON tp.id_customer = c.id_customer
                        JOIN master_metode_pembayaran mp ON tp.id_metode = mp.id_metode
                        JOIN master_produk p ON tp.id_produk = p.id_produk
                        JOIN master_akun ma ON tp.id_akun = ma.id_akun;
                    ");
                    
                    //Display transaction data
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['id_transaksi']}</td>
                            <td>{$row['nama_customer']}</td>
                            <td>" . date('d-m-Y', strtotime($row['tgl_transaksi'])) . "</td>
                            <td>{$row['nama_metode_pembayaran']}</td>
                            <td>{$row['nama_produk']}</td>
                            <td>{$row['jumlah_produk']}</td>
                            <td>" . number_format($row['harga_satuan'], 0, ',', '.') . "</td>
                            <td>" . number_format($row['subtotal'], 0, ',', '.') . "</td>
                            <td>{$row['nama_akun']}</td>
                            <td>{$row['jenis_pendapatan']}</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Transaksi Pendapatan -->
        <div class="modal fade" id="addTransaksiPendapatanModal" tabindex="-1" aria-labelledby="addTransaksiPendapatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="add_transaksi_pendapatan.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTransaksiPendapatanModalLabel">Tambah Transaksi Pendapatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Nama Customer -->
                            <div class="mb-3">
                                <label for="id_customer" class="form-label">Nama Customer</label>
                                <select class="form-select" id="id_customer" name="id_customer" required>
                                    <option value="">Pilih Customer</option>
                                    <?php
                                    $customers = mysqli_query($koneksi, "SELECT id_customer, nama_customer FROM master_customer");
                                    while ($customer = mysqli_fetch_assoc($customers)) {
                                        echo "<option value='{$customer['id_customer']}'>{$customer['nama_customer']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Metode Pembayaran -->
                            <div class="mb-3">
                                <label for="id_metode" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="id_metode" name="id_metode" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php
                                    $paymentMethods = mysqli_query($koneksi, "SELECT id_metode, nama_metode_pembayaran FROM master_metode_pembayaran");
                                    while ($method = mysqli_fetch_assoc($paymentMethods)) {
                                        echo "<option value='{$method['id_metode']}'>{$method['nama_metode_pembayaran']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Tanggal Transaksi -->
                            <div class="mb-3">
                                <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                            </div>
                            <!-- Nama Produk -->
                            <div class="mb-3">
                                <label for="id_produk" class="form-label">Nama Produk</label>
                                <select class="form-select" id="id_produk" name="id_produk" required>
                                    <option value="">Pilih Produk</option>
                                    <?php
                                    $products = mysqli_query($koneksi, "SELECT id_produk, nama_produk FROM master_produk");
                                    while ($product = mysqli_fetch_assoc($products)) {
                                        echo "<option value='{$product['id_produk']}'>{$product['nama_produk']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Jumlah Produk -->
                            <div class="mb-3">
                                <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                                <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" required>
                            </div>
                            <!-- Harga Satuan -->
                            <div class="mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
                            </div>
                            <!-- Subtotal -->
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
    </div>

    <script>
        // Menghitung subtotal otomatis
        $('#jumlah_produk, #harga_satuan').on('input', function() {
            const jumlahProduk = parseInt($('#jumlah_produk').val()) || 0;
            const hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
            const subtotal = jumlahProduk * hargaSatuan;
            $('#subtotal').val(subtotal.toFixed(0));
        });
    </script>
</div>
