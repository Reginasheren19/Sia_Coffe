<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['metode_pembayaran'])) {
    $hapus_id_metode = mysqli_real_escape_string($koneksi, $_GET['metode_pembayaran']);

    $sql = mysqli_query($koneksi, "DELETE FROM master_metode_pembayaran WHERE id_metode = '$hapus_id_metode_pembayaran'");

    if ($sql) {
        header("location: master_metode_pembayaran.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No employee specified for deletion.";
}
?>