<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    // Data Umum
    $nama_siswa = $data['nama_siswa'];
    $nama_sekolah = $data['nama_sekolah'];
    $minat = $data['minat'];
    $nilai_tes = $data['nilai_tes'];
    $hasil_uji = "";
    $id_rule = "";
    
    // Nilai Matematika
    $nilai_mtk1 = $data['nilai_mtk1'];
    $nilai_mtk2 = $data['nilai_mtk2'];
    $nilai_mtk3 = $data['nilai_mtk3'];
    $nilai_mtk4 = $data['nilai_mtk4'];
    $nilai_mtk5 = $data['nilai_mtk5'];
    
    // Nilai IPA
    $nilai_ipa1 = $data['nilai_ipa1'];
    $nilai_ipa2 = $data['nilai_ipa2'];
    $nilai_ipa3 = $data['nilai_ipa3'];
    $nilai_ipa4 = $data['nilai_ipa4'];
    $nilai_ipa5 = $data['nilai_ipa5'];
    
    // Nilai IPS
    $nilai_ips1 = $data['nilai_ips1'];
    $nilai_ips2 = $data['nilai_ips2'];
    $nilai_ips3 = $data['nilai_ips3'];
    $nilai_ips4 = $data['nilai_ips4'];
    $nilai_ips5 = $data['nilai_ips5'];

    // Nilai Rata-rata IPA
    $ipa_rata = ($nilai_ipa1 + $nilai_ipa2 + $nilai_ipa3 + $nilai_ipa4 + $nilai_ipa5) / 5;

    // Nilai Rata-rata Matematika
    $mtk_rata = ($nilai_mtk1 + $nilai_mtk2 + $nilai_mtk3 + $nilai_mtk4 + $nilai_mtk5) / 5;

    // Nilai Rata-rata IPS
    $ips_rata = ($nilai_ips1 + $nilai_ips2 + $nilai_ips3 + $nilai_ips4 + $nilai_ips5) / 5;

    // Nilai IPA Grade
    $ipa_grade = "";
    if ($ipa_rata < 75) {
        $ipa_grade = "C";
    } elseif ($ipa_rata >= 85) {
        $ipa_grade = "A";
    } else {
        $ipa_grade = "B";
    }

    // Nilai Matematika Grade
    $mtk_grade = "";
    if ($mtk_rata < 75) {
        $mtk_grade = "C";
    } elseif ($mtk_rata >= 85) {
        $mtk_grade = "A";
    } else {
        $mtk_grade = "B";
    }

    // Nilai IPS Grade
    $ips_grade = "";
    if ($ips_rata < 75) {
        $ips_grade = "C";
    } elseif ($ips_rata >= 85) {
        $ips_grade = "A";
    } else {
        $ips_grade = "B";
    }

        // Nilai Tes Grade
    $tes_grade = "";
    if ($nilai_tes < 75) {
        $tes_grade = "C";
    } elseif ($nilai_tes >= 85) {
        $tes_grade = "A";
    } else {
        $tes_grade= "B";
    }

    // Hasil
    $hasil = $mtk_rata + $ipa_rata + $ips_rata + $nilai_tes;
    if ($hasil < 340) {
        $hasil = "IPS";
    } else {
        $hasil = "IPA";
    }

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO tb_training 
    VALUES
    ('','$nama_siswa','$nama_sekolah','$nilai_mtk1','$nilai_mtk2','$nilai_mtk3','$nilai_mtk4','$nilai_mtk5','$mtk_rata','$mtk_grade','$nilai_ipa1','$nilai_ipa2','$nilai_ipa3','$nilai_ipa4','$nilai_ipa5','$ipa_rata','$ipa_grade','$nilai_ips1','$nilai_ips2','$nilai_ips3','$nilai_ips4','$nilai_ips5','$ips_rata','$ips_grade','$minat','$nilai_tes','$hasil')");

    mysqli_query($conn, "INSERT INTO tb_training2
    VALUES
    ('','$nama_siswa','$minat','$ipa_grade','$mtk_grade','$ips_grade','$tes_grade','$hasil')");

    return mysqli_affected_rows($conn);
}

//Data Menu
if (isset($_POST["tambah"])) {

    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Admin Baru";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../training.php");
    } else {
        $_SESSION['status'] = "Admin Baru";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../training.php");
    }

}
