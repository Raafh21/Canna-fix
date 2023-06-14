<?php 
session_start();
$title = "Login - CannaApp";
require 'functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: home.php");
}


if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $row["username"];

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: home.php");
        } else {
            $_SESSION['error'] = "<strong>Password Salah!</strong>";
        }
    } else {
        $_SESSION['error'] = "<strong>Akun Tidak Terdaftar!</strong>";
    }

    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sistem penjurusan Siswa - Canna</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logo3.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/flex-start/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/flex-start/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/flex-start/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/flex-start/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/flex-start/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/flex-start/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/mazer/vendors/simple-datatables/style.css">

    <!-- Template Main CSS File -->
    <link href="assets/flex-start/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexStart - v1.12.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo1.png" alt="">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="navbar-nav " href="klasifikasi.php">Klasifikasi</a></li>
                    <li><a class="navbar-nav " href="riwayat-klasifikasi.php">Riwayat Klasifikasi</a></li>
                    <li><a class="navbar-nav " href="about.php">Tentang</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <section id="hero" class="hero d-flex align-items-center">
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <br><br>
                        <img class="mb-4" src="assets/img/BG2.png" alt="" width="380" height="340" data-aos="fade-up">

                        <h6 class="mt-2" data-aos="fade-up" data-aos-delay="400"> Login ke administrator berfungsi untuk
                            mengakses decision tree, data latih, & beberapa hal terkait algoritma C4.5 lainnya.
                        </h6>
                    </div>
                    <main class="form-signin w-100 m-auto" data-aos="fade-up">
                        <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['error'];  ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                        <?php } ?>
                        <form action="" method="post">
                            <div class="form-floating" data-aos="fade-up" data-aos-delay="">
                                <input type="text" name='username' class="form-control" id="username"
                                    placeholder="username" autocomplete="off" autofocus required>
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mt-3" data-aos="fade-up" data-aos-delay="800">
                                <input type="password" name='password' autocomplete="off" class="form-control"
                                    id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                <br>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login" data-aos="fade-up"
                                data-aos-delay="1200">Login</button>
                            <small class=" d-block text-center mt-4" data-aos="fade-up" data-aos-delay="1400">
                                silahkan menghubungi devloper untuk mendapatkan akses ke administrator
                                <br><br>&copy;canna-2023 | <a href="/kontak">Raafh</a>
                            </small>

                        </form>
                    </main>
                </section>
            </div>
        </div>
    </section>
    <?php 
    require 'layouts/footer_app.php';
?>