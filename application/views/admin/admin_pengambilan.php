<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5>Form Pengambilan</h5>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="card-body">
            <form action="<?= base_url() . 'admin/A_pengambilan/add_pengambilan_cart'; ?>" method="POST">
                <div class="row justify-content-start">
                    <div class="col-2">
                        <label for="noFaktur">No.Faktur</label>
                        <input type="text" class="form-control" name="faktur" value="<?= $this->session->userdata('faktur'); ?>" id="noFaktur" placeholder="" required>
                    </div>
                    <div class="col-2">
                        <label for="tgl">Tanggal</label>
                        <input type="date" class="form-control" name="tgl" value="<?= $this->session->userdata('tgl'); ?>" id="datepicker" placeholder="" required>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="col-2">
                        <label for="kode_brg">Kode Produk</label>
                        <input type="text" name="kode_brg" id="kode_brg" class="form-control">
                    </div>
                    <div class="col">
                        <div id="detail_barang">
                        </div>
                    </div>
                </div>
            </form>
            <hr />
            <div>
                <p>Detail Pengambilan Barang</p>
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th style="text-align:center;">Harga</th>
                            <th style="text-align:center;">Jumlah</th>
                            <th style="text-align:center;">Sub Total</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($this->cart->contents() as $items) : ?>
                            <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                            <tr>
                                <td><?= $items['id']; ?></td>
                                <td><?= $items['nama']; ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['harga']); ?></td>
                                <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>
                                <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/A_pengambilan/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align:center;">Total</td>
                            <td style="text-align:right;">Rp. <?php echo number_format($this->cart->total()); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <a href="<?php echo base_url() . 'admin/pembelian/simpan_pembelian' ?>" class="btn btn-info" style="float: right"><span class="fa fa-save"></span> Save</a>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div>
                <h5>Tabel Pengambilan Barang</h5>
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
                            <th style="text-align: center">Tanggal</th>
                            <th style="text-align: center">Total</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($pengambilan->result_array() as $pn) : ?>
                            <tr>
                                <td style="text-align: center" scope="row"><?= $i; ?></td>
                                <td style="text-align: center"><?= $pn['pengambilan_id']; ?></td>
                                <td><?= $pn['pengambilan_tgl']; ?></td>
                                <td><?= 'Rp ' . number_format($pn['pd_total']); ?></td>
                                <td><?= $pn['status']; ?></td>
                                <td style="text-align: center">
                                    <a href="#updateProduk<?= $po['produk_id']; ?>" class="btn btn-success edit-kategori" data-toggle="modal"><i class="fas fa-edit"></i></a>
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
<script type="text/javascript">
    $(document).ready(function() {
        $("#kode_brg").focus();
        $("#kode_brg").keyup(function() {
            var kobar = {
                kode_brg: $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'admin/A_pengambilan/get_barang'; ?>",
                data: kobar,
                success: function(msg) {
                    $('#detail_barang').html(msg);
                }
            });
        });

        $("#kode_brg").keypress(function(e) {
            if (e.which == 13) {
                $("#qty").focus();
            }
        });
    });
</script>