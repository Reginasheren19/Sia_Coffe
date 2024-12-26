<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['customer'])) {
    $hapus_id_customer = mysqli_real_escape_string($koneksi, $_GET['customer']);

    $sql = mysqli_query($koneksi, "DELETE FROM master_customer WHERE id_customer = '$hapus_id_customer'");

    if ($sql) {
        header("location: master_customer.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No employee specified for deletion.";
}
?>