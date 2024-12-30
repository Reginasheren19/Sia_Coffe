<?php
include("../config/koneksi_mysql.php");

// Debugging $_GET
echo "Parameter GET: ";
print_r($_GET);
echo "<br>";

if (isset($_GET['metode_pembayaran']) && !empty($_GET['metode_pembayaran'])) { // Periksa 'id_metode'
    // Ambil ID metode dari parameter URL dan sanitasi
    $hapus_id_metode = mysqli_real_escape_string($koneksi, $_GET['metode_pembayaran']);
    echo "ID metode yang akan dihapus: " . $hapus_id_metode . "<br>"; // Debugging

    // Jalankan query untuk menghapus produk berdasarkan ID
    $sql = mysqli_query($koneksi, "DELETE FROM master_metode_pembayaran WHERE id_metode = '$hapus_id_metode'");

    // Cek apakah query berhasil dieksekusi
    if ($sql && mysqli_affected_rows($koneksi) > 0) { // Pastikan ada baris yang terhapus
        header("location: master_metode_pembayaran.php"); // Redirect ke halaman master_metode_pembayaran.php setelah berhasil
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No metode specified for deletion.";
}
?>
