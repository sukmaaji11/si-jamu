<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div>
                <a href="" class="btn btn-primary add-new" data-toggle="modal" data-target="#newProduk">Add New</a>
                <h5>Tabel Produk</h5>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="produkTabel" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center">No</th>
                            <th style="text-align: center">Id</th>
                            <th style="text-align: center">Produk</th>
                            <th style="text-align: center">Kategori</th>
                            <th style="text-align: center">Harga</th>
                            <th style="text-align: center">Harga Jual</th>
                            <th style="text-align: center">Stok</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($produk->result_array() as $po) : ?>
                            <tr>
                                <td style="text-align: center" scope="row"><?= $i; ?></td>
                                <td style="text-align: center"><?= $po['produk_id']; ?></td>
                                <td><?= $po['produk_nama']; ?></td>
                                <td><?= $po['kategori_nama']; ?></td>
                                <td><?= 'Rp ' . number_format($po['produk_harga']); ?></td>
                                <td><?= 'Rp ' . number_format($po['produk_harga_jual']); ?></td>
                                <td style="text-align: center"><?= $po['produk_stok']; ?></td>
                                <td style="text-align: center">
                                    <a href="#updateProduk<?= $po['produk_id']; ?>" class="btn btn-success edit-kategori" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                    <a href="#deleteProduk<?= $po['produk_id']; ?>" class="btn btn-danger delete-kategori" data-toggle="modal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


<!-- Modal Add-->
<div class="modal fade" id="newProduk" tabindex="-1" role="dialog" aria-labelledby="newProdukTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/A_produk/add'); ?>">
                    <div class="form-group">
                        <label for="namaProduk">Nama Produk</label>
                        <input type="text" class="form-control" name="namaProduk" id="namaProduk" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kategori" data-width="80%" placeholder="Pilih Kategori" required>
                            <?php
                            foreach ($kategori->result_array() as $kat) {
                                $kat['kategori_id'];
                                $kat['kategori_nama'];
                            ?>
                                <option value="<?= $kat['kategori_id']; ?>"><?= $kat['kategori_nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="harga form-control" name="harga" id="harga" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hargaJual">Harga Jual</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="hargaJual form-control" name="hargaJual" id="hargaJual" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete-->
<?php
foreach ($produk->result_array() as $po) {
    $po['produk_id'];
    $po['produk_nama'];
    $po['kategori_nama'];
    $po['produk_harga'];
    $po['produk_harga_jual'];
    $po['produk_stok'];
?>
    <div class="modal fade" id="deleteProduk<?= $po['produk_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProdukTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin/A_produk/delete'); ?>">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="kode_produk" value="<?= $po['produk_id']; ?>">
                            <h6> Apakah Anda Yakin Akan Menghapus Produk <i><b><?= $po['produk_nama']; ?></b></i> ? </h6>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Edit-->
<?php
foreach ($produk->result_array() as $po) {
    $po['produk_id'];
    $po['produk_nama'];
    $po['kategori_nama'];
    $po['kategori_id'];
    $po['produk_harga'];
    $po['produk_harga_jual'];
    $po['produk_stok'];
?>
    <div class="modal fade" id="updateProduk<?= $po['produk_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateProdukTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin/A_produk/edit'); ?>">
                        <input type="hidden" class="form-control" name="kode_produk" value="<?= $po['produk_id']; ?>">
                        <div class="form-group">
                            <label for="namaProduk">Nama Produk</label>
                            <input type="text" class="form-control" name="namaProduk" id="namaProduk" placeholder="Nama Produk" value="<?= $po['produk_nama']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kategori" data-width="80%" placeholder="Pilih Kategori" required>
                                <?php
                                foreach ($kategori2->result_array() as $kat2) {
                                    $katid2 = $kat2['kategori_id'];
                                    $katnm2 = $kat2['kategori_nama'];
                                    if ($kat2['kategori_id'] == $po['kategori_id']) {
                                        echo "<option value='$katid2' selected>$katnm2</option>";
                                    } else {
                                        echo "<option value='$katid2'>$katnm2</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="harga form-control" name="harga" id="harga" value="<?= $po['produk_harga']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hargaJual">Harga Jual</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="hargaJual form-control" name="hargaJual" id="hargaJual" value="<?= $po['produk_harga_jual']; ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End of Main Content -->
<script type="text/javascript">
    $(function() {
        $('.harga').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.hargaJual').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#produkTabel').DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ]
        });
    });
</script>