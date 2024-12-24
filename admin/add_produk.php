<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include koneksi ke database
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $kategori_produk = mysqli_real_escape_string($koneksi, $_POST['kategori_produk']);
    $no_telp_supplier = mysqli_real_escape_string($koneksi, $_POST['no_telp_supplier']);
    $email_supplier = mysqli_real_escape_string($koneksi, $_POST['email_supplier']);

    // Query untuk menyimpan data ke database tanpa saldo_hutang
    $sql = "INSERT INTO master_supplier (nama_supplier, alamat_supplier, no_telp_supplier, email_supplier) 
            VALUES ('$nama_supplier', '$alamat_supplier', '$no_telp_supplier', '$email_supplier')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='master_supplier.php';</script>";
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
    <title>Master Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Supplier</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSupplierModal">Add Data</button>

    <!-- Tabel Data Supplier -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Supplier</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Email</th>
                    <th>Saldo Hutang</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM master_supplier");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id_supplier']}</td>
                            <td>{$row['nama_supplier']}</td>
                            <td>{$row['alamat_supplier']}</td>
                            <td>{$row['no_telp_supplier']}</td>
                            <td>{$row['email_supplier']}</td>
                            <td>{$row['saldo_hutang']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalLabel">Tambah Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
                        <textarea class="form-control" id="alamat_supplier" name="alamat_supplier" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp_supplier" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp_supplier" name="no_telp_supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_supplier" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_supplier" name="email_supplier" required>
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
