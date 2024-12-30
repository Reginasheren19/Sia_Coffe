<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori_pengeluaran = mysqli_real_escape_string($koneksi, $_POST['kategori_pengeluaran']);
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $tanggal_pengeluaran = mysqli_real_escape_string($koneksi, $_POST['tanggal_pengeluaran']);
    $total_pengeluaran = (int)$_POST['total_pengeluaran'];
    $jumlah_bayar = (int)$_POST['jumlah_bayar'];
    $hutang = $total_pengeluaran - $jumlah_bayar;

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO transaksi_pengeluaran 
              (kategori_pengeluaran, id_supplier, id_akun, tanggal_pengeluaran, total_pengeluaran, jumlah_bayar, hutang) 
              VALUES ('$kategori_pengeluaran', '$id_supplier', '$id_akun', '$tanggal_pengeluaran', '$total_pengeluaran', '$jumlah_bayar', '$hutang')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='transaksi_pengeluaran.php';</script>";
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
    <title>Transaksi Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Transaksi Pengeluaran</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTransaksiPengeluaranModal">Add Pengeluaran</button>

    <!-- Tabel Data Transaksi Pengeluaran -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Transaksi</th>
                    <th>Kategori Pengeluaran</th>
                    <th>Nama Supplier</th>
                    <th>Nama Akun</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Total Pengeluaran</th>
                    <th>Jumlah Bayar</th>
                    <th>Hutang</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data_pengeluaran">
                <?php
                // Query untuk mengambil data transaksi_pengeluaran dan join master_supplier serta master_akun
                $result = mysqli_query($koneksi, "
                    SELECT tp.id_transaksi, 
                        tp.kategori_pengeluaran, 
                        ms.nama_supplier, 
                        ma.nama_akun, 
                        tp.tanggal_pengeluaran, 
                        tp.total_pengeluaran, 
                        tp.jumlah_bayar, 
                        tp.total_pengeluaran - tp.jumlah_bayar AS hutang 
                    FROM transaksi_pengeluaran tp
                    JOIN master_supplier ms ON tp.id_supplier = ms.id_supplier
                    JOIN master_akun ma ON tp.id_akun = ma.id_akun
                ");

                // Tampilkan data transaksi
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_transaksi']}</td>
                        <td>{$row['kategori_pengeluaran']}</td>
                        <td>{$row['nama_supplier']}</td>
                        <td>{$row['nama_akun']}</td>
                        <td>{$row['tanggal_pengeluaran']}</td>
                        <td>" . number_format($row['total_pengeluaran'], 2) . "</td>
                        <td>" . number_format($row['jumlah_bayar'], 2) . "</td>
                        <td>" . number_format($row['hutang'], 2) . "</td>
                        <td>
                            <a href='delete_transaksi_pengeluaran.php?transaksi={$row['id_transaksi']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this transaction?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Modal Tambah Transaksi Pengeluaran -->
    <div class="modal fade" id="addTransaksiPengeluaranModal" tabindex="-1" aria-labelledby="addTransaksiPengeluaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="add_transaksi_pengeluaran.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTransaksiPengeluaranModalLabel">Tambah Transaksi Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="mb-3">
                        <label for="kategori_pengeluaran" class="form-label">Kategori Pengeluaran</label>
                        <select class="form-select" id="kategori_pengeluaran" name="kategori_pengeluaran" required>
                            <option value="pengeluaran utama">Pengeluaran Utama</option>
                            <option value="pembayaran hutang">Pembayaran Hutang</option>
                            <option value="pengeluaran lain">Pengeluaran Lain</option>
                        </select>
                    </div>
                        <div class="mb-3">
                            <label for="id_supplier" class="form-label">Nama Supplier</label>
                            <select class="form-select" id="id_supplier" name="id_supplier" required>
                                <option value="">Pilih Supplier</option>
                                <?php
                                // Ambil data supplier dari database
                                $suppliers = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier FROM master_supplier");
                                while ($supplier = mysqli_fetch_assoc($suppliers)) {
                                    echo "<option value='{$supplier['id_supplier']}'>{$supplier['nama_supplier']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_akun" class="form-label">Nama Akun</label>
                            <select class="form-select" id="id_akun" name="id_akun" required>
                                <option value="">Pilih Akun</option>
                                <?php
                                // Ambil data akun dari database
                                $accounts = mysqli_query($koneksi, "SELECT id_akun, nama_akun FROM master_akun");
                                while ($account = mysqli_fetch_assoc($accounts)) {
                                    echo "<option value='{$account['id_akun']}'>{$account['nama_akun']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
                            <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_pengeluaran" class="form-label">Total Pengeluaran</label>
                            <input type="number" class="form-control" id="total_pengeluaran" name="total_pengeluaran" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                            <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" required>
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
</div>
</body>
</html>
