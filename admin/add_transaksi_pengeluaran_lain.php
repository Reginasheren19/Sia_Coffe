<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Debugging untuk melihat data yang dikirimkan dari form
echo '<pre>';
print_r($_POST);
echo '</pre>';

// Query untuk mendapatkan ID transaksi terakhir
$result = mysqli_query($koneksi, "SELECT MAX(id_pengeluaran_lain) AS last_id FROM transaksi_pengeluaran_lain");
$row = mysqli_fetch_assoc($result);
$lastId = isset($row['last_id']) ? $row['last_id'] + 1 : 1; // Jika kosong, mulai dari 1

// Format no_nota
$nota_pengeluaran_lain = 'TRPL-' . date('Ymd') . '-' . $lastId;

// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nota_pengeluaran_lain = mysqli_real_escape_string($koneksi, $_POST['nota_pengeluaran_lain']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $tanggal_pengeluaran_lain = mysqli_real_escape_string($koneksi, $_POST['tanggal_pengeluaran_lain']);
    $total = (float)$_POST['total']; // Menggunakan float untuk total

    // Query untuk mendapatkan nama akun berdasarkan id_akun
    $query_akun = "SELECT nama_akun FROM master_akun WHERE id_akun = '$id_akun'";
    $result_akun = mysqli_query($koneksi, $query_akun);

    if ($result_akun && mysqli_num_rows($result_akun) > 0) {
        $row_akun = mysqli_fetch_assoc($result_akun);
        $nama_akun = $row_akun['nama_akun']; // Mengambil nama akun
    }

    // Query untuk menyimpan data ke tabel transaksi_pengeluaran_lain
    $sql = "INSERT INTO transaksi_pengeluaran_lain (nota_pengeluaran_lain, id_akun, tanggal_pengeluaran_lain, total) 
            VALUES ('$nota_pengeluaran_lain', '$id_akun', '$tanggal_pengeluaran_lain', '$total')";

    // Eksekusi query pengeluaran lain
    if (mysqli_query($koneksi, $sql)) {
        // Insert jurnal umum (debit: beban, kredit: kas)
        $query_jurnal_debit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                               VALUES ('$tanggal_pengeluaran_lain', '$nama_akun', '$id_akun', '$total', 0)";

        $query_jurnal_kredit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                                VALUES ('$tanggal_pengeluaran_lain', 'Kas', '2', 0, '$total')";

        // Eksekusi query
        if (mysqli_query($koneksi, $query_jurnal_debit) && mysqli_query($koneksi, $query_jurnal_kredit)) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='transaksi_pengeluaran_lain.php';</script>";
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
    <title>Transaksi Pengeluaran Lain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Transaksi Pengeluaran Lain</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTransaksiPengeluaranLainModal">Add Pengeluaran</button>

<!-- Modal for Adding Expense Transaction -->
<div class="modal fade" id="addTransaksiPengeluaranLainModal" tabindex="-1" aria-labelledby="addTransaksiPengeluaranLainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add_transaksi_pengeluaran_lain.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiPengeluaranLainModalLabel">Tambah Pengeluaran Lain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nota_pengeluaran_lain" class="form-label">Nota Pengeluaran</label>
                        <input type="text" class="form-control" id="nota_pengeluaran_lain"  name="nota_pengeluaran_lain" value="<?php echo $nota_pengeluaran_lain; ?>" readonly>
                    </div>
                    <!-- Dropdown for Account Name -->
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
                        <label for="tanggal_pengeluaran_lain" class="form-label">Tanggal Pengeluaran</label>
                        <input type="date" class="form-control" id="tanggal_pengeluaran_lain" name="tanggal_pengeluaran_lain" required>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="total" required>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script>

