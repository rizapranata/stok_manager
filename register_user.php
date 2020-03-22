<?php
// jalankan init.php untuk autoloader
require 'init.php';

// buat object user yang akan di pakai untuk input
$user = new User();

if (!empty($_POST)) {
    // jika terdeteksi form $_POST di submit, jalankan proses validasi
    $pesanError = $user->validasiInsert($_POST);
    if (empty($pesanError)) {
        $user->insert();
        header('Location:register_berhasil.php');
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
    <title>Inventory</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 py-4">
                <h1 class="h2 mr-auto">
                    <a href="register_user.php" class="text-info">Register User</a>
                </h1>

                <?php
                // jika ada error, tampilkan pesan error
                if (!empty($pesanError)) :
                ?>
                    <div class="divPesanError">
                        <div class="mx-auto">
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    <?php
                                    foreach ($pesanError as $pesan) {
                                        echo "<li>$pesan</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                <?php
                endif;
                ?>

                <!-- Form unutk proses insert -->
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <small>(Minimal 4 karakter angka atau huruf)</small>
                        <input type="text" class="form-control" name="username" value="<?= $user->getItem('username'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <small>(Minimal 6 karakter angka atau huruf)</small>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="ulangi_password">Ulangi password</label>
                        <input type="password" class="form-control" name="ulangi_password">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="<?= $user->getItem('email'); ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Daftar">
                    <a href="login.php" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <?php
    // include footer
    include 'template/footer.php';
    ?>