<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_POST['id_jenis_pendapatan']);
    $nama_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_POST['nama_jenis_pendapatan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO master_jenis_pendapatan (id_jenis_pendapatan, nama_jenis_pendapatan, deskripsi) 
            VALUES ('$id_jenis_pendapatan', '$nama_jenis_pendapatan', '$deskripsi')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='master_jenis_pendapatan.php';</script>";
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
    <title>Master Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Jenis Pendapatan</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addJenisPendapatanModal">Add Data</button>

    <!-- Tabel Data Jenis Pendapatan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                        <th>Id Jenis Pendapatan</th>
                        <th>Nama Jenis Pendapatan</th>
                        <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM master_jenis_pendapatan");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id_jenis_pendapatan']}</td>
                            <td>{$row['nama_jenis_pendapatan']}</td>
                            <td>{$row['deskripsi']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addJenisPendapatanModal" tabindex="-1" aria-labelledby="addJenisPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add_jenis_pendapatan.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJenisPendapatanModalLabel">Tambah Data Jenis Pendapatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_jenis_pendapatan" class="form-label">Nama Jenis Pendapatan</label>
                        <input type="text" class="form-control" id="nama_jenis_pendapatan" name="nama_jenis_pendapatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
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
