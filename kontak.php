<?php

include 'koneksi.php';

session_start();


if (isset($_SESSION['username_admin'])) {
   $isLoggedIn = true;
   $namaAdmin = $_SESSION['nama_admin']; // Ambil nama user dari session
} elseif (isset($_SESSION['username_pelanggan'])) {
   $isLoggedIn = true;
   $namaPelanggan = $_SESSION['nama_pelanggan']; // Ambil nama user dari session
} elseif (isset($_SESSION['username_agen'])) {
   $isLoggedIn = true;
   $namaAgen = $_SESSION['nama_agen']; // Ambil nama user dari session
} else {
   $isLoggedIn = false;
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Properti</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="assets/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="assets/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="assets/images/logoproperti.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="assets/images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.php"><img src="assets/images/logoproperti.png" width="120" style="margin-top:-25px;" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="properti.php">Properti</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="gallery.html">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="blog.html">Blog</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link active" href="kontak.php">Kontak</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                        <?php if($isLoggedIn): ?>
                                            <?php if(isset($_SESSION['username_admin'])): ?>
                                            <a href="admin" class="nav-link">Dashboard</a>
                                            <?php elseif(isset($_SESSION['username_agen'])): ?>
                                            <a href="agen" class="nav-link">Dashboard</a>
                                            <?php else: ?>
                                            <a href="pelanggan" class="nav-link">Dashboard</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                        <a class="nav-link" href="login.php">Login</a>
                                        <?php endif; ?>
                                    </li>
                            </ul>
                        </div>
                    </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
     <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                      <h2>Kontak</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--  contact -->
      <div class="contact">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-6 text-center">
                  <form class="main_form">
                     <div class="row">
                        <div class="col-md-12">
                           <input class="contactus text-center" placeholder="Alamat" name="Name" value="Alamat: Jl. Perintis Kemerdekaan" readonly> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus text-center" placeholder="Telepon" value="Telepon: +62 853456789" readonly> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus text-center" placeholder="Email" value="Email: properti@gmail.com" readonly>                          
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class=" col-md-6">
                     <h3>Kontak</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>Jl. Perintis Kemerdekaan</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i>+62 853456789</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#">properti@gmail.com</a></li>
                     </ul>
                  </div>
                  <div class="col-md-6">
                     <h3>Menu Link</h3>
                     <ul class="link_menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="properti.php">Properti</a></li>
                        <li><a href="kontak.php">Kontak</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-10 offset-md-1">
                        
                        <p>
                        © 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a>
                        <br><br>
                        Distributed by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                        </p>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="assets/js/custom.js"></script>
   </body>
</html>