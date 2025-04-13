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
    <title>Admin</title>
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
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome <?= $_SESSION['nama_agen'] ?></h5>
          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ms-2" src="assets/images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal"> <?= $_SESSION['nama_agen'] ?> </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
                  <p class="mb-1 mt-3"><?= $_SESSION['nama_agen'] ?></p>
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
              <a class="nav-link navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            </li>
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?= $_SESSION['nama_agen'] ?></p>
                  <p class="designation">Administrator</p>
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
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Properti</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="properti.php">Lihat Properti</a></li>
                  <li class="nav-item"> <a class="nav-link" href="tambahproperti.php">Tambah Properti</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Pemesanan</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pemesanan.php">Data Pemesanan</a></li>
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
              <h3 class="page-title"> Data Pemesanan</h3>
            </div>
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
                            <th>Nama Pembeli</th>
                            <th>Nama Properti</th>
                            <th>Harga Properti</th>
                            <th>Tanggal Transaksi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Sample Transaction 1 - Pending -->
                          <tr>
                            <td>1</td>
                            <td>TRX001_222146</td>
                            <td>Budi Santoso</td>
                            <td>Cluster Dahlia - Type 36/72</td>
                            <td>Rp. 450.000.000</td>
                            <td>2023-06-15 10:30:45</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                              <button class="btn btn-sm bg-success" data-bs-toggle="modal" data-bs-target="#detailModal1">
                                Detail
                              </button>
                            </td>
                          </tr>

                          <!-- Sample Transaction 2 - Confirmed -->
                          <tr>
                            <td>2</td>
                            <td>TRX002_222146</td>
                            <td>Ani Lestari</td>
                            <td>Cluster Mawar - Type 45/90</td>
                            <td>Rp. 550.000.000</td>
                            <td>2023-06-14 14:15:22</td>
                            <td><span class="badge bg-success">Dikonfirmasi</span></td>
                            <td>
                              <button class="btn btn-sm bg-info" data-bs-toggle="modal" data-bs-target="#detailModal2">
                                Detail
                              </button>
                            </td>
                          </tr>

                          <!-- Sample Transaction 3 - Canceled -->
                          <tr>
                            <td>3</td>
                            <td>TRX003_222146</td>
                            <td>Citra Dewi</td>
                            <td>Cluster Melati - Type 30/60</td>
                            <td>Rp. 380.000.000</td>
                            <td>2023-06-13 09:45:10</td>
                            <td><span class="badge bg-danger">Batal</span></td>
                            <td>
                              <button class="btn btn-sm bg-warning" data-bs-toggle="modal" data-bs-target="#detailModal3">
                                Detail
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
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
                                <p><strong>ID Pengguna:</strong> USER001_222146<br>
                                <strong>Nama:</strong> Budi Santoso<br>
                                <strong>Kontak:</strong> 08123456789</p>
                              </div>
                              <div class="col-md-6">
                                <h6>Data Properti</h6>
                                <p><strong>ID Properti:</strong> PROP001_222146<br>
                                <strong>Nama:</strong> Cluster Dahlia - Type 36/72<br>
                                <strong>Harga:</strong> Rp. 450.000.000</p>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-6">
                                <h6>Detail Transaksi</h6>
                                <p><strong>Tanggal:</strong> 2023-06-15 10:30:45<br>
                                <strong>Status:</strong> <span class="badge bg-warning">Pending</span><br>
                                <strong>Metode Pembayaran:</strong> Transfer Bank</p>
                              </div>
                              <div class="col-md-6">
                                <h6>Bukti Pembayaran</h6>
                                <div class="payment-proof">
                                  <img src="assets/images/payment-proof.jpg" class="img-fluid" alt="Bukti Pembayaran">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-success">Konfirmasi</button>
                            <button type="button" class="btn btn-danger">Tolak</button>
                          </div>
                        </div>
                      </div>
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