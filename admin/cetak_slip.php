<?php  
error_reporting(E_ALL & ~E_NOTICE); // Suppress notices  
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
    tp.gaji_bersih,
    tp.tanggal_penggajian 
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

if (!$result || mysqli_num_rows($result) == 0) {  
    // Redirect or show a different message without outputting error details  
    header('Location: error_page.php'); // Example redirection  
    exit;  
}  
$tanggal_penggajian = date('d-m-Y', strtotime($data['tanggal_penggajian']));
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
        max-width: 550px; /* Batas maksimal lebar container */  
        padding: 20px;  
        border: 1px solid #ccc;  
        border-radius: 8px;  
        background-color: #fff;  
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  
    }  
    .header {  
        text-align: center;  
        border: 2px solid #000;  /* Menambahkan border kotak */
        padding: 10px;  /* Memberikan jarak di dalam kotak */
        margin-bottom: 20px;  /* Jarak bawah agar tidak terlalu mepet dengan konten lainnya */
    }  
    .header h1 {
        margin: 0;  /* Menghilangkan margin default dari h1 */
        padding: 0;  /* Menghilangkan padding default dari h1 */
    } 
    .section {  
        margin-bottom: 30px;  
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
    .section p {
        display: flex;
        justify-content: space-between;
    }
    .section p span {
        flex: 1;
    }
    .section p .label {
        text-align: left;
    }
    .section p .value {
        text-align: right;
    }
        .bold {
        font-weight: bold;
    }
    
    @media print {
    @page {  
        size: 150mm 150mm; /* Set custom size for the slip gaji */  
        margin: 0; /* Remove margins */  
    }  
    body * {
        visibility: hidden; /* Sembunyikan semua elemen */
    }
    #slip-gaji, #slip-gaji * {
        visibility: visible; /* Tampilkan hanya slip gaji */
    }
    #slip-gaji {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }
}

</style>
  
</head>  
<body>  
    <div class="container" id="slip-gaji"> 
        <div class="header">  
            <h1>Slip Gaji Bulan <?php echo date('F Y'); ?></h1>   
        </div> 
        
        <div class="section">
            <p>Nama&nbsp;&nbsp;&nbsp;: <?php echo $data['nama_karyawan']; ?></p>  
            <p>NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['NIK']; ?></p> 
        </div>
        
        <div class="section">  
            <p><span class="label bold">Penghasilan</span></p>
            <p><span class="label">Gaji Pokok</span> <span class="value">Rp<?php echo number_format($data['gaji_pokok'], 0, ',', '.'); ?></span></p>
            <p><span class="label">Tunjangan</span> <span class="value">Rp<?php echo number_format($data['tunjangan'], 0, ',', '.'); ?></span></p>
            <p><span class="label">Gaji Lembur</span> <span class="value">Rp<?php echo number_format($data['gaji_lembur'], 0, ',', '.'); ?></span></p>
            <p><span class="label">Bonus</span> <span class="value">Rp<?php echo number_format($data['bonus'], 0, ',', '.'); ?></span></p>
        </div>  
        
        <div class="section">  
            <p><span class="label bold">Potongan</span></p>
            <p><span class="label">Potongan</span> <span class="value">Rp<?php echo number_format($data['potongan'], 0, ',', '.'); ?></span></p>
        </div>  
        
        <div class="section">  
            <p><span class="label bold">Gaji Bersih</span> <span class="value">Rp<?php echo number_format($data['gaji_bersih'], 0, ',', '.'); ?></span></p>  
        </div>

        
        <div class="footer">  
            <p>Tanggal: <?php echo $tanggal_penggajian; ?></p>
            <p>TOKO KOPI CINTA</p>  
        </div>  
    </div>  
</body>  
</html>
<script type="text/javascript">
    window.onload = function() {
        window.print();
    }
</script>
