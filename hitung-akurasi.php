<?php 
$title = "Proses Hitung Akurasi";    
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
                <h2 class="card-title">Proses Hitung Akurasi</h2>
            </div>
            <div class="card-body">
                <?php
            $query = $db_object->db_query("SELECT * FROM tb_klasifikasi");
            $id_rule = array();
            $it = 1;
            while ($bar = $db_object->db_fetch_array($query)) {
                //ambil data uji
                $n_minat = $bar['minat'];
                $n_ipa = $bar['ipa_grade'];
                $n_mtk = $bar['mtk_grade'];
                $n_ips = $bar['ips_grade'];
                $n_tes = $bar['tes_grade'];
                $n_hasil = $bar['hasil'];

                $hasil = klasifikasi($db_object, $n_minat, 
                        $n_ipa, $n_mtk, $n_ips, $n_tes);
                
                $keputusan = $hasil['keputusan'];
                $id_rule_keputusan = $hasil['id_rule'];
                $it++;
                $db_object->db_query("UPDATE tb_klasifikasi SET hasil_uji='$keputusan', id_rule='$id_rule_keputusan' WHERE id=$bar[0]");
            }

            $sql = $db_object->db_query("SELECT * FROM tb_klasifikasi");
            ?>
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
                        <th><b>ID Rule Terpilih</b></th>
                        <th><b>Ketepatan</b></th>
                    </tr>
                    <?php
                        $no = 1;
                        while ($row = $db_object->db_fetch_array($sql)) {
                            if ($row['hasil'] == $row['hasil_uji']) {
                                $ketepatan = "benar";
                            } else {
                                $ketepatan = "salah";
                            }
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
                                echo "<td>" . ($ketepatan=='benar'?"<b>".$ketepatan."</b>":$ketepatan) . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    ?>
                </table>

                <?php
                //perhitungan akurasi
                    $que = $db_object->db_query("SELECT * FROM tb_klasifikasi");
                    $jumlah_uji=$db_object->db_num_rows($que);

                    $TA = $FB = $TF = $FG = 0;
                    $kosong = 0;
                    while ($row = $db_object->db_fetch_array($que)) {
                    $asli = $row['hasil'];
                    $prediksi = $row['hasil_uji'];
                    if($asli=='IPA' && $prediksi=='IPA'){
                    $TA++;
                    }
                    else if($asli=='IPA' && $prediksi=='IPS'){
                    $FB++;
                    }
                    else if($asli=='IPS' && $prediksi=='IPS'){
                    $TF++;
                    }
                    else if($asli=='IPS' && $prediksi=='IPA'){
                    $FG++;
                    }
                    else if($prediksi==''){
                    $kosong++;
                    }
                    }
                    $tepat=($TA+$TF);
                    $tidak_tepat=($FB+$FG+$kosong);
                    $akurasi=($tepat/$jumlah_uji)*100;
                    $laju_error=($tidak_tepat/$jumlah_uji)*100;
                    $sensitivitas=($TA/($TA+$FG))*100;
                    $spesifisitas=($TF/($FB+$TF))*100;

                    $akurasi = round($akurasi,2);
                    $laju_error = round($laju_error,2);
                    $sensitivitas = round($sensitivitas,2);
                    $spesifisitas = round($spesifisitas,2);

                    echo "<div class='row'>";
                    echo "<div class='col-sm-4'>";
                    echo "<br><br>";
                    echo "<h5>";
                    echo "Jumlah prediksi: $jumlah_uji<br> <br>";
                    echo "Jumlah tepat: $tepat<br><br>";
                    echo "Jumlah tidak tepat: $tidak_tepat<br><br>";
                    if($kosong!=0){
                    echo "Jumlah data yang prediksinya kosong: $kosong<br><br></h5>";
                    }
                    echo "</div>";
                    echo "<div class='col-sm-4'>";
                    echo "<br><br>";
                    echo "<h4>AKURASI = $akurasi %<br><br>";
                    echo "LAJU ERROR = $laju_error %<br><br></h4>";
                    echo "</div>";
                    echo "<div class='col-sm-4'>";
                    echo "<br><br>";  
                    echo "</div>";
                    echo "</div>";  
                ?>
            </div>
        </div>
    </section>
</div>

<?php 
require 'layouts/footer.php';
?>