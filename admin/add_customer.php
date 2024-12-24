<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_customer = mysqli_real_escape_string($koneksi, $_POST['id_customer']);
    $nama_customer = mysqli_real_escape_string($koneksi, $_POST['nama_customer']);
    $alamat_customer = mysqli_real_escape_string($koneksi, $_POST['alamat_customer']);
    $tlp_customer = mysqli_real_escape_string($koneksi, $_POST['tlp_customer']);
    $saldo_piutang = mysqli_real_escape_string($koneksi, $_POST['saldo_piutang']);

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO master_customer (id_customer, nama_customer, alamat_customer, tlp_customer, saldo_piutang) 
            VALUES ('$id_customer', '$nama_customer', '$alamat_customer', '$tlp_customer', '$saldo_piutang')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='master_customer.php';</script>";
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
    <h1 class="mb-4">Master Data Customer</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Add Data</button>

    <!-- Tabel Data Karyawan -->
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
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM master_customer");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id_customer']}</td>
                            <td>{$row['nama_customer']}</td>
                            <td>{$row['alamat_customer']}</td>
                            <td>{$row['tlp_customer']}</td>
                            <td>{$row['saldo_piutang']}</td>
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
            <form method="POST" action="add_customer.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalLabel">Tambah Data Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_customer" class="form-label">Id Customer</label>
                        <input type="text" class="form-control" id="id_customer" name="id_customer" required>
                    </div>
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
