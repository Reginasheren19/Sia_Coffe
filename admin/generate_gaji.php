<?php
include('config.php'); // Pastikan ini sesuai dengan konfigurasi koneksi database Anda

header('Content-Type: application/json'); // Set header untuk JSON

// Ambil data yang dikirimkan melalui POST
$id_transaksi_karyawan = $_POST['id_transaksi_karyawan'];
$bulan_gaji = $_POST['bulan_gaji'];
$tahun_gaji = $_POST['tahun_gaji'];

if ($id_transaksi_karyawan && $bulan_gaji && $tahun_gaji) {
    // Query untuk mengambil data gaji dan menghitung gaji berdasarkan bulan dan tahun
    $query = "SELECT 
            tk.id_transaksi_karyawan,
            mk.nama_karyawan,
            mj.nama_jabatan,
            md.nama_divisi,
            mj.gaji_pokok,
            mj.tunjangan,
            tp.bonus,
            (SUM(ak.alpha) * mj.potongan) AS potongan,
            (SUM(ak.jam_lembur) * mj.upah_lembur) AS gaji_lembur,
            (mj.gaji_pokok + mj.tunjangan + tp.bonus - (SUM(ak.alpha) * mj.potongan) + (SUM(ak.jam_lembur) * mj.upah_lembur)) AS gaji_bersih
        FROM 
            transaksi_karyawan tk
        JOIN 
            master_karyawan mk ON tk.NIK = mk.NIK
        JOIN 
            master_jabatan mj ON tk.id_jabatan = mj.id_jabatan
        JOIN 
            master_divisi md ON tk.id_divisi = md.id_divisi
        LEFT JOIN 
            absensi_karyawan ak ON tk.id_transaksi_karyawan = ak.id_transaksi_karyawan 
                                AND ak.bulan = '$bulan_gaji' 
                                AND ak.tahun = '$tahun_gaji'
        LEFT JOIN 
            transaksi_penggajian tp ON tk.id_transaksi_karyawan = tp.id_transaksi_karyawan 
                                AND tp.bulan_gaji = '$bulan_gaji' 
                                AND tp.tahun_gaji = '$tahun_gaji'
        WHERE 
            tk.id_transaksi_karyawan = '$id_transaksi_karyawan'
        GROUP BY 
            tk.id_transaksi_karyawan
    ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $dataGaji = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'data' => $dataGaji]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Data gaji tidak ditemukan']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container-fluid px-4">
    <h1 class="mt-4">Penggajian Karyawan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Penggajian Karyawan</li>
    </ol>
    <div class="mb-3 d-flex justify-content-end">
        <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#addGajiModal">
            Generate Gaji
        </button>
    </div>
