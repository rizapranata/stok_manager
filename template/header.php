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
    <!-- NAVBAR -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">
                Hello, <?= $_SESSION['username']; ?>
            </span>
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="tampil_barang.php">Tabel Barang <span class="sr-only">(current)</span></a>
                </div> -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link p-3 <?= basename($_SERVER['PHP_SELF']) == "tampil_barang.php" ? "active" : ""; ?>" href="tampil_barang.php">Tabel barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-3 <?= basename($_SERVER['PHP_SELF']) == "profile.php" ? "active" : ""; ?>" href="profile.php">My profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-3" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>