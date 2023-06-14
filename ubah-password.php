<?php
    $title = "Ubah Password";      
    require 'layouts/header.php';
    require 'layouts/sidebar.php';
    require 'layouts/navbar.php';
?>

<div class="container">
    <section class="row">
        <br>

        <div class="mt-5 col-md-7">
            <img src="assets/img/ganti.png" alt="" width="490" height="410">
        </div>
        <br>
        <div class="mt-4 col-md-5">
            <br>
            <br>
            <h2>Ganti Password</h2>
            <br>

            <form method="POST" action="">
                <div class="form-floating" data-aos="fade-up" data-aos-delay="">
                    <input type="text" name='password_lama' class="form-control" id="Pasword" placeholder="Pasword"
                        autocomplete="off" autofocus required>
                    <label for="Password">Password Lama</label>
                    <br>
                </div>
                <div class="form-floating mt-3" data-aos="fade-up" data-aos-delay="800">
                    <input type="password" name='password_baru' autocomplete="off" class="form-control" id="password"
                        placeholder="Password" required>
                    <label for="password">Password Baru</label>
                </div>
                <div class="form-floating mt-3" data-aos="fade-up" data-aos-delay="800">
                    <input type="password" name='konfirmasi_password' autocomplete="off" class="form-control"
                        id="password" placeholder="Password" required>
                    <label for="password">Konfirmasi Password Baru</label>
                    <br>
                </div>
                <div class="offset-8 col-md-4">
                    <button class="w-100 btn btn-lg btn-primary" type="submit" data-aos="fade-up"
                        data-aos-delay="1200">Ubah</button>
                </div>
            </form>

        </div>
    </section>
</div>

<?php 
    require 'layouts/footer.php';
?>