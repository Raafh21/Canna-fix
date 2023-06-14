<?php
    $title = "Mining C.45";    
    require 'layouts/header.php';
    require 'layouts/sidebar.php';
    require 'layouts/navbar.php';
?>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Mining C.45</h2>
            </div>
            <div class="card-body">
                <a href="mining2.php" class="btn btn-success btn-sm mb-3"><svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>Proses Mining</a>

                <p>Jumlah Data Training = <?= $totDataTraining; ?></p>
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Nilai IPA</th>
                            <th>Nilai Matematika</th>
                            <th>Nilai IPS</th>
                            <th>Nilai Tes</th>
                            <th>Minat</th>
                        </tr>
                    </thead>
                    <?php 
                        $no = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM tb_training2 ORDER BY id DESC");
                        while($row = mysqli_fetch_assoc($sql)){
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row["nama_siswa"]; ?></td>
                        <td><?= $row["ipa_grade"]; ?></td>
                        <td><?= $row["mtk_grade"]; ?></td>
                        <td><?= $row["ips_grade"]; ?></td>
                        <td><?= $row["nilai_tes"]; ?></td>
                        <td><?= $row["minat"]; ?></td>
                    </tr>
                    <?php 
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