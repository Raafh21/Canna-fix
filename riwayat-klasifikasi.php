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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data Hasil Klasifikasi</h4>
                        <a target="_blank" href="cetak-klasifikasi.php" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-printer" viewBox="0 0 20 20">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg>
                            Cetak
                        </a>
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
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['nama_siswa'] ?></td>
                                    <td><?php echo $row['nama_sekolah'] ?></td>
                                    <td><?php echo $row['nilai_tes'] ?></td>
                                    <td><?php echo $row['hasil_uji'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewmodel<?= $row["id"]; ?>">lihat</a>
                                    </td>
                                </tr>
                                <div class="modal  fade bd-example-modal-lg" id="viewmodel<?= $row["id"]; ?>"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Nilai Raport</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <br>
                                                Nama Siswa: <?php echo $row['nama_siswa'] ?><br><br>
                                                Nama Sekolah: <?php echo $row['nama_sekolah'] ?><br>
                                                -------------------------------------------
                                                <br><br>
                                                Minat: <?php echo $row['minat'] ?><br>
                                                Nilai Tes: <?php echo $row['nilai_tes'] ?><br>
                                                <table class="mt-4 table table-bordered text-center"
                                                    style="width: auto;">
                                                    <thead>
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
                                                    <tbody>
                                                        <tr>
                                                            <!-- Tabel MTK -->
                                                            <td><?php echo $row['mtk_1'] ?></td>
                                                            <td><?php echo $row['mtk_2'] ?></td>
                                                            <td><?php echo $row['mtk_3'] ?></td>
                                                            <td><?php echo $row['mtk_4'] ?></td>
                                                            <td><?php echo $row['mtk_5'] ?></td>
                                                            <td><?php echo $row['mtk_rata'] ?></td>

                                                            <!-- Tabel IPA -->
                                                            <td><?php echo $row['ipa_1'] ?></td>
                                                            <td><?php echo $row['ipa_2'] ?></td>
                                                            <td><?php echo $row['ipa_3'] ?></td>
                                                            <td><?php echo $row['ipa_4'] ?></td>
                                                            <td><?php echo $row['ipa_5'] ?></td>
                                                            <td><?php echo $row['ipa_rata'] ?></td>

                                                            <!-- Tabel IPS -->
                                                            <td><?php echo $row['ips_1'] ?></td>
                                                            <td><?php echo $row['ips_2'] ?></td>
                                                            <td><?php echo $row['ips_3'] ?></td>
                                                            <td><?php echo $row['ips_4'] ?></td>
                                                            <td><?php echo $row['ips_5'] ?></td>
                                                            <td><?php echo $row['ips_rata'] ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                            $no++;
                            }
                            ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<?php 
    require 'layouts/footer_app.php';
?>