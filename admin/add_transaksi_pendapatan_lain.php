<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Debugging untuk melihat data yang dikirimkan dari form
echo '<pre>';
print_r($_POST);
echo '</pre>';


// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $tanggal_pendapatan_lain = mysqli_real_escape_string($koneksi, $_POST['tanggal_pendapatan_lain']);
    $total = (float)$_POST['total']; // Menggunakan float untuk total

    // Query untuk mendapatkan nama akun berdasarkan id_akun
    $query_akun = "SELECT nama_akun FROM master_akun WHERE id_akun = '$id_akun'";
    $result_akun = mysqli_query($koneksi, $query_akun);

    if ($result_akun && mysqli_num_rows($result_akun) > 0) {
        $row_akun = mysqli_fetch_assoc($result_akun);
        $nama_akun = $row_akun['nama_akun']; // Mengambil nama akun
    }

    // Query untuk menyimpan data ke tabel transaksi_pendapatan_lain
    $sql = "INSERT INTO transaksi_pendapatan_lain (nama_kategori, id_akun, tanggal_pendapatan_lain, total) 
            VALUES ('$nama_kategori', '$id_akun', '$tanggal_pendapatan_lain', '$total')";

    // Eksekusi query pendapatan lain
    if (mysqli_query($koneksi, $sql)) {
        // Insert jurnal umum (debit: kas, kredit: pendapatan lain)
        $query_jurnal_debit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                               VALUES ('$tanggal_pendapatan_lain', '$nama_akun', '$id_akun', '$total', 0)";

        $query_jurnal_kredit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                                VALUES ('$tanggal_pendapatan_lain', '$Kas', '2', 0, '$total')";

        // Eksekusi query
        if (mysqli_query($koneksi, $query_jurnal_debit) && mysqli_query($koneksi, $query_jurnal_kredit)) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='transaksi_pendapatan_lain.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pendapatan Lain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Transaksi Pendapatan Lain</h1>

    <!-- Form untuk menambah pendapatan lain -->
    <h5 class="mb-3">Tambah Pendapatan Lain</h5>
    <form method="POST" action="add_transaksi_pendapatan_lain.php">
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <select class="form-select" id="nama_kategori" name="nama_kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="Sewa Tempat">Sewa Tempat</option>
                <option value="Workshop">Workshop</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_akun" class="form-label">Nama Akun</label>
            <select class="form-select" id="id_akun" name="id_akun" required>
                <option value="">Pilih Akun</option>
                <?php
                $accounts = mysqli_query($koneksi, "SELECT id_akun, nama_akun FROM master_akun");
                while ($account = mysqli_fetch_assoc($accounts)) {
                    echo "<option value='{$account['id_akun']}'>{$account['nama_akun']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_pendapatan_lain" class="form-label">Tanggal Pendapatan</label>
            <input type="date" class="form-control" id="tanggal_pendapatan_lain" name="tanggal_pendapatan_lain" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <!-- Tabel untuk menampilkan transaksi pendapatan lain -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Pendapatan Lain</th>
                    <th>Nama Kategori</th>
                    <th>Nama Akun</th>
                    <th>Tanggal Pendapatan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "
                    SELECT tpl.id_pendapatan_lain, 
                           tpl.nama_kategori, 
                           ma.nama_akun, 
                           tpl.tanggal_pendapatan_lain, 
                           tpl.total
                    FROM transaksi_pendapatan_lain tpl
                    JOIN master_akun ma ON tpl.id_akun = ma.id_akun
                ");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_pendapatan_lain']}</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>{$row['nama_akun']}</td>
                        <td>{$row['tanggal_pendapatan_lain']}</td>
                        <td>" . number_format($row['total'], 2) . "</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
