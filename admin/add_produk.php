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
    $harga_satuan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    
    $sql = "INSERT INTO master_produk (nama_produk, kategori_produk, harga_satuan, satuan) 
            VALUES ('$nama_produk', '$kategori_produk', '$harga_satuan', '$satuan')";

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
    <h1 class="mb-4">Master Data Produk</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProdukModal">Add Data</button>

    <!-- Tabel Data Supplier -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori Produk</th>
                    <th>Harga Satuan</th>
                    <th>Satuan</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM master_produk");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id_produk']}</td>
                            <td>{$row['nama_produk']}</td>
                            <td>{$row['kategori_produk']}</td>
                            <td>{$row['harga_satuan']}</td>
                            <td>{$row['satuan']}</td>
                            <td>{$row['deskripsi']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addProdukModal" tabindex="-1" aria-labelledby="addProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProdukModalLabel">Tambah Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_produk" class="form-label">Kategori Produk</label>
                        <textarea class="form-control" id="kategori_produk" name="kategori_produk" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Produk</label>
                        <input type="text" class="form-control" id="harga_produk" name="harga_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="satuan" class="form-control" id="satuan" name="satuan" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="deskripsi" class="form-control" id="deskripsi" name="deskripsi" required>
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
