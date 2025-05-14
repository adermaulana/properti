<?php
include '../koneksi.php';

if(isset($_POST['update_status'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $new_status = $_POST['update_status'];
    
    // Update status transaksi
    $query = "UPDATE transaksi_222146 SET status_222146 = ? WHERE id_transaksi_222146 = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $new_status, $id_transaksi);
    mysqli_stmt_execute($stmt);
    
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // Jika berhasil diupdate
        header("Location: pemesanan.php?success=Status transaksi berhasil diupdate");
        exit();
    } else {
        // Jika gagal
        header("Location: pemesanan.php?error=Gagal mengupdate status transaksi");
        exit();
    }
} else {
    header("Location: pemesanan.php");
    exit();
}
?>