<?php

include "../koneksi.php";


$PelangganID = $_POST['pelanggan_id'];


mysqli_query($koneksi,"delete from penjualan where pelanggan_id='$PelangganID'");
mysqli_query($koneksi,"delete from pelanggan where pelanggan_id='$PelangganID'");


header("location:pembelian.php?pesan=hapus");

?>