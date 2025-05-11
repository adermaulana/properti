<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login sebagai pelanggan
if(!isset($_SESSION['username_pelanggan'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah form sudah di-submit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $id_properti = $_POST['id_properti'];
    
    // Cek apakah pembayaran langsung atau cicilan
    if(isset($_POST['beli'])) {
        // Pembayaran langsung
        $query = "INSERT INTO transaksi_222146 (
                    id_pengguna_222146,
                    id_properti_222146,
                    tanggal_transaksi_222146,
                    status_222146,
                    metode_pembayaran_222146
                  ) VALUES (
                    '$id_pelanggan',
                    '$id_properti',
                    NOW(),
                    'pending',
                    'lunas'
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
    } elseif(isset($_POST['beli_cicil'])) {
        // Pembayaran cicilan
        $jumlah_cicilan = $_POST['jumlah_cicilan'];
        $dp_percentage = $_POST['dp_percentage'];
        
        // Dapatkan harga properti
        $query_properti = "SELECT harga_222146 FROM properti_222146 WHERE id_properti_222146 = '$id_properti'";
        $result_properti = mysqli_query($koneksi, $query_properti);
        $properti = mysqli_fetch_assoc($result_properti);
        $harga_properti = $properti['harga_222146'];
        
        // Hitung DP
        $dp_amount = ($dp_percentage / 100) * $harga_properti;
        
        // Hitung nilai cicilan per bulan (sisa setelah DP dibagi jumlah cicilan)
        $cicilan_amount = ($harga_properti - $dp_amount) / $jumlah_cicilan;
        
        // Mulai transaksi database
        mysqli_begin_transaction($koneksi);
        
        try {
            // Insert ke tabel transaksi
            $query_transaksi = "INSERT INTO transaksi_222146 (
                                id_pengguna_222146,
                                id_properti_222146,
                                tanggal_transaksi_222146,
                                status_222146,
                                metode_pembayaran_222146
                              ) VALUES (
                                '$id_pelanggan',
                                '$id_properti',
                                NOW(),
                                'pending',
                                'cicilan'
                              )";
            $result_transaksi = mysqli_query($koneksi, $query_transaksi);
            
            if(!$result_transaksi) {
                throw new Exception("Gagal membuat transaksi: " . mysqli_error($koneksi));
            }
            
            $id_transaksi = mysqli_insert_id($koneksi);
            
            // Insert ke tabel cicilan
            $query_cicilan = "INSERT INTO cicilan_222146 (
                                id_transaksi_222146,
                                jumlah_cicilan_222146,
                                nilai_cicilan_222146,
                                interval_cicilan_222146,
                                status_222146
                              ) VALUES (
                                '$id_transaksi',
                                '$jumlah_cicilan',
                                '$cicilan_amount',
                                '30',
                                'pending'
                              )";
            $result_cicilan = mysqli_query($koneksi, $query_cicilan);
            
            if(!$result_cicilan) {
                throw new Exception("Gagal membuat cicilan: " . mysqli_error($koneksi));
            }
            
            $id_cicilan = mysqli_insert_id($koneksi);
            
            // Buat detail cicilan
            for($i = 1; $i <= $jumlah_cicilan; $i++) {
                $jatuh_tempo = date('Y-m-d', strtotime("+".($i * 30)." days"));
                
                $query_detail = "INSERT INTO detail_cicilan_222146 (
                                    id_cicilan_222146,
                                    angsuran_ke_222146,
                                    jumlah_222146,
                                    tanggal_jatuh_tempo_222146,
                                    status_222146
                                  ) VALUES (
                                    '$id_cicilan',
                                    '$i',
                                    '$cicilan_amount',
                                    '$jatuh_tempo',
                                    'pending'
                                  )";
                $result_detail = mysqli_query($koneksi, $query_detail);
                
                if(!$result_detail) {
                    throw new Exception("Gagal membuat detail cicilan: " . mysqli_error($koneksi));
                }
            }
            
            // Commit transaksi
            mysqli_commit($koneksi);
            
            // Redirect ke halaman pembayaran DP
            header("Location: pembayaran.php?id=" . $id_transaksi . "&type=dp");
            exit();
            
        } catch (Exception $e) {
            // Rollback jika ada error
            mysqli_rollback($koneksi);
            $_SESSION['error'] = $e->getMessage();
            header("Location: detail.php?id=" . $id_properti);
            exit();
        }
    }
}
?>