<?php
include '../koneksi.php';

$NamaProduk = $_POST['nama_produk'];
$Harga = $_POST['harga'];
$Stok = $_POST['stok'];

mysqli_query($koneksi, "insert into produk values('','$NamaProduk','$Harga','$Stok')");

header("location:data_barang.php?pesan=simpan");

?>