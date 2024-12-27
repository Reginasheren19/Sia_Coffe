<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php"); // Pastikan koneksi ke database sudah benar

// Mengecek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $id_karyawan = mysqli_real_escape_string($koneksi, $_POST['id_karyawan']);
    $waktu_masuk = mysqli_real_escape_string($koneksi, $_POST['waktu_masuk']);
    $waktu_keluar = mysqli_real_escape_string($koneksi, $_POST['waktu_keluar']);
    $tanggal = date('Y-m-d'); // Menggunakan tanggal hari ini

    // Mengecek apakah tombol Absen Masuk atau Absen Keluar yang ditekan
    if (isset($_POST['absen_masuk'])) {
        // Jika tombol Absen Masuk ditekan, status = 'Hadir'
        $status = 'Hadir';
        
        // Insert data absen masuk ke database
        $sql = "INSERT INTO absensi (id_transaksi_karyawan, waktu_masuk, status, tanggal) 
                VALUES ('$id_karyawan', '$waktu_masuk', '$status', '$tanggal')";
    } 
    else if (isset($_POST['absen_keluar'])) {
        // Jika tombol Absen Keluar ditekan, status = 'Selesai'
        $status = 'Selesai';
        
        // Update data absen keluar di database (hanya yang status 'Hadir' yang dapat diupdate)
        $sql = "UPDATE absensi 
                SET waktu_keluar = '$waktu_keluar', status = '$status' 
                WHERE id_transaksi_karyawan = '$id_karyawan' 
                AND tanggal = '$tanggal' 
                AND status = 'Hadir' LIMIT 1";
    }

    // Mengeksekusi query untuk memasukkan data absensi
    if (mysqli_query($koneksi, $sql)) {
        // Jika berhasil, arahkan kembali ke halaman absensi
        echo "<script>alert('Data absensi berhasil ditambahkan!'); window.location.href='absensi.php';</script>";
    } else {
        // Jika ada error, tampilkan pesan error
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='absensi.php';</script>";
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
    // Fungsi untuk mengambil tanggal saat ini
    function getCurrentDate() {
        const date = new Date();
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return year + '-' + month + '-' + day;
    }

    // Fungsi untuk mengambil jam saat ini
    function getCurrentTime() {
        const time = new Date();
        return time.toLocaleTimeString('en-GB', { hour12: false }).slice(0, 5); // Format HH:MM
    }

    // Fungsi untuk set waktu absensi
    function setAbsenceTime(type) {
        const selectedKaryawan = document.getElementById('id_absensi').value;
        if (!selectedKaryawan) {
            alert("Pilih karyawan terlebih dahulu.");
            return;
        }

        const waktu = getCurrentTime();
        const tanggal = getCurrentDate();

        if (type === 'masuk') {
            // Set waktu masuk otomatis ke waktu saat ini
            document.querySelector('input[name="waktu_masuk"]').value = waktu;
            document.querySelector('input[name="tanggal"]').value = tanggal;
        } else if (type === 'keluar') {
            // Set waktu keluar otomatis ke waktu saat ini
            document.querySelector('input[name="waktu_keluar"]').value = waktu;
            document.querySelector('input[name="tanggal"]').value = tanggal;
        }

        // Submit form untuk menyimpan data absensi
        document.querySelector('form').submit();
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
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data_absensi">
                <?php
                // Query data absensi dari database
                $result = mysqli_query($koneksi, "SELECT a.id_absensi, a.id_transaksi_karyawan, a.tanggal, a.waktu_masuk, a.waktu_keluar, a.status FROM absensi a");

                // Check if the query was successful
                if (!$result) {
                    die("Query failed: " . mysqli_error($koneksi));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id_absensi']}</td>
                        <td>{$row['id_transaksi_karyawan']}</td>
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
                <form method="POST" action="add_absensi.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAbsensiModalLabel">Tambah Absensi Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Pilih Karyawan -->
                        <div class="mb-3">
                            <label for="id_absensi" class="form-label">Pilih Karyawan</label>
                            <select class="form-select" id="id_absensi" name="id_absensi" required>
                                <option value="">Pilih Karyawan</option>
                                <?php
                                // Ambil data karyawan untuk dropdown
                                $karyawan = mysqli_query($koneksi, "SELECT NIK, nama_karyawan FROM master_karyawan");
                                while ($row = mysqli_fetch_assoc($karyawan)) {
                                    echo "<option value='{$row['NIK']}'>{$row['NIK']} - {$row['nama_karyawan']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Tombol Absen Masuk -->
                        <button type="button" class="btn btn-success" onclick="setAbsenceTime('masuk')">Absen Masuk</button>

                        <!-- Tombol Absen Keluar -->
                        <button type="button" class="btn btn-warning" onclick="setAbsenceTime('keluar')">Absen Keluar</button>

                        <!-- Tombol Batal -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
