<?php
include "../koneksi.php";

$DetailID = $_POST['detail_id'];
$PelangganID = $_POST['pelanggan_id'];

mysqli_query($koneksi,"delete from detailpenjualan where detail_id= '$DetailID'");

header("location:detail_pembelian.php?pelanggan_id=$PelangganID");
?>