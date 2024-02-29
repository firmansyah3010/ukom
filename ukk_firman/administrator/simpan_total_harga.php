<?php
include "../koneksi.php";

$TotalHarga = $_POST['total_harga'];
$PenjualanID = $_POST['penjualan_id'];
$PelangganID = $_POST['pelanggan_id'];

mysqli_query($koneksi,"update penjualan set total_harga= '$TotalHarga' where penjualan_id= '$PenjualanID'");

header("location:detail_pembelian.php?pelanggan_id=$PelangganID");
?>