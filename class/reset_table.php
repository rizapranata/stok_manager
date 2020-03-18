<?php


require 'DB.php';

$DB = DB::getInstance();

$reset = $DB->createTable('barang',[
    'id_barang INT PRIMARY KEY AUTO_INCREMENT',
    'nama_barang VARCHAR(50)',
    'jumlah_barang VARCHAR(50)',
    'harga_barang VARCHAR(50)',
    'tanggal_update DATE'
]);

// =======================================================================
// method createTable() 
// $result = $DB->createTable('users',
//                         [
//                             'id_user INT PRIMARY KEY AUTO_INCREMENT',
//                             'username VARCHAR(50)',
//                             'email VARCHAR(50)',
//                             'password VARCHAR(225)'
//                         ]);