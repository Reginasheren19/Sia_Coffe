<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

// Query untuk mendapatkan ID transaksi terakhir
$result = mysqli_query($koneksi, "SELECT MAX(id_transaksi) AS last_id FROM transaksi_pengeluaran");
$row = mysqli_fetch_assoc($result);
$lastId = isset($row['last_id']) ? $row['last_id'] + 1 : 1; // Jika kosong, mulai dari 1

// Format no_nota
$no_nota = 'TRP-' . date('Ymd') . '-' . $lastId;

// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $no_nota = mysqli_real_escape_string($koneksi, $_POST['no_nota']);
    $kategori_pengeluaran = mysqli_real_escape_string($koneksi, $_POST['kategori_pengeluaran']);
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $tanggal_transaksi = mysqli_real_escape_string($koneksi, $_POST['tanggal_transaksi']);
    $harga = (float)$_POST['harga']; // Menggunakan float untuk harga
    $jumlah = (int)$_POST['jumlah']; // Menggunakan integer untuk jumlah
    $total = $harga * $jumlah; // Total pengeluaran dihitung dari harga dan jumlah
    $total_bayar = (float)$_POST['total_bayar'];
    $status = ($total_bayar < $total) ? 'Belum Lunas' : 'Lunas'; // Status berdasarkan perbandingan total bayar dengan total pengeluaran

    // Query untuk menyimpan data ke tabel transaksi_pengeluaran
    $sql = "INSERT INTO transaksi_pengeluaran 
                (no_nota, kategori_pengeluaran, id_supplier, id_akun, tanggal_transaksi, harga, jumlah, total, total_bayar, status) 
            VALUES 
                ('$no_nota', '$kategori_pengeluaran', '$id_supplier', '$id_akun', '$tanggal_transaksi', '$harga', '$jumlah', '$total', '$total_bayar', '$status')";

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Transaksi Pengeluaran</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTransaksiPengeluaranModal">Add Pengeluaran</button>

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
                        <label for="no_nota">No Nota:</label>
                        <input type="text" class="form-control" id="no_nota" name="no_nota" value="<?php echo $no_nota; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_pengeluaran" class="form-label">Kategori Pengeluaran</label>
                        <select class="form-select" id="kategori_pengeluaran" name="kategori_pengeluaran" required>
                            <option value="peralatan">Peralatan</option>
                            <option value="perlengkapan">Perlengkapan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Nama Supplier</label>
                        <select class="form-select" id="id_supplier" name="id_supplier">
                            <option value="">Pilih Supplier</option>
                            <?php
                            // Fetch supplier data from the database
                            $suppliers = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier FROM master_supplier");
                            while ($supplier = mysqli_fetch_assoc($suppliers)) {
                                echo "<option value='{$supplier['id_supplier']}'>{$supplier['nama_supplier']}</option>";
                            }
                            ?>
                        </select>
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
                        <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Banyaknya</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="total" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_bayar" class="form-label">Total Bayar</label>
                        <input type="number" class="form-control" id="total_bayar" name="total_bayar" required>
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
    // Mengisi total pengeluaran otomatis berdasarkan harga dan jumlah
    $('#harga, #jumlah').on('input', function() {
        const harga = parseFloat($('#harga').val()) || 0;
        const jumlah = parseInt($('#jumlah').val()) || 0;
        const total = harga * jumlah;

        // Menampilkan total pengeluaran di kolom yang sesuai
        $('#total').val(total);

        // Menentukan status setelah total bayar dihitung
        const totalBayar = parseFloat($('#total_bayar').val()) || 0;
        
        // Menentukan status berdasarkan perbandingan total bayar dan total pengeluaran
        if (totalBayar < total) {
            $('#status').val('Belum Lunas');
        } else {
            $('#status').val('Lunas');
        }
    });

    // Mengubah status secara otomatis saat total bayar dimasukkan
    $('#total_bayar').on('input', function() {
        const total = parseFloat($('#total').val()) || 0;
        const totalBayar = parseFloat($('#total_bayar').val()) || 0;

        // Menentukan status berdasarkan total bayar dan total pengeluaran
        if (totalBayar < total) {
            $('#status').val('Belum Lunas');
        } else {
            $('#status').val('Lunas');
        }
    });
</script>
</body>
</html>
