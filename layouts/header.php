<?php 
session_start();
require 'functions.php';
if (isset($_SESSION["login"])) {
    $user = $_SESSION["username"];
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user'");
    $admin = mysqli_fetch_assoc($query);
}
// Total Data User
$totUser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_user"));
// Total Data Training
$totDataTraining = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_training2"));
// Total Rule
$jumlahRule = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM t_keputusan"));
// Total Data Uji
$jumlahDataUji = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_klasifikasi"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - CannaApp</title>

    <!-- Favicons -->
    <link href="assets/img/logo3.png" rel="icon">
    <link href="assets/flex-start/img/logo.png" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/mazer/css/bootstrap.css">

    <link rel="stylesheet" href="assets/mazer/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/mazer/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="assets/mazer/vendors/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/mazer/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/mazer/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/mazer/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/mazer/css/app.css">
    <link rel="shortcut icon" href="assets/mazer/images/favicon.svg" type="image/x-icon">


    <style>
    .treeview ul {
        padding-left: 20px;
        list-style: none;
    }

    .treeview li {
        margin-bottom: 10px;
    }

    .treeview li span {
        font-weight: bold;
        cursor: pointer;
    }

    .treeview li ul li span {
        font-weight: normal;
    }

    .treeview li ul {
        display: none;
    }

    .treeview li.active>ul {
        display: block;
    }
    </style>

</head>

<body>
    <div id="app">