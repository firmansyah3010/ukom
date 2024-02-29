<?php

include '../koneksi.php';


$ProdukID = $_POST['produk_id'];
$NamaProduk = $_POST['nama_produk'];
$Harga = $_POST['harga'];
$Stok = $_POST['stok'];


mysqli_query($koneksi,"update produk set nama_produk='$NamaProduk', harga='$Harga', stok='$Stok' where produk_id='$ProdukID'");


header("location:data_barang.php?pesan=update");

?>