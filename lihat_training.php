<?php
$title = "Administrator";    
require 'layouts/header.php';
require 'layouts/sidebar.php';
require 'layouts/navbar.php';
?>
<div class="container">

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Data Individu Siswa</h4>
            </div>
            <?PHP
                include 'koneksi.php';
                $id = $_GET['id'];
                $data = mysqli_query($conn,"select * from tb_training where id='$id'");
                while($d = mysqli_fetch_array($data)){
                    ?>
            <div class="card-body">
                <br>
                Nama Siswa   :  <?php echo $d['nama_siswa'] ?>
                <br>
                <br>
                Nama Sekolah :  <?php echo $d['nama_sekolah'] ?>
                <br>
                -------------------------------------------
                <br><br>
                Minat : <?php echo $d['minat'] ?> <br>
                Nilai Tes : <?php echo $d['nilai_tes'] ?> 
                <table class="mt-4 table table-bordered text-center" style="width: auto;">
                    <thead>
                        <tr>
                            <th colspan="24">Nilai Rata-rata Raport</th>
                        </tr>
                        <tr>
                            <th colspan="5">Matematika</th>
                            <th rowspan="2">Rata-rata</th>
                            <th colspan="5">IPA</th>
                            <th rowspan="2">Rata-rata</th>
                            <th colspan="5">IPS</th>
                            <th rowspan="2">Rata-rata</th>

                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            
                        </tr>
                    </thead>
                    <tr>
                        <!-- Tabel MTK -->
                        <td><?php echo $d['mtk_1'] ?></td>
                        <td><?php echo $d['mtk_2'] ?></td>
                        <td><?php echo $d['mtk_3'] ?></td>
                        <td><?php echo $d['mtk_4'] ?></td>
                        <td><?php echo $d['mtk_5'] ?></td>
                        <td><?php echo $d['mtk_rata'] ?></td>
                        
                        <!-- Tabel IPA -->
                        <td><?php echo $d['ipa_1'] ?></td>
                        <td><?php echo $d['ipa_2'] ?></td>
                        <td><?php echo $d['ipa_3'] ?></td>
                        <td><?php echo $d['ipa_4'] ?></td>
                        <td><?php echo $d['ipa_5'] ?></td>
                        <td><?php echo $d['ipa_rata'] ?></td>

                        <!-- Tabel IPS-->
                        <td><?php echo $d['ips_1'] ?></td>
                        <td><?php echo $d['ips_2'] ?></td>
                        <td><?php echo $d['ips_3'] ?></td>
                        <td><?php echo $d['ips_4'] ?></td>
                        <td><?php echo $d['ips_5'] ?></td>
                        <td><?php echo $d['ips_rata'] ?></td>

                    </table>
            </div>
            <?php
                }
            ?>
        </div>
    </section>
</div>
</div>
<?php 
    require 'layouts/footer.php';
?>