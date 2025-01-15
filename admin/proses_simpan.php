<?php
include("../config/koneksi_mysql.php");

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_customer = $_POST['id_customer'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $id_metode = $_POST['id_metode'];
    $id_produk = $_POST['id_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $harga_satuan = $_POST['harga_satuan'];
    $subtotal = $_POST['subtotal'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $sisa_pembayaran = $_POST['sisa_pembayaran'];
    $jumlah_dibayar = $_POST['jumlah_dibayar'];

    // Validasi subtotal
    if ($subtotal != $jumlah_produk * $harga_satuan) {
        echo "Error: Subtotal tidak valid.";
        exit();
    }

    // Query untuk menyimpan data
    $query = "INSERT INTO transaksi_pendapatan 
        (id_customer, tgl_transaksi, id_metode, id_produk, jumlah_produk, harga_satuan, subtotal, status_pembayaran, sisa_pembayaran, jumlah_dibayar)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('sssiiiisii', $id_customer, $tgl_transaksi, $id_metode, $id_produk, $jumlah_produk, $harga_satuan, $subtotal, $status_pembayaran, $sisa_pembayaran, $jumlah_dibayar);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan.";
        header("Location: transaksi_pendapatan.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
