<?php
include("../config/koneksi_mysql.php");

// Debugging $_GET
echo "Parameter GET: ";
print_r($_GET);
echo "<br>";

if (isset($_GET['id_customer']) && !empty($_GET['id_customer'])) { // Periksa 'id_customer'
    // Ambil ID produk dari parameter URL dan sanitasi
    $hapus_id_customer = mysqli_real_escape_string($koneksi, $_GET['id_customer']);
    echo "ID Customer yang akan dihapus: " . $hapus_id_customer . "<br>"; // Debugging

    // Jalankan query untuk menghapus produk berdasarkan ID
    $sql = mysqli_query($koneksi, "DELETE FROM master_customer WHERE id_customer = '$hapus_id_customer'");

    // Cek apakah query berhasil dieksekusi
    if ($sql && mysqli_affected_rows($koneksi) > 0) { // Pastikan ada baris yang terhapus
        header("location: master_customer.php"); // Redirect ke halaman master_produk.php setelah berhasil
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No produk specified for deletion.";
}
?>
