<?php
function insert_jurnal_umum($tanggal, $keterangan, $id_akun, $debit, $kredit, $koneksi) {
    // Escape string untuk mencegah SQL injection
    $tanggal = mysqli_real_escape_string($koneksi, $tanggal);
    $keterangan = mysqli_real_escape_string($koneksi, $keterangan);
    $id_akun = mysqli_real_escape_string($koneksi, $id_akun);
    $debit = mysqli_real_escape_string($koneksi, $debit);
    $kredit = mysqli_real_escape_string($koneksi, $kredit);

    // Query untuk mencatat jurnal umum
    $query = "INSERT INTO jurnal_umum (tanggal, keterangan, id_akun, debit, kredit) 
              VALUES ('$tanggal', '$keterangan', '$id_akun', '$debit', '$kredit')";

    // Debugging: Log query sebelum eksekusi
    error_log("Executing query: $query");

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        return true;  // Jika berhasil
    } else {
        // Log error query jika gagal
        error_log("Error inserting data into jurnal_umum: " . mysqli_error($koneksi));
        return false;
    }
}
?>
