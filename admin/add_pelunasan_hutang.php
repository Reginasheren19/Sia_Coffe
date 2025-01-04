<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_nota = mysqli_real_escape_string($koneksi, $_POST['no_nota']);
    $id_supplier = mysqli_real_escape_string($koneksi, $_POST['id_supplier']);
    $tanggal_pelunasan = mysqli_real_escape_string($koneksi, $_POST['tanggal_pelunasan']);
    $total_pelunasan = (float)$_POST['total_pelunasan'];

    // Ambil saldo hutang
    $query_saldo = "
        SELECT (tp.harga * tp.jumlah - tp.total_bayar) AS saldo_hutang 
        FROM transaksi_pengeluaran tp 
        WHERE tp.no_nota = '$no_nota'
    ";
    $result_saldo = mysqli_query($koneksi, $query_saldo);
    $saldo_hutang = 0;

    if ($result_saldo && mysqli_num_rows($result_saldo) > 0) {
        $row = mysqli_fetch_assoc($result_saldo);
        $saldo_hutang = (float)$row['saldo_hutang'];
    }

    if ($total_pelunasan > $saldo_hutang) {
        echo "<script>alert('Error: Total pelunasan tidak boleh lebih besar dari saldo hutang!'); window.history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO transaksi_hutang (no_nota, id_supplier, tanggal_pelunasan, total_pelunasan) 
            VALUES ('$no_nota', '$id_supplier', '$tanggal_pelunasan', '$total_pelunasan')";
    $sql_update_pengeluaran = "
        UPDATE transaksi_pengeluaran 
        SET total_bayar = total_bayar + $total_pelunasan 
        WHERE no_nota = '$no_nota'
    ";

    if (mysqli_query($koneksi, $sql) && mysqli_query($koneksi, $sql_update_pengeluaran)) {
        echo "<script>alert('Pelunasan hutang berhasil ditambahkan!'); window.location.href='pelunasan_hutang.php';</script>";
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
    <title>Pelunasan Hutang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Pelunasan Hutang</h1>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addHutangModal">Add Hutang</button>

<!-- Modal untuk Menambah Transaksi Hutang -->
<div class="modal fade" id="addHutangModal" tabindex="-1" aria-labelledby="addHutangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add_pelunasan_hutang.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHutangModalLabel">Tambah Transaksi Hutang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="no_nota" class="form-label">No Nota</label>
                        <input type="text" class="form-control" id="no_nota" name="no_nota" required>
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
                            // PHP untuk menampilkan daftar supplier
                            $suppliers = mysqli_query($koneksi, "SELECT id_supplier, nama_supplier FROM master_supplier");
                            while ($supplier = mysqli_fetch_assoc($suppliers)) {
                                echo "<option value='{$supplier['id_supplier']}'>{$supplier['nama_supplier']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="saldo_hutang" class="form-label">Saldo Hutang</label>
                        <input type="text" class="form-control" id="saldo_hutang" name="saldo_hutang" readonly>
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

<script>
    $(document).ready(function () {
        // Event saat pengguna mengetikkan nomor nota
        $('#no_nota').on('keyup', function () {
            var noNota = $(this).val();

            // Cek jika input tidak kosong
            if (noNota !== '') {
                // Lakukan AJAX request ke get_saldo_hutang.php
                $.ajax({
                    url: 'get_saldo_hutang.php',
                    type: 'GET',
                    data: { no_nota: noNota },
                    dataType: 'json',
                    success: function (response) {
                        // Jika saldo hutang ditemukan, tampilkan
                        if (response.saldo_hutang !== undefined) {
                            $('#saldo_hutang').val(response.saldo_hutang.toFixed(2)); // Format ke 2 desimal
                        } else {
                            $('#saldo_hutang').val('0.00'); // Default jika tidak ada saldo
                        }
                    },
                    error: function () {
                        alert('Gagal mengambil saldo hutang. Coba lagi.');
                    }
                });
            } else {
                // Reset saldo hutang jika input kosong
                $('#saldo_hutang').val('');
            }
        });
    });
</script>

</body>
</html>
