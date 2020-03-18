<?php
// jalankan init.php (untuk auto loader)
require 'init.php';

// buat koneksi ke database
$DB = DB::getInstance();

if (!empty($_GET)) {
    // jika terdeteksi form di submit, tampilkan hasil pencarian 
    $tabelBarang = $DB->getLike('barang','nama_barang', 
                                    '%'.Input::get('search')."%");
} else {
    // jika form tidak di submit, ambil semua isi tabel barang
    $tabelBarang = $DB->get('barang');
}


// include head
include 'template/header.php';

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- form pencarian -->
            <div class="py-4  d-flex justify-content-end align-items-center">
                <h1 class="h2 mr-auto">
                    <a href="tampil_barang.php" class="text-info">Tampil Barang</a>
                </h1>
                <a href="tambah_barang.php" class="btn btn-priary">Tambah Barang</a>
                <form method="GET" class="w-25" ml-4>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="search" name="search">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-secoundary" value="Cari">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Tabel Barang -->
            <?php
             if (!empty($tabelBarang)) :
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga (Rp.)</th>
                        <th>Tanggal Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($tabelBarang as $barang) {
                            echo "<tr>";
                            echo "<th>{$barang->id_barang}</th>";
                            echo "<td>{$barang->nama_barang}</td>";
                            echo "<td>{$barang->jumlah_barang}</td>";
                            echo "<td>".number_format($barang->harga_barang, 0, ',', '.').
                            "</td>";
                            $tanggal = new DateTime($barang->tanggal_update);
                            echo "<td>".$tanggal->format("d-m-Y H:i"). "</td>";
                            echo "<td>";
                            echo "<a href=\"edit_barang.php?id_barang={$barang->id_barang}\" class=\"btn btn-info\">Edit</a> ";
                            echo "<a href=\"hapus_barang.php?id_barang={$barang->id_barang}\" class=\"btn btn-danger\">Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <?php
                endif;
            ?>

        </div>
    </div>
</div>

<?php
    include 'template/footer.php';
?>