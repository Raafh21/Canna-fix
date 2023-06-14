<?php
include 'connect.php'; // Ganti 'connect.php' dengan nama file dan jalur yang benar ke file 'koneksi.php'

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM tb_training WHERE id='$id'");
mysqli_query($conn,"DELETE FROM tb_training2 WHERE id='$id'");

header('location: training.php');

mysqli_close($conn);
?>