<!-- Form untuk memilih bulan dan tahun -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Data Gaji Karyawan
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-3">
                    <label for="bulan">Bulan</label>
                    <select class="form-control ml-3" name="bulan" id="bulan">
                        <option value="">Pilih Bulan</option>
                        <option value="01" <?php echo ($bulan == '01') ? 'selected' : ''; ?>>Januari</option>
                        <option value="02" <?php echo ($bulan == '02') ? 'selected' : ''; ?>>Februari</option>
                        <option value="03" <?php echo ($bulan == '03') ? 'selected' : ''; ?>>Maret</option>
                        <option value="04" <?php echo ($bulan == '04') ? 'selected' : ''; ?>>April</option>
                        <option value="05" <?php echo ($bulan == '05') ? 'selected' : ''; ?>>Mei</option>
                        <option value="06" <?php echo ($bulan == '06') ? 'selected' : ''; ?>>Juni</option>
                        <option value="07" <?php echo ($bulan == '07') ? 'selected' : ''; ?>>Juli</option>
                        <option value="08" <?php echo ($bulan == '08') ? 'selected' : ''; ?>>Agustus</option>
                        <option value="09" <?php echo ($bulan == '09') ? 'selected' : ''; ?>>September</option>
                        <option value="10" <?php echo ($bulan == '10') ? 'selected' : ''; ?>>Oktober</option>
                        <option value="11" <?php echo ($bulan == '11') ? 'selected' : ''; ?>>November</option>
                        <option value="12" <?php echo ($bulan == '12') ? 'selected' : ''; ?>>Desember</option>
                    </select>
                </div>
                <div class="form-group mb-2 ml-5">
                    <label for="tahun">Tahun</label>
                    <select class="form-control ml-3" name="tahun" id="tahun">
                        <option value="">Pilih Tahun</option>
                        <?php 
                        $tahun_sekarang = date('Y');
                        for ($i = 2023; $i <= $tahun_sekarang + 5; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo ($tahun == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3
                    d-flex justify-content-end">
                    <button type="submit" class="btn btn-success" formaction="get_gaji.php?bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>">
                        Tampilkan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Data Gaji Karyawan
            </div>
            <div class="card-body">
                <form class="form-inline">
                    <div class="form-group mb-3">
                        <label for="bulan">Bulan</label>
                        <select class="form-control ml-3" name="bulan" id="bulan">
                            <option value="">Pilih Bulan</option>
                            <option value="01" <?php echo ($bulan == '01') ? 'selected' : ''; ?>>Januari</option>
                            <option value="02" <?php echo ($bulan == '02') ? 'selected' : ''; ?>>Februari</option>
                            <option value="03" <?php echo ($bulan == '03') ? 'selected' : ''; ?>>Maret</option>
                            <option value="04" <?php echo ($bulan == '04') ? 'selected' : ''; ?>>April</option>
                            <option value="05" <?php echo ($bulan == '05') ? 'selected' : ''; ?>>Mei</option>
                            <option value="06" <?php echo ($bulan == '06') ? 'selected' : ''; ?>>Juni</option>
                            <option value="07" <?php echo ($bulan == '07') ? 'selected' : ''; ?>>Juli</option>
                            <option value="08" <?php echo ($bulan == '08') ? 'selected' : ''; ?>>Agustus</option>
                            <option value="09" <?php echo ($bulan == '09') ? 'selected' : ''; ?>>September</option>
                            <option value="10" <?php echo ($bulan == '10') ? 'selected' : ''; ?>>Oktober</option>
                            <option value="11" <?php echo ($bulan == '11') ? 'selected' : ''; ?>>November</option>
                            <option value="12" <?php echo ($bulan == '12') ? 'selected' : ''; ?>>Desember</option>
                        </select>
                    </div>
                    <div class="form-group mb-2 ml-5">
                        <label for="tahun">Tahun</label>
                        <select class="form-control ml-3" name="tahun" id="tahun">
                            <option value="">Pilih Tahun</option>
                            <?php 
                            $tahun_sekarang = date('Y');
                            for ($i = 2023; $i <= $tahun_sekarang + 5; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php echo ($tahun == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" formaction="get_gaji.php?bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>">
                            Tampilkan Data
                        </button>
                        <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#addGajiModal" onclick="setBulanTahun('<?php echo $bulan; ?>', '<?php echo $tahun; ?>')">
                            Generate Gaji
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal Tambah Gaji -->
        <div class="modal fade" id="addGajiModal" tabindex="-1" aria-labelledby="addGajiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="add_gaji.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addGajiModalLabel">Tambah Data Gaji</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Dropdown Bulan -->
                            <div class="mb-3">
                                <label for="modal_bulan" class="form-label">Bulan</label>
                                <select class="form-control" name="modal_bulan" id="modal_bulan" required>
                                    <option value="">Pilih Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>

                            <!-- Dropdown Tahun -->
                            <div class="mb-3">
                                <label for="modal_tahun" class="form-label">Tahun</label>
                                <select class="form-control" name="modal_tahun" id="modal_tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    <?php 
                                    $tahun_sekarang = date('Y');
                                    for ($i = 2023; $i <= $tahun_sekarang + 5; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Dropdown Karyawan -->
                            <div class="mb-3">
                                <label for="id_transaksi_karyawan" class="form-label">Karyawan</label>
                                <select class="form-control" name="id_transaksi_karyawan" id="id_transaksi_karyawan" required>
                                    <option value="">Pilih Karyawan</option>
                                    <?php
                                    $query = "
                                        SELECT 
                                            tk.id_transaksi_karyawan, 
                                            mk.nama_karyawan 
                                        FROM transaksi_karyawan tk
                                        JOIN master_karyawan mk ON tk.NIK = mk.NIK
                                    ";
                                    $result = mysqli_query($koneksi, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id_transaksi_karyawan']}'>{$row['nama_karyawan']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Gaji Pokok -->
                            <div class="mb-3">
                                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" readonly>
                            </div>

                            <!-- Tunjangan -->
                            <div class="mb-3">
                                <label for="tunjangan" class="form-label">Tunjangan</label>
                                <input type="text" class="form-control" id="tunjangan" name="tunjangan" readonly>
                            </div>

                            <!-- Potongan -->
                            <div class="mb-3">
                                <label for="potongan" class="form-label">Potongan</label>
                                <input type="text" class="form-control" id="potongan" name="potongan" readonly>
                            </div>

                            <!-- Gaji Lembur -->
                            <div class="mb-3">
                                <label for="gaji_lembur" class="form-label">Gaji Lembur</label>
                                <input type="text" class="form-control" id="gaji_lembur" name="gaji_lembur" readonly>
                            </div>

                            <!-- Bonus -->
                            <div class="mb-3">
                                <label for="bonus" class="form-label">Bonus</label>
                                <input type="number" class="form-control" id="bonus" name="bonus" required>
                            </div>

                            <!-- Gaji Bersih -->
                            <div class="mb-3">
                                <label for="gaji_bersih" class="form-label">Gaji Bersih</label>
                                <input type="text" class="form-control" id="gaji_bersih" name="gaji_bersih" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>