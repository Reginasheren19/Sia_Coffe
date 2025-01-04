<?php
include("../config/koneksi_mysql.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bulan = $_POST['modal_bulan_gaji'];
    $tahun = $_POST['modal_tahun_gaji'];
    $id_karyawan = $_POST['id_transaksi_karyawan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan = $_POST['tunjangan'];
    $potongan = $_POST['potongan'];
    $gaji_lembur = $_POST['gaji_lembur'];
    $bonus = $_POST['bonus'];
    $gaji_bersih = $_POST['gaji_bersih'];

    $query = "
        INSERT INTO gaji_karyawan (bulan, tahun, id_karyawan, gaji_pokok, tunjangan, potongan, gaji_lembur, bonus, gaji_bersih)
        VALUES ('$bulan', '$tahun', '$id_karyawan', '$gaji_pokok', '$tunjangan', '$potongan', '$gaji_lembur', '$bonus', '$gaji_bersih')
    ";
    mysqli_query($koneksi, $query);

    header('Location: transaksi_penggajian.php');
}
?>
