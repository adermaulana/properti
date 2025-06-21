<?php
include 'koneksi.php';
session_start();

// Redirect if already logged in
if(isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
    header("location:admin");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    // Validate password length
    $password_error = '';
    if(strlen($password) < 8) {
        $password_error = "Password minimal 8 karakter!";
    }
    
    // Check if username already exists
    $check_query = "SELECT * FROM pengguna_222146 WHERE username_222146 = '$username'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        $error = "Username sudah digunakan!";
    } elseif(!empty($password_error)) {
        // Don't proceed if password validation fails
        $error = $password_error;
    } else {
        // Hash password
        $hashed_password = md5($password);
        
        // Insert new user
        $insert_query = "INSERT INTO pengguna_222146 (
            nama_222146,
            no_hp_222146,
            alamat_222146,
            username_222146,
            password_222146,
            created_at_222146
        ) VALUES (
            '$nama',
            '$telepon',
            '$alamat',
            '$username',
            '$hashed_password',
            NOW()
        )";
        
        if(mysqli_query($koneksi, $insert_query)) {
            $success = "Registrasi berhasil! Silakan login.";
            // Clear form
            $_POST = array();
        } else {
            $error = "Registrasi gagal: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrasi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">


    <style>
        .text-danger {
            color: #dc3545 !important;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }
    </style>

</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/login/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Account Registrasi
                </span>
                
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger" style="color: #fff; background-color: #ff4444; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($success)): ?>
                    <div class="alert alert-success" style="color: #fff; background-color: #00C851; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        <?= $success ?>
                    </div>
                <?php endif; ?>
                
            <form class="login100-form validate-form p-b-33 p-t-5" method="POST">
                <div class="wrap-input100 validate-input" data-validate="Enter Nama">
                    <input class="input100" type="text" name="nama" placeholder="Nama" 
                        value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>" required>
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input class="input100" type="text" name="username" placeholder="Username" 
                        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter Telepon">
                    <input class="input100" type="number" name="telepon" placeholder="Telepon" 
                        value="<?= isset($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : '' ?>" required>
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter Alamat">
                    <input class="input100" type="text" name="alamat" placeholder="Alamat" 
                        value="<?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : '' ?>" required>
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    <?php if(isset($password_error) && !empty($password_error)): ?>
                        <small class="text-danger d-block mt-1" style="color: red; font-size: 12px; margin-left:20px;">
                            <?= $password_error ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit" name="register">
                        Registrasi
                    </button>
                </div>

                <div class="text-center mt-3">
                    <span class="txt2">
                        Sudah punya akun?
                    </span>
                    <a class="txt2" href="login.php">
                        Login
                    </a>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>
    
    <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
    <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/login/vendor/select2/select2.min.js"></script>
    <script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
    <script src="assets/login/js/main.js"></script>
</body>
</html>