<?php
include("../config/koneksi_mysql.php");
ini_set('display_errors', 0);  // Matikan tampilan error
error_reporting(E_ALL); 

$response = null; // Inisialisasi variabel response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $id_transaksi_karyawan = $_POST['id_transaksi_karyawan'];

    // Fetch employee salary details from the database
    $query = "SELECT 
            tk.id_transaksi_karyawan,
            mk.nama_karyawan,
            mj.nama_jabatan,
            md.nama_divisi,
            mj.gaji_pokok,
            mj.tunjangan,
            tp.bonus,
            (COALESCE(SUM(ak.alpha), 0) * mj.potongan) AS potongan,
            (COALESCE(SUM(ak.jam_lembur), 0) * mj.upah_lembur) AS gaji_lembur,
            (mj.gaji_pokok + mj.tunjangan + COALESCE(tp.bonus, 0) - (COALESCE(SUM(ak.alpha), 0) * mj.potongan) + (COALESCE(SUM(ak.jam_lembur), 0) * mj.upah_lembur)) AS gaji_bersih
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
                                AND ak.bulan = '$bulan' 
                                AND ak.tahun = '$tahun'
        LEFT JOIN 
            transaksi_penggajian tp ON tk.id_transaksi_karyawan = tp.id_transaksi_karyawan 
                                AND tp.bulan_gaji = '$bulan' 
                                AND tp.tahun_gaji = '$tahun'
        WHERE 
            tk.id_transaksi_karyawan = '$id_transaksi_karyawan'
        GROUP BY 
            tk.id_transaksi_karyawan
    ";
    
    $result = mysqli_query($koneksi, $query);  
    if ($result) {  
        $data = mysqli_fetch_assoc($result);  

        if ($data) {  
            // Prepare response  
            $response = [  
                'success' => true,  
                'data' => $data  
            ];             
            // Set individual variables for further use if needed  
            $gaji_pokok = $data['gaji_pokok'];  
            $tunjangan = $data['tunjangan'];  
            $potongan = $data['potongan'];  
            $gaji_lembur = $data['gaji_lembur'];  
            $gaji_bersih = $data['gaji_bersih'];   
        } else {  
            $response = [  
                'success' => false,  
                'message' => 'Data gaji tidak ditemukan.'  
            ];  
        }  
    } else {  
        // Handle query failure  
        $response = [  
            'success' => false,  
            'message' => 'Query error: ' . mysqli_error($koneksi)  
        ];  
    }  
}  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Revenue Cycle</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pendapatan
                        </a>
                        <div class="sb-sidenav-menu-heading">Expenditure Cycle</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Pengeluaran
                        </a>
                        <a class="nav-link" href="pelunasan_hutang.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Pelunasan Hutang
                            </a>
                        <div class="sb-sidenav-menu-heading">Payroll Cycle</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Kelola Karyawan
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Penggajian
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Rekap Presensi
                        </a>
                        <div class="sb-sidenav-menu-heading">Report Cycle</div>
                        <a class="nav-link" href="jurnal_umum.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Jurnal Umum
                        </a>
                        <a class="nav-link" href="buku_besar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Buku Besar
                        </a>
                        <div class="sb-sidenav-menu-heading">Mastering</div>
                        <a class="nav-link" href="master_karyawan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Karyawan
                        </a>
                        <a class="nav-link" href="master_jabatan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Jabatan
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Divisi
                        </a>
                        <a class="nav-link" href="master_produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Produk
                        </a>
                        <a class="nav-link" href="master_jenis_pendapatan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> 
                            Data Jenis Pendapatan
                        </a>
                        <a class="nav-link" href="master_metode_pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Metode Pembayaran
                        </a>
                        <a class="nav-link" href="master_customer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Customer
                        </a>
                        <a class="nav-link" href="master_supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Supplier
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Generate Gaji</h1>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-control" name="bulan" id="bulan" required>
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
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-control" name="tahun" id="tahun" required>
                                <option value="">Pilih Tahun</option>
                                <?php 
                                $tahun_sekarang = date('Y');
                                for ($i = 2023; $i <= $tahun_sekarang + 5; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for ="id_transaksi_karyawan" class="form-label">Karyawan</label>
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
                        <button type="submit" class="btn btn-primary">Hitung Gaji</button>
                    </form>

                    <?php if (isset($response)): ?>
                    <h3>Detail Gaji</h3>
                    <?php if ($response['success']): ?>
                        <form method="POST" action="simpan_gaji.php"> <!-- Ganti dengan URL yang sesuai untuk menyimpan data -->
                            <div>
                                <div class="form-group">
                                    <label for="nama_karyawan">Nama Karyawan:</label>
                                    <input type="text" id="nama_karyawan" value="<?php echo $response['data']['nama_karyawan']; ?>" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama_jabatan">Jabatan:</label>
                                    <input type="text" id="nama_jabatan" value="<?php echo $response['data']['nama_jabatan']; ?>" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama_divisi">Divisi:</label>
                                    <input type="text" id="nama_divisi" value="<?php echo $response['data']['nama_divisi']; ?>" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="gaji_pokok">Gaji Pokok:</label>
                                    <input type="text" id="gaji_pokok" name="gaji_pokok" value="<?php echo $response['data']['gaji_pokok']; ?>" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tunjangan">Tunjangan:</label>
                                    <input type="text" id="tunjangan" name="tunjangan" value="<?php echo $response['data']['tunjangan']; ?>" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="potongan">Potongan:</label>
                                    <input type="text" id="potongan" name="potongan" value="<?php echo $response['data']['potongan']; ?>" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="gaji_lembur">Gaji Lembur:</label>
                                    <input type="text" id="gaji_lembur" name="gaji_lembur" value="<?php echo $response['data']['gaji_lembur']; ?>" class="form-control" disabled>
                                </div>
                                
                                <!-- Input Bonus -->
                                <div class="form-group">
                                    <label for="bonus">Bonus:</label>
                                    <input type="number" id="bonus" name="bonus" value="" class="form-control" oninput="updateGajiBersih()">
                                </div>

                                <!-- Gaji Bersih -->
                                <div class="form-group">
                                    <label for="gaji_bersih">Gaji Bersih:</label>
                                    <input type="text" id="gaji_bersih" name="gaji_bersih" value="<?php echo $response['data']['gaji_bersih']; ?>" class="form-control" disabled>
                                </div>

                                <!-- Hidden Fields to Keep Transaction Data -->
                                <input type="hidden" name="id_transaksi_karyawan" value="<?php echo $response['data']['id_transaksi_karyawan']; ?>">
                                <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
                                <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
                                <input type="hidden" name="gaji_pokok" value="<?php echo $gaji_pokok; ?>">
                                <input type="hidden" name="tunjangan" value="<?php echo $tunjangan; ?>">
                                <input type="hidden" name="potongan" value="<?php echo $potongan; ?>">
                                <input type="hidden" name="gaji_lembur" value="<?php echo $gaji_lembur; ?>">
                                <input type="hidden" name="gaji_bersih" value="<?php echo $gaji_bersih; ?>">
                                <input type="hidden" name="id_akun" value="1">


                                <!-- Submit and Cancel Buttons -->
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="halaman_awal.php" class="btn btn-danger">Batal</a> <!-- Ganti dengan URL halaman yang sesuai -->
                            </div>
                        </form>
                    <?php else: ?>
                        <p><?php echo $response['message']; ?></p>
                    <?php endif; ?>
                <?php endif; ?>

                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        function updateGajiBersih() {
            // Ambil nilai input yang diperlukan
            var gajiPokok = parseFloat(document.getElementById('gaji_pokok').value);
            var tunjangan = parseFloat(document.getElementById('tunjangan').value);
            var potongan = parseFloat(document.getElementById('potongan').value);
            var gajiLembur = parseFloat(document.getElementById('gaji_lembur').value);
            var bonus = parseFloat(document.getElementById('bonus').value) || 0;

            // Perhitungan Gaji Bersih
            var gajiBersih = gajiPokok + tunjangan + bonus - potongan + gajiLembur;

            // Update nilai gaji bersih
            document.getElementById('gaji_bersih').value = gajiBersih.toFixed(2);
        }
    </script>
</body>
</html>