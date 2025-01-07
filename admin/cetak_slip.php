<?php  
include("../config/koneksi_mysql.php");  

// Ambil data berdasarkan id_penggajian  
$id_penggajian = isset($_GET['id_penggajian']) ? $_GET['id_penggajian'] : '';  

// Query untuk mendapatkan data gaji  
$query = "SELECT   
    mk.nama_karyawan,  
    mk.NIK,  
    mj.nama_jabatan,  
    tp.gaji_pokok,  
    tp.tunjangan,  
    tp.potongan,  
    tp.gaji_lembur,  
    tp.bonus,  
    tp.gaji_bersih  
FROM   
    transaksi_penggajian tp  
JOIN   
    transaksi_karyawan tk ON tp.id_transaksi_karyawan = tk.id_transaksi_karyawan  
JOIN   
    master_karyawan mk ON tk.NIK = mk.NIK  
JOIN   
    master_jabatan mj ON tk.id_jabatan = mj.id_jabatan  
WHERE   
    tp.id_penggajian = '$id_penggajian'";  

$result = mysqli_query($koneksi, $query);  
$data = mysqli_fetch_assoc($result);  

if (!$data) {  
    echo "Data slip gaji tidak ditemukan.";  
    exit;  
}  
?>  

<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <title>Slip Gaji</title>  
    <style>  
        body {  
            font-family: Arial, sans-serif;  
        }  
        .container {  
            width: 80%;  
            margin: auto;  
        }  
        .header {  
            text-align: center;  
            border-bottom: 2px solid black;  
            margin-bottom: 20px;  
        }  
        .section {  
            margin-bottom: 20px;  
        }  
        .footer {  
            margin-top: 50px;  
            text-align: right;  
        }  
    </style>  
</head>  
<body>  
    <div class="container">  
        <div class="header">  
            <h1>Slip Gaji Bulan <?php echo date('F Y'); ?></h1>  
            <p>Nama: <?php echo $data['nama_karyawan']; ?></p>  
            <p>NIK: <?php echo $data['NIK']; ?></p>  
        </div>  
        
        <div class="section">  
            <h3>Penghasilan</h3>  
            <p>Gaji Pokok: <?php echo number_format($data['gaji_pokok'], 0, ',', '.'); ?></p>  
            <p>Tunjangan: <?php echo number_format($data['tunjangan'], 0, ',', '.'); ?></p>  
            <p>Gaji Lembur: <?php echo number_format($data['gaji_lembur'], 0, ',', '.'); ?></