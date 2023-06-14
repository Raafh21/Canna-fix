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
                <h2 class="card-title text-center">tambah data training</h2>
            </div>
            <div class="card-body">
            <div class="card-body">
                                    <form class="form form-vertical " method="post" action="training/tambah.php">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nama_siswa">Nama Siswa</label>
                                                    <input type="text" class="form-control mt-2" name="nama_siswa"
                                                        id="nama_siswa" autocomplete="off" placeholder="Nama Siswa">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nama_sekolah">Nama Sekolah</label>
                                                    <input type="text" class="form-control mt-2" name="nama_sekolah"
                                                        id="nama_sekolah" autocomplete="off" placeholder="Nama sekolah">
                                                </div>

                                            </div>

                                            <div class="col-md-7 offset-1">
                                                <!-- Nilai IPA -->
                                                <div class="form-group row">
                                                    <label for="nilai_ipa" class="col-sm-2 col-form-label">IPA</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ipa1"
                                                            id="nilai_ipa1" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ipa2"
                                                            id="nilai_ipa2" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ipa3"
                                                            id="nilai_ipa3" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ipa4"
                                                            id="nilai_ipa4" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ipa5"
                                                            id="nilai_ipa5" autocomplete="off">
                                                    </div>
                                                </div>

                                                <!-- Nilai Matematika -->
                                                <div class="form-group row mt-3">
                                                    <label for="nilai_mtk" class="col-sm-2 col-form-label">MTK</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_mtk1"
                                                            id="nilai_mtk1" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_mtk2"
                                                            id="nilai_mtk2" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_mtk3"
                                                            id="nilai_mtk3" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_mtk4"
                                                            id="nilai_mtk4" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_mtk5"
                                                            id="nilai_mtk5" autocomplete="off">
                                                    </div>
                                                </div>

                                                <!-- Nilai IPS -->
                                                <div class="form-group row mt-3">
                                                    <label for="nilai_ips" class="col-sm-2 col-form-label">IPS</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ips1"
                                                            id="nilai_ips1" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ips2"
                                                            id="nilai_ips2" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ips3"
                                                            id="nilai_ips3" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ips4"
                                                            id="nilai_ips4" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_ips5"
                                                            id="nilai_ips5" autocomplete="off">
                                                    </div>
                                                </div>
                                                <!-- Minat & Nilai Test -->
                                                <div class="form-group row mt-3">
                                                    <label for="nilai_test" class="col-sm-2 col-form-label">Nilai
                                                        Test</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="nilai_tes"
                                                            id="nilai_tes" autocomplete="off">
                                                    </div>

                                                    <label for="minat"
                                                        class="col-sm-2 offset-1 col-form-label">Minat</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="minat" id="minat">
                                                            <option value="">--Silahkan Pilih--</option>
                                                            <option value="IPA">IPA</option>
                                                            <option value="IPS">IPS</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <button type="submit" name="tambah"
                                                    class="btn btn-primary offset-10 mt-4">Simpan</button>
            </div>
        </div>
    </section>
</div>
</div>
<?php 
    require 'layouts/footer.php';
?>