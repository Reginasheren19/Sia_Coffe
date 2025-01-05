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
    $id_transaksi_pemesanan = mysqli_real_escape_string($koneksi, $_POST['id_transaksi_pemesanan']);
    $tgl_pembayaran = mysqli_real_escape_string($koneksi, $_POST['tgl_pembayaran']);
    $jumlah_pembayaran = (float)$_POST['jumlah_pembayaran'];
    $id_metode = mysqli_real_escape_string($koneksi, $_POST['id_metode']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);

 // Query untuk menyimpan data ke tabel transaksi_pembayaran
    $sql = "INSERT INTO transaksi_pembayaran (
                id_transaksi_pemesanan, 
                tgl_pembayaran, 
                jumlah_pembayaran, 
                id_metode, 
                status, 
                id_akun
            ) VALUES (
                '$id_transaksi_pemesanan', 
                '$tgl_pembayaran', 
                '$jumlah_pembayaran', 
                '$id_metode', 
                '$status', 
                '$id_akun'
            )";    
            // Eksekusi query
            if (mysqli_query($koneksi, $sql)) {
                echo "<script>alert('Data pembayaran berhasil ditambahkan!'); window.location.href='transaksi_pembayaran.php';</script>";
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
    <title>Transaksi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Transaksi Pembayaran</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTransaksiPembayaranModal">Add Datta</button>

            <!-- Modal untuk menambah transaksi pembayaran-->
            <div class="modal fade" id="addTransaksiPembayaranModal" tabindex="-1" aria-labelledby="addTransaksiPembayaranModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTransaksiPembayaranModalLabel">Tambah Transaksi Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan transaksi pembayaran -->
                            <form action="add_transaksi_pembayaran.php" method="POST">
                                <div class="form-group">
                                    <label for="id_transaksi_pemesanan">ID Transaksi Pemesanan:</label>
                                    <select name="id_transaksi_pemesanan" id="id_transaksi_pemesanan" class="form-control" required>
                                        <option value="" selected disabled>Pilih ID Pemesanan</option>
                                        <?php
                                        // Query untuk mendapatkan data transaksi pemesanan
                                        $pemesanan_result = mysqli_query($koneksi, "SELECT id_transaksi_pemesanan, total_pemesanan FROM transaksi_pemesanan");
                                        while ($pemesanan = mysqli_fetch_assoc($pemesanan_result)) {
                                            echo "<option value='{$pemesanan['id_transaksi_pemesanan']}' data-total='{$pemesanan['total_pemesanan']}'>
                                                {$pemesanan['id_transaksi_pemesanan']}
                                            </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pembayaran">Tanggal Pembayaran:</label>
                                    <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_pembayaran">Jumlah Pembayaran:</label>
                                    <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="id_metode">Metode Pembayaran:</label>
                                    <select name="id_metode" id="id_metode" class="form-control" required>
                                        <?php
                                        // Query untuk mendapatkan data metode pembayaran
                                        $metode_result = mysqli_query($koneksi, "SELECT id_metode, nama_metode FROM master_metode_pembayaran");
                                        while ($metode = mysqli_fetch_assoc($metode_result)) {
                                            echo "<option value='{$metode['id_metode']}'>{$metode['nama_metode']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status Pembayaran:</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_akun">Nama Akun:</label>
                                    <select name="id_akun" id="id_akun" class="form-control" required>
                                        <?php
                                        // Query untuk mendapatkan data akun
                                        $akun_result = mysqli_query($koneksi, "SELECT id_akun, nama_akun FROM master_akun");
                                        while ($akun = mysqli_fetch_assoc($akun_result)) {
                                            echo "<option value='{$akun['id_akun']}'>{$akun['nama_akun']}</option>";
                                        }
                                        ?>
                                    </select>
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
                document.addEventListener('DOMContentLoaded', function () {
                    const idTransaksiPemesananSelect = document.getElementById('id_transaksi_pemesanan');
                    const jumlahPembayaranInput = document.getElementById('jumlah_pembayaran');

                    idTransaksiPemesananSelect.addEventListener('change', function () {
                        const selectedOption = this.options[this.selectedIndex];
                        const totalPemesanan = selectedOption.getAttribute('data-total');

                        if (totalPemesanan) {
                            jumlahPembayaranInput.value = totalPemesanan; // Isi otomatis jumlah pembayaran
                        } else {
                            jumlahPembayaranInput.value = ''; // Kosongkan jika tidak ada data
                        }
                    });
                });
            </script>
</body>
</html>


