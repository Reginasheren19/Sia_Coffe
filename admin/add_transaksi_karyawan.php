<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NIK = mysqli_real_escape_string($koneksi, $_POST['NIK']);
    $id_jabatan = mysqli_real_escape_string($koneksi, $_POST['id_jabatan']);
    $id_divisi = mysqli_real_escape_string($koneksi, $_POST['id_divisi']);
    $status_karyawan = mysqli_real_escape_string($koneksi, $_POST['status_karyawan']);

    // Query untuk menyimpan data ke tabel transaksi_karyawan
    $sql = "INSERT INTO transaksi_karyawan (NIK, id_jabatan, id_divisi, status_karyawan) 
            VALUES ('$NIK', '$id_jabatan', '$id_divisi', '$status_karyawan')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='transaksi_karyawan.php';</script>";
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
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTransaksiKaryawanModal">Add Data</button>

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
                        <select class="form-select" id="NIK" name="NIK" required onchange="updateKaryawanInfo()">
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
                        <select class="form-select" id="id_jabatan" name="id_jabatan" required onchange="updateJabatanInfo()">
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
                        <select class="form-select" id="id_divisi" name="id_divisi" required onchange="updateDivisiInfo()">
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
</body>
</html>
