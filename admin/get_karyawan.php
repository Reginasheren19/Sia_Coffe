<?php
include("../config/koneksi_mysql.php");

// Query untuk mengambil data karyawan
$query = "SELECT 
        tk.id_transaksi_karyawan, 
        mk.nama_karyawan 
    FROM transaksi_karyawan tk
    JOIN master_karyawan mk ON tk.NIK = mk.NIK
";

// Eksekusi query
$result = mysqli_query($koneksi, $query);

// Cek apakah ada data yang ditemukan
if (mysqli_num_rows($result) > 0) {
    $karyawanList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $karyawanList[] = $row;
    }

    // Mengembalikan data karyawan dalam format JSON
    echo json_encode($karyawanList);
} else {
    // Mengembalikan data kosong jika tidak ada data
    echo json_encode([]);
}
?>
