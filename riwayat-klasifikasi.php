<?php 
require 'layouts/header_app.php';
include_once "database.php";
include_once 'proses-mining.php';

//object database class
$db_object = new database();
?>
<section id="hero">
    <div class="container">

        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Hasil Klasifikasi</h4>
                    </div>
                    <div class="card-body">
                        <?php
                            $query = $db_object->db_query("SELECT * FROM tb_klasifikasi ORDER BY id DESC");
                            $id_rule = array();
                            $it = 1;
                            while ($bar = $db_object->db_fetch_array($query)) {
                                //ambil data uji
                                $n_minat = $bar['minat'];
                                $n_ipa = $bar['ipa_grade'];
                                $n_mtk = $bar['mtk_grade'];
                                $n_ips = $bar['ips_grade'];
                                $n_tes = $bar['tes_grade'];
                
                                $hasil = klasifikasi($db_object, $n_minat, 
                                        $n_ipa, $n_mtk, $n_ips, $n_tes);
                                $keputusan = $hasil['keputusan'];
                                $id_rule_keputusan = $hasil['id_rule'];
                                $it++;
                                $db_object->db_query("UPDATE tb_klasifikasi SET hasil_uji='$keputusan', id_rule='$id_rule_keputusan' WHERE id=$bar[0]");
                            }
                
                            $sql = $db_object->db_query("SELECT * FROM tb_klasifikasi ORDER BY id DESC");
                        ?>
                        <table class="table table-striped" id="tableRiwayat">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Sekolah</th>
                                    <th>Nilai Tes</th>
                                    <th>Hasil Penjurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    while ($row = $db_object->db_fetch_array($sql)) {
                                        echo "<tr>";
                                            echo "<td>" . $no . "</td>";
                                            echo "<td>" . $row['nama_siswa'] . "</td>";
                                            echo "<td>" . $row['nama_sekolah'] . "</td>";
                                            echo "<td>" . $row['nilai_tes'] . "</td>";
                                            echo "<td>" . $row['hasil_uji'] . "</td>";
                                        echo "</tr>";   
                                        $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <div class="d-flex justify-content-end">
            <a href="" class="btn btn-primary btn-sm mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 20 20">
              <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
                Cetak
            </a>
        </div>
    </div>
</section>
<?php 
    require 'layouts/footer_app.php';
?>