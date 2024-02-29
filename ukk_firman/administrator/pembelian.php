<?php
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
            Tambah Data
        </button>
    </div>
    <div class="card-body">
        <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=="simpan"){?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Simpan
                </div>
           <?php } ?>
           <?php if($_GET['pesan']=="update"){?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Update
                </div>
            <?php } ?>
            <?php if($_GET['pesan']=="hapus"){?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Hapus
                </div>
            <?php } ?>
            <?php
        }
        ?>
        <table class="table">
            <thead>
                <tr>

                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Total Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../koneksi.php';
                $no =1;
                $data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.pelanggan_id=penjualan.pelanggan_id");
                while($d = mysqli_fetch_array($data)){
                    ?>
                <tr>
                    
                    <td><?php echo $d['pelanggan_id']; ?></td>
                    <td><?php echo $d['nama_pelanggan']; ?></td>
                    <td><?php echo $d['nomer_telepon']; ?></td>
                    <td><?php echo $d['alamat']; ?></td>
                    <td>Rp. <?php echo $d['total_harga']; ?></td>
                <td>
                    <a class="btn btn-info btn-sm" href="detail_pembelian.php?pelanggan_id=<?php echo $d['pelanggan_id']; ?>">Detail</a>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['pelanggan_id']; ?>">
                    Edit
                    </button>  
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['pelanggan_id']; ?>">
                    Hapus
                    </button> 
                    </td>
                </tr>
            <div class="modal fade" id="edit-data<?php echo $d['pelanggan_id'];?>" tabinex="-1" aria-labelledby="exampleModelLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModelLabel">Edit Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                            </div>
                            <form action="proses_update_pembelian.php" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" name="pelanggan_id" value="<?php echo $d['pelanggan_id']; ?>" class="form-control" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" name="nama_pelanggan" value="<?php echo $d['nama_pelanggan']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" name="nomer_telepon" value="<?php echo $d['nomer_telepon']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" value="<?php echo $d['alamat']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="modal fade" id="hapus-data<?php echo $d['pelanggan_id'];?>" tabinex="-1" aria-labelledby="exampleModelLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModelLabel">Hapus Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <form action="proses_hapus_pembelian.php" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="pelanggan_id" value="<?php echo $d['pelanggan_id']; ?>">
                                Apakah anda yakin akan menghapus data <b><?php echo $d['nama_pelanggan'];?></b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php    } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="tambah-data" tabinex="-1" aria-labelledby="exampleModelLabel" aria-hidden="true">
    <div class="modal-dialog">
         <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModelLabel">Tambah Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                            </div>
                            <form action="proses_pembelian.php" method="post">
                                <div class="modal-body">
                                <div class="form-group">
                                        <label>No</label>
                                        <input type="number" required name="pelanggan_id" value="<?php echo date("dmHis")?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" required name="nama_pelanggan" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" required name="alamat" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="number" required name="nomer_telepon" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            include "footer.php";
            ?>


