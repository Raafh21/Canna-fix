<?php
$title = "Administrator";    
require 'layouts/header.php';
require 'layouts/sidebar.php';
require 'layouts/navbar.php';
?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <a href="#">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldUser"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">User</h6>
                                        <h6 class="font-extrabold mb-0"><?= $totUser; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <a href="#">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldSearch"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Data Training</h6>
                                        <h6 class="font-extrabold mb-0"><?= $totDataTraining; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <a href="#">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldStar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Data uji</h6>
                                        <h6 class="font-extrabold mb-0"><?= $jumlahDataUji; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="d-block text-center mt-2">
                <img src="assets/img/BG3.png" alt="" width="650" height="340">
            </div>
        </div>
    </section>

</div>

<?php 
    require 'layouts/footer.php';
?>