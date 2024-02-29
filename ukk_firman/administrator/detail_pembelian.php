<?php
include '../koneksi.php';
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
    <div class="card-body">
        <?php
        $PelangganID = $_GET['pelanggan_id'];
        $no = 1;
        $data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.pelanggan_id=penjualan.pelanggan_id");
        while($d = mysqli_fetch_array($data)){
            ?>
            <?php if ($d['pelanggan_id'] == $PelangganID) { ?>
            <table>
                <tr>
                    <td>ID Pelanggan</td>
                    <td>: <?= $d['pelanggan_id']; ?></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>: <?= $d['nama_pelanggan']; ?></td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>: <?= $d['nomer_telepon']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?= $d['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Total Pembelian</td>
                    <td>: Rp. <?= $d['total_harga']; ?></td>
                </tr>
            </table>
            <form method="post" action="tambah_detail_penjualan.php">
                <input type="text" name="penjualan_id" value="<?= $d['penjualan_id'] ?>" hidden>
                <input type="text" name="pelanggan_id" value="<?= $d['pelanggan_id'] ?>" hidden>   
                <button type="submit" class="btn btn-primary btn-sm mt-2">Tambah Barang</button>            
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Beli</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nos = 1;
                    $detailpenjualan = mysqli_query($koneksi,"SELECT * FROM detailpenjualan");
                    while($d_detailpenjualan = mysqli_fetch_array($detailpenjualan)){
                    ?>
                    <?php
                    if ($d_detailpenjualan['penjualan_id'] == $d['penjualan_id']) { ?>
                        <tr>
                            <td><?= $nos++; ?></td>
                            <td>
                                <form action="simpan_barang_beli.php" method="post">
                                    <div class="form-group">
                                        <input type="text" name="pelanggan_id" value="<?= $d['pelanggan_id']; ?>" hidden>
                                        <input type="text" name="detail_id" value="<?= $d_detailpenjualan['detail_id']; ?>" hidden>
                                        <select name="produk_id" class="form-control" onchange="this.form.submit()">
                                            <option>--- Pilih Produk ---</option>
                                            <?php
                                            $no = 1;
                                            $produk = mysqli_query($koneksi,"SELECT * FROM produk");
                                            while($d_produk =  mysqli_fetch_array($produk)){
                                                ?>
                                                <option value="<?= $d_produk['produk_id']; ?>" <?php if($d_produk['produk_id']==$d_detailpenjualan['produk_id']) { echo "selected"; }?>><?= $d_produk['nama_produk']; ?></option>
                                            <?php } ?>                                     
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="hitung_subtotal.php">
                                    <?php
                                    $produk = mysqli_query($koneksi,"SELECT * FROM produk");
                                    while($d_produk = mysqli_fetch_array($produk)){
                                        ?>
                                        <?php
                                        if ($d_produk['produk_id']==$d_detailpenjualan['produk_id']) { ?>
                                            <input type="text" name="harga" value=<?= $d_produk['harga']; ?> hidden>
                                            <input type="text" name="produk_id" value=<?= $d_produk['produk_id']; ?> hidden>
                                            <input type="text" name="stok" value=<?= $d_produk['stok']; ?> hidden>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="form-group">
                                        <input type="number" name="jumlah_produk" value="<?= $d_detailpenjualan['jumlah_produk']; ?>" class="form-control">
                                    </div>
                                </td>
                                <td><?= $d_detailpenjualan['subtotal']; ?></td>
                                <td>
                                    <input type="text" name="detail_id" value="<?= $d_detailpenjualan['detail_id']; ?>" hidden>
                                    <input type="text" name="pelanggan_id" value="<?= $d['pelanggan_id']; ?> "hidden>
                                    <button type="submit" class="btn btn-warning btn-sm">Proses</button>
                                </form>
                                <form method="post" action="hapus_detail_pembelian.php">
                                    <input type="text" name="pelanggan_id" value="<?= $d['pelanggan_id']; ?>" hidden>
                                    <input type="text" name="detail_id" value="<?= $d_detailpenjualan['detail_id']; ?> "hidden>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php } else {
                        ?>
                        <?php
                    }    
                    }
                    ?>
                </tbody>
            </table>
            <form method="post" action="simpan_total_harga.php">
                <?php
                $detailpenjualan =  mysqli_query($koneksi, "SELECT SUM(subtotal) AS total_harga FROM detailpenjualan WHERE penjualan_id='$d[penjualan_id]'");
                $row =  mysqli_fetch_assoc($detailpenjualan);
                $sum = $row['total_harga'];
                ?>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <input type="number" class="form-control" name="total_harga" value="<?= $sum ?>">
                            <input type="text"  name="pelanggan_id" value="<?= $d['pelanggan_id'] ?>" hidden>
                            <input type="text"  name="penjualan_id" value="<?= $d['penjualan_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button class="btn btn-info btn-sm form-control" type="submit">simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php } else { ?>
            <?php
        }
        }
        ?>
    </div>
</div>

<?php
include "footer.php";
?>