<?php
    $title = "Uji Pohon Keputusan";  
    require 'layouts/header.php';
    require 'layouts/sidebar.php';
    require 'layouts/navbar.php';
?>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="card-title">Uji Pohon Keputusan</h2>
            </div>
            <div class="card-body">
                <a href="hitung-akurasi.php" class="btn btn-success btn-sm mb-3">
                    Hitung Akurasi</a>
                <p>Jumlah Data Uji = <?= $jumlahDataUji; ?></p>
                <table class="table table-striped" id="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Minat</th>
                        <th>Nilai IPA</th>
                        <th>Nilai Matematika</th>
                        <th>Nilai IPS</th>
                        <th>Nilai Tes</th>
                        <th>Hasil</th>
                        <th>Hasil Uji</th>
                        <th>ID Rule</th>
                    </tr>
                    <?php
                    $no = 1;
                    $query = mysqli_query($conn, "SELECT * FROM tb_klasifikasi");
                    while ($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['nama_siswa'] . "</td>";
                        echo "<td>" . $row['minat'] . "</td>";
                        echo "<td>" . $row['ipa_grade'] . "</td>";
                        echo "<td>" . $row['mtk_grade'] . "</td>";
                        echo "<td>" . $row['ips_grade'] . "</td>";
                        echo "<td>" . $row['tes_grade'] . "</td>";
                        echo "<td>" . $row['hasil'] . "</td>";
                        echo "<td>" . $row['hasil_uji'] . "</td>";
                        echo "<td>" . $row['id_rule'] . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </div>

        </div>
    </section>
</div>

<?php 
    require 'layouts/footer.php';
?>