<?php
include "../koneksi.php";

$PelangganID = $_POST['pelanggan_id'];
$PenjualanID = $_POST['penjualan_id'];

mysqli_query($koneksi,"INSERT INTO detailpenjualan(penjualan_id, produk_id, jumlah_produk, subtotal)VALUES ('$PenjualanID', NULL,0,0)");

header("location:detail_pembelian.php?pelanggan_id=$PelangganID");
exit();
?>