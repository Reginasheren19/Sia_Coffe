<?php
include("../config/koneksi_mysql.php");

// Periksa apakah parameter 'produk' ada dalam URL
if (isset($_GET['produk'])) {
    // Escape input untuk mencegah SQL Injection
    $hapus_id_produk = mysqli_real_escape_string($koneksi, $_GET['produk']);
    echo "ID Produk yang akan dihapus: " . $hapus_id_produk . "<br>"; // Debugging

    // Query untuk menghapus data
    $sql = mysqli_query($koneksi, "DELETE FROM master_produk WHERE id_produk = '$hapus_id_produk'");

    // Periksa apakah query berhasil dijalankan
    if ($sql) {
        // Redirect ke halaman master_produk.php
        header("Location: master_produk.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        // Tampilkan pesan error jika terjadi kesalahan
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    // Tampilkan pesan jika parameter 'produk' tidak ada
    echo "No produk specified for deletion.";
}
?>

