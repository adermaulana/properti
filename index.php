<?php

include 'koneksi.php';

session_start();


  if(isset($_SESSION['username_admin'])) {
    $isLoggedIn = true;
    $namaAdmin = $_SESSION['nama_admin']; // Ambil nama user dari session
  } else if(isset($_SESSION['username_pelanggan'])) {
    $isLoggedIn = true;
    $namaPelanggan = $_SESSION['nama_pelanggan']; // Ambil nama user dari session
  } 

  else {
      $isLoggedIn = false;
  }


  if (isset($_POST['pesan'])) {
   
   header("location:kamar.php");
  
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
      <style>

      .carousel-item img {
      width: 100%;        /* Set the width to 100% of the container */
      height: auto;      /* Maintain aspect ratio */
      object-fit: cover; /* Ensures the image covers the container without distortion */
      }

      .room_img {
         position: relative;
         overflow: hidden;
      }

      .sold-out-overlay {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .sold-out-text {
         color: white;
         font-size: 24px;
         font-weight: bold;
         background-color: rgba(255, 0, 0, 0.7);
         padding: 10px 20px;
         transform: rotate(-45deg);
         text-transform: uppercase;
         letter-spacing: 2px;
      }
      

      .carousel-caption {
   bottom: 30%;
   text-align: left;
   padding: 20px;
   background: rgba(0,0,0,0.5);
   border-left: 4px solid #ff5722;
   max-width: 600px;
}

.carousel-caption h2 {
   font-size: 36px;
   font-weight: 700;
   margin-bottom: 15px;
   color: #fff;
}

.carousel-caption p {
   font-size: 18px;
   line-height: 1.5;
   color: #fff;
}


.titlepage p {
   font-size: 18px;
   color: #666;
   max-width: 700px;
   margin: 15px auto 0;
}

.property {
   background: #fff;
   border-radius: 10px;
   overflow: hidden;
   box-shadow: 0 5px 15px rgba(0,0,0,0.1);
   margin-bottom: 30px;
   transition: all 0.3s ease;
}

.property:hover {
   transform: translateY(-10px);
   box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.property_img {
   position: relative;
   overflow: hidden;
   height: 220px;
}

.property_img figure {
   margin: 0;
   height: 100%;
}

.property_img img {
   width: 100%;
   height: 100%;
   object-fit: cover;
   transition: transform 0.5s ease;
}

.property:hover .property_img img {
   transform: scale(1.1);
}

.property_tag {
   position: absolute;
   top: 15px;
   right: 15px;
}

.property_tag span {
   display: inline-block;
   padding: 5px 12px;
   border-radius: 5px;
   font-size: 12px;
   font-weight: 600;
   text-transform: uppercase;
   color: #fff;
}

.tag_best {
   background-color: #ff5722;
}

.tag_new {
   background-color: #4CAF50;
}

.tag_sold {
   background-color: #f44336;
}

.tag_limited {
   background-color: #FF9800;
}

.tag_premium {
   background: linear-gradient(45deg, #1976D2, #64B5F6);
}

.property_details {
   padding: 20px;
}

.property_details h3 {
   font-size: 20px;
   font-weight: 600;
   color: #333;
   margin-bottom: 15px;
}

.property_specs {
   display: flex;
   flex-wrap: wrap;
   margin-bottom: 15px;
   gap: 10px;
}

.property_specs span {
   font-size: 14px;
   color: #666;
   margin-right: 15px;
   display: flex;
   align-items: center;
}

.property_specs span i {
   margin-right: 5px;
   color: #ff5722;
}

.property_details p {
   font-size: 14px;
   color: #666;
   margin-bottom: 15px;
   line-height: 1.5;
   height: 42px;
   overflow: hidden;
}

.property_price {
   display: flex;
   align-items: center;
   justify-content: space-between;
   margin-bottom: 5px;
}

.property_price h4 {
   font-size: 18px;
   font-weight: 700;
   color: #ff5722;
   margin: 0;
}

.property_price .promo {
   font-size: 12px;
   background-color: #e3f2fd;
   color: #1976D2;
   padding: 3px 8px;
   border-radius: 4px;
   font-weight: 500;
}

.btn-primary {
   background-color: #ff5722;
   border-color: #ff5722;
   border-radius: 5px;
   font-weight: 500;
   padding: 8px 20px;
   transition: all 0.3s ease;
   width: 100%;
}

.btn-primary:hover {
   background-color: #e64a19;
   border-color: #e64a19;
   transform: translateY(-3px);
   box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}

.sold-out-notice {
   background-color: #f8d7da;
   border-radius: 5px;
   padding: 10px;
   margin-top: 10px;
   text-align: center;
}

.sold-out-notice p {
   color: #721c24;
   margin: 0;
   font-size: 13px;
   height: auto;
}

.btn-view-all {
   background-color: transparent;
   border: 2px solid #ff5722;
   color: #ff5722;
   padding: 10px 30px;
   font-weight: 600;
   border-radius: 30px;
   transition: all 0.3s ease;
}

.btn-view-all:hover {
   background-color: #ff5722;
   color: #fff;
   transform: translateY(-3px);
   box-shadow: 0 5px 15px rgba(255, 87, 34, 0.3);
}

/* Responsif untuk mobile */
@media (max-width: 767px) {
   .our_properties {
      padding: 50px 0;
   }
   
   .titlepage h2 {
      font-size: 28px;
   }
   
   .titlepage p {
      font-size: 16px;
   }
   
   .property_img {
      height: 180px;
   }
}

      </style>



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
                                <li class="nav-item active">
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
                                    <a class="nav-link" href="kontak.php">Kontak</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                 <?php if($isLoggedIn): ?>
                                       <?php if(isset($_SESSION['username_admin'])): ?>
                                          <a href="admin" class="nav-link">Dashboard</a>
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
      <!-- banner -->
      <section class="banner_main">
         <div id="propertyCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#propertyCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#propertyCarousel" data-slide-to="1"></li>
               <li data-target="#propertyCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide" src="assets/images/properti.jpg" alt="Rumah Impian Anda">
                  <div class="carousel-caption d-none d-md-block">
                     <h2>Temukan Rumah Impian Anda</h2>
                     <p>Hunian modern dengan desain eksklusif yang siap menjadi milik Anda</p>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide" src="assets/images/properti2.jpg" alt="Investasi Masa Depan">
                  <div class="carousel-caption d-none d-md-block">
                     <h2>Investasi Cerdas untuk Masa Depan</h2>
                     <p>Nilai properti yang terus meningkat dengan lokasi strategis</p>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="third-slide" src="assets/images/properti3.jpeg" alt="Lingkungan Asri">
                  <div class="carousel-caption d-none d-md-block">
                     <h2>Lingkungan Asri dan Nyaman</h2>
                     <p>Nikmati kenyamanan hidup dengan fasilitas lengkap dan keamanan 24 jam</p>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#propertyCarousel" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
            </a>
         </div>
   
      </section>
      <!-- end banner -->

      <div  class="our_room">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Properti Pilihan</h2>
                     <p>Rumah Impian dengan Harga Terbaik di Lokasi Strategis</p>
                  </div>
               </div>
            </div>
       <div class="row">
         <!-- Properti 1 -->
         <div class="col-md-4 col-sm-6">
            <div id="prop_hover" class="property">
               <div class="property_img position-relative">
                  <figure>
                     <img src="assets/images/36.jpg" alt="Rumah Type 36"/>
                     <div class="property_tag">
                        <span class="tag_best">BEST DEAL</span>
                     </div>
                  </figure>
               </div>
               <div class="property_details">
                  <h3>Cluster Dahlia - Type 36/72</h3>
                  <div class="property_specs">
                     <span><i class="fas fa-ruler-combined"></i> 36m² / 72m²</span>
                     <span><i class="fas fa-bed"></i> 2 Kamar</span>
                     <span><i class="fas fa-bath"></i> 1 Kamar Mandi</span>
                  </div>
                  <p>Rumah minimalis modern di kawasan asri dan bebas banjir</p>
                  <div class="property_price">
                     <h4>Rp. 450.000.000</h4>
                     <span class="promo">Dp Mulai 5%</span>
                  </div>
                  <a href="detail-properti.php?id=1" class="btn btn-primary mt-3">Lihat Detail</a>
               </div>
            </div>
         </div>

         <!-- Properti 2 -->
         <div class="col-md-4 col-sm-6">
            <div id="prop_hover" class="property">
               <div class="property_img position-relative">
                  <figure>
                     <img src="assets/images/45.jpg" alt="Rumah Type 45"/>
                     <div class="property_tag">
                        <span class="tag_new">UNIT BARU</span>
                     </div>
                  </figure>
               </div>
               <div class="property_details">
                  <h3>Cluster Mawar - Type 45/90</h3>
                  <div class="property_specs">
                     <span><i class="fas fa-ruler-combined"></i> 45m² / 90m²</span>
                     <span><i class="fas fa-bed"></i> 2 Kamar</span>
                     <span><i class="fas fa-bath"></i> 2 Kamar Mandi</span>
                  </div>
                  <p>Desain modern dengan taman belakang dan carport luas</p>
                  <div class="property_price">
                     <h4>Rp. 650.000.000</h4>
                     <span class="promo">Free Custom Kitchen</span>
                  </div>
                  <a href="detail-properti.php?id=2" class="btn btn-primary mt-3">Lihat Detail</a>
               </div>
            </div>
         </div>

         <!-- Properti 3 -->
         <div class="col-md-4 col-sm-6">
            <div id="prop_hover" class="property">
               <div class="property_img position-relative">
                  <figure>
                     <img src="assets/images/54.jpg" alt="Rumah Type 54"/>
                     <div class="property_tag">
                        <span class="tag_sold">TERJUAL</span>
                     </div>
                  </figure>
               </div>
               <div class="property_details">
                  <h3>Cluster Anggrek - Type 54/120</h3>
                  <div class="property_specs">
                     <span><i class="fas fa-ruler-combined"></i> 54m² / 120m²</span>
                     <span><i class="fas fa-bed"></i> 3 Kamar</span>
                     <span><i class="fas fa-bath"></i> 2 Kamar Mandi</span>
                  </div>
                  <p>Rumah 2 lantai dengan area taman yang luas dan balkon</p>
                  <div class="property_price">
                     <h4>Rp. 850.000.000</h4>
                     <span class="promo">Bonus AC 2 Unit</span>
                  </div>
                  <div class="sold-out-notice">
                     <p>Maaf, unit ini telah terjual. Silakan lihat properti lainnya.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <!-- Tombol lihat semua properti -->
      <div class="row mt-4">
         <div class="col-md-12 text-center">
            <a href="properti.php" class="btn btn-lg btn-view-all">Lihat Semua Properti</a>
         </div>
      </div>
   </div>
</div>

      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class=" col-md-6">
                     <h3>Kontak</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Jl. Perintis Kemerdekaan</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> +62 858349494</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> kost@gmail.com</a></li>
                     </ul>
                  </div>
                  <div class="col-md-6">
                     <h3>Menu Link</h3>
                     <ul class="link_menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="kamar.php">Properti</a></li>
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