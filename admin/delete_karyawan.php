<?php

    include("../config/koneksi_mysql.php");

    $hapus_nik = $_GET['nik'];

    $sql = mysqli_query($koneksi,

            "DELETE FROM master_karyawan WHERE NIK = '$hapus_nik'");

if($sql){

    header("location: master_karyawan.php");

}

?>