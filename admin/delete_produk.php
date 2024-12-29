<?php
include("../config/koneksi_mysql.php");

// Debugging $_GET
echo "Parameter GET: ";
print_r($_GET);
echo "<br>";

if (isset($_GET['id_produk']) && !empty($_GET['id_produk'])) { // Periksa 'id_produk'
    // Ambil ID produk dari parameter URL dan sanitasi
    $hapus_id_produk = mysqli_real_escape_string($koneksi, $_GET['id_produk']);
    echo "ID Produk yang akan dihapus: " . $hapus_id_produk . "<br>"; // Debugging

    // Jalankan query untuk menghapus produk berdasarkan ID
    $sql = mysqli_query($koneksi, "DELETE FROM master_produk WHERE id_produk = '$hapus_id_produk'");

    // Cek apakah query berhasil dieksekusi
    if ($sql && mysqli_affected_rows($koneksi) > 0) { // Pastikan ada baris yang terhapus
        header("location: master_produk.php"); // Redirect ke halaman master_produk.php setelah berhasil
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No produk specified for deletion.";
}
?>
