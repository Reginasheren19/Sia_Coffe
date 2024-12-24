<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Cek apakah NIK ada di POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_divisi = mysqli_real_escape_string($koneksi, $_POST['id_divisi']);
    $nama_divisi = mysqli_real_escape_string($koneksi, $_POST['nama_divisi']);
    $deskripsi_divisi = mysqli_real_escape_string($koneksi, $_POST['deskripsi_divisi']);


    // Query untuk memperbarui data ke database
    $sql = "UPDATE master_divisi SET 
            nama_divisi='$nama_divisi', 
            deskripsi_divisi='$deskripsi_divisi'
            WHERE id_divisi='$id_divisi'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_divisi.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_divisi.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Edit Data Divisi</h1>
<!-- Modal Edit Data Divisi -->
    <div class="modal fade" id="editDivisiModal" tabindex="-1" aria-labelledby="editDivisiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="update_divisi.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDivisiModalLabel">Edit Data Divisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_divisi" id="editiddivisi">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Divisi</label>
                            <input type="text" class="form-control" id="editNama" name="nama_divisi" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDeskripsi" class="form-label">Deskripsi Divisi</label>
                            <textarea class="form-control" id="editDeskripsi" name="deskripsi_divisi" rows="3" required></textarea>
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
</div>
</body>
</html>
