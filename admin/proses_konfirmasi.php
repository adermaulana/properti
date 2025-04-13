<?php

include '../koneksi.php';

$id_pemesanan = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_pemesanan) {
    // Mulai transaction untuk memastikan semua query berhasil
    mysqli_begin_transaction($koneksi);
    
    try {
        // Ambil id_kamar dan id_pelanggan dari tabel pemesanan
        $query_get = "SELECT id_kamar, id_pelanggan FROM pemesanan WHERE id = '$id_pemesanan'";
        $result_get = mysqli_query($koneksi, $query_get);
        $row = mysqli_fetch_assoc($result_get);
        
        if (!$row) {
            throw new Exception("Data pemesanan tidak ditemukan");
        }
        
        $id_kamar = $row['id_kamar'];
        $id_pelanggan = $row['id_pelanggan'];
        
        // Update status pemesanan menjadi selesai
        $query_pemesanan = "UPDATE pemesanan SET status = 'selesai' WHERE id = '$id_pemesanan'";
        if (!mysqli_query($koneksi, $query_pemesanan)) {
            throw new Exception("Gagal mengupdate status pemesanan");
        }
        
        // Update id_kamar pada tabel pelanggan
        $query_pelanggan = "UPDATE pelanggan SET id_kamar = '$id_kamar' WHERE id = '$id_pelanggan'";
        if (!mysqli_query($koneksi, $query_pelanggan)) {
            throw new Exception("Gagal mengupdate data pelanggan");
        }
        
        // Commit transaction jika semua query berhasil
        mysqli_commit($koneksi);
        
        echo "<script>
        alert('Sukses Dikonfirmasi!');
        document.location='pemesanan.php';
        </script>";
        
    } catch (Exception $e) {
        // Rollback jika terjadi error
        mysqli_rollback($koneksi);
        
        echo "<script>
        alert('Gagal Dikonfirmasi: " . $e->getMessage() . "');
        document.location='pemesanan.php';
        </script>";
    }
    
} else {
    // Jika tidak ada ID yang diterima, arahkan kembali
    header("Location: pemesanan.php?pesan=gagal");
    exit();
}