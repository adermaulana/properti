<?php
include '../koneksi.php';
session_start();

// Cek apakah form sudah di-submit
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_pengguna = $_SESSION['id_pengguna'];
    
    // Validasi bahwa transaksi ini milik pengguna yang login
    $check_query = "SELECT * FROM transaksi_222146 
                   WHERE id_transaksi_222146 = '$id_transaksi' 
                   AND id_pengguna_222146 = '$id_pengguna' 
                   AND status_222146 = 'pending'";
    $check_result = mysqli_query($koneksi, $check_query);

    
    // Konfigurasi upload file
    $target_dir = "../pelanggan/bukti_pembayaran/";
    $file_name = "bukti_" . $id_transaksi . "_" . basename($_FILES["bukti_pembayaran"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Cek apakah file adalah gambar asli atau fake
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION['error'] = "File bukan gambar.";
            $uploadOk = 0;
        }
    }
    
    // Cek ukuran file (maksimal 2MB)
    if ($_FILES["bukti_pembayaran"]["size"] > 2000000) {
        $_SESSION['error'] = "Maaf, ukuran file terlalu besar (maksimal 2MB).";
        $uploadOk = 0;
    }
    
    // Hanya izinkan format gambar tertentu
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['error'] = "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }
    
    // Cek jika $uploadOk bernilai 0 karena ada error
    if ($uploadOk == 0) {
        $_SESSION['error'] = isset($_SESSION['error']) ? $_SESSION['error'] : "Maaf, file Anda tidak dapat diupload.";
        header("Location: pemesanan.php");
        exit();
    } else {
        // Jika semua kondisi terpenuhi, coba upload file
        if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {
            // Update database dengan bukti pembayaran
            $update_query = "INSERT INTO pembayaran_222146 
                            (id_transaksi_222146, jumlah_222146, bukti_pembayaran_222146, tanggal_pembayaran_222146) 
                            VALUES (
                                '$id_transaksi', 
                                (SELECT harga_222146 FROM properti_222146 WHERE id_properti_222146 = (SELECT id_properti_222146 FROM transaksi_222146 WHERE id_transaksi_222146 = '$id_transaksi')),
                                '$file_name',
                                NOW()
                            )";
            
            if(mysqli_query($koneksi, $update_query)) {
                $_SESSION['success'] = "Bukti pembayaran berhasil diupload.";
                header("Location: pemesanan.php");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menyimpan data pembayaran: " . mysqli_error($koneksi);
                unlink($target_file); // Hapus file yang sudah diupload
                header("Location: pemesanan.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Maaf, terjadi kesalahan saat mengupload file.";
            header("Location: pemesanan.php");
            exit();
        }
    }
} else {
    // Jika akses langsung ke file ini tanpa submit form
    header("Location: pemesanan.php");
    exit();
}
?>