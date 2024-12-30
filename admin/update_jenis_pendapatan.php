<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Cek apakah request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_POST['id_jenis_pendapatan']);
    $nama_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_POST['nama_jenis_pendapatan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Query untuk memperbarui data ke database
    $sql = "UPDATE master_jenis_pendapatan SET 
            nama_jenis_pendapatan = '$nama_jenis_pendapatan',
            deskripsi = '$deskripsi'
            WHERE id_jenis_pendapatan = '$id_jenis_pendapatan'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_jenis_pendapatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_jenis_pendapatan.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Jenis Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Jenis Pendapatan</h1>

<!-- Modal Edit Data Jenis Pendapatan -->
<div class="modal fade" id="editJenisPendapatanModal" tabindex="-1" aria-labelledby="editJenisPendapatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="update_jenis_pendapatan.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJenisPendapatanLabel">Edit Data Jenis Pendapatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Input untuk ID Produk -->
                    <input type="hidden" name="id_jenis_pendapatan" id="editIdJenisPendapatan">
                    
                    <div class="mb-3">
                        <label for="editNamaJenisPendapatan" class="form-label">Nama Jenis Pendapatan</label>
                        <input type="text" class="form-control" id="editNamaJenisPendapatan" name="nama_jenis_pendapatan" required>
                    </div>

                    <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
