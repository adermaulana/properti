<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login' || !isset($_SESSION['username_admin'])){

  header("location:../pelanggan");

}


if (isset($_POST['simpan'])) {
  $nama_properti = mysqli_real_escape_string($koneksi, $_POST['nama_properti']);
  $id_agen = mysqli_real_escape_string($koneksi, $_POST['id_agen']);
  $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
  $luas_bangunan = mysqli_real_escape_string($koneksi, $_POST['luas_bangunan']);
  $luas_tanah = mysqli_real_escape_string($koneksi, $_POST['luas_tanah']);
  $kamar_tidur = mysqli_real_escape_string($koneksi, $_POST['kamar_tidur']);
  $kamar_mandi = mysqli_real_escape_string($koneksi, $_POST['kamar_mandi']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
  $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
  $nomor_telepon = mysqli_real_escape_string($koneksi, $_POST['whatsapp']);
  $status = mysqli_real_escape_string($koneksi, $_POST['status']);

  
  // Handle file upload
  $foto = $_FILES['foto_properti']['name'];
  $tmp = $_FILES['foto_properti']['tmp_name'];
  $fotobaru = date('dmYHis').$foto;
  $path = "uploads/".$fotobaru;
  
  if(move_uploaded_file($tmp, $path)) {
      // Insert new property data
      $insert = mysqli_query($koneksi, "INSERT INTO properti_222146 (
                  id_properti_222146,
                  nama_properti_222146,
                  lokasi_222146,
                  harga_222146,
                  id_agen_222146,
                  luas_bangunan_222146,
                  luas_tanah_222146,
                  kamar_tidur_222146,
                  kamar_mandi_222146,
                  foto_222146,
                  deskripsi_222146,
                  nomor_telepon_222146,
                  status_222146
              ) VALUES (
                  '$id_properti',
                  '$nama_properti',
                  '$lokasi',
                  '$harga',
                  '$id_agen',
                  '$luas_bangunan',
                  '$luas_tanah',
                  '$kamar_tidur',
                  '$kamar_mandi',
                  '$fotobaru',
                  '$deskripsi',
                  '$nomor_telepon',
                  '$status'
              )");

      if ($insert) {
          echo "<script>
                  alert('Data properti berhasil ditambahkan!');
                  document.location='properti.php';
              </script>";
      } else {
          echo "<script>
                  alert('Gagal menambahkan data: ".mysqli_error($koneksi)."');
                  window.history.back();
              </script>";
      }
  } else {
      echo "<script>
              alert('Gagal mengupload foto!');
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
              <h3 class="page-title">Tambah Properti</h3>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" method="POST" enctype="multipart/form-data">

                      <div class="form-group">
                        <label for="nama_properti">Nama Properti</label>
                        <input type="text" class="form-control" id="nama_properti" name="nama_properti" placeholder="Cluster Dahlia - Type 36/72" required>
                      </div>
                      <div class="form-group">
                        <label for="id_agen">Pilih Agen</label>
                        <select class="form-control" id="id_agen" name="id_agen" required>
                          <option value="" disabled selected>-- Pilih Agen --</option>
                          <?php
                            $query_agen = mysqli_query($koneksi, "SELECT * FROM agen_222146 ORDER BY nama_agen_222146 ASC");
                            while($agen = mysqli_fetch_array($query_agen)) {
                              echo "<option value='".$agen['id_agen_222146']."'>".$agen['nama_agen_222146']."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="harga">Harga Properti</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="450000000" required>
                      </div>
                      <div class="form-group">
                        <label for="luas_bangunan">Luas Bangunan (m²)</label>
                        <input type="number" class="form-control" id="luas_bangunan" name="luas_bangunan" placeholder="36" required>
                      </div>
                      <div class="form-group">
                        <label for="luas_tanah">Luas Tanah (m²)</label>
                        <input type="number" class="form-control" id="luas_tanah" name="luas_tanah" placeholder="72" required>
                      </div>
                      <div class="form-group">
                        <label for="kamar_tidur">Kamar Tidur</label>
                        <input type="number" class="form-control" id="kamar_tidur" name="kamar_tidur" placeholder="2" required>
                      </div>
                      <div class="form-group">
                        <label for="kamar_mandi">Kamar Mandi</label>
                        <input type="number" class="form-control" id="kamar_mandi" name="kamar_mandi" placeholder="1" required>
                      </div>
                      <div class="form-group">
                        <label>Foto Properti</label>
                        <input type="file" name="foto_properti" class="file-upload-default" required>
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Deskripsi Properti</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Jl. Dahlia Raya No. 10, Perumahan Green Garden, Kota Baru" required>
                      </div>
                      <div class="form-group">
                        <label for="whatsapp">Nomor WhatsApp</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="628123456789" required>
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" name="status" id="status" required>
                          <option value="Tersedia">Tersedia</option>
                          <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
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