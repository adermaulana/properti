<?php

include 'koneksi.php';

session_start();

// Ambil ID properti dari URL
$id_properti = isset($_GET['id']) ? $_GET['id'] : null;

// Query untuk mendapatkan detail properti berdasarkan ID
$query_properti = "SELECT * FROM properti_222146 WHERE id_properti_222146 = '$id_properti'";
$result_properti = mysqli_query($koneksi, $query_properti);
$properti = mysqli_fetch_assoc($result_properti);

if(!$properti) {
    // Jika properti tidak ditemukan
    header("Location: properti.php");
    exit();
}

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
    <title>Detail Properti</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .property:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
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
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
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
        <div class="loader"><img src="assets/images/loading.gif" alt="#" /></div>
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
                                    <a href="index.php"><img src="assets/images/logoproperti.png" width="120"
                                            style="margin-top:-25px;" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
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
    <div class="back_re mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Detail Properti</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- our_room -->
    <div class="property_detail">
        <div class="container">
            <div class="row">
                <!-- Property Image Gallery -->
                <div class="col-md-8">
                    <div class="detail_gallery">
                        <div class="main_image">
                            <img src="admin/uploads/<?= $properti['foto_222146'] ?>" alt="Cluster Dahlia" class="img-fluid rounded" />
                            <div class="property_tag">
                                <span class="tag_best">BEST DEAL</span>
                            </div>
                        </div>
                     
                    </div>
                </div>

                <!-- Property Quick Info -->
                <div class="col-md-4">
                    <div class="property_quick_info">
                        <h2><?php echo $properti['nama_properti_222146']; ?></h2>
                        <div class="property_price_detail">
                            <h3>Rp. <?php echo number_format($properti['harga_222146'], 0, ',', '.'); ?></h3>
                            <span class="promo">Dp Mulai 10%</span>
                        </div>
                        <div class="property_specs_detail mt-4">
                            <div class="spec_item">
                                <i class="fas fa-ruler-combined"></i>
                                <div class="spec_content">
                                    <h5>Luas Bangunan/Tanah</h5>
                                    <p><?php echo $properti['luas_bangunan_222146']; ?>m² / <?php echo $properti['luas_tanah_222146']; ?>m²</p>
                                </div>
                            </div>
                            <!-- Item spesifikasi lainnya -->
                        </div>

                        <div class="contact_buttons mt-4">
                            <?php if($isLoggedIn && isset($_SESSION['username_pelanggan'])): ?>
                                <!-- Modal Trigger -->
                                <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                    <i class="fas fa-shopping-cart"></i> Beli Properti
                                </button>
                                
                                <!-- Payment Method Modal -->
                                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paymentModalLabel">Pilih Metode Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="proses_pemesanan.php" id="paymentForm">
                                                    <input type="hidden" name="id_properti" value="<?php echo $properti['id_properti_222146']; ?>">
                                                    <input type="hidden" name="harga_properti" value="<?php echo $properti['harga_222146']; ?>">
                                                    
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="payment_method" id="fullPayment" value="full" checked>
                                                            <label class="form-check-label" for="fullPayment">
                                                                <strong>Pembayaran Penuh</strong><br>
                                                                <small>Bayar seluruh harga properti sekaligus</small>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="payment_method" id="installmentPayment" value="installment">
                                                            <label class="form-check-label" for="installmentPayment">
                                                                <strong>Pembayaran Cicilan</strong><br>
                                                                <small>Bayar dengan sistem cicilan</small>
                                                            </label>
                                                        </div>
                                                        
                                                        <div id="installmentOptions" style="display: none; margin-top: 15px; padding-left: 20px;">
                                                            <div class="mb-3">
                                                                <label for="dp_percentage" class="form-label">Uang Muka (DP)</label>
                                                                <select class="form-select" id="dp_percentage" name="dp_percentage">
                                                                    <option value="10">10%</option>
                                                                    <option value="20">20%</option>
                                                                    <option value="30" selected>30%</option>
                                                                    <option value="40">40%</option>
                                                                    <option value="50">50%</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="jumlah_cicilan" class="form-label">Jumlah Cicilan</label>
                                                                <select class="form-select" id="jumlah_cicilan" name="jumlah_cicilan">
                                                                    <option value="3">3 Bulan</option>
                                                                    <option value="6" selected>6 Bulan</option>
                                                                    <option value="12">12 Bulan</option>
                                                                    <option value="24">24 Bulan</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="alert alert-info">
                                                                <h6>Perkiraan Cicilan:</h6>
                                                                <p id="installmentCalculation">
                                                                    DP: <span id="dpAmount">0</span><br>
                                                                    Cicilan: <span id="installmentAmount">0</span>/bulan
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-grid gap-2">
                                                        <button type="submit" name="proses_pembayaran" class="btn btn-primary">Lanjutkan Pembayaran</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <script>
                                    // Tampilkan opsi cicilan ketika dipilih
                                    document.getElementById('installmentPayment').addEventListener('change', function() {
                                        document.getElementById('installmentOptions').style.display = 'block';
                                        calculateInstallment();
                                    });
                                    
                                    document.getElementById('fullPayment').addEventListener('change', function() {
                                        document.getElementById('installmentOptions').style.display = 'none';
                                    });
                                    
                                    // Form submission handler
                                    document.getElementById('paymentForm').addEventListener('submit', function(e) {
                                        // Add the correct button based on payment method
                                        var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
                                        
                                        if (paymentMethod == 'full') {
                                            // Add beli button for full payment
                                            var inputElement = document.createElement('input');
                                            inputElement.type = 'hidden';
                                            inputElement.name = 'beli';
                                            inputElement.value = '1';
                                            this.appendChild(inputElement);
                                        } else if (paymentMethod == 'installment') {
                                            // Add beli_cicil button for installment
                                            var inputElement = document.createElement('input');
                                            inputElement.type = 'hidden';
                                            inputElement.name = 'beli_cicil';
                                            inputElement.value = '1';
                                            this.appendChild(inputElement);
                                        }
                                    });
                                    
                                    // Hitung cicilan
                                    function calculateInstallment() {
                                        const harga = <?php echo $properti['harga_222146']; ?>;
                                        const dpPercentage = parseInt(document.getElementById('dp_percentage').value);
                                        const jumlahCicilan = parseInt(document.getElementById('jumlah_cicilan').value);
                                        
                                        const dpAmount = (dpPercentage / 100) * harga;
                                        const installmentAmount = (harga - dpAmount) / jumlahCicilan;
                                        
                                        document.getElementById('dpAmount').textContent = 'Rp ' + dpAmount.toLocaleString('id-ID');
                                        document.getElementById('installmentAmount').textContent = 'Rp ' + installmentAmount.toLocaleString('id-ID');
                                    }
                                    
                                    // Hitung saat perubahan input
                                    document.getElementById('dp_percentage').addEventListener('change', calculateInstallment);
                                    document.getElementById('jumlah_cicilan').addEventListener('change', calculateInstallment);
                                    
                                    // Hitung awal
                                    calculateInstallment();
                                </script>

                            <?php else: ?>
                                <a href="login.php" class="btn btn-primary btn-block">
                                    <i class="fas fa-shopping-cart"></i> Login untuk Membeli
                                </a>
                            <?php endif; ?>
                            <a href="https://wa.me/628123456789" class="btn btn-success btn-block mt-2">
                                <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <!-- Property Description -->
                <div class="col-md-8">
                    <div class="property_description">
                        <div class="section_title">
                            <h3>Deskripsi Properti</h3>
                        </div>
                        <div class="description_content">
                            <p>Rumah minimalis modern di kawasan asri dan bebas banjir. Cluster Dahlia merupakan hunian
                                dengan konsep modern minimalis yang didesain untuk memberikan kenyamanan maksimal bagi
                                keluarga kecil.</p>
                            <p>Terletak di kawasan strategis dengan akses mudah ke berbagai fasilitas umum seperti
                                sekolah, rumah sakit, dan pusat perbelanjaan. Lingkungan yang asri, aman, dan nyaman
                                menjadikan Cluster Dahlia sebagai pilihan tepat untuk hunian keluarga.</p>
                            <p>Spesifikasi bangunan premium dengan material berkualitas, dan desain yang memaksimalkan
                                sirkulasi udara dan pencahayaan alami.</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="property_sidebar">
                        <div class="sidebar_section">
                            <div class="section_title">
                                <h3>Lokasi</h3>
                            </div>
                            <div class="location_map">
                                <div class="location_details mt-3">
                                    <p><i class="fas fa-map-marker-alt"></i> Jl. Dahlia Raya No. 10, Perumahan Green
                                        Garden, Kota Baru</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#">
                                    kost@gmail.com</a></li>
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
                                © 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html
                                    Templates</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
