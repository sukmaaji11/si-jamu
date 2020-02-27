<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div>
                <a href="" class="btn btn-primary add-new" data-toggle="modal" data-target="#newKategori">Add New</a>
                <h5>Tabel Kategori</h5>
            </div>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="kategoriTabel" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center">No</th>
                            <th style="text-align: center">Id</th>
                            <th style="text-align: center">Kategori</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($kategori->result_array() as $ktg) : ?>
                            <tr>
                                <td style="text-align: center" scope="row"><?= $i; ?></td>
                                <td style="text-align: center"><?= $ktg['kategori_id']; ?></td>
                                <td><?= $ktg['kategori_nama']; ?></td>
                                <td style="text-align: center">
                                    <a href="#updateKategori<?= $ktg['kategori_id']; ?>" class="btn btn-success edit-kategori" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                    <a href="#deleteKategori<?= $ktg['kategori_id']; ?>" class="btn btn-danger delete-kategori" data-toggle="modal"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="newKategori" tabindex="-1" role="dialog" aria-labelledby="newKategoriTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/A_kategori/add'); ?>">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" required>
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

<!-- Modal Delete-->
<?php
foreach ($kategori->result_array() as $ktg) {
    $ktg['kategori_id'];
    $ktg['kategori_nama'];
?>
    <div class="modal fade" id="deleteKategori<?= $ktg['kategori_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteKategoriTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin/A_kategori/delete'); ?>">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_kategori" id="id_kategori" value="<?= $ktg['kategori_id']; ?>">
                            <h6> Apakah Anda Yakin Akan Menghapus Kategori <i><b><?= $ktg['kategori_nama']; ?></b></i> ? </h6>
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

<!-- Modal Delete-->
<?php
foreach ($kategori->result_array() as $ktg) {
    $ktg['kategori_id'];
    $ktg['kategori_nama'];
?>
    <div class="modal fade" id="updateKategori<?= $ktg['kategori_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateKategoriTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin/A_kategori/edit'); ?>">
                        <input type="hidden" class="form-control" name="id_kategori" id="id_kategori" value="<?= $ktg['kategori_id']; ?>">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" value="<?= $ktg['kategori_nama']; ?>" name="kategori" id="kategori" placeholder="kategori" required>
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
<?php } ?>

</div>
<!-- End of Main Content -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#kategoriTabel').DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ]
        });
    });
</script>