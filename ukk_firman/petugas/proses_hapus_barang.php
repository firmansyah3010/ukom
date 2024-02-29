<?php
include '../koneksi.php';

$ProdukID = $_POST['produk_id'];

mysqli_query($koneksi, "delete from produk where produk_id='$ProdukID'");

header("location:data_barang.php?pesan=hapus");

?>