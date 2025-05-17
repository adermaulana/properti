<?php

include '../koneksi.php';

session_start();



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
.payment-proof {
    max-height: 200px;
    overflow: hidden;
    border: 1px solid #ddd;
    padding: 5px;
}
.badge {
    font-weight: normal;
    padding: 5px 10px;
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
                        <a class="nav-link navbar-brand brand-logo-mini" href="index.html"><img
                                src="assets/images/logo-mini.svg" alt="logo" /></a>
                    </li>
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="profile-image">
                                <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg"
                                    alt="profile image">
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
                        <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false"
                            aria-controls="forms">
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
                        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                            aria-controls="charts">
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
              <h3 class="page-title">Laporan</h3>
            </div>
            
            <!-- Filter Form -->
            <div class="row mb-4">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Filter Laporan</h4>
                    <form method="get" action="">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Pilih Periode</label>
                            <select class="form-control" name="periode" id="periode" onchange="toggleDateInputs()">
                              <option value="hari" <?= (isset($_GET['periode'])) && $_GET['periode'] == 'hari' ? 'selected' : '' ?>>Hari Ini</option>
                              <option value="minggu" <?= (isset($_GET['periode'])) && $_GET['periode'] == 'minggu' ? 'selected' : '' ?>>Minggu Ini</option>
                              <option value="bulan" <?= (isset($_GET['periode'])) && $_GET['periode'] == 'bulan' ? 'selected' : '' ?>>Bulan Ini</option>
                              <option value="custom" <?= (isset($_GET['periode'])) && $_GET['periode'] == 'custom' ? 'selected' : '' ?>>Range Waktu Tertentu</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3" id="tanggal-container" style="display: none;">
                          <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d') ?>">
                          </div>
                        </div>
                        <div class="col-md-3" id="tanggal-awal-container" style="display: none;">
                          <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" class="form-control" name="tanggal_awal" value="<?= isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-d') ?>">
                          </div>
                        </div>
                        <div class="col-md-3" id="tanggal-akhir-container" style="display: none;">
                          <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggal_akhir" value="<?= isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d') ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>&nbsp;</label><br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <?php if(isset($_GET['periode'])) { ?>
                              <a href="riwayat.php" class="btn btn-secondary">Reset</a>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Export Button -->
            <div class="row mb-3">
              <div class="col-md-12 text-right">
                <a href="export_pemesanan.php?<?= http_build_query($_GET) ?>" class="btn btn-success">
                  <i class="fa fa-file-excel-o"></i> Export to Excel
                </a>
              </div>
            </div>
            
            <!-- Filter Info -->
            <div class="row mb-3">
              <div class="col-md-12">
                <?php if(isset($_GET['periode'])): ?>
                  <div class="alert alert-info">
                    <strong>Filter Aktif:</strong> 
                    <?php 
                    $periode = $_GET['periode'];
                    if($periode == 'hari') {
                      echo "Hari: " . (isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'));
                    } elseif($periode == 'minggu') {
                      echo "Minggu Ini (".date('d M Y', strtotime('monday this week'))." - ".date('d M Y', strtotime('sunday this week')).")";
                    } elseif($periode == 'bulan') {
                      echo "Bulan Ini (".date('M Y').")";
                    } elseif($periode == 'custom') {
                      echo "Custom: ".(isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '')." s/d ".(isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '');
                    }
                    ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            
            <!-- Main Table -->
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table display" id="example" style="width:100%">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Nama Properti</th>
                            <th>Harga Properti</th>
                            <th>Tanggal Transaksi</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          // Query dasar
                          $query = "SELECT t.*, pr.nama_properti_222146, pr.harga_222146 
                                    FROM transaksi_222146 t
                                    JOIN properti_222146 pr ON t.id_properti_222146 = pr.id_properti_222146";

                          // Create a conditions array to collect all WHERE conditions
                          $conditions = [];

                          // Filter based on periode
                          if(isset($_GET['periode'])) {
                              $periode = $_GET['periode'];
                              
                              if($periode == 'hari') {
                                  $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                  $conditions[] = "DATE(t.tanggal_transaksi_222146) = '$tanggal'";
                              } 
                              elseif($periode == 'minggu') {
                                  $minggu_awal = date('Y-m-d', strtotime('monday this week'));
                                  $minggu_akhir = date('Y-m-d', strtotime('sunday this week'));
                                  $conditions[] = "DATE(t.tanggal_transaksi_222146) BETWEEN '$minggu_awal' AND '$minggu_akhir'";
                              } 
                              elseif($periode == 'bulan') {
                                  $bulan_awal = date('Y-m-01');
                                  $bulan_akhir = date('Y-m-t');
                                  $conditions[] = "DATE(t.tanggal_transaksi_222146) BETWEEN '$bulan_awal' AND '$bulan_akhir'";
                              } 
                              elseif($periode == 'custom' && isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
                                  $tanggal_awal = $_GET['tanggal_awal'];
                                  $tanggal_akhir = $_GET['tanggal_akhir'];
                                  $conditions[] = "DATE(t.tanggal_transaksi_222146) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                              }
                          }

                          // If the logged-in user is a customer, add a condition for filtering by user ID
                          if(isset($_SESSION['id_pelanggan'])) {
                              $id_pengguna = $_SESSION['id_pelanggan'];
                              $conditions[] = "t.id_pengguna_222146 = '$id_pengguna'";
                          }

                          // Now add the WHERE clause only if there are conditions
                          if (!empty($conditions)) {
                              $query .= " WHERE " . implode(" AND ", $conditions);
                          }

                          // Finally add the ORDER BY clause
                          $query .= " ORDER BY t.tanggal_transaksi_222146 DESC";

                          // Execute the query
                          $result = mysqli_query($koneksi, $query);

                          // Check for errors
                          if (!$result) {
                              echo "Error in query: " . mysqli_error($koneksi);
                              echo "<br>Query: " . $query;
                          }
                          
                          if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)){
                              // Determine badge color based on status
                              $badge_color = '';
                              if($row['status_222146'] == 'pending') $badge_color = 'bg-warning';
                              elseif($row['status_222146'] == 'dikonfirmasi') $badge_color = 'bg-success';
                              elseif($row['status_222146'] == 'lunas') $badge_color = 'bg-success';
                              elseif($row['status_222146'] == 'batal') $badge_color = 'bg-danger';
                              
                              // Format price
                              $harga = 'Rp. ' . number_format($row['harga_222146'], 0, ',', '.');
                              
                              // Check payment method
                              $metode_pembayaran = $row['metode_pembayaran_222146'];
                          ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_transaksi_222146'] ?></td>
                            <td><?= $row['nama_properti_222146'] ?></td>
                            <td><?= $harga ?></td>
                            <td><?= $row['tanggal_transaksi_222146'] ?></td>
                            <td><?= ucfirst($metode_pembayaran) ?></td>
                            <td><span class="badge <?= $badge_color ?>"><?= $row['status_222146'] ?></span></td> 
                          </tr>

                          <!-- Modal for full payment (lunas) -->
                          <?php if($metode_pembayaran == 'lunas') { ?>
                            <div class="modal fade" id="detailModal<?= $row['id_transaksi_222146'] ?>" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Detail Transaksi <?= $row['id_transaksi_222146'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <?php
                                    // Get payment details if exists
                                    $payment_query = "SELECT * FROM pembayaran_222146 WHERE id_transaksi_222146 = '".$row['id_transaksi_222146']."'";
                                    $payment_result = mysqli_query($koneksi, $payment_query);
                                    $payment_data = mysqli_fetch_array($payment_result);
                                    
                                    // Get property details
                                    $property_query = "SELECT pr.*, a.nama_agen_222146 
                                                    FROM properti_222146 pr
                                                    LEFT JOIN agen_222146 a ON pr.id_agen_222146 = a.id_agen_222146
                                                    WHERE pr.id_properti_222146 = '".$row['id_properti_222146']."'";
                                    $property_result = mysqli_query($koneksi, $property_query);
                                    $property_data = mysqli_fetch_array($property_result);
                                    ?>
                                    
                                    <div class="row">
                                      <div class="col-md-6">
                                        <h6>Data Properti</h6>
                                        <p><strong>ID Properti:</strong> <?= $property_data['id_properti_222146'] ?><br>
                                        <strong>Nama:</strong> <?= $property_data['nama_properti_222146'] ?><br>
                                        <strong>Harga:</strong> <?= $harga ?><br>
                                        <strong>Lokasi:</strong> <?= $property_data['lokasi_222146'] ?><br>
                                        <strong>Agen:</strong> <?= $property_data['nama_agen_222146'] ?><br>
                                        <strong>Kontak Agen:</strong> <?= $property_data['nomor_telepon_222146'] ?></p>
                                      </div>
                                      <div class="col-md-6">
                                        <h6>Detail Transaksi</h6>
                                        <p><strong>Tanggal:</strong> <?= $row['tanggal_transaksi_222146'] ?><br>
                                        <strong>Status:</strong> <span class="badge <?= $badge_color ?>"><?= $row['status_222146'] ?></span></p>
                                        
                                        <?php if($payment_data) { ?>
                                        <h6 class="mt-3">Detail Pembayaran</h6>
                                        <p><strong>Jumlah:</strong> Rp. <?= number_format($payment_data['jumlah_222146'], 0, ',', '.') ?><br>
                                        <strong>Tanggal Pembayaran:</strong> <?= $payment_data['tanggal_pembayaran_222146'] ?></p>
                                        <?php } ?>
                                      </div>
                                    </div>
                                    <div class="row mt-3">
                                      <div class="col-md-12">
                                        <?php if($payment_data && !empty($payment_data['bukti_pembayaran_222146'])) { ?>
                                        <h6>Bukti Pembayaran</h6>
                                        <div class="payment-proof">
                                          <img src="../pelanggan/bukti_pembayaran/<?= $payment_data['bukti_pembayaran_222146'] ?>" class="img-fluid" alt="Bukti Pembayaran">
                                        </div>
                                        <?php } elseif($row['status_222146'] == 'pending') { ?>
                                        <div class="alert alert-info">
                                          <p>Silakan lakukan pembayaran dan upload bukti pembayaran</p>
                                          <form action="upload_bukti.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi_222146'] ?>">
                                            <div class="mb-3">
                                              <input type="file" class="form-control" name="bukti_pembayaran" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload Bukti</button>
                                          </form>
                                        </div>
                                        <?php } ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <?php if($row['status_222146'] == 'pending' && $payment_data) { ?>
                                    <form action="update_status.php" method="post">
                                      <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi_222146'] ?>">
                                      <button type="submit" class="btn btn-success" name="update_status" value="lunas">
                                        Konfirmasi Pembayaran
                                      </button>
                                    </form>
                                    <?php } ?>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                          <?php
                            }
                          } else {

                          }
                          ?>
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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi TRX001_222146</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Data Pembeli</h6>
                        <p><strong>ID:</strong> USER001_222146<br>
                        <strong>Nama:</strong> Budi Santoso<br>
                        <strong>Kontak:</strong> 08123456789</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Data Properti</h6>
                        <p><strong>ID:</strong> PROP001_222146<br>
                        <strong>Nama:</strong> Cluster Dahlia - Type 36/72<br>
                        <strong>Harga:</strong> Rp. 450.000.000</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Detail Pembayaran</h6>
                        <p><strong>Metode:</strong> Transfer Bank BCA<br>
                        <strong>Tanggal:</strong> 2023-06-15 10:30:45<br>
                        <strong>Status:</strong> <span class="badge bg-success">Lunas</span></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Bukti Pembayaran</h6>
                        <div class="payment-proof">
                            <img src="assets/images/payment-proof-1.jpg" class="img-fluid" alt="Bukti Pembayaran">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
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
      
      function toggleDateInputs() {
        var periode = document.getElementById('periode').value;
        
        // Sembunyikan semua dulu
        document.getElementById('tanggal-container').style.display = 'none';
        document.getElementById('tanggal-awal-container').style.display = 'none';
        document.getElementById('tanggal-akhir-container').style.display = 'none';
        
        // Tampilkan yang sesuai
        if(periode === 'hari') {
          document.getElementById('tanggal-container').style.display = 'block';
        } else if(periode === 'custom') {
          document.getElementById('tanggal-awal-container').style.display = 'block';
          document.getElementById('tanggal-akhir-container').style.display = 'block';
        }
      }
      
      // Panggil fungsi saat halaman dimuat
      window.onload = function() {
        toggleDateInputs();
      };
    </script>
  </body>
</html>