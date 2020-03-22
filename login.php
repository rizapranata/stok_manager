<?php
// jalankan init.php untuk auto load
require 'init.php';

// buat object user yang akan di pakai untuk proses login
$user = new User();

if (!empty($_POST)) {
    // jika terdeteksi form $_POST di submit, jalankan proses validasi
    $pesanError = $user->validasiLogin($_POST);
    if (empty($pesanError)) {
        // jika tidak ada error proses login user
        $user->login();
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <title>Riza Inventoru</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container pt-5">
        <?php
        if (!empty($pesanError)) :
        ?>

            <div class="row">
                <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
                    <ul class="mb-0">
                        <?php
                        foreach ($pesanError as $val) {
                            echo "<li>$val</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

        <?php
        endif;
        ?>

        <div class="row">
            <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Accound Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" autocomplete="off">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="username" class="form-control" name="username" value="<?= $user->getItem('username'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <input type="submit" class="btn btn-info btn-block" value="Login">
                        </form>
                        <p class="mt-2 text-center">
                            <small class="text-center">Belum terdaftar? Silahkan
                                <a href="register_user.php">Register</a> terlebih dahulu
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery-3.2.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

</html>