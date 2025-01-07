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
    $nota_pelunasan = mysqli_real_escape_string($koneksi, $_POST['nota_pelunasan']);
    $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
    $tanggal_pelunasan = mysqli_real_escape_string($koneksi, $_POST['tanggal_pelunasan']);
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);
    $saldo_hutang_pl = (float)$_POST['saldo_hutang_pl']; // Menggunakan float untuk saldo hutang
    $total_pelunasan = (float)$_POST['total_pelunasan']; // Menggunakan float untuk total pelunasan

    // Validasi jika total pelunasan lebih besar dari saldo hutang
    if ($total_pelunasan > $saldo_hutang_pl) {
        echo "<script>alert('Total pelunasan tidak boleh lebih besar dari saldo hutang!'); window.history.back();</script>";
        exit();
    }

    // Query untuk menyimpan data ke tabel pelunasan_hutang
    $sql = "INSERT INTO pelunasan_hutang (nota_pelunasan, id_transaksi, tanggal_pelunasan, id_supplier, saldo_hutang_pl, total_pelunasan) 
            VALUES ('$nota_pelunasan', '$id_transaksi', '$tanggal_pelunasan', '$id_supplier', '$saldo_hutang_pl', '$total_pelunasan')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data pelunasan hutang berhasil ditambahkan!'); window.location.href='pelunasan_hutang.php';</script>";
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
    <title>Transaksi Pengeluaran Lain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Pelunasan Hutang</h1>
        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPelunasanHutangModal">Add Pelunasan Hutang</button>

<!-- Modal for Adding Debt Payment -->
<div class="modal fade" id="addPelunasanHutangModal" tabindex="-1" aria-labelledby="addPelunasanHutangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add_pelunasan_hutang.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPelunasanHutangModalLabel">Tambah Pelunasan Hutang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_transaksi" class="form-label">No Nota</label>
                        <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?php echo isset($transaction['no_nota']) ? $transaction['no_nota'] : ''; ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="nota_pelunasan" class="form-label">Nota Pelunasan</label>
                        <input type="text" class="form-control" id="nota_pelunasan" name="nota_pelunasan" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pelunasan" class="form-label">Tanggal Pelunasan</label>
                        <input type="date" class="form-control" id="tanggal_pelunasan" name="tanggal_pelunasan" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Nama Supplier</label>
                        <select class="form-select" id="id_supplier" name="id_supplier" required>
                            <option value="">Pilih Supplier</option>
                            <?php
                                // Mengambil data supplier
                                $suppliers = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier FROM master_supplier");
                                while ($supplier = mysqli_fetch_assoc($suppliers)) {
                                    echo "<option value='{$supplier['id_supplier']}'>{$supplier['nama_supplier']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="saldo_hutang_pl" class="form-label">Saldo Hutang</label>
                        <input type="text" class="form-control" id="saldo_hutang_pl" name="saldo_hutang_pl" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="total_pelunasan" class="form-label">Total Pelunasan</label>
                        <input type="number" class="form-control" id="total_pelunasan" name="total_pelunasan" required>
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
