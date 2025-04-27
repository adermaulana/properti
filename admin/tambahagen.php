<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login' || !isset($_SESSION['username_admin'])){

  header("location:../pelanggan");

}


if (isset($_POST['simpan'])) {
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama_agen_222146']);
  $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat_222146']);
  $telepon = mysqli_real_escape_string($koneksi, $_POST['kontak_222146']);
  $username = mysqli_real_escape_string($koneksi, $_POST['username_222146']);
  $password = md5($_POST['password_222146']);
  
  // Check if username already exists
  $check = mysqli_query($koneksi, "SELECT * FROM agen_222146 WHERE username_222146='$username'");
  
  if (mysqli_num_rows($check) > 0) {
      echo "<script>
              alert('Username sudah digunakan oleh agen lain!');
              window.history.back(); // This will go back without clearing form data
          </script>";
      exit;
  }

  // Insert new data
  $insert = mysqli_query($koneksi, "INSERT INTO agen_222146 (
              nama_agen_222146, 
              alamat_222146, 
              kontak_222146, 
              username_222146, 
              password_222146,
              created_at_222146
          ) VALUES (
              '$nama', 
              '$alamat', 
              '$telepon', 
              '$username', 
              '$password',
              NOW()
          )");

  if ($insert) {
      echo "<script>
              alert('Data agen berhasil ditambahkan!');
              document.location='agen.php';
          </script>";
  } else {
      echo "<script>
              alert('Gagal menambahkan data: ".mysqli_error($koneksi)."');
              window.history.back();
          </script>";
  }
}



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
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome <?= $_SESSION['nama_admin'] ?></h5>
          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ms-2" src="assets/images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal"> <?= $_SESSION['nama_admin'] ?> </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
                  <p class="mb-1 mt-3"><?= $_SESSION['nama_admin'] ?></p>
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
                  <p class="profile-name"><?= $_SESSION['nama_admin'] ?></p>
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
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Pengguna</span>
                <i class="icon-globe menu-icon"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pengguna.php">Lihat Pengguna</a></li>
                <li class="nav-item"> <a class="nav-link" href="tambahpengguna.php">Tambah Pengguna</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#agen" aria-expanded="false" aria-controls="agen">
                <span class="menu-title">Agen</span>
                <i class="icon-globe menu-icon"></i>
              </a>
              <div class="collapse" id="agen">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="agen.php">Lihat Agen</a></li>
                  <li class="nav-item"> <a class="nav-link" href="tambahagen.php">Tambah Agen</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="admin">
                <span class="menu-title">Admin</span>
                <i class="icon-globe menu-icon"></i>
              </a>
              <div class="collapse" id="admin">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="user.php">Lihat Admin</a></li>
                  <li class="nav-item"> <a class="nav-link" href="tambahuser.php">Tambah Admin</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Tambah Agen</h3>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="nama">Nama Agen</label>
                        <input type="text" class="form-control" name="nama_agen_222146" id="nama" placeholder="Nama" required>
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username_222146" id="username" placeholder="Username" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat_222146" rows="4" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="telepon">No Hp</label>
                        <input type="text" class="form-control" name="kontak_222146" id="telepon" placeholder="No Hp" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password_222146" id="password" placeholder="" required>
                      </div>

                      <button type="submit" name="simpan" class="btn btn-primary me-2">Submit</button>
                    </form>
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
    <script src="assets/js/file-upload.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>