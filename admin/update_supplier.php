<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Cek apakah NIK ada di POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);
    $nama_supplier = mysqli_real_escape_string($koneksi, $_POST['nama_supplier']);
    $alamat_supplier = mysqli_real_escape_string($koneksi, $_POST['alamat_supplier']);
    $no_telp_supplier = mysqli_real_escape_string($koneksi, $_POST['no_telp_supplier']);
    $email_supplier = mysqli_real_escape_string($koneksi, $_POST['email_supplier']);

    // Query untuk memperbarui data ke database
    $sql = "UPDATE master_supplier SET 
            nama_supplier='$nama_supplier', 
            alamat_supplier='$alamat_supplier', 
            no_telp_supplier='$no_telp_suplier', 
            email_supplier='$email_supplier', 
            WHERE id_supplier='$id_supplier'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_supplier.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_supplier.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Edit Data Supplier</h1>
<!-- Modal Edit Data Supplier -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="update_supplier.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSupplierModalLabel">Edit Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_supplier" id="edit_id_supplier">
                    <div class="mb-3">
                        <label for="editNamaSupplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="editNamaSupplier" name="nama_supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAlamatSupplier" class="form-label">Alamat Supplier</label>
                        <textarea class="form-control" id="editAlamatSupplier" name="alamat_supplier" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editNoTelpSupplier" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="editNoTelpSupplier" name="no_telp_supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmailSupplier" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmailSupplier" name="email_supplier" required>
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
