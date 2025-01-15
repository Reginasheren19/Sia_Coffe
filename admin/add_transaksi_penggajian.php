<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/koneksi_mysql.php");

// Menyimpan data penggajian ke database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_transaksi_karyawan = mysqli_real_escape_string($koneksi, $_POST['id_transaksi_karyawan']);
    $periode_gaji = mysqli_real_escape_string($koneksi, $_POST['periode_gaji']);
    $gaji_pokok = mysqli_real_escape_string($koneksi, $_POST['gaji_pokok']);
    $tunjangan = mysqli_real_escape_string($koneksi, $_POST['tunjangan']);
    $potongan = mysqli_real_escape_string($koneksi, $_POST['potongan']);

    // Hitung gaji lembur berdasarkan absensi
    $query_lembur = "
        SELECT 
            id_transaksi_karyawan,
            SUM(GREATEST(0, TIME_TO_SEC(TIMEDIFF(waktu_keluar, waktu_masuk)) / 3600 - 8)) AS total_jam_lembur
        FROM 
            absensi
        WHERE 
            status = 'Hadir' AND 
            id_transaksi_karyawan = '$id_transaksi_karyawan' AND 
            tanggal LIKE '$periode_gaji%'
        GROUP BY 
            id_transaksi_karyawan
    ";

    $result_lembur = mysqli_query($koneksi, $query_lembur);
    if (!$result_lembur) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $gaji_lembur = 0;
    while ($row_lembur = mysqli_fetch_assoc($result_lembur)) {
        // Ambil total jam lembur
        $total_jam_lembur = $row_lembur['total_jam_lembur'];
        $jabatan_id = $row_lembur['jabatan_id'];

        // Ambil tarif lembur per jam dari master jabatan
        $query_tarif = "SELECT tarif_lembur FROM master_jabatan WHERE id = '$jabatan_id'";
        $result_tarif = mysqli_query($conn, $query_tarif);
        $row_tarif = mysqli_fetch_assoc($result_tarif);
        $tarif_lembur = $row_tarif['tarif_lembur'];
    
        // Hitung gaji lembur berdasarkan tarif lembur sesuai jabatan
        $gaji_lembur += $total_jam_lembur * $tarif_lembur;
    }
    
    // Hitung jumlah absensi alpha (tidak hadir)
$query_alpha = "
SELECT 
    COUNT(*) AS jumlah_alpha 
FROM 
    absensi 
WHERE 
    status = 'Alpha' AND 
    id_transaksi_karyawan = '$id_transaksi_karyawan' AND 
    tanggal LIKE '$periode_gaji%'
";
$result_alpha = mysqli_query($koneksi, $query_alpha);
$row_alpha = mysqli_fetch_assoc($result_alpha);
$jumlah_alpha = $row_alpha['jumlah_alpha'];

// Ambil tarif potongan per alpha dari master jabatan
$query_tarif_alpha = "SELECT tarif_potongan_per_alpha FROM master_jabatan WHERE id = '$jabatan_id'";
$result_tarif_alpha = mysqli_query($koneksi, $query_tarif_alpha);
$row_tarif_alpha = mysqli_fetch_assoc($result_tarif_alpha);
$tarif_potongan_per_alpha = $row_tarif_alpha['tarif_potongan_per_alpha'];

// Hitung total potongan berdasarkan jumlah alpha dan tarif potongan per alpha
$total_potongan = $jumlah_alpha * $tarif_potongan_per_alpha;


    // Hitung gaji bersih
    $gaji_bersih = $gaji_pokok + $tunjangan + $gaji_lembur - $potongan;
    

    // Insert data penggajian ke tabel transaksi_penggajian
    $sql = "INSERT INTO transaksi_penggajian 
            (id_transaksi_karyawan, periode_gaji, gaji_pokok, tunjangan, potongan, gaji_lembur, gaji_bersih) 
            VALUES ('$id_transaksi_karyawan', '$periode_gaji', '$gaji_pokok', '$tunjangan', '$potongan', '$gaji_lembur', '$gaji_bersih')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data penggajian berhasil ditambahkan!'); window.location.href='transaksi_penggajian.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
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
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Karyawan</h1>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gajiModal">
    Add Data
    </button>
    <!-- Tabel Data Karyawan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat Karyawan</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telpon</th>
                    <th>Email</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM master_karyawan");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['NIK']}</td>
                            <td>{$row['nama_karyawan']}</td>
                            <td>{$row['alamat_karyawan']}</td>
                            <td>{$row['tgl_lahir']}</td>
                            <td>{$row['jenis_kelamin']}</td>
                            <td>{$row['no_telp']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['tgl_bergabung']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="gajiModal" tabindex="-1" aria-labelledby="gajiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gajiModalLabel">Tambah Penggajian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form untuk menambahkan penggajian -->
        <form action="add_transaksi_penggajian.php" method="POST">
          <div class="form-group">
            <label for="id_transaksi_karyawan">ID Transaksi Karyawan:</label>
            <input type="text" name="id_transaksi_karyawan" id="id_transaksi_karyawan" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="periode_gaji">Periode Gaji (Bulan/Tahun):</label>
            <input type="month" name="periode_gaji" id="periode_gaji" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="gaji_pokok">Gaji Pokok:</label>
            <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tunjangan">Tunjangan:</label>
            <input type="number" name="tunjangan" id="tunjangan" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="potongan">Potongan:</label>
            <input type="number" name="potongan" id="potongan" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Tambah Penggajian</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
