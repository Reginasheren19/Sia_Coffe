<?php
include("../config/koneksi_mysql.php");

// Debugging $_GET
echo "Parameter GET: ";
print_r($_GET);
echo "<br>";

// Periksa apakah 'jenis_pendapatan' ada di dalam parameter dan pastikan tidak kosong
if (isset($_GET['jenis_pendapatan']) && $_GET['jenis_pendapatan'] !== '') { 
    // Ambil ID jenis dari parameter URL dan sanitasi
    $hapus_id_jenis_pendapatan = mysqli_real_escape_string($koneksi, $_GET['jenis_pendapatan']);
    echo "ID jenis pendapatan yang akan dihapus: " . $hapus_id_jenis_pendapatan . "<br>"; // Debugging

    // Jalankan query untuk menghapus produk berdasarkan ID
    $sql = mysqli_query($koneksi, "DELETE FROM master_jenis_pendapatan WHERE id_jenis_pendapatan = '$hapus_id_jenis_pendapatan'");

    // Cek apakah query berhasil dieksekusi
    if ($sql && mysqli_affected_rows($koneksi) > 0) { // Pastikan ada baris yang terhapus
        header("location: master_jenis_pendapatan.php"); // Redirect ke halaman master_jenis_pendapatan.php setelah berhasil
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada parameter atau parameter kosong
    echo "No jenis pendapatan specified for deletion.";
}
?>
