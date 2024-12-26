<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $kategori_produk = mysqli_real_escape_string($koneksi, $_POST['kategori_produk']);
    $harga_satuan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO master_produk (id_produk, nama_produk, kategori_produk, harga_satuan, satuan, deskripsi) 
            VALUES ('$id_produk', '$nama_produk', '$kategori_produk', '$harga_satuan', '$satuan', '$deskripsi')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='master_produk.php';</script>";
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
    <title>Master Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Produk</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProdukModal">Add Data</button>

    <!-- Tabel Data Produk -->
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
            <form method="POST" action="add_produk.php">
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
                        <select class="form-select" id="kategori_produk" name="kategori_produk" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Minuman Panas">Minuman Panas</option>
                                <option value="Minuman Dingin">Minuman Dingin</option>
                                <option value="Makanan Ringan">Makanan Ringan</option>
                                <option value="Dessert">Dessert</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Satuan (Rp)</label>
                        <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" placeholder="Contoh: 25000" required>
                     </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Contoh: Gelas, Piring" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Contoh: Minuman kopi dengan cream susu" required></textarea>
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
