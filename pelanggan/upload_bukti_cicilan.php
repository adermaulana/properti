
<?php
include '../koneksi.php';
session_start();

// Check if form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_detail_cicilan'])) {
    $id_detail_cicilan = $_POST['id_detail_cicilan'];
    $id_transaksi = $_POST['id_transaksi'];
    $id_pengguna = $_SESSION['id_pelanggan'];
    
    // Validate that this installment belongs to the logged-in user
    $check_query = "SELECT dc.* FROM detail_cicilan_222146 dc
                   JOIN cicilan_222146 c ON dc.id_cicilan_222146 = c.id_cicilan_222146
                   JOIN transaksi_222146 t ON c.id_transaksi_222146 = t.id_transaksi_222146
                   WHERE dc.id_detail_cicilan_222146 = '$id_detail_cicilan'
                   AND t.id_pengguna_222146 = '$id_pengguna'
                   AND dc.status_222146 = 'pending'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if(mysqli_num_rows($check_result) == 0) {
        $_SESSION['error'] = "Angsuran tidak ditemukan atau sudah dibayar";
        header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
        exit();
    }
    
    // File upload configuration
    $target_dir = "../pelanggan/bukti_pembayaran/";
    $file_name = "cicilan_".time()."_".basename($_FILES["bukti_pembayaran"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if file is an actual image
    $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
    if($check === false) {
        $_SESSION['error'] = "File bukan gambar.";
        $uploadOk = 0;
    }
    
    // Check file size (max 2MB)
    if ($_FILES["bukti_pembayaran"]["size"] > 2000000) {
        $_SESSION['error'] = "Ukuran file terlalu besar (maksimal 2MB).";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    $allowed_types = ["jpg", "png", "jpeg", "gif"];
    if(!in_array($imageFileType, $allowed_types)) {
        $_SESSION['error'] = "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }
    
    // Check if uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION['error'] = isset($_SESSION['error']) ? $_SESSION['error'] : "Maaf, file Anda tidak dapat diupload.";
        header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
        exit();
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {
            // Update installment payment in database
            $update_query = "UPDATE detail_cicilan_222146 
                            SET bukti_pembayaran_222146 = '$file_name',
                                tanggal_pembayaran_222146 = NOW(),
                                status_222146 = 'menunggu verifikasi'
                            WHERE id_detail_cicilan_222146 = '$id_detail_cicilan'";
            
            if(mysqli_query($koneksi, $update_query)) {
                // Check if all installments are paid
                $check_all_paid = "SELECT COUNT(*) as unpaid 
                                   FROM detail_cicilan_222146 
                                   WHERE id_cicilan_222146 = '".$cicilan_data['id_cicilan_222146']."'
                                   AND status_222146 = 'pending'";
                $paid_result = mysqli_query($koneksi, $check_all_paid);
                $paid_data = mysqli_fetch_assoc($paid_result);
                
                if($paid_data['unpaid'] == 0) {
                    // Update transaction status if all installments are paid
                    $update_transaksi = "UPDATE transaksi_222146 
                                       SET status_222146 = 'pending'
                                       WHERE id_transaksi_222146 = '$id_transaksi'";
                    mysqli_query($koneksi, $update_transaksi);
                }
                
                $_SESSION['success'] = "Bukti pembayaran angsuran berhasil diupload. Menunggu verifikasi admin.";
                header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menyimpan data pembayaran: " . mysqli_error($koneksi);
                unlink($target_file); // Delete uploaded file
                header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
                exit();
            }
        } else {
            $_SESSION['error'] = "Maaf, terjadi kesalahan saat mengupload file.";
            header("Location: detail_cicilan.php?id_transaksi=$id_transaksi");
            exit();
        }
    }
} else {
    // If accessed directly without POST method
    header("Location: pemesanan.php");
    exit();
}
?>