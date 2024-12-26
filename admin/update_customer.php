<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include koneksi ke database
include("../config/koneksi_mysql.php");

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari POST
    $id_customer = mysqli_real_escape_string($koneksi, $_POST['id_customer']);
    $nama_customer = mysqli_real_escape_string($koneksi, $_POST['nama_custoomer']);
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
    <title>Master Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Customer</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Add Data</button>

    <!-- Tabel Data Customer -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Customer</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Saldo Piutang</th>
                </tr>
            </thead>
            <tbody id="data_customer">
                <?php
                // Query data supplier dari database
                $result = mysqli_query($koneksi, "SELECT * FROM master_customer");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_customer']}</td>
                        <td>{$row['nama_customer']}</td>
                        <td>{$row['alamat_customer']}</td>
                        <td>{$row['telp_customer']}</td>
                        <td>{$row['saldo_customer']}</td>
                        <td>
                            <button class='btn btn-primary btn-sm btn-update'>Update</button>
                            <a href='delete_customer.php?id_customer={$row['id_customer']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this data?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="form_add_customer">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCustomerModalLabel">Tambah Data Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_customer" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_customer" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat_customer" name="alamat_customer" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="tlp_customer" class="form-label">No Telepon</label>
                                    <input type="text" class="form-control" id="tlp_customer" name="tlp_customer" required>
                                </div>
                                <div class="mb-3">
                                    <label for="saldo_piutang" class="form-label">Saldo Piutang</label>
                                    <input type="text" class="form-control" id="saldo_piutang" name="saldo_piutang" required>
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
