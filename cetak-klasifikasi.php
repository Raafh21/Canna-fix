<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

require 'functions.php';
$sql = mysqli_query($conn, "SELECT * FROM tb_klasifikasi");

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Hasil Klasifikasi</title>
</head>
<body>
   <h1>PENENTUAN JURUSAN</h1>
   <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Sekolah</th>
            <th>Nilai Tes</th>
            <th>Hasil Penjurusan</th>
        </tr>';

     $i = 1;
     while($row = mysqli_fetch_assoc($sql)) {
        $html .= '<tr>
            <td>'. $i++ .'</td>
            <td>'. $row["nama_siswa"] .'</td>
            <td>'. $row["nama_sekolah"] .'</td>
            <td>'. $row["nilai_tes"] .'</td>
            <td>'. $row["hasil_uji"] .'</td>
        </tr>';
     }   

$html .= '</table>    
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('hasil.pdf', 'I');

?>