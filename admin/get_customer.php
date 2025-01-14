<?php
include("../config/koneksi_mysql.php");

// Set header untuk JSON
header('Content-Type: application/json');

if (isset($_GET['id_transaksi_pendapatan'])) {
    $id_transaksi = $_GET['id_transaksi_pendapatan'];

    // Validasi input (hanya angka atau alfanumerik jika diperlukan)
    if (!preg_match('/^[a-zA-Z0-9]+$/', $id_transaksi)) {
        echo json_encode(['error' => 'ID Transaksi tidak valid']);
        exit;
    }

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "SELECT tp.id_customer, c.nama_customer, tp.saldo_piutang 
              FROM transaksi_pendapatan tp 
              JOIN customer c ON tp.id_customer = c.id_customer 
              WHERE tp.id_transaksi_pendapatan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $id_transaksi);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Respons data dalam format JSON
            echo json_encode([
                'id_customer' => $row['id_customer'],
                'nama_customer' => $row['nama_customer'],
                'saldo_piutang' => $row['saldo_piutang']
            ]);
        } else {
            // Jika data tidak ditemukan
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Jika query gagal dipersiapkan
        echo json_encode(['error' => 'Terjadi kesalahan pada server']);
    }
} else {
    // Jika parameter tidak diberikan
    echo json_encode(['error' => 'ID Transaksi tidak diberikan']);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
