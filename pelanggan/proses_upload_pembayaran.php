<?php
include '../koneksi.php'; // pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pemesanan_id = $_POST['pemesanan_id']; // Mengambil ID transaksi dari input form
    $metode_pembayaran = $_POST['metode_pembayaran']; // Mengambil metode pembayaran dari input form
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $tanggal_pembayaran = date('Y-m-d');
    
    // Memastikan folder untuk menyimpan foto ada
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder jika belum ada
    }

    $target_file = $target_dir . basename($_FILES["bukti_pembayaran"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file gambar sebenarnya adalah gambar
    $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File bukan gambar.'); window.history.back();</script>";
        exit();
    }

    // Memeriksa ukuran file (misal, maksimal 2MB)
    if ($_FILES["bukti_pembayaran"]["size"] > 2000000) {
        echo "<script>alert('Maaf, ukuran file terlalu besar.'); window.history.back();</script>";
        exit();
    }

    // Memeriksa format file
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "<script>alert('Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.'); window.history.back();</script>";
        exit();
    }

    // Jika semuanya baik, coba untuk mengunggah file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {
            // Ambil nama file yang diupload
            $nama_file = basename($_FILES["bukti_pembayaran"]["name"]);
            
            // Cek apakah ID transaksi sudah ada
            $sql_check = "SELECT * FROM pembayaran WHERE pemesanan_id  = '$pemesanan_id'";
            $result = mysqli_query($koneksi, $sql_check);
            
            if (mysqli_num_rows($result) > 0) {
                // ID transaksi sudah ada, lakukan update
                $sql_update = "UPDATE pembayaran 
                               SET 
                                   bukti_pembayaran = '$nama_file', 
                                   metode_pembayaran = '$metode_pembayaran', 
                                   jumlah_bayar = '$jumlah_bayar',
                                   tanggal_pembayaran = '$tanggal_pembayaran'
                               WHERE pemesanan_id = '$pemesanan_id'";
                
                if (mysqli_query($koneksi, $sql_update)) {
                    echo "<script>alert('File " . htmlspecialchars($nama_file) . " berhasil diunggah dan data berhasil diperbarui.'); window.location.href='pemesanan.php';</script>";
                } else {
                    echo "<script>alert('Kesalahan saat memperbarui database: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
                }
            } else {
                // ID transaksi belum ada, lakukan insert
                $sql_insert = "INSERT INTO pembayaran (pemesanan_id , bukti_pembayaran, metode_pembayaran, jumlah_bayar,tanggal_pembayaran) 
                               VALUES ('$pemesanan_id', '$nama_file', '$metode_pembayaran', '$jumlah_bayar','$tanggal_pembayaran')";
                
                if (mysqli_query($koneksi, $sql_insert)) {
                    echo "<script>alert('File " . htmlspecialchars($nama_file) . " berhasil diunggah dan data berhasil ditambahkan.'); window.location.href='pemesanan.php';</script>";
                } else {
                    echo "<script>alert('Kesalahan saat menambahkan data ke database: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
                }
            }
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.'); window.history.back();</script>";
        }
    }
}
?>
