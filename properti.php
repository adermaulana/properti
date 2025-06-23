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

  // Query untuk mendapatkan properti dengan status terjual
  $query = "SELECT p.*, 
                   CASE WHEN t.id_properti_222146 IS NOT NULL THEN 'Terjual' ELSE p.status_222146 END as status_properti
            FROM properti_222146 p 
            LEFT JOIN transaksi_222146 t ON p.id_properti_222146 = t.id_properti_222146 
            WHERE p.status_222146 = 'Tersedia'
            ORDER BY CASE WHEN t.id_properti_222146 IS NOT NULL THEN 1 ELSE 0 END, p.id_properti_222146 DESC";
  $result = mysqli_query($koneksi, $query);

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
         background-color: rgba(0, 0, 0, 0.7);
         display: flex;
         justify-content: center;
         align-items: center;
         z-index: 10;
      }

      .sold-out-text {
         color: white;
         font-size: 24px;
         font-weight: bold;
         background-color: rgba(255, 0, 0, 0.9);
         padding: 15px 30px;
         transform: rotate(-45deg);
         text-transform: uppercase;
         letter-spacing: 3px;
         border-radius: 5px;
         border: 2px solid white;
         box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      }

      .property.sold {
         opacity: 0.8;
         filter: grayscale(30%);
      }

      .property.sold .property_img {
         position: relative;
      }

      .property.sold .btn-primary {
         background-color: #6c757d;
         border-color: #6c757d;
         cursor: not-allowed;
         opacity: 0.6;
      }

      .property.sold .btn-primary:hover {
         background-color: #6c757d;
         border-color: #6c757d;
         transform: none;
         box-shadow: none;
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

.property:hover:not(.sold) {
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

.property:hover:not(.sold) .property_img img {
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
   
   .sold-out-text {
      font-size: 18px;
      padding: 10px 20px;
      letter-spacing: 2px;
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
                                <li class="nav-item ">
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
                     <h2>Daftar Properti</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- our_room -->
    <div class="our_room">
        <div class="container">
            <div class="row">
                <?php while($properti = mysqli_fetch_assoc($result)): ?>
                    <?php $isSold = ($properti['status_properti'] == 'Terjual'); ?>
                    <div class="col-md-4 col-sm-6">
                        <div id="prop_hover" class="property <?php echo $isSold ? 'sold' : ''; ?>">
                            <div class="property_img position-relative">
                                <figure>
                                    <img src="admin/uploads/<?= $properti['foto_222146'] ?>" alt="<?= $properti['nama_properti_222146'] ?>"/>
                                </figure>
                                
                                <?php if($isSold): ?>
                                    <div class="sold-out-overlay">
                                        <div class="sold-out-text">TERJUAL</div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if($isSold): ?>
                                    <div class="property_tag">
                                        <span class="tag_sold">Terjual</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="property_details">
                                <h3><?= $properti['nama_properti_222146'] ?></h3>
                                <div class="property_specs">
                                    <span><i class="fas fa-ruler-combined"></i> <?= $properti['luas_bangunan_222146'] ?>m² / <?= $properti['luas_tanah_222146'] ?>m²</span>
                                    <span><i class="fas fa-bed"></i> <?= $properti['kamar_tidur_222146'] ?> Kamar</span>
                                    <span><i class="fas fa-bath"></i> <?= $properti['kamar_mandi_222146'] ?> Kamar Mandi</span>
                                </div>
                                <p><?= substr($properti['deskripsi_222146'], 0, 100) ?>...</p>
                                <div class="property_price">
                                    <h4>Rp. <?= number_format($properti['harga_222146'], 0, ',', '.') ?></h4>
                                    <?php if(!empty($properti['promo_text_222146']) && !$isSold): ?>
                                        <span class="promo"><?= $properti['promo_text_222146'] ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if($isSold): ?>
                                    <button class="btn btn-primary mt-3" disabled>Properti Telah Terjual</button>
                                    <div class="sold-out-notice">
                                        <p><i class="fa fa-info-circle"></i> Properti ini sudah tidak tersedia karena telah terjual</p>
                                    </div>
                                <?php else: ?>
                                    <a href="detail.php?id=<?= $properti['id_properti_222146'] ?>" class="btn btn-primary mt-3">Lihat Detail</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
         </div>
      </div>
      <!-- end our_room -->
     
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