
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Jika data dikirimkan melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NIK = $_POST['NIK'];
    $NIK = $_POST['NIK']; 
    error_log("Received POST data: " . print_r($_POST, true));
    $nama_karyawan = $_POST['nama_karyawan'];
    $alamat_karyawan = $_POST['alamat_karyawan'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $tgl_bergabung = $_POST['tgl_bergabung'];

    $sql = "INSERT INTO master_karyawan (NIK, nama_karyawan, alamat_karyawan, tgl_lahir, jenis_kelamin, no_telp, email, tgl_bergabung) 
            VALUES ('$NIK', '$nama_karyawan', '$alamat_karyawan', '$tgl_lahir', '$jenis_kelamin', '$no_telp', '$email', '$tgl_bergabung')";

    if (mysqli_query($koneksi, $sql)) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . mysqli_error($koneksi);
        echo "<br>Query: " . $sql; // Debug query yang dijalankan
    }
    exit; // Stop script to prevent HTML output
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Karyawan</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addKaryawanModal">Add Data</button>

    <!-- Tabel Data Karyawan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat Karyawan</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telpon</th>
                    <th>Email</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody id="data_karyawan">
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM master_karyawan");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['NIK']}</td>
                            <td>{$row['nama_karyawan']}</td>
                            <td>{$row['alamat_karyawan']}</td>
                            <td>{$row['tgl_lahir']}</td>
                            <td>{$row['jenis_kelamin']}</td>
                            <td>{$row['no_telp']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['tgl_bergabung']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addKaryawanModal" tabindex="-1" aria-labelledby="addKaryawanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_add_karyawan" action="add_karyawan.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKaryawanModalLabel">Tambah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="NIK" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="NIK" name="NIK" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_karyawan" class="form-label">Alamat Karyawan</label>
                        <textarea class="form-control" id="alamat_karyawan" name="alamat_karyawan" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_bergabung" class="form-label">Tanggal Bergabung</label>
                        <input type="date" class="form-control" id="tgl_bergabung" name="tgl_bergabung" required>
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

<script>
$(document).ready(function() {
    // Submit form tambah karyawan
    $('#form_add_karyawan').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "add_karyawan.php",
            method: "POST",
            data: $(this).serialize(),
            success: function(data) {
                alert(data);
                $('#form_add_karyawan')[0].reset();
                $('#addKaryawanModal').modal('hide');
                location.reload(); // Reload halaman
            }
        });
    });
});
</script>
</body>
</html>
