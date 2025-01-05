<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Debugging untuk melihat data yang dikirimkan dari form
echo '<pre>';
print_r($_POST);
echo '</pre>';

// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form dengan sanitasi
    $id_customer = mysqli_real_escape_string($koneksi, $_POST['id_customer']);
    $id_metode = mysqli_real_escape_string($koneksi, $_POST['id_metode']);
    $tgl_transaksi = mysqli_real_escape_string($koneksi, $_POST['tgl_transaksi']);
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $jumlah_produk = (int)$_POST['jumlah_produk']; // Menggunakan integer untuk jumlah produk
    $harga_satuan = (float)$_POST['harga_satuan']; // Menggunakan float untuk harga satuan
    $subtotal = $jumlah_produk * $harga_satuan; // Menghitung subtotal otomatis

    // Query untuk menyimpan data ke tabel transaksi_pemesanan
    $sql = "INSERT INTO transaksi_pemesanan 
            (id_customer, id_metode, id_akun, tgl_transaksi, id_produk, jumlah_produk, harga_satuan, subtotal) 
            VALUES 
            ('$id_customer', '$id_metode', '$id_akun', '$tgl_transaksi', '$id_produk', '$jumlah_produk', '$harga_satuan', '$subtotal')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data transaksi berhasil ditambahkan!'); window.location.href='transaksi_pemesanan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

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
<div class="container mt-4">
    <h1 class="mb-4">Transaksi Pengeluaran Lain</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTransaksiPemesananModal">Add Pemesanan</button>

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
                                                            $paymentMethods = mysqli_query($koneksi, "SELECT id_metode, nama_metode_pembayaran FROM metode_pembayaran");
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
</body>
</html>


