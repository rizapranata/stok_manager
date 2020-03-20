<?php
// jalankan init.php untuk autoload
require 'init.php';

// halaman tidak bisa di akses lansung, harus ada query string id_barang
if (empty(Input::get('id_barang'))) {
    die ('Maaf halaman ini tidak bisa di akses langsung');
}

// ambil data barang yang akan dihapus
$barang = new Barang();
$barang->generate(Input::get('id_barang'));

if (!empty($_POST)) {
    // jika terdeteksi form di submit, hapus barang berdasarkan nilai id-barang
    $barang->delete(Input::get('id_barang'));
    header('Location: tampil_barang.php');
}
// include head
require 'template/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-6 mx-auto">

        <!-- Modul untuk konfigurasi hapus -->
        <div id="modalHapus">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="moda-header">
                        <h4 class="modal-title">Konfigurasi</h4>
                    </div>
                    <div class="modal-body">
                        <p>Apakan anda yakin akan menghapus
                            <b><?= $barang->getItem('nama_barang'); ?></b>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="tampil_barang.php" class="btn btn-secondary">Tidak</a>

                        <form action="" method="POST">
                            <input type="hidden" name="id_barang" 
                            value="<?= $barang->getItem('id_barang'); ?>">
                            <input type="submit" class="btn btn-danger" value="Ya">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?php
// include footer
require 'template/footer.php';
?>