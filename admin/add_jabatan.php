<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Jika form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jabatan = mysqli_real_escape_string($koneksi, $_POST['id_jabatan']);
    $nama_jabatan = mysqli_real_escape_string($koneksi, $_POST['nama_jabatan']);
    $gaji_pokok = mysqli_real_escape_string($koneksi, $_POST['gaji_pokok']);
    $tunjangan = mysqli_real_escape_string($koneksi, $_POST['tunjangan']);
    $upah_lembur = mysqli_real_escape_string($koneksi, $_POST['upah_lembur']);
    $potongan = mysqli_real_escape_string($koneksi, $_POST['potongan']);
    $jam_kerja = mysqli_real_escape_string($koneksi, $_POST['jam_kerja']);

    // Query untuk menyimpan data jabatan ke database
    $sql = "INSERT INTO master_jabatan (id_jabatan, nama_jabatan, gaji_pokok, tunjangan, upah_lembur, potongan, jam_kerja) 
            VALUES ('$id_jabatan', '$nama_jabatan', '$gaji_pokok', '$tunjangan', '$upah_lembur', '$potongan', '$jam_kerja')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='master_jabatan.php';</script>";
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
    <h1 class="mb-4">Master Data Karyawan</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addJabatanModal">Add Data</button>

    <!-- Tabel Data Jabatan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Jabatan</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Upah Lembur</th>
                    <th>Potongan</th>
                    <th>Jam Kerja</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data_jabatan">
                <?php
                // Query data jabatan dari database
                $result = mysqli_query($koneksi, "SELECT * FROM master_jabatan");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_jabatan']}</td>
                        <td>{$row['nama_jabatan']}</td>
                        <td>{$row['gaji_pokok']}</td>
                        <td>{$row['tunjangan']}</td>
                        <td>{$row['upah_lembur']}</td>
                        <td>{$row['potongan']}</td>
                        <td>{$row['jam_kerja']}</td>
                        <td>
                            <button class='btn btn-primary btn-sm btn-update'>Update</button>
                            <a href='delete_jabatan.php?id_jabatan={$row['id_jabatan']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this jabatan?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addJabatanModal" tabindex="-1" aria-labelledby="addJabatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add_jabatan.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJabatanModalLabel">Tambah Data Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                        <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" required>
                    </div>
                    <div class="mb-3">
                        <label for="tunjangan" class="form-label">Tunjangan</label>
                        <input type="number" class="form-control" id="tunjangan" name="tunjangan" required>
                    </div>
                    <div class="mb-3">
                        <label for="upah_lembur" class="form-label">Upah Lembur</label>
                        <input type="number" class="form-control" id="upah_lembur" name="upah_lembur" required>
                    </div>
                    <div class="mb-3">
                        <label for="potongan" class="form-label">Potongan</label>
                        <input type="number" class="form-control" id="potongan" name="potongan" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_kerja" class="form-label">Jam Kerja</label>
                        <input type="number" class="form-control" id="jam_kerja" name="jam_ kerja" required>
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
