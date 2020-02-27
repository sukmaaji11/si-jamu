<?php
if ($this->session->userdata('role_id') == 2) {
    redirect('user');
} else if (!$this->session->userdata('username')) {
    redirect('auth');
}
?>
<!-- Page Heading -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Library</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
</nav>
<a href="" class="btn btn-primary add-new" data-toggle="modal" data-target="#newKategori">Add New</a>
<form method="POST" action="<?= base_url('kategori/search'); ?>">
    <div class="form-group">
        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Pencarian">
    </div>
</form>
<?= $this->session->flashdata('message'); ?>
<table id="mytable" class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">NO</th>
            <th scope="col">ID_KATEGORI</th>
            <th scope="col">KATEGORI</th>
            <th scope="col">ACTION</th>
        </tr>
    </thead>
    <?php
    $query = $this->db->get('kategori');
    if ($query->num_rows() == 0) {
        echo '<div class="col-md-6 offset-md-3">
                <div class="alert alert-danger alert-dashboard">Belum Ada Data</div>
              </div>';
    } ?>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($kategori as $ktg) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $ktg['id_kategori']; ?></td>
                <td><?= $ktg['kategori']; ?></td>
                <td>
                    <a href="" class="btn btn-success edit-kategori"><i class="fas fa-edit"></i></a>
                    <a href="" class="btn btn-danger delete-kategori" data-toggle="modal" data-target="#deleteKategori"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
</nav>
</div>


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
                <form method="POST" action="<?= base_url('kategori/add'); ?>">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Contoh : Obat Ayam">
                        <?= form_error('kategori', '<div class="alert alert-danger role="alert"></div>'); ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete-->
    <div class="modal fade" id="deleteKategori" tabindex="-1" role="dialog" aria-labelledby="deleteKategoriTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        Are you sure to delete this data?
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="<?= base_url('kategori/delete'); ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="deleteKategori" tabindex="-1" role="dialog" aria-labelledby="deleteKategoriTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        Are you sure to delete this data?
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="<?= base_url('kategori/delete'); ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mytable').DataTable();
        });
    </script>
    <!-- /.container-fluid -->