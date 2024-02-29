<?php

include '../koneksi.php';


$PelangganID = $_POST['pelanggan_id'];
$NamaPelanggan = $_POST['nama_pelanggan'];
$NomorTelepon = $_POST['nomer_telepon'];
$Alamat = $_POST['alamat'];


mysqli_query($koneksi,"update pelanggan set nama_pelanggan='$NamaPelanggan', nomer_telepon='$NomorTelepon', alamat='$Alamat' where pelanggan_id='$PelangganID'");


header("location:pembelian.php?pesan=update");

?>