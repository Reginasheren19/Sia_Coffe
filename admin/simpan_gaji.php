<?php
// Koneksi ke database
include("../config/koneksi_mysql.php");  // Sesuaikan path koneksi Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $id_transaksi_karyawan = $_POST['id_transaksi_karyawan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan = $_POST['tunjangan'];
    $potongan = $_POST['potongan'];
    $gaji_lembur = $_POST['gaji_lembur'];
    $bonus = $_POST['bonus'];
    $gaji_bersih = $_POST['gaji_bersih'];
    $id_akun = $_POST['id_akun'];  // Gaji bersih sudah dihitung sebelumnya

    // Debugging: Log the received values
    error_log("Bulan: $bulan, Tahun: $tahun, ID Karyawan: $id_transaksi_karyawan, Gaji Pokok: $gaji_pokok, Tunjangan: $tunjangan, Potongan: $potongan, Gaji Lembur: $gaji_lembur, Bonus: $bonus, Gaji Bersih: $gaji_bersih, Akun: $id_akun");

    // Query untuk menyimpan data penggajian
    $query = "INSERT INTO transaksi_penggajian (
                id_transaksi_karyawan,
                bulan_gaji,
                tahun_gaji,
                gaji_pokok,
                tunjangan,
                potongan,
                gaji_lembur,
                bonus,
                gaji_bersih,
                id_akun
              ) 
              VALUES (
                '$id_transaksi_karyawan', 
                '$bulan', 
                '$tahun', 
                '$gaji_pokok', 
                '$tunjangan', 
                '$potongan', 
                '$gaji_lembur', 
                '$bonus', 
                '$gaji_bersih',
                '$id_akun'
              )";

    // Menjalankan query untuk menyimpan data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, tampilkan pesan sukses
        echo "<script>
                alert('Data berhasil disimpan');
                window.location.href = 'transaksi_penggajian.php';  // Sesuaikan dengan halaman tujuan
              </script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>
                alert('Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>
