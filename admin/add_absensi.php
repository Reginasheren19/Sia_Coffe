<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Menyimpan data absensi ke database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_transaksi_karyawan = mysqli_real_escape_string($koneksi, $_POST['id__transaksikaryawan']);
    $waktu_masuk = mysqli_real_escape_string($koneksi, $_POST['waktu_masuk']);
    $waktu_keluar = mysqli_real_escape_string($koneksi, $_POST['waktu_keluar']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $tanggal = date('Y-m-d'); // Tanggal hari ini

    // Insert absensi ke tabel absensi
    $sql = "INSERT INTO absensi (id_transaksi_karyawan, waktu_masuk, waktu_keluar, status, tanggal) 
            VALUES ('$id__transaksi_karyawan', '$waktu_masuk', '$waktu_keluar', '$status', '$tanggal')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data absensi berhasil ditambahkan!'); window.location.href='absensi.php';</script>";
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
    <title>Master Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Karyawan</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addKaryawanModal">Add Data</button>

    <!-- Tabel Data Absensi Karyawan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Absensi</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data_absensi">
                <?php
                // Query data absensi dari database
                $result = mysqli_query($koneksi, "SELECT a.id_absensi, a.id_transaksi_karyawan, a.tanggal, a.waktu_masuk, a.waktu_keluar, a.status FROM absensi a");

                // Check if the query was successful
                if (!$result) {
                    die("Query failed: " . mysqli_error($koneksi));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_absensi']}</td>
                        <td>{$row['id_transaksi_karyawan']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['waktu_masuk']}</td>
                        <td>{$row['waktu_keluar']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <button class='btn btn-primary btn-sm btn-update'>Update</button>
                            <a href='delete_absensi.php?id={$row['id_absensi']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this attendance record?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<!-- Modal Tambah Absensi -->
<div class="modal fade" id="addAbsensiModal" tabindex="-1" aria-labelledby="addAbsensiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add_absensi.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAbsensiModalLabel">Tambah Absensi Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- ID Karyawan -->
                    <div class="mb-3">
                        <label for="id_karyawan" class="form-label">Pilih Karyawan</label>
                        <select class="form-select" id="id_karyawan" name="id_karyawan" required>
                            <option value="">Pilih Karyawan</option>
                            <?php
                            // Query untuk mendapatkan NIK, nama_karyawan, dan ID Transaksi Karyawan
                            $query = "SELECT id_transaksi_karyawan, NIK, nama_karyawan FROM master_karyawan";
                            $result = mysqli_query($koneksi, $query);

                            // Menampilkan opsi karyawan dalam dropdown
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id_transaksi_karyawan']}'>NIK: {$row['NIK']} - {$row['nama_karyawan']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- Tombol Absen Masuk -->
                    <button type="submit" name="absen_masuk" class="btn btn-success">Absen Masuk</button>

                    <!-- Tombol Absen Keluar -->
                    <button type="submit" name="absen_keluar" class="btn btn-warning">Absen Keluar</button>

                    <!-- Tombol Batal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
