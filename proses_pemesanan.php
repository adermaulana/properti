<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login sebagai pelanggan
if(!isset($_SESSION['username_pelanggan'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah form sudah di-submit
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['beli'])) {
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $id_properti = $_POST['id_properti'];
    
    // Query untuk insert ke tabel transaksi
    $query = "INSERT INTO transaksi_222146 (
                id_pengguna_222146,
                id_properti_222146,
                tanggal_transaksi_222146,
                status_222146
              ) VALUES (
                '$id_pelanggan',
                '$id_properti',
                NOW(),
                'pending'
              )";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result) {
        $id_transaksi = mysqli_insert_id($koneksi);
        header("Location: pembayaran.php?id=" . $id_transaksi);
        exit();
    } else {
        $_SESSION['error'] = "Gagal memproses pemesanan: " . mysqli_error($koneksi);
        header("Location: detail.php?id=" . $id_properti);
        exit();
    }
}
?>