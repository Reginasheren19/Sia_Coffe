<?php
include("../config/koneksi_mysql.php"); // Pastikan koneksi PDO sudah diinisialisasi di sini

if (isset($_GET['id_transaksi'])) { // Menggunakan id_transaksi
    $id_transaksi = $_GET['id_transaksi'];

    // Query untuk mendapatkan nama supplier berdasarkan id_transaksi
    $query = "SELECT master_supplier.nama_supplier FROM transaksi_pengeluaran 
              JOIN master_supplier ON transaksi_pengeluaran.id_supplier = master_supplier.id_supplier 
              WHERE transaksi_pengeluaran.id_transaksi = :id_transaksi"; // Menggunakan parameter named

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_transaksi', $id_transaksi); // Binding parameter
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(['nama_supplier' => $result['nama_supplier']]);
    } else {
        echo json_encode(['nama_supplier' => null]);
    }
} else {
    echo json_encode(['error' => 'ID Transaksi tidak diberikan']);
}
?>