<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['karyawan'])) {
    $hapus_NIK = mysqli_real_escape_string($koneksi, $_GET['karyawan']);

    $sql = mysqli_query($koneksi, "DELETE FROM master_karyawan WHERE NIK = '$hapus_NIK'");

    if ($sql) {
        header("location: master_karyawan.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No employee specified for deletion.";
}
?>