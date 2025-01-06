<?php
include('config.php');

// Ambil data yang dikirimkan melalui POST
$id_transaksi_karyawan = $_POST['id_transaksi_karyawan'];
$bulan_gaji = $_POST['bulan_gaji'];
$tahun_gaji = $_POST['tahun_gaji'];
$gaji_pokok = $_POST['gaji_pokok'];
$tunjangan = $_POST['tunjangan'];
$bonus = $_POST['bonus'];
$potongan = $_POST['potongan'];
$gaji_lembur = $_POST['gaji_lembur'];
$gaji_bersih = $_POST['gaji_bersih'];

if ($id_transaksi_karyawan && $bulan_gaji && $tahun_gaji) {
    // Query untuk menyimpan data gaji
    $insertQuery = "INSERT INTO transaksi_penggajian 
                    (id_transaksi_karyawan, bulan_gaji, tahun_gaji, gaji_pokok, tunjangan, bonus, potongan, gaji_lembur, gaji_bersih) 
                    VALUES ('$id_transaksi_karyawan', '$bulan_gaji', '$tahun_gaji', '$gaji_pokok', '$tunjangan', '$bonus', '$potongan', '$gaji_lembur', '$gaji_bersih')";

    if (mysqli_query($conn, $insertQuery)) {
        echo json_encode(['success' => true, 'message' => 'Data gaji berhasil disimpan']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data gaji']);
    }
}
?>
