<?php
include("../config/koneksi_mysql.php");

// Periksa apakah parameter no_nota dikirim
if (isset($_GET['no_nota'])) {
    $no_nota = mysqli_real_escape_string($koneksi, $_GET['no_nota']);

    // Query untuk mendapatkan saldo hutang
    $query = "
        SELECT (tp.harga * tp.jumlah - tp.total_bayar) AS saldo_hutang 
        FROM transaksi_pengeluaran tp 
        WHERE tp.no_nota = '$no_nota'
    ";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['saldo_hutang' => $row['saldo_hutang']]);
    } else {
        echo json_encode(['saldo_hutang' => 0]); // Jika data tidak ditemukan
    }
} else {
    echo json_encode(['error' => 'Parameter no_nota tidak ditemukan']);
}
?>
