<?php

    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $database = "sia_coffeeshop";

    $koneksi = mysqli_connect($server, $user, $pass);
    mysqli_select_db($koneksi, $database);

    if(!$koneksi){
        die("Gagal connect Ke Server" . mysqli_connect_error() );
    }

?>