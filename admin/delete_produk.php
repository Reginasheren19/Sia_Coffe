<?php

    include("../config/koneksi_mysql.php");

    $hapus_id_karyawan = $_GET['id_karyawan'];

    $sql = mysqli_query($koneksi,

            "DELETE FROM master_produk WHERE id_karyawan = '$hapus_id_karyawan'");

if($sql){

    header("location: master_produk.php");

}

?>