<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['supplier'])) {
    $hapus_id_supplier = mysqli_real_escape_string($koneksi, $_GET['supplier']);

    $sql = mysqli_query($koneksi, "DELETE FROM master_supplier WHERE id_supplier = '$hapus_id_supplier'");

    if ($sql) {
        header("location: master_supplier.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No supplier specified for deletion.";
}
?>