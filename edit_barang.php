<?php
// jalankan init untuk session star dan auto loader
require 'init.php';

// halaman tidak bisa di aakses langsung. harus ada query string id_barang
if (empty(Input::get('id_barang'))) {
    die('Maaf Halaman ini tidak bosa di akses langsung');
}

// ambil semua data barang yang akan di update dari database
$barang = new Barang();
$barang->generate(Input::get('id_barang'));

if (!empty($_POST)) {
    // jika terdeteksi form $_POST di submit, jalankan proses validasi
    $pesanError = $barang->validasi($_POST);
    if (empty($pesanError)) {
        // jika tidak ada error, proses update barang
        $barang->update($barang->getItem('id_barang'));
        header('Location: tampil_barang.php');
    }
}
// include head
include 'template/header.php';

?>

<div class="container">
    <div class="row">
        <div class="col-6 py-4">
            <h1 class="h2 mr-auto"><a href="edit._barang.php" class="text-info">Edit Barang</a></h1>
            <?php
            // jika ada error, tampilkan pesan error
            if (!empty($pesanError)) :
            ?>

                <div id="divPesanError">
                    <div class="mx-auto">
                        <div class="alert alert-danger" role="alert">
                            <?php
                            foreach ($pesanError as $pesan) {
                                echo "<li>$pesan</li>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>

            <!-- Form untuk proses update -->
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_barang">ID Barang</label>
                    <input type="text" class="form-control" name="nama_barang" value="<?= $barang->getItem('id_barang'); ?>">
                    <small class="d-block">*ID Barang tidak bisa diubah</small>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" value="<?= $barang->getItem('nama_barang'); ?>">
                </div>
                <div class="form-group">
                    <label for="jumlah_barang">Jumlah Barang</label>
                    <input type="text" class="form-control" name="jumlah_barang" value="<?= $barang->getItem('jumlah_barang'); ?>">
                </div>
                <div class="form-group">
                    <label for="harga_barang">Harga</label>
                    <input type="text" class="form-control" name="harga_barang" value="<?= $barang->getItem('harga_barang'); ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Update">
                <a href="tampil_barang.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php
// include footer
include 'template/footer.php';
?>

<!-- bikin method generate() dan update() -->