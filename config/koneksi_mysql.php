<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$database = "sia_coffeeshop";

$koneksi = mysqli_connect($server, $user, $pass, $database);

// Tambahkan pemeriksaan koneksi
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Database connected successfully!";
}
?>
