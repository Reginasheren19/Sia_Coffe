<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Cek apakah NIK ada di POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_customer = mysqli_real_escape_string($koneksi, $_POST['id_customer']);
    $nama_customer = mysqli_real_escape_string($koneksi, $_POST['nama_customer']);
    $alamat_customer = mysqli_real_escape_string($koneksi, $_POST['alamat_customer']);
    $telp_customer = mysqli_real_escape_string($koneksi, $_POST['telp_customer']);
    $saldo_piutang = mysqli_real_escape_string($koneksi, $_POST['saldo_piutang']);


    // Query untuk memperbarui data ke database
    $sql = "UPDATE master_customer SET 
            nama_customer='$nama_customer',
            alamat_customer='$alamat_customer', 
            telp_customer='$telp_customer',
            saldo_piutang='$saldo_piutang',
            WHERE id_customer='$id_customer'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_customer.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_customer.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Edit Data Customer</h1>
    <!-- Modal Edit Data customer -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="update_customer.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCustomerModalLabel">Edit Data Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_customer" id="edit_id_customer">
                                <div class="mb-3">
                                    <label for="editNamaCustomer" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="editNamaCustomer" name="nama_customer" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editAlamatCustomer" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="editAlamatCustomer" name="alamat_customer" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edirTelpCustomer" class="form-label">No Telepon</label>
                                    <input type="text" class="form-control" id="editTelpCustomer" name="telp_customer" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editSaldoPiutang" class="form-label">Saldo</label>
                                    <input type="text" class="form-control" id="editSaldoPiutang" name="saldo_piutang" required>
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
