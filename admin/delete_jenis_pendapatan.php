<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['jenis_pendapatan'])) {
    $hapus_id_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_GET['jenis_pendapatan']);

    $sql = mysqli_query($koneksi, "DELETE FROM master_jenis_pendapatan WHERE id_jenis_pendapatan = '$hapus_id_jenis_pendapatan'");

    if ($sql) {
        header("location: master_jenis_pendapatan.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No employee specified for deletion.";
}
?>