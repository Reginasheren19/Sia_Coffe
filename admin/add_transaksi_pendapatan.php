<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal_transaksi = mysqli_real_escape_string($koneksi, $_POST['tanggal_transaksi']);
    $id_customer = mysqli_real_escape_string($koneksi, $_POST['id_customer']);
    $nama_customer = mysqli_real_escape_string($koneksi, $_POST['nama_customer']);
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $kuantitas = mysqli_real_escape_string($koneksi, $_POST['kuantitas']);
    $harga_satuan = (int)$_POST['harga_satuan'];
    $total_pendapatan = (int)$_POST['total_pendapatan'];
    $id_metode = mysqli_real_escape_string($koneksi, $_POST['id_metode']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $id_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_POST['id_jenis_pendapatan']);
    $nama_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_POST['nama_jenis_pendapatan']);
    $NIK = mysqli_real_escape_string($koneksi, $_POST['NIK']);
    $nama_karyawan = mysqli_real_escape_string($koneksi, $_POST['nama_karyawan']);
    $status_transaksi = mysqli_real_escape_string($koneksi, $_POST['status_transaksi']);
    $catatan_transaksi = mysqli_real_escape_string($koneksi, $_POST['catatan_transaksi']);



    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO transaksi_pendapatan 
              (tanggal_transaksi, id_customer, nama_customer, id_produk, nama_produk, kuantitas, harga_satuan, total_pendapatan, id_metode, id_jenis_pendapatan, nama_jenis_pendapatan, NIK, nama_karyawan, status_transaksi, catatan_transaksi) 
              VALUES ('$tanggal_transaksi', '$id_customer', '$nama_customer', '$id_produk', '$nama_produk', '$kuantitas', '$harga_satuan', '$total_pendapatan', '$id_metode', '$id_jenis_pendapatan', '$nama_jenis_pendapatan', '$NIK', '$nama_karyawan', '$status_transaksi', '$catatan_transaksi')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='transaksi_pendapatan.php';</script>";
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
    <title>Transaksi Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Transaksi Pendapatan</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransaksiPendapatanModal">
        Add Pendapatan
    </button>

    <!-- Tabel Data Transaksi Pendapatan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Customer</th>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Total Pendapatan</th>
                    <th>Metode Pembayaran</th>
                    <th>Jenis Pendapatan</th>
                    <th>Status Transaksi</th>
                    <th>Catatan Transaksi</th>
                </tr>
            </thead>
            <tbody id="data_pendapatan">
                <?php

            // Query untuk mengambil data transaksi_pendapatan
            $result = mysqli_query($koneksi, "
                SELECT tp.id_transaksi,
                        tp.tanggal_transaksi,
                        mc.nama_customer,
                        mp.nama_produk,
                        tp.kuantitas,
                        tp.harga_satuan,
                        (tp.kuantitas * tp.harga_satuan) AS total_pendapatan,
                        mpb.nama_metode AS metode_pembayaran,
                        jp.nama_jenis_pendapatan AS jenis_pendapatan,
                        tp.status_transaksi,
                        tp.catatan_transaksi,
                                FROM transaksi_pendapatan tp
                JOIN master_customer mc ON tp.id_customer = mc.id_customer
                JOIN master_produk mp ON tp.id_produk = mp.id_produk
                JOIN master_metode_pembayaran mpb ON tp.id_metode_pembayaran = mpb.id_metode_pembayaran
                JOIN jenis_pendapatan jp ON tp.id_jenis_pendapatan = jp.id_jenis_pendapatan                                 
                ");


            // Tampilkan data transaksi Pendapatan
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['id_transaksi']}</td>
                    <td>{$row['tanggal_transaksi']}</td>
                    <td>{$row['nama_customer']}</td>
                    <td>{$row['nama_produk']}</td>
                    <td>{$row['kuantitas']}</td>
                    <td>" . number_format($row['harga_satuan'], 2) . "</td>
                    <td>" . number_format($row['total_pendapatan'], 2) . "</td>
                    <td>{$row['metode_pembayaran']}</td>
                    <td>{$row['jenis_pendapatan']}</td>
                    <td>{$row['status_transaksi']}</td>
                    <td>{$row['catatan_transaksi']}</td>

                    </tr>
                    <td>
                        <a href='delete_transaksi_pendapatan.php?transaksi={$row['id_transaksi']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this transaction?')\">Delete</a>
                    </td>
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
            <div class="mb-3">
                <label for="id_customer" class="form-label">ID Customer</label>
                <select class="form-select" id="id_customer" name="id_customer" required>
                    <?php
                    $customers = mysqli_query($koneksi, "SELECT id_customer, nama_customer FROM master_customer");
                    while ($customer = mysqli_fetch_assoc($customers)) {
                        echo "<option value='{$customer['id_customer']}'>{$customer['nama_customer']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_produk" class="form-label">ID Produk</label>
                <select class="form-select" id="id_produk" name="id_produk" required>
                    <?php
                    $products = mysqli_query($koneksi, "SELECT id_produk, nama_produk FROM master_produk");
                    while ($product = mysqli_fetch_assoc($products)) {
                        echo "<option value='{$product['id_produk']}'>{$product['nama_produk']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="kuantitas" class="form-label">Kuantitas</label>
                <input type="number" class="form-control" id="kuantitas" name="kuantitas" required>
            </div>
            <div class="mb-3">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="number" step="0.01" class="form-control" id="harga_satuan" name="harga_satuan" required>
            </div>
            <div class="mb-3">
                <label for="id_metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="id_metode_pembayaran" name="id_metode_pembayaran" required>
                    <?php
                    $methods = mysqli_query($koneksi, "SELECT id_metode_pembayaran, nama_metode FROM master_metode_pembayaran");
                    while ($method = mysqli_fetch_assoc($methods)) {
                        echo "<option value='{$method['id_metode_pembayaran']}'>{$method['nama_metode']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_jenis_pendapatan" class="form-label">Jenis Pendapatan</label>
                <select class="form-select" id="id_jenis_pendapatan" name="id_jenis_pendapatan" required>
                    <?php
                    $types = mysqli_query($koneksi, "SELECT id_jenis_pendapatan, nama_jenis_pendapatan FROM jenis_pendapatan");
                    while ($type = mysqli_fetch_assoc($types)) {
                        echo "<option value='{$type['id_jenis_pendapatan']}'>{$type['nama_jenis_pendapatan']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="status_transaksi" class="form-label">Status Transaksi</label>
                <select class="form-select" id="status_transaksi" name="status_transaksi" required>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="catatan_transaksi" class="form-label">Catatan Transaksi</label>
                <textarea class="form-control" id="catatan_transaksi" name="catatan_transaksi"></textarea>
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
</body>
</html>
