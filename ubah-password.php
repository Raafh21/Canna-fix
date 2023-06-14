<?php
    $title = "Ubah Password";      
    require 'layouts/header.php';
    require 'layouts/sidebar.php';
    require 'layouts/navbar.php';

if (isset($_POST["ubahPassword"])) {

    $username = $_POST["username"];
    $password_lama = $_POST["password_lama"];
    $password_baru = $_POST["password_baru"];
    $konfirmasi_password = $_POST["konfirmasi_password"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password_lama, $row["password"])) {
        if ($password_baru == $konfirmasi_password) {
            // enkripsi password
            $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
            $query = "UPDATE tb_user SET password = '$password_baru' WHERE username = '$username' ";
            mysqli_query($conn, $query);
            $_SESSION['pesan'] = "<strong>Password Berhasil Diubah!</strong>";
        } else {
            $_SESSION['error'] = "<strong>Konfirmasi Password Salah!</strong>";
        }
    } else {
        $_SESSION['error'] = "<strong>Password Lama Salah!</strong>";
    }


    $error = true;
}
?>

<div class="container">
    <section class="row">
        <br>

        <div class="mt-5 col-md-7">
            <img src="assets/img/ganti.png" alt="" width="490" height="410">
        </div>
        <div class="mt-5 col-md-5">

            <h2>Ganti Password</h2>

            <?php if (isset($_SESSION['pesan'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['pesan'];  ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['pesan']); ?>
            <?php } ?>
            <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'];  ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['error']); ?>
            <?php } ?>
            <form class="mt-3" method="POST" action="">
                <input type="hidden" name="username" value="<?= $_SESSION["username"]; ?>">
                <div class="form-floating mt-3" data-aos="fade-up" data-aos-delay="">
                    <input type="text" name='password_lama' class="form-control" id="Pasword" placeholder="Pasword"
                        autocomplete="off" autofocus required>
                    <label for="Password">Password Lama</label>
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
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="ubahPassword" data-aos="fade-up"
                        data-aos-delay="1200">Ubah</button>
                </div>
            </form>

        </div>
    </section>
</div>

<?php 
    require 'layouts/footer.php';
?>