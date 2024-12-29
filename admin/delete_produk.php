<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['produk'])) {
    $hapus_id_produk = mysqli_real_escape_string($koneksi, $_GET['produk']);
    echo "ID Produk yang akan dihapus: " . $hapus_id_produk . "<br>"; // Debugging

    $sql = mysqli_query($koneksi, "DELETE FROM master_produk WHERE id_produk = '$hapus_id_produk'");

    if ($sql) {
        header("location: master_produk.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No produk specified for deletion.";
}
?>


