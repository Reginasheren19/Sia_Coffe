<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['transaksi_karyawan'])) {
    $hapus_id_transaksi_karyawan = mysqli_real_escape_string($koneksi, $_GET['transaksi_karyawan']);

    // Query untuk menghapus data
    $sql = mysqli_query($koneksi, "DELETE FROM transaksi_karyawan WHERE id_transaksi_karyawan = '$hapus_id_transaksi_karyawan'");

    if ($sql) {
        // Redirect setelah berhasil menghapus
        header("Location: transaksi_karyawan.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No transaction ID specified for deletion.";
}
?>