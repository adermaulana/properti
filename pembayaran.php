<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login sebagai pelanggan
if(!isset($_SESSION['username_pelanggan'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID transaksi dari URL
$id_transaksi = isset($_GET['id']) ? $_GET['id'] : null;
$payment_type = isset($_GET['type']) ? $_GET['type'] : 'full';

if(!$id_transaksi) {
    $_SESSION['error'] = "ID Transaksi tidak valid";
    header("Location: properti.php");
    exit();
}

// Query untuk mendapatkan detail transaksi
$query = "SELECT t.*, p.nama_properti_222146, p.harga_222146, p.foto_222146, 
                 c.id_cicilan_222146, c.jumlah_cicilan_222146, c.nilai_cicilan_222146
          FROM transaksi_222146 t
          JOIN properti_222146 p ON t.id_properti_222146 = p.id_properti_222146
          LEFT JOIN cicilan_222146 c ON t.id_transaksi_222146 = c.id_transaksi_222146
          WHERE t.id_transaksi_222146 = '$id_transaksi'
          AND t.id_pengguna_222146 = '".$_SESSION['id_pelanggan']."'";
$result = mysqli_query($koneksi, $query);
$transaksi = mysqli_fetch_assoc($result);

if(!$transaksi) {
    $_SESSION['error'] = "Transaksi tidak ditemukan";
    header("Location: properti.php");
    exit();
}

// Hitung jumlah yang harus dibayar
if($transaksi['metode_pembayaran_222146'] == 'cicilan' && $payment_type == 'dp') {
    // Pembayaran DP untuk cicilan
    $dp_percentage = $transaksi['dp_percentage_222146'];
    $jumlah_bayar = ($dp_percentage / 100) * $transaksi['harga_222146'];
    $payment_title = "Pembayaran Uang Muka (DP)";
    $payment_description = "Silakan lakukan pembayaran uang muka sebesar $dp_percentage% dari harga properti untuk memulai proses cicilan.";
} elseif($transaksi['metode_pembayaran_222146'] == 'cicilan' && $payment_type == 'installment') {
    // Pembayaran cicilan
    $angsuran_ke = isset($_GET['angsuran_ke']) ? $_GET['angsuran_ke'] : null;
    
    if(!$angsuran_ke) {
        $_SESSION['error'] = "Nomor angsuran tidak valid";
        header("Location: pelanggan/transaksi.php");
        exit();
    }
    
    $query_cicilan = "SELECT * FROM detail_cicilan_222146 
                      WHERE id_cicilan_222146 = '".$transaksi['id_cicilan_222146']."'
                      AND angsuran_ke_222146 = '$angsuran_ke'";
    $result_cicilan = mysqli_query($koneksi, $query_cicilan);
    $cicilan = mysqli_fetch_assoc($result_cicilan);
    
    if(!$cicilan) {
        $_SESSION['error'] = "Detail cicilan tidak ditemukan";
        header("Location: pelanggan/transaksi.php");
        exit();
    }
    
    $jumlah_bayar = $cicilan['jumlah_222146'];
    $payment_title = "Pembayaran Cicilan ke-$angsuran_ke";
    $payment_description = "Silakan lakukan pembayaran cicilan ke-$angsuran_ke sesuai dengan jatuh tempo.";
} else {
    // Pembayaran penuh
    $jumlah_bayar = $transaksi['harga_222146'];
    $payment_title = "Pembayaran Properti";
    $payment_description = "Silakan lakukan pembayaran penuh untuk properti ini.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $payment_title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .property-img {
            max-height: 200px;
            object-fit: cover;
        }
        .card-header {
            font-weight: bold;
        }
        .badge {
            font-size: 0.9em;
            padding: 0.5em 0.75em;
        }
        .payment-steps {
            counter-reset: step;
            margin-bottom: 20px;
        }
        .payment-step {
            position: relative;
            padding-left: 50px;
            margin-bottom: 15px;
        }
        .payment-step:before {
            counter-increment: step;
            content: counter(step);
            position: absolute;
            left: 0;
            top: 0;
            width: 35px;
            height: 35px;
            background-color: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Notifikasi -->
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i> <?php echo $payment_title; ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Detail Transaksi -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2">Detail Transaksi</h5>
                                <div class="mb-3">
                                    <img src="admin/uploads/<?= $transaksi['foto_222146'] ?>" alt="<?= $transaksi['nama_properti_222146'] ?>" class="img-fluid rounded property-img mb-3">
                                    <p><strong>ID Transaksi:</strong> <?= $transaksi['id_transaksi_222146'] ?></p>
                                    <p><strong>Properti:</strong> <?= $transaksi['nama_properti_222146'] ?></p>
                                    <p><strong>Harga:</strong> Rp <?= number_format($transaksi['harga_222146'], 0, ',', '.') ?></p>
                                    <p><strong>Metode Pembayaran:</strong> 
                                        <?= $transaksi['metode_pembayaran_222146'] == 'cicilan' ? 'Cicilan' : 'Lunas' ?>
                                    </p>
                                        <?php if($transaksi['metode_pembayaran_222146'] == 'cicilan'): ?>
                                            <p><strong>Persentase DP:</strong> <?= $transaksi['dp_percentage_222146'] ?>%</p>
                                            <p><strong>Jumlah DP:</strong> Rp <?= number_format(($transaksi['dp_percentage_222146']/100)*$transaksi['harga_222146'], 0, ',', '.') ?></p>
                                        <?php endif; ?>
                                    <p><strong>Status:</strong> <span class="badge bg-warning text-dark"><?= ucfirst($transaksi['status_222146']) ?></span></p>
                                    <p><strong>Tanggal Transaksi:</strong> <?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi_222146'])) ?></p>
                                </div>
                            </div>
                            
                            <!-- Form Pembayaran -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2">Instruksi Pembayaran</h5>
                                
                                <div class="alert alert-info mb-4">
                                    <h6><i class="fas fa-info-circle me-2"></i><?php echo $payment_description; ?></h6>
                                    <p class="mb-0"><strong>Jumlah yang harus dibayar:</strong> Rp <?= number_format($jumlah_bayar, 0, ',', '.') ?></p>
                                </div>
                                
                                <div class="payment-steps mb-4">
                                    <h6><i class="fas fa-list-ol me-2"></i>Langkah Pembayaran:</h6>
                                    <div class="payment-step">
                                        <p>Transfer ke rekening BCA <strong>1234567890</strong> a.n. Perusahaan Properti</p>
                                    </div>
                                    <div class="payment-step">
                                        <p>Jumlah transfer: <strong>Rp <?= number_format($jumlah_bayar, 0, ',', '.') ?></strong></p>
                                    </div>
                                    <div class="payment-step">
                                        <p>Gunakan ID Transaksi sebagai keterangan transfer</p>
                                    </div>
                                    <div class="payment-step">
                                        <p>Upload bukti transfer di bawah ini</p>
                                    </div>
                                </div>
                                
                                <form action="pelanggan/upload_bukti.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi_222146'] ?>">
                                    <input type="hidden" name="payment_type" value="<?= $payment_type ?>">
                                    <?php if($payment_type == 'installment'): ?>
                                        <input type="hidden" name="angsuran_ke" value="<?= $_GET['angsuran_ke'] ?>">
                                    <?php endif; ?>
                                    
                                    <div class="mb-3">
                                        <label for="bukti_pembayaran" class="form-label">Upload Bukti Transfer</label>
                                        <input class="form-control" type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*,.pdf" required>
                                        <div class="form-text">Format: JPG, PNG, atau PDF (maks. 2MB)</div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-2"></i>Kirim Bukti Pembayaran
                                        </button>
                                        <a href="detail.php?id=<?= $transaksi['id_properti_222146'] ?>" class="btn btn-outline-secondary">
                                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Detail Properti
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>