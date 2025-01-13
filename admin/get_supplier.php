<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id_transaksi']);

    // Query untuk menghitung saldo hutang dengan benar
    $query = "
        SELECT 
            tp.id_supplier, 
            ms.nama_supplier, 
            (tp.total - tp.total_bayar) AS saldo_hutang_pl
        FROM transaksi_pengeluaran tp
        JOIN master_supplier ms 
            ON tp.id_supplier = ms.id_supplier
        WHERE tp.id_transaksi = '$id_transaksi'
    ";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Query gagal: ' . mysqli_error($koneksi)]);
    }
}
?>
