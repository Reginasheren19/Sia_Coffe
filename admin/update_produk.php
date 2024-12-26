<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Cek apakah NIK ada di POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $kategori_produk = mysqli_real_escape_string($koneksi, $_POST['kategori_produk']);
    $harga_satuan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);


    // Query untuk memperbarui data ke database
    $sql = "UPDATE master_produk SET 
            nama_produk='$nama_produk',
            kategori_produk='$kategori_produk', 
            harga_satuan='$harga_satuan',
            satuan='$satuan',
            deskripsi='$deskripsi'
            WHERE id_produk='$id_produk'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_produk.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_produk.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Edit Data Produk</h1>
    <!-- Modal Edit Data Produk -->
    <div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="update_produk.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProdukModalLabel">Edit Data Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_produk" id="edit_id_produk">
                                <div class="mb-3">
                                    <label for="editNamaProduk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="editNamaProduk" name="nama_produk" required>
                                </div>
                                <div class="mb-3">
                                <label for="editKategoriProduk" class="form-label">Kategori Produk</label>
                                    <select class="form-select" id="editKategoriProduk" name="kategori_produk" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Minuman Panas">Minuman Panas</option>
                                        <option value="Minuman Dingin">Minuman Dingin</option>
                                        <option value="Makanan Ringan">Makanan Ringan</option>
                                        <option value="Dessert">Dessert</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editHargaSatuan" class="form-label">Harga Satuan</label>
                                    <input type="date" class="form-control" id="editHargaSatuan" name="harga_satuan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editSatuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="editSatuan" name="satuan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editDeskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
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
