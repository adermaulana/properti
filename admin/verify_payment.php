<?php
include '../koneksi.php';
session_start();

// Check if form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_detail_cicilan'])) {
    $id_detail_cicilan = $_POST['id_detail_cicilan'];
    $id_transaksi = $_POST['id_transaksi'];
    
    // Verify the installment exists and is waiting for verification
    $check_query = "SELECT * FROM detail_cicilan_222146 
                   WHERE id_detail_cicilan_222146 = '$id_detail_cicilan'
                   AND status_222146 = 'menunggu verifikasi'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if(mysqli_num_rows($check_result) == 0) {
        $_SESSION['error'] = "Angsuran tidak ditemukan atau sudah diverifikasi";
        header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
        exit();
    }
    
    // Update the installment status to verified
    $update_query = "UPDATE detail_cicilan_222146 
                    SET status_222146 = 'lunas'
                    WHERE id_detail_cicilan_222146 = '$id_detail_cicilan'";
    
    if(mysqli_query($koneksi, $update_query)) {
        // Get the installment plan details
        $cicilan_query = "SELECT c.jumlah_cicilan_222146, 
                         (SELECT COUNT(*) FROM detail_cicilan_222146 
                          WHERE id_cicilan_222146 = c.id_cicilan_222146 
                          AND status_222146 = 'lunas') as paid_count
                         FROM cicilan_222146 c
                         JOIN detail_cicilan_222146 dc ON c.id_cicilan_222146 = dc.id_cicilan_222146
                         WHERE dc.id_detail_cicilan_222146 = '$id_detail_cicilan'";
        $cicilan_result = mysqli_query($koneksi, $cicilan_query);
        $cicilan_data = mysqli_fetch_assoc($cicilan_result);
        
        // Check if all installments are paid
        if($cicilan_data['paid_count'] == $cicilan_data['jumlah_cicilan_222146']) {
            // Update transaction status to 'lunas' if all installments are paid
            $update_transaksi = "UPDATE transaksi_222146 
                               SET status_222146 = 'lunas'
                               WHERE id_transaksi_222146 = '$id_transaksi'";
            mysqli_query($koneksi, $update_transaksi);
            
            $_SESSION['success'] = "Pembayaran angsuran berhasil diverifikasi dan semua cicilan telah lunas";
        } else {
            $_SESSION['success'] = "Pembayaran angsuran berhasil diverifikasi";
        }
        
        header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
        exit();
    } else {
        $_SESSION['error'] = "Gagal memverifikasi pembayaran: " . mysqli_error($koneksi);
        header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
        exit();
    }
} else {
    // If accessed directly without POST method
    header("Location: pemesanan.php");
    exit();
}
?>