<?php

include '../koneksi.php';


$PelangganID = $_POST['pelanggan_id'];
$NamaPelanggan = $_POST['nama_pelanggan'];
$NomorTelepon = $_POST['nomer_telepon'];
$Alamat = $_POST['alamat'];
$TanggalPenjualan = $_POST['tanggal_penjualan'];


mysqli_query($koneksi,"INSERT INTO pelanggan VALUES ('$PelangganID','$NamaPelanggan', '$Alamat','$NomorTelepon')");
mysqli_query($koneksi,"INSERT INTO penjualan VALUES ('','$TanggalPenjualan', '','$PelangganID')");

header("location:pembelian.php?pesan=simpan");

?>