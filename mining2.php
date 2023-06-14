<?php 
$title = "Proses Mining C.45";    
require 'layouts/header.php';
require 'layouts/sidebar.php';
require 'layouts/navbar.php';
include_once "database.php";
include_once 'proses-mining.php';

//object database class
$db_object = new database();
?>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Proses Mining</h2>
            </div>
            <div class="card-body">
                <?php 
                    $awal = microtime(true);
                    $db_object->db_query("TRUNCATE t_keputusan");
                    
                    pembentukan_tree($db_object, "","");
                    echo "<br><h3><center>---PROSES SELESAI---</center></h3>";
                    
                    $akhir = microtime(true);
                    $lama = $akhir - $awal;
                ?>
            </div>
        </div>
    </section>
</div>

<?php 
require 'layouts/footer.php';
?>