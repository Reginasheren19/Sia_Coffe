<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include koneksi ke database
include("../config/koneksi_mysql.php");

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $kode_akun = mysqli_real_escape_string($koneksi, $_POST['kode_akun']);
    $nama_akun = mysqli_real_escape_string($koneksi, $_POST['nama_akun']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $jenis_saldo = mysqli_real_escape_string($koneksi, $_POST['jenis_saldo']);

    // Query untuk memperbarui data ke database
    $sql = "UPDATE master_akun SET 
            kode_akun='$kode_akun', 
            nama_akun='$nama_akun', 
            kategori='$kategori', 
            jenis_saldo='$jenis_saldo' 
            WHERE id_akun='$id_akun'";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='master_akun.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='master_akun.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Supplier</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAkunModal">Add Data</button>

                            <!-- Tabel Data Akun -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Akun</th>
                                            <th>Kode Akun</th>
                                            <th>Nama Akun</th>
                                            <th>Kategori</th>
                                            <th>Jenis Saldo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_akun">
                                        <?php
                                        // Query data akun dari database
                                        $result = mysqli_query($koneksi, "SELECT * FROM master_akun");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>{$row['id_akun']}</td>
                                                <td>{$row['kode_akun']}</td>
                                                <td>{$row['nama_akun']}</td>
                                                <td>{$row['kategori']}</td>
                                                <td>{$row['jenis_saldo']}</td>
                                                <td>
                                                    <button class='btn btn-primary btn-sm btn-update'>Update</button>
                                                    <a href='delete_akun.php?akun={$row['id_akun']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this account?')\">Delete</a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="addAkunModal" tabindex="-1" aria-labelledby="addAkunModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="add_akun.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAkunModalLabel">Tambah Data Akun</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kode_akun" class="form-label">Kode Akun</label>
                                    <input type="text" class="form-control" id="kode_akun" name="kode_akun" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_akun" class="form-label">Nama Akun</label>
                                    <input type="text" class="form-control" id="nama_akun" name="nama_akun" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="Aset">Aset</option>
                                        <option value="Kewajiban">Kewajiban</option>
                                        <option value="Modal">Modal</option>
                                        <option value="Pendapatan">Pendapatan</option>
                                        <option value="Beban">Beban</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_saldo" class="form-label">Jenis Saldo</label>
                                    <select class="form-select" id="jenis_saldo" name="jenis_saldo" required>
                                        <option value="Debit">Debit</option>
                                        <option value="Kredit">Kredit</option>
                                    </select>
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
