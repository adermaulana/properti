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
        // Check if all installments are now verified
        $check_all_paid = "SELECT COUNT(*) as unpaid 
                          FROM detail_cicilan_222146 
                          WHERE id_cicilan_222146 = (
                              SELECT id_cicilan_222146 FROM detail_cicilan_222146 
                              WHERE id_detail_cicilan_222146 = '$id_detail_cicilan'
                          )
                          AND status_222146 != 'lunas'";
        $paid_result = mysqli_query($koneksi, $check_all_paid);
        $paid_data = mysqli_fetch_assoc($paid_result);
        
        if($paid_data['unpaid'] == 0) {
            // Update transaction status if all installments are paid
            $update_transaksi = "UPDATE transaksi_222146 
                               SET status_222146 = 'dikonfirmasi'
                               WHERE id_transaksi_222146 = '$id_transaksi'";
            mysqli_query($koneksi, $update_transaksi);
        }
        
        $_SESSION['success'] = "Pembayaran angsuran berhasil diverifikasi";
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