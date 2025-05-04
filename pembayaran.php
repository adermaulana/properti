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

if(!$id_transaksi) {
    $_SESSION['error'] = "ID Transaksi tidak valid";
    header("Location: properti.php");
    exit();
}

// Query untuk mendapatkan detail transaksi
$query = "SELECT t.*, p.nama_properti_222146, p.harga_222146, p.foto_222146 
          FROM transaksi_222146 t
          JOIN properti_222146 p ON t.id_properti_222146 = p.id_properti_222146
          WHERE t.id_transaksi_222146 = '$id_transaksi'
          AND t.id_pengguna_222146 = '".$_SESSION['id_pelanggan']."'";
$result = mysqli_query($koneksi, $query);
$transaksi = mysqli_fetch_assoc($result);

if(!$transaksi) {
    $_SESSION['error'] = "Transaksi tidak ditemukan";
    header("Location: properti.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Properti</title>
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
                        <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i> Pembayaran Properti</h4>
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
                                    <p><strong>Status:</strong> <span class="badge bg-warning text-dark"><?= ucfirst($transaksi['status_222146']) ?></span></p>
                                    <p><strong>Tanggal Transaksi:</strong> <?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi_222146'])) ?></p>
                                </div>
                            </div>
                            
                            <!-- Form Pembayaran -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2">Instruksi Pembayaran</h5>
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>Transfer Bank</h6>
                                    <ol class="mb-0">
                                        <li>Transfer ke rekening BCA <strong>1234567890</strong> a.n. Perusahaan Properti</li>
                                        <li>Jumlah transfer: <strong>Rp <?= number_format($transaksi['harga_222146'], 0, ',', '.') ?></strong></li>
                                        <li>Gunakan ID Transaksi sebagai keterangan transfer</li>
                                        <li>Upload bukti transfer di bawah ini</li>
                                    </ol>
                                </div>
                                
                                <form action="pelanggan/upload_bukti.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi_222146'] ?>">
                                    
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