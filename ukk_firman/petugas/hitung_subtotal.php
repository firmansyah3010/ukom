<?php
include "../koneksi.php";

$Stok = $_POST['stok'];
$ProdukID = $_POST['produk_id'];
$JumblahProduk = $_POST['jumlah_produk'];
$Harga = $_POST['harga'];
$DetailID = $_POST['detail_id'];
$PelangganID = $_POST['pelanggan_id'];
$Subtotal = $JumblahProduk * $Harga;
$Stok_total = $Stok - $JumblahProduk;

mysqli_query($koneksi,"update detailpenjualan set subtotal='$Subtotal', jumlah_produk= '$JumblahProduk' where detail_id= '$DetailID'");
mysqli_query($koneksi,"update produk set stok= '$Stok_total' where produk_id= '$ProdukID'");

header("location:detail_pembelian.php?pelanggan_id=$PelangganID");
?>