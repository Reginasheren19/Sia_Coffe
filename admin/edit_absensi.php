<?php
include("../config/koneksi_mysql.php"); // Pastikan koneksi ke database sudah benar

// Periksa apakah bulan dan tahun ada di URL atau POST
$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : date('m');
$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : date('Y');

// Ambil data absensi yang ada di database berdasarkan bulan dan tahun
$query = "UPDATE 
            absensi_karyawan ak
          JOIN 
            transaksi_karyawan tk ON ak.id_transaksi_karyawan = tk.id_transaksi_karyawan
          JOIN 
            master_karyawan mk ON tk.NIK = mk.NIK
          JOIN 
            master_jabatan mj ON tk.id_jabatan = mj.id_jabatan
          SET 
            ak.hadir = '$hadir', 
            ak.sakit = '$sakit', 
            ak.alpha = '$alpha'
          WHERE 
            ak.bulan = '$bulan' AND ak.tahun = '$tahun'";


$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error pada query: ' . mysqli_error($koneksi));
}

$absensi_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $absensi_data[] = $row; // Menyimpan data absensi yang ada
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
</head>
<body>

    <h3>Edit Absensi Karyawan</h3>
    <form method="POST" action="edit_absensi.php">
        
        <!-- Pilihan Bulan -->
        <div class="form-group mb-3">
            <label for="bulan">Bulan</label>
            <select class="form-control" name="bulan" id="bulan">
                <option value="01" <?php if ($bulan == '01') echo 'selected'; ?>>Januari</option>
                <option value="02" <?php if ($bulan == '02') echo 'selected'; ?>>Februari</option>
                <option value="03" <?php if ($bulan == '03') echo 'selected'; ?>>Maret</option>
                <option value="04" <?php if ($bulan == '04') echo 'selected'; ?>>April</option>
                <option value="05" <?php if ($bulan == '05') echo 'selected'; ?>>Mei</option>
                <option value="06" <?php if ($bulan == '06') echo 'selected'; ?>>Juni</option>
                <option value="07" <?php if ($bulan == '07') echo 'selected'; ?>>Juli</option>
                <option value="08" <?php if ($bulan == '08') echo 'selected'; ?>>Agustus</option>
                <option value="09" <?php if ($bulan == '09') echo 'selected'; ?>>September</option>
                <option value="10" <?php if ($bulan == '10') echo 'selected'; ?>>Oktober</option>
                <option value="11" <?php if ($bulan == '11') echo 'selected'; ?>>November</option>
                <option value="12" <?php if ($bulan == '12') echo 'selected'; ?>>Desember</option>
            </select>
        </div>

        <!-- Pilihan Tahun -->
        <div class="form-group mb-2 ml-5">
            <label for="tahun">Tahun</label>
            <select class="form-control" name="tahun" id="tahun">
                <?php 
                $current_year = date('Y');
                for ($i = 2023; $i <= $current_year + 5; $i++) { ?>
                    <option value="<?php echo $i; ?>" <?php if ($tahun == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Data Absensi -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Nama Jabatan</th>
                    <th>Hadir</th>
                    <th>Sakit</th>
                    <th>Alpha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absensi_data as $data) { ?>
                    <tr>
                        <td><?php echo $data['nama_karyawan']; ?></td>
                        <td><?php echo $data['nama_jabatan']; ?></td>
                        <td><input type="number" name="hadir[<?php echo $data['id_transaksi_karyawan']; ?>]" value="<?php echo $data['hadir']; ?>"></td>
                        <td><input type="number" name="sakit[<?php echo $data['id_transaksi_karyawan']; ?>]" value="<?php echo $data['sakit']; ?>"></td>
                        <td><input type="number" name="alpha[<?php echo $data['id_transaksi_karyawan']; ?>]" value="<?php echo $data['alpha']; ?>"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <button type="submit" name="submit">Update Absensi</button>

    </form>

</body>
</html>
