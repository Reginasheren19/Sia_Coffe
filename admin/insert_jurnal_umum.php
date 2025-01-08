<?php
include("../config/koneksi_mysql.php");
ini_set('display_errors', 0);  // Matikan tampilan error
error_reporting(E_ALL); 

$response = null; // Inisialisasi variabel response

// Memeriksa metode request POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Query untuk mengambil data transaksi penggajian berdasarkan bulan dan tahun
    $query_gaji = "SELECT * FROM transaksi_penggajian 
                   WHERE bulan = '$bulan' AND tahun = '$tahun'"; // Menyesuaikan periode gaji
    $result_gaji = mysqli_query($koneksi, $query_gaji);

    if (mysqli_num_rows($result_gaji) > 0) {
        while ($row = mysqli_fetch_assoc($result_gaji)) {
            $id_penggajian = $row['id_penggajian'];
            $gaji_bersih = $row['gaji_bersih'];
            $id_akun = $row['id_akun'];
            $tanggal_penggajian = $row['tanggal_penggajian'];

            // Ambil data akun berdasarkan id_akun dari master_akun untuk debit
            $query_akun = "SELECT * FROM master_akun WHERE id_akun = $id_akun";
            $result_akun = mysqli_query($koneksi, $query_akun);
            $akun = mysqli_fetch_assoc($result_akun);
            $nama_akun = $akun['nama_akun'];
            $kode_akun = $akun['kode_akun'];  // Ambil kode akun

            // Ambil informasi akun kas (id_akun 1001) untuk kredit
            $query_akun_kas = "SELECT * FROM master_akun WHERE id_akun = 2"; // id_akun kas yang benar
            $result_akun_kas = mysqli_query($koneksi, $query_akun_kas);
            $akun_kas = mysqli_fetch_assoc($result_akun_kas);
            $nama_akun_kas = $akun_kas['nama_akun'];
            $kode_akun_kas = $akun_kas['kode_akun'];  // Ambil kode akun kas

            // Menampilkan informasi transaksi penggajian yang ditemukan
            echo "ID Penggajian: " . $id_penggajian . "<br>";
            echo "Gaji Bersih: " . number_format($gaji_bersih, 2) . "<br>";
            echo "Nama Akun: " . $nama_akun . "<br>";
            echo "Kode Akun: " . $kode_akun . "<br>";  // Menampilkan kode akun
            echo "Tanggal Penggajian: " . $tanggal_penggajian . "<br><br>";

            // Insert untuk debit (gaji bersih)
            $query_debit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit) 
                            VALUES ('$tanggal_penggajian', '$nama_akun', '$id_akun', '$gaji_bersih', 0)";
            mysqli_query($koneksi, $query_debit);

            // Insert untuk kredit (kas)
            $query_kredit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit) 
                             VALUES ('$tanggal_penggajian', '$nama_akun_kas', '1001', 0, '$gaji_bersih')";
            mysqli_query($koneksi, $query_kredit);

            // Menampilkan data yang dimasukkan ke dalam jurnal_umum
            echo "Data Jurnal Umum (Debit):<br>";
            echo "Tanggal: " . $tanggal_penggajian . "<br>";
            echo "Keterangan: " . $nama_akun . "<br>";
            echo "Kode Akun: " . $kode_akun . "<br>";  // Menampilkan kode akun
            echo "Debit: " . number_format($gaji_bersih, 2) . "<br>";
            echo "Kredit: 0<br><br>";

            echo "Data Jurnal Umum (Kredit):<br>";
            echo "Tanggal: " . $tanggal_penggajian . "<br>";
            echo "Keterangan: " . $nama_akun_kas . "<br>";
            echo "Kode Akun: " . $kode_akun_kas . "<br>";  // Menampilkan kode akun kas
            echo "Debit: 0<br>";
            echo "Kredit: " . number_format($gaji_bersih, 2) . "<br><br>";
        }
        echo "Transaksi penggajian berhasil dimasukkan ke jurnal umum.";
    } else {
        echo "Tidak ada transaksi penggajian untuk bulan dan tahun yang dipilih.";
    }
} else {
    echo "Request method tidak valid.";
}

// Tutup koneksi
mysqli_close($koneksi);
?>
