<?php
// Mulai sesi
session_start();

// Hapus semua sesi
session_unset();
session_destroy();

// Arahkan ke halaman login
header("Location: login.php");
exit();
?>
