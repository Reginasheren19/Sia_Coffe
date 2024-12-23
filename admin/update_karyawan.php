<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Cek apakah NIK ada di POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NIK = mysqli_real_escape_string($koneksi, $_POST['NIK']);
    $nama_karyawan = mysqli_real_escape_string($koneksi, $_POST['nama_karyawan']);
    $alamat_karyawan = mysqli_real_escape_string($koneksi, $_POST['alamat_karyawan']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $tgl_bergabung = mysqli_real_escape_string($koneksi, $_POST['tgl_bergabung']);

    // Query untuk memperbarui data ke database
    $sql = "UPDATE master_karyawan SET 
            nama_karyawan='$nama_karyawan', 
            alamat_karyawan='$alamat_karyawan', 
            tgl_lahir='$tgl_lahir', 
            jenis_kelamin='$jenis_kelamin', 
            no_telp='$no_telp', 
            email='$email', 
            tgl_bergabung='$tgl_bergabung' 
            WHERE NIK='$NIK'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_karyawan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_karyawan.php';</script>";
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
    <h1 class="mb-4">Edit Data Karyawan</h1>
<!-- Modal Edit Data Karyawan -->
    <div class="modal fade" id="editKaryawanModal" tabindex="-1" aria-labelledby="editKaryawanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="update_karyawan.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKaryawanModalLabel">Edit Data Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <input type="hidden" name="NIK" id="editNIK">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="editNama" name="nama_karyawan" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAlamat" class="form-label">Alamat Karyawan</label>
                            <textarea class="form-control" id="editAlamat" name="alamat_karyawan" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editTglLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="editTglLahir" name="tgl_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="editJenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="editJenisKelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editNoTelp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="editNoTelp" name="no_telp" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTglBergabung" class="form-label">Tanggal Bergabung</label>
                            <input type="date" class="form-control" id="editTglBergabung" name="tgl_bergabung" required>
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
