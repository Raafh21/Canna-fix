<?php
    $title = "Pohon Keputusan";  
    require 'layouts/header.php';
    require 'layouts/sidebar.php';
    require 'layouts/navbar.php';
?>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Pohon Keputusan</h2>
            </div>
            <div class="card-body">
                <a href="" class="btn btn-danger btn-sm mb-3">
                    Hapus Pohon Keputusan</a>
                <a href="uji-rule.php" class="btn btn-secondary btn-sm mb-3">
                    Uji Rule</a>

                <p>Jumlah Rule = <?= $jumlahRule; ?></p>
                <table class="table table-striped" id="table">
                    <tr align='center'>
                        <th>Id</th>
                        <th>Aturan</th>
                    </tr>
                    <?php
                        $warna1 = '#ffc';
                        $warna2 = '#eea';
                        $warna  = $warna1;
                        $no=1;
                        $sql = mysqli_query($conn, "SELECT * FROM t_keputusan");
                            while($row = mysqli_fetch_assoc($sql)){
                        ?>
                    <tr>
                        <td align='center'><?php echo $row['id'];?></td>
                        <td><?php
                                        echo "IF ";
                                        if($row['parent']!=''){
                                                echo $row['parent']." AND ";
                                        }
                                        echo $row['akar']." THEN Label = ".$row['keputusan'];?>
                        </td>
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