<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['akun'])) {
    $hapus_id_akun = mysqli_real_escape_string($koneksi, $_GET['akun']);
    echo "ID akun yang akan dihapus: " . $hapus_id_akun . "<br>"; // Debugging

    $sql = mysqli_query($koneksi, "DELETE FROM master_akun WHERE id_akun = '$hapus_id_akun'");

    if ($sql) {
        header("location: master_akun.php");
        exit; // Pastikan untuk menghentikan eksekusi skrip setelah header
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "No supplier specified for deletion.";
}
?>