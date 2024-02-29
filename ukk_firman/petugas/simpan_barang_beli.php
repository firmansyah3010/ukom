<?php
include "../koneksi.php";

$ProdukID = $_POST['produk_id'];
$DetailID = $_POST['detail_id'];
$PelangganID = $_POST['pelanggan_id'];

mysqli_query($koneksi,"update detailpenjualan set produk_id= '$ProdukID' where detail_id= '$DetailID'");

header("location:detail_pembelian.php?pelanggan_id=$PelangganID");

?>