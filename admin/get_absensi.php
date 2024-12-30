<?php
include("../config/koneksi_mysql.php");

if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

    // Query untuk mendapatkan data absensi
    $query = "SELECT 
        ak.id_absensi,
        ak.hadir,
        ak.sakit,
        ak.alpha,
        mk.nama_karyawan,
        mj.nama_jabatan
    FROM 
        absensi_karyawan ak
    JOIN transaksi_karyawan tk ON ak.id_transaksi_karyawan = tk.id_transaksi_karyawan
    JOIN master_karyawan mk ON tk.NIK = mk.NIK
    JOIN master_jabatan mj ON tk.id_jabatan = mj.id_jabatan
    WHERE ak.bulan = '$bulan' AND ak.tahun = '$tahun'";

    $result = mysqli_query($koneksi, $query);

    // Output hasil query dalam format HTML
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id_absensi']}</td>
                        <td>{$row['nama_karyawan']}</td>
                        <td>{$row['nama_jabatan']}</td>
                        <td>{$row['hadir']}</td>
                        <td>{$row['sakit']}</td>
                        <td>{$row['alpha']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Data absensi tidak ditemukan.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Error dalam pengambilan data: " . mysqli_error($koneksi) . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Parameter bulan dan tahun tidak valid.</td></tr>";
    }
?>
