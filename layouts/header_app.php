<?php 
session_start();
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
                    <?php
                        if (!empty($_SESSION["login"])) {
                    ?>
                    <li><a class="getstarted" href="home.php">Dashboard</a></li>
                    <li><a class="getstarted" href="logout.php">Keluar</a></li>
                    <?php } else { ?>
                    <li><a class="getstarted" href="login.php">Masuk</a></li>
                    <?php } ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->