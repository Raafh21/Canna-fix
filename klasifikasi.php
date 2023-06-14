<?php 
    require 'layouts/header_app.php';
?>
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
            <section id="hero" class="hero d-flex align-items-center">

                <div class="content-wrapper">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="mt-5 col-sm-12">
                                    <h1 class="d-block text-center mt-5">Klasifikasi Jurusan Siswa</h1>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"><strong>Masukkan Data Klasifikasi</strong></div>
                                </div>

                                <div class="card-body">
                                    <form class="form form-vertical " method="post" action="klasifikasi/tambah.php">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="no_pendaftaran">No. Pendaftaran</label>
                                                    <input type="text" class="form-control mt-2" name="no_pendaftaran"
                                                        id="no_pendaftaran" autocomplete="off"
                                                        placeholder="No. Pendaftaran">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="nama_siswa">Nama Siswa</label>
                                                    <input type="text" class="form-control mt-2" name="nama_siswa"
                                                        id="nama_siswa" autocomplete="off" placeholder="Nama Siswa">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="nama_sekolah">Nama Sekolah</label>
                                                    <input type="text" class="form-control mt-2" name="nama_sekolah"
                                                        id="nama_sekolah" autocomplete="off" placeholder="Nama Sekolah">
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </section><!-- End Hero -->
        </div>
    </div>
</section><!-- End Hero -->
<?php 
    require 'layouts/footer_app.php';
?>