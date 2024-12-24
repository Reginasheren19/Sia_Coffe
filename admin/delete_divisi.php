<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['divisi'])) {
    $hapus_id_divisi = mysqli_real_escape_string($koneksi, $_GET['divisi']);

    $sql = mysqli_query($koneksi, "DELETE FROM master_divisi WHERE id_divisi = '$hapus_id_divisi'");

    if ($sql) {
        header("location: master_divisi.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No Divisi specified for deletion.";
}
?>