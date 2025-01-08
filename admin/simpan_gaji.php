<?php
// Koneksi ke database
include("../config/koneksi_mysql.php");  // Sesuaikan dengan path koneksi Anda

// Menyertakan file jurnal umum
include("insert_jurnal_umum.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form dengan sanitasi input
    $bulan = mysqli_real_escape_string($koneksi, $_POST['bulan']);
    $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $id_transaksi_karyawan = mysqli_real_escape_string($koneksi, $_POST['id_transaksi_karyawan']);
    $gaji_pokok = mysqli_real_escape_string($koneksi, $_POST['gaji_pokok']);
    $tunjangan = mysqli_real_escape_string($koneksi, $_POST['tunjangan']);
    $potongan = mysqli_real_escape_string($koneksi, $_POST['potongan']);
    $gaji_lembur = mysqli_real_escape_string($koneksi, $_POST['gaji_lembur']);
    $bonus = mysqli_real_escape_string($koneksi, $_POST['bonus']);
    $gaji_bersih = mysqli_real_escape_string($koneksi, $_POST['gaji_bersih']);
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $tanggal_penggajian = date("Y-m-d");  // Mengambil tanggal saat ini

    // Query untuk mengambil nama_akun dan kode_akun dari master_akun
    $query_akun = "SELECT nama_akun, kode_akun FROM master_akun WHERE id_akun = ?";
    $stmt_akun = mysqli_prepare($koneksi, $query_akun);
    mysqli_stmt_bind_param($stmt_akun, 'i', $id_akun);
    mysqli_stmt_execute($stmt_akun);
    mysqli_stmt_bind_result($stmt_akun, $nama_akun, $kode_akun);
    mysqli_stmt_fetch($stmt_akun);
    mysqli_stmt_close($stmt_akun);

    // Debugging: Log values
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
                id_akun,
                tanggal_penggajian
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
                '$id_akun',
                '$tanggal_penggajian'
              )";

    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, catat Jurnal Umum
        $insert_debit = insert_jurnal_umum(
            $tanggal_penggajian, 
            $nama_akun, 
            $kode_akun, 
            $gaji_bersih, 
            0, 
            $koneksi
        );

        $insert_kredit = insert_jurnal_umum(
            $tanggal_penggajian, 
            'Kas', 
            '1001', 
            0, 
            $gaji_bersih, 
            $koneksi
        );

        // Debugging untuk mencatat jurnal umum
        if (!$insert_debit) {
            error_log("Gagal mencatat jurnal umum debit: $nama_akun ($kode_akun)");
        }
        if (!$insert_kredit) {
            error_log("Gagal mencatat jurnal umum kredit: Kas (1001)");
        }

        if ($insert_debit && $insert_kredit) {
            echo "<script>
                    alert('Data berhasil disimpan dan jurnal umum berhasil dicatat');
                    window.location.href = 'transaksi_penggajian.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal mencatat jurnal umum');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menyimpan data penggajian: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>
