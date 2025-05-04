<?php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login sebagai admin atau agen
if(!isset($_SESSION['username_agen'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah parameter id dan status ada
if(isset($_GET['id']) && isset($_GET['status'])) {
    $id_transaksi = $_GET['id'];
    $status = $_GET['status'];
    
    // Validasi status hanya bisa 'dikonfirmasi' atau 'batal'
    if($status != 'dikonfirmasi' && $status != 'batal') {
        $_SESSION['error'] = "Status tidak valid!";
        header("Location: pemesanan.php");
        exit();
    }
    
    // Update status transaksi
    $query = "UPDATE transaksi_222146 SET status_222146 = '$status' WHERE id_transaksi_222146 = '$id_transaksi'";
    $result = mysqli_query($koneksi, $query);
    
    if($result) {
        // Jika berhasil diupdate
        if($status == 'dikonfirmasi') {
            $_SESSION['success'] = "Pembayaran berhasil dikonfirmasi!";
            
            // Tambahan: update status properti menjadi 'terjual' jika diperlukan
            $get_properti = "SELECT id_properti_222146 FROM transaksi_222146 WHERE id_transaksi_222146 = '$id_transaksi'";
            $properti_result = mysqli_query($koneksi, $get_properti);
            if($row = mysqli_fetch_assoc($properti_result)) {
                $id_properti = $row['id_properti_222146'];
                $update_properti = "UPDATE properti_222146 SET status_222146 = 'terjual' WHERE id_properti_222146 = '$id_properti'";
                mysqli_query($koneksi, $update_properti);
            }
        } else {
            $_SESSION['success'] = "Pembayaran ditolak dan transaksi dibatalkan!";
        }
    } else {
        $_SESSION['error'] = "Gagal mengubah status: " . mysqli_error($koneksi);
    }
    
    // Redirect kembali ke halaman transaksi
    header("Location: pemesanan.php");
    exit();
} else {
    // Jika parameter tidak lengkap
    $_SESSION['error'] = "Parameter tidak lengkap!";
    header("Location: pemesanan.php");
    exit();
}
?>