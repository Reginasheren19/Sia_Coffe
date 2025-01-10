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
      // Jika berhasil, masukkan data ke jurnal umum
      $tanggal_penggajian = date('Y-m-d'); // Ambil tanggal saat ini
  
      // Query untuk mendapatkan nama akun dan kode akun berdasarkan id_akun
      $query_akun = "SELECT nama_akun, kode_akun FROM master_akun WHERE id_akun = '$id_akun'";
      $result_akun = mysqli_query($koneksi, $query_akun);
      
      if ($result_akun && mysqli_num_rows($result_akun) > 0) {
          $akun_data = mysqli_fetch_assoc($result_akun);

          error_log("Gaji Bersih: " . $_POST['gaji_bersih']);
          // Query untuk jurnal debit (gaji bersih)
          $query_jurnal_debit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                                 VALUES ('$tanggal_penggajian', 'Beban Gaji', '1', '$gaji_bersih', 0)";
          
          // Query untuk jurnal kredit (kas)
          $query_jurnal_kredit = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit)
                                  VALUES ('$tanggal_penggajian', 'Kas', '2', 0, '$gaji_bersih')";
          
          // Eksekusi kedua query jurnal umum
          if (mysqli_query($koneksi, $query_jurnal_debit) && mysqli_query($koneksi, $query_jurnal_kredit)) {
              echo "<script>
                      alert('Data gaji dan jurnal umum berhasil disimpan');
                      window.location.href = 'transaksi_penggajian.php';  // Sesuaikan halaman tujuan
                    </script>";
          } else {
              echo "<script>
                      alert('Data gaji berhasil disimpan, tetapi terjadi kesalahan pada jurnal umum');
                    </script>";
          }
      } else {
          echo "<script>
                  alert('Data gaji berhasil disimpan, tetapi akun tidak ditemukan');
                </script>";
      }
  } else {
      // Jika query penggajian gagal
      echo "<script>
              alert('Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi) . "');
            </script>";
  }
}
?>
