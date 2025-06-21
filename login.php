<?php

    include 'koneksi.php';

    session_start();

    if(isset($_SESSION['status']) == 'login'){

        header("location:admin");
    }

$error_message = '';
$password_error = '';

if(isset($_POST['login'])){
    // Validate input
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $error_message = "Username dan password harus diisi!";
    } elseif(strlen($_POST['password']) < 8) {
        $password_error = "Password minimal 8 karakter!";
        $error_message = "Password minimal 8 karakter!";
    } else {
        // Sanitize input
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = md5($_POST['password']);

        // Check admin login
        $login = mysqli_query($koneksi, "SELECT * FROM admin_222146 WHERE username_admin_222146='$username' AND password_admin_222146='$password'");
        $cek = mysqli_num_rows($login);

        // Check agen login
        $loginAgen = mysqli_query($koneksi, "SELECT * FROM agen_222146 WHERE username_222146='$username' AND password_222146='$password'");
        $cekAgen = mysqli_num_rows($loginAgen);

        // Check pelanggan login
        $loginPelanggan = mysqli_query($koneksi, "SELECT * FROM pengguna_222146 WHERE username_222146='$username' AND password_222146='$password'");
        $cekPelanggan = mysqli_num_rows($loginPelanggan);

        if($cek > 0) {
            // Admin login
            $admin_data = mysqli_fetch_assoc($login);
            $_SESSION['id_admin'] = $admin_data['id_admin_222146'];
            $_SESSION['nama_admin'] = $admin_data['username_admin_222146'];
            $_SESSION['username_admin'] = $username;
            $_SESSION['status'] = "login";
            $_SESSION['role'] = "admin";
            header('location: admin/');
            exit();

        } else if ($cekPelanggan > 0) {
            // Pelanggan login
            $pelanggan_data = mysqli_fetch_assoc($loginPelanggan);
            $_SESSION['id_pelanggan'] = $pelanggan_data['id_pengguna_222146'];
            $_SESSION['nama_pelanggan'] = $pelanggan_data['nama_222146'];
            $_SESSION['username_pelanggan'] = $username;
            $_SESSION['alamat_pelanggan'] = $pelanggan_data['alamat_222146'];
            $_SESSION['telepon_pelanggan'] = $pelanggan_data['no_hp_222146'];
            $_SESSION['status'] = "login";
            $_SESSION['role'] = "pelanggan";
            header('location: pelanggan/');
            exit();

        } else if ($cekAgen > 0) {
            // Agen login
            $agen_data = mysqli_fetch_assoc($loginAgen);
            $_SESSION['id_agen'] = $agen_data['id_agen_222146'];
            $_SESSION['nama_agen'] = $agen_data['nama_agen_222146'];
            $_SESSION['username_agen'] = $username;
            $_SESSION['alamat_agen'] = $agen_data['alamat_222146'];
            $_SESSION['telepon_agen'] = $agen_data['no_hp_222146'];
            $_SESSION['status'] = "login";
            $_SESSION['role'] = "agen";
            header('location: agen/');
            exit();

        } else {
            $error_message = "Login gagal! Username atau password salah.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
<!--===============================================================================================-->


<style>
.alert {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

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
                Account Login
            </span>
            <?php if(!empty($error_message)): ?>
                <div class="alert alert-danger text-center mb-3" style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>
            <form class="login100-form validate-form p-b-33 p-t-5" method="POST">
                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input class="input100" type="text" name="username" placeholder="User name" 
                        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
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
                    <button class="login100-form-btn" type="submit" name="login">
                        Login
                    </button>
                </div>

                <!-- Tambahkan Link Registrasi -->
                <div class="text-center mt-3">
                    <span class="txt2">
                        Belum punya akun?
                    </span>
                    <a class="txt2" href="registrasi.php">
                        Registrasi
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/js/main.js"></script>

</body>
</html>