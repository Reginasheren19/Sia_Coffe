<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['jabatan'])) {
    $hapus_id_jabatan = mysqli_real_escape_string($koneksi, $_GET['jabatan']);

    $sql = mysqli_query($koneksi, "DELETE FROM master_jabatan WHERE id_jabatan = '$hapus_id_jabatan'");

    if ($sql) {
        header("location: master_jabatan.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No employee specified for deletion.";
}
?>