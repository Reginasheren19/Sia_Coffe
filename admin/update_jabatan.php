<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Cek apakah ID Jabatan ada di POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jabatan = mysqli_real_escape_string($koneksi, $_POST['id_jabatan']);
    $nama_jabatan = mysqli_real_escape_string($koneksi, $_POST['nama_jabatan']);
    $gaji_pokok = mysqli_real_escape_string($koneksi, $_POST['gaji_pokok']);
    $tunjangan = mysqli_real_escape_string($koneksi, $_POST['tunjangan']);
    $upah_lembur = mysqli_real_escape_string($koneksi, $_POST['upah_lembur']);
    $potongan = mysqli_real_escape_string($koneksi, $_POST['potongan']);
    $jam_kerja = mysqli_real_escape_string($koneksi, $_POST['jam_kerja']);

    // Query untuk memperbarui data jabatan ke database
    $sql = "UPDATE master_jabatan SET 
            nama_jabatan='$nama_jabatan', 
            gaji_pokok='$gaji_pokok', 
            tunjangan='$tunjangan', 
            upah_lembur='$upah_lembur', 
            potongan='$potongan', 
            jam_kerja='$jam_kerja' 
            WHERE id_jabatan='$id_jabatan'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_jabatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_jabatan.php';</script>";
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
    <h1 class="mb-4">Master Data Jabatan</h1>
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
                        <label for="editGajiPokok" class="form-label">G aji Pokok</label>
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
</body>
</html>
