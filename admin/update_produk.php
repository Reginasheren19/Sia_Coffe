<?php
include("../config/koneksi_mysql.php");

// Jika data dikirimkan melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nama_karyawan = $_POST['nama_karyawan'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $tgl_bergabung = $_POST['tgl_bergabung'];

    $sql = "UPDATE master_karyawan 
            SET nama_karyawan = '$nama_karyawan', alamat_karyawan = '$alamat', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', 
                no_telp = '$no_telp', email = '$email', tgl_bergabung = '$tgl_bergabung' 
            WHERE NIK = '$nik'";

    if (mysqli_query($koneksi, $sql)) {
        echo "Data berhasil diupdate!";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    exit; // Stop script to prevent HTML output
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Master Data Karyawan</h1>

    <!-- Tombol Tambah Data -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addKaryawanModal">Add Data</button>

    <!-- Tabel Data Karyawan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telpon</th>
                    <th>Email</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody id="data_karyawan">
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

<!-- Modal Update Data -->
<div class="modal fade" id="updateKaryawanModal" tabindex="-1" aria-labelledby="updateKaryawanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_update_karyawan">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateKaryawanModalLabel">Update Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update_nik" name="nik">
                    <div class="mb-3">
                        <label for="update_nama_karyawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="update_nama_karyawan" name="nama_karyawan" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="update_alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="update_tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="update_tgl_lahir" name="tgl_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="update_jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update_no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="update_no_telp" name="no_telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="update_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_tgl_bergabung" class="form-label">Tanggal Bergabung</label>
                        <input type="date" class="form-control" id="update_tgl_bergabung" name="tgl_bergabung" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).on('click', '.btn-update', function() {
    // Ambil data dari baris yang sesuai
    var row = $(this).closest('tr');
    var nik = row.find('td:eq(0)').text();
    var nama_karyawan = row.find('td:eq(1)').text();
    var alamat = row.find('td:eq(2)').text();
    var tgl_lahir = row.find('td:eq(3)').text();
    var jenis_kelamin = row.find('td:eq(4)').text();
    var no_telp = row.find('td:eq(5)').text();
    var email = row.find('td:eq(6)').text();
    var tgl_bergabung = row.find('td:eq(7)').text();

    // Isi modal dengan data yang diambil
    $('#update_nik').val(nik);
    $('#update_nama_karyawan').val(nama_karyawan);
    $('#update_alamat').val(alamat);
    $('#update_tgl_lahir').val(tgl_lahir);
    $('#update_jenis_kelamin').val(jenis_kelamin);
    $('#update_no_telp').val(no_telp);
    $('#update_email').val(email);
    $('#update_tgl_bergabung').val(tgl_bergabung);

    // Tampilkan modal
    $('#updateKaryawanModal').modal('show');
});

// Submit form update karyawan
$('#form_update_karyawan').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: "update_karyawan.php", // URL untuk proses update data
        method: "POST",
        data: $(this).serialize(),
        success: function(data) {
            alert(data);
            $('#form_update_karyawan')[0].reset(); // Reset form
            $('#updateKaryawanModal').modal('hide'); // Tutup modal
            location.reload(); // Refresh halaman
        }
    });
});
</script>
</body>
</html>
