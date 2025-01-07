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
        display: flex;  
        justify-content: center;  
        align-items: center;  
        height: 100vh;  
        margin: 0;  
        background-color: #f4f4f4;  
    }  
    .container {  
        width: 80%; /* Mengatur lebar container agar lebih kecil */  
        max-width: 700px; /* Batas maksimal lebar container */  
        max-width: 700px; /* Batas maksimal lebar container */  

        padding: 20px;  
        border: 1px solid #ccc;  
        border-radius: 8px;  
        background-color: #fff;  
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  
    }  
    .header {  
        text-align: center;  
        border-bottom: 2px solid black;  
        margin-bottom: 20px;  
        padding-bottom: 10px;  
    }  
    .section {  
        margin-bottom: 20px;  
    }  
    .footer {  
        margin-top: 30px;  
        text-align: right;  
        font-weight: bold;  
    }  
    .row {
    display: flex;
    justify-content: space-between;
    }

    .left {
        text-align: left; /* Gaji Pokok rata kiri */
        flex: 1;
    }

    .right {
        text-align: right; /* Isinya rata kanan */
        flex: 1;
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
            <p>Gaji Lembur: <?php echo number_format($data['gaji_lembur'], 0, ',', '.'); ?></p>
            <p>Bonus: <?php echo number_format($data['bonus'], 0, ',', '.'); ?></p>  
        </div>  
        
        <div class="section">  
            <h3>Potongan</h3>  
            <p>Potongan: <?php echo number_format($data['potongan'], 0, ',', '.'); ?></p>  
        </div>  
        
        <div class="section">  
            <h3>Gaji Bersih</h3>  
            <p><?php echo number_format($data['gaji_bersih'], 0, ',', '.'); ?></p>  
        </div>  
        
        <div class="footer">  
            <p>Tanggal: <?php echo date('d-m-Y'); ?></p>  
            <p>TOKO KOPI CINTA</p>  
        </div>  
    </div>  
</body>  
</html>