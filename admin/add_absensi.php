<?php
include("../config/koneksi_mysql.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi_karyawan = $_POST['id_transaksi_karyawan'];
    $waktu_masuk = $_POST['waktu_masuk'];
    $waktu_keluar = $_POST['waktu_keluar'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Pastikan data tidak kosong
    if ($id_transaksi_karyawan && $waktu_masuk && $tanggal && $status) {
        $query = "INSERT INTO absensi (id_transaksi_karyawan, waktu_masuk, waktu_keluar, tanggal, status)
                  VALUES ('$id_transaksi_karyawan', '$waktu_masuk', '$waktu_keluar', '$tanggal', '$status')";

        if (mysqli_query($koneksi, $query)) {
            echo "Data berhasil disimpan!";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Semua data harus diisi!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Function untuk menangani waktu absen masuk dan keluar
    function setAbsenceTime(type) {
        const modal = document.querySelector('#addAbsensiModal');
        const waktuMasuk = modal.querySelector('#waktu_masuk');
        const waktuKeluar = modal.querySelector('#waktu_keluar');
        const tanggal = modal.querySelector('#tanggal');
        const status = modal.querySelector('#status');

        const now = new Date().toLocaleTimeString('en-GB', { hour12: false });
        const today = new Date().toISOString().split('T')[0]; // Tanggal hari ini
        tanggal.value = today;

        if (type === 'masuk') {
            waktuMasuk.value = now;
            status.value = 'Hadir';
        } else if (type === 'keluar') {
            waktuKeluar.value = now;
            status.value = 'Hadir';
        }

        // Submit form setelah waktu diatur
        modal.querySelector('form').submit();
    }
    </script>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Karyawan</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAbsensiModal">Tambah Absensi</button>

    <!-- Tabel Data Absensi Karyawan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Absensi</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data_absensi">
                <?php
                // Query data absensi dengan JOIN untuk mendapatkan nama karyawan
                $query = "
                SELECT 
                    a.id_absensi, 
                    a.tanggal, 
                    a.waktu_masuk, 
                    a.waktu_keluar, 
                    a.status, 
                    k.nama_karyawan
                FROM absensi a
                JOIN transaksi_karyawan t ON a.id_transaksi_karyawan = t.id_transaksi_karyawan
                JOIN master_karyawan k ON t.nik = k.nik";
                
                $result = mysqli_query($koneksi, $query);

                // Check if the query was successful
                if (!$result) {
                    die("Query failed: " . mysqli_error($koneksi));
                }

                // Tampilkan data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_absensi']}</td>
                        <td>{$row['nama_karyawan']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['waktu_masuk']}</td>
                        <td>{$row['waktu_keluar']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <button class='btn btn-primary btn-sm btn-update'>Update</button>
                            <a href='delete_absensi.php?id={$row['id_absensi']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this attendance record?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Absensi -->
    <div class="modal fade" id="addAbsensiModal" tabindex="-1" aria-labelledby="addAbsensiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAbsensiModalLabel">Tambah Absensi Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Pilih Karyawan -->
                        <div class="mb-3">
                            <label for="id_transaksi_karyawan" class="form-label">Pilih Karyawan</label>
                            <select class="form-select" id="id_transaksi_karyawan" name="id_transaksi_karyawan" required>
                                <option value="">Pilih Karyawan</option>
                                <?php
                                $karyawan = mysqli_query($koneksi, "
                                    SELECT tk.id_transaksi_karyawan, mk.nama_karyawan 
                                    FROM transaksi_karyawan tk
                                    INNER JOIN master_karyawan mk ON tk.NIK = mk.NIK
                                ");
                                while ($row = mysqli_fetch_assoc($karyawan)) {
                                    echo "<option value='{$row['id_transaksi_karyawan']}'>{$row['id_transaksi_karyawan']} - {$row['nama_karyawan']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" id="waktu_masuk" name="waktu_masuk">
                        <input type="hidden" id="waktu_keluar" name="waktu_keluar">
                        <input type="hidden" id="tanggal" name="tanggal">
                        <input type="hidden" id="status" name="status">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="setAbsenceTime('masuk')">Absen Masuk</button>
                        <button type="button" class="btn btn-warning" onclick="setAbsenceTime('keluar')">Absen Keluar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
