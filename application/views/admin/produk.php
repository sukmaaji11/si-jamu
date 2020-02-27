<!-- Begin Page Content -->
<div class="container-fluid">

    <body>
        <div class="container">
            <h2>Kategori</h2>
            <button class="btn btn-success" data-toggle="modal" data-target="#myModalAdd">Add New</button>
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>ID_PRODUK</th>
                        <th>KATEGORI</th>
                        <th>NAMA</th>
                        <th>HARGA</th>
                        <th>STOK</th>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- Modal Add Produk-->
        <form id="add-row-form" action="<?php echo base_url() . 'index.php/kategori/simpan' ?>" method="post">
            <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="kategori" class="form-control" placeholder="kategori" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="add-row" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal Update Produk-->
        <form id="add-row-form" action="<?php echo base_url() . 'index.php/crud/update' ?>" method="post">
            <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Update Produk</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="kategori" class="form-control" placeholder="kategori" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="add-row" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal Hapus Produk-->
        <form id="add-row-form" action="<?php echo base_url() . 'index.php/crud/delete' ?>" method="post">
            <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Hapus Produk</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_kategori" class="form-control" placeholder="id_kategori" required>
                            <strong>Anda yakin mau menghapus record ini?</strong>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="add-row" class="btn btn-success">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script src="<?php echo base_url() . 'assets/js/jquery-2.1.4.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/jquery.datatables.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.js' ?>"></script>

        <script>
            $(document).ready(function() {
                // Setup datatables
                jQuery.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": oSettings._iDisplayLength === -1 ?
                            0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": oSettings._iDisplayLength === -1 ?
                            0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var table = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                            .off('.DT')
                            .on('input.DT', function() {
                                api.search(this.value).draw();
                            });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        "url": "<?php echo base_url() . 'index.php/produk/get_produk_json' ?>",
                        "type": "POST"
                    },
                    columns: [{
                            "data": "id_produk"
                        },
                        {
                            "data": "kategori"
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "harga"
                        },
                        {
                            "data": "stok"
                        },
                        {
                            "data": "view"
                        }
                    ],
                    order: [
                        [1, 'asc']
                    ],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        $('td:eq(0)', row).html();
                    }

                });
                // end setup datatables
                // get Edit Records
                $('#mytable').on('click', '.edit_record', function() {
                    var id_kategori = $(this).data('id_kategori');
                    var kategori = $(this).data('kategori');
                    $('#ModalUpdate').modal('show');
                    $('[name="id_kategori"]').val(id_kategori);
                    $('[name="kategori"]').val(kategori);
                });
                // End Edit Records
                // get Hapus Records
                $('#mytable').on('click', '.hapus_record', function() {
                    var id_kategori = $(this).data('id_kategori');
                    $('#ModalHapus').modal('show');
                    $('[name="id_kategori"]').val(id_kategori);
                });
                // End Hapus Records

            });
        </script>
    </body>

    </html>


</div>
<!-- End of Main Content -->