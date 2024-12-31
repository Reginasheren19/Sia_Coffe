<?php
include("../config/koneksi_mysql.php"); // Pastikan koneksi ke database sudah benar

// Ambil data dari form
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$hadir = $_POST['hadir'];
$sakit = $_POST['sakit'];
$alpha = $_POST['alpha'];

// Cek dan simpan data absensi
foreach ($hadir as $id_transaksi_karyawan => $value) {
    // Cek apakah data absensi sudah ada
    $query_check = "SELECT * FROM absensi_karyawan WHERE bulan = '$bulan' AND tahun = '$tahun' AND id_transaksi_karyawan = '$id_transaksi_karyawan'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Update data absensi
        $query_update = "UPDATE absensi_karyawan SET hadir = '$value', sakit = '{$sakit[$id_transaksi_karyawan]}', alpha = '{$alpha[$id_transaksi_karyawan]}' WHERE bulan = '$bulan' AND tahun = '$tahun' AND id_transaksi_karyawan = '$id_transaksi_karyawan'";
        mysqli_query($koneksi, $query_update);
    } else {
        // Insert data absensi baru
        $query_insert = "INSERT INTO absensi_karyawan (bulan, tahun, id_transaksi_karyawan, hadir, sakit, alpha) VALUES ('$bulan', '$tahun', '$id_transaksi_karyawan', '$value', '{$sakit[$id_transaksi_karyawan]}', '{$alpha[$id_transaksi_karyawan]}')";
        mysqli_query($koneksi, $query_insert);
    }
}

// Redirect ke halaman absensi
header("Location: get_absensi.php?bulan=$bulan&tahun=$tahun");
exit();
