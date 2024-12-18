<?php

    include("../config/koneksi_mysql.php");

    $hapus_id_jadwal = $_GET['jadwal'];

    $sql = mysqli_query($koneksi,

            "DELETE FROM master_karyawan WHERE id_jadwal = '$hapus_id_jadwal'");

if($sql){

    header("location: master_karyawan.php");

}

?>