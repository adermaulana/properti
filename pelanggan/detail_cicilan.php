<?php
include '../koneksi.php';
session_start();

// Check if transaction ID is provided
if(!isset($_GET['id_transaksi'])) {
    header("Location: pemesanan.php");
    exit();
}

$id_transaksi = $_GET['id_transaksi'];
$id_pengguna = $_SESSION['id_pelanggan'];

// Verify this transaction belongs to the logged-in user
$check_query = "SELECT t.*, pr.nama_properti_222146, pr.harga_222146 
               FROM transaksi_222146 t
               JOIN properti_222146 pr ON t.id_properti_222146 = pr.id_properti_222146
               WHERE t.id_transaksi_222146 = '$id_transaksi'
               AND t.id_pengguna_222146 = '$id_pengguna'";
$check_result = mysqli_query($koneksi, $check_query);

if(mysqli_num_rows($check_result) == 0) {
    header("Location: pemesanan.php");
    exit();
}

$transaction = mysqli_fetch_assoc($check_result);
$harga = 'Rp. ' . number_format($transaction['harga_222146'], 0, ',', '.');

// Get installment plan
$cicilan_query = "SELECT * FROM cicilan_222146 
                 WHERE id_transaksi_222146 = '$id_transaksi'";
$cicilan_result = mysqli_query($koneksi, $cicilan_query);
$cicilan_data = mysqli_fetch_assoc($cicilan_result);

// Get installment details
$detail_cicilan_query = "SELECT * FROM detail_cicilan_222146 
                        WHERE id_cicilan_222146 = '".$cicilan_data['id_cicilan_222146']."'
                        ORDER BY angsuran_ke_222146";
$detail_cicilan_result = mysqli_query($koneksi, $detail_cicilan_query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pengguna</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/vertical-light-layout/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">


    <style>

.badge {
  font-weight: normal;
}
</style>
  </head>
  <body>
    <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
            <img src="assets/images/logoproperti.png" alt="logo" class="logo-dark" />
            <img src="assets/images/logoproperti.png" alt="logo-light" class="logo-light">
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome <?= $_SESSION['nama_pelanggan'] ?></h5>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ms-2" src="assets/images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal"> <?= $_SESSION['nama_pelanggan'] ?> </span></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
                <p class="mb-1 mt-3"><?= $_SESSION['nama_pelanggan'] ?></p>
                </div>
                <a class="dropdown-item" href="hapusSession.php"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
            </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item navbar-brand-mini-wrapper">
            <a class="nav-link navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            </li>
            <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="profile image">
                <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                <p class="profile-name"><?= $_SESSION['nama_pelanggan'] ?></p>
                <p class="designation">Pelanggan</p>
                </div>
                <div class="icon-container">
                <i class="icon-bubbles"></i>
                <div class="dot-indicator bg-danger"></div>
                </div>
            </a>
            </li>
            <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
            </li>
            <li class="nav-item nav-category"><span class="nav-link">Fitur</span></li>
            <li class="nav-item">
            <a class="nav-link" href="../properti.php">
                <span class="menu-title">Beli Properti</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Pemesanan</span>
                <i class="icon-book-open menu-icon"></i>
            </a>
            <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pemesanan.php">Pemesanan</a></li>
                </ul>
            </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Riwayat Pembayaran</span>
                <i class="icon-chart menu-icon"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="riwayat.php">Riwayat</a></li>
                </ul>
            </div>
            </li>
        </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
            <h3 class="page-title">Detail Cicilan</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="pemesanan.php">Pemesanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Cicilan</li>
                </ol>
            </nav>
            <?php
            if(isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }

            if(isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }
            ?>
            </div>
            <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi Transaksi</h4>
                    <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID Transaksi:</strong> <?= $transaction['id_transaksi_222146'] ?></p>
                        <p><strong>Properti:</strong> <?= $transaction['nama_properti_222146'] ?></p>
                        <p><strong>Harga:</strong> <?= $harga ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Metode Pembayaran:</strong> <?= ucfirst($transaction['metode_pembayaran_222146']) ?></p>
                        <p><strong>Tanggal Transaksi:</strong> <?= $transaction['tanggal_transaksi_222146'] ?></p>
                        <?php
                        // Determine badge color based on status (tambahkan di bagian atas sebelum digunakan)
                        $badge_color = '';
                        if($transaction['status_222146'] == 'pending') {
                            $badge_color = 'bg-warning'; // Kuning untuk status pending
                        } elseif($transaction['status_222146'] == 'dikonfirmasi') {
                            $badge_color = 'bg-success'; // Hijau untuk status dikonfirmasi
                        } elseif($transaction['status_222146'] == 'lunas') {
                            $badge_color = 'bg-success'; // Hijau untuk status dikonfirmasi
                        } elseif($transaction['status_222146'] == 'batal') {
                            $badge_color = 'bg-danger'; // Merah untuk status batal
                        } else {
                            $badge_color = 'bg-secondary'; // Abu-abu untuk status lainnya
                        }
                        ?>
                        <p><strong>Status:</strong> <span class="badge <?= $badge_color ?>"><?= $transaction['status_222146'] ?></span></p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Rencana Cicilan</h4>
                    <div class="row">
                    <div class="col-md-4">
                        <p><strong>Jumlah Cicilan:</strong> <?= $cicilan_data['jumlah_cicilan_222146'] ?>x</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Nilai per Cicilan:</strong> Rp. <?= number_format($cicilan_data['nilai_cicilan_222146'], 0, ',', '.') ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Interval:</strong> <?= $cicilan_data['interval_cicilan_222146'] ?> bulan</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Angsuran</h4>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Angsuran Ke</th>
                            <th>Jumlah</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Bukti Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while($detail = mysqli_fetch_assoc($detail_cicilan_result)) { 
                            $jumlah_cicilan = 'Rp. ' . number_format($detail['jumlah_222146'], 0, ',', '.');
                            $status_badge = '';
                            if($detail['status_222146'] == 'lunas') $status_badge = 'bg-success';
                            elseif($detail['status_222146'] == 'menunggu verifikasi') $status_badge = 'bg-warning';
                            else $status_badge = 'bg-secondary';
                        ?>
                        <tr>
                            <td><?= $detail['angsuran_ke_222146'] ?></td>
                            <td><?= $jumlah_cicilan ?></td>
                            <td><?= $detail['tanggal_jatuh_tempo_222146'] ?></td>
                            <td><span class="badge <?= $status_badge ?>"><?= $detail['status_222146'] ?></span></td>
                            <td>
                            <?php if(!empty($detail['bukti_pembayaran_222146'])) { ?>
                                <a href="../pelanggan/bukti_pembayaran/<?= $detail['bukti_pembayaran_222146'] ?>" target="_blank" class="btn btn-sm btn-info">Lihat Bukti</a>
                            <?php } else { ?>
                                Belum diupload
                            <?php } ?>
                            </td>
                            <td>
                            <?php if($detail['status_222146'] == 'pending') { ?>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $detail['id_detail_cicilan_222146'] ?>">
                                Upload Bukti
                            </button>
                            
                            <!-- Upload Modal for each installment -->
                            <div class="modal fade" id="uploadModal<?= $detail['id_detail_cicilan_222146'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Upload Bukti Pembayaran Angsuran #<?= $detail['angsuran_ke_222146'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="upload_bukti_cicilan.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_detail_cicilan" value="<?= $detail['id_detail_cicilan_222146'] ?>">
                                        <input type="hidden" name="id_transaksi" value="<?= $transaction['id_transaksi_222146'] ?>">
                                        <div class="form-group">
                                        <label>Jumlah Pembayaran</label>
                                        <input type="text" class="form-control" value="<?= $jumlah_cicilan ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                        <label>Tanggal Jatuh Tempo</label>
                                        <input type="text" class="form-control" value="<?= $detail['tanggal_jatuh_tempo_222146'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                        <label>Bukti Pembayaran</label>
                                        <input type="file" class="form-control" name="bukti_pembayaran" required>
                                        <small class="text-muted">Format: JPG, PNG (Maks. 2MB)</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 Stellar. All rights reserved. <a href="#"> Terms of use</a><a href="#">Privacy Policy</a></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
            </div>
        </footer>
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendors/moment/moment.min.js"></script>
    <script src="assets/vendors/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendors/chartist/chartist.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        new DataTable('#example');
    </script>

  </body>
</html>