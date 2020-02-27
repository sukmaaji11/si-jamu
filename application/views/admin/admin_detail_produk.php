<?php
error_reporting(0);
$b = $barang->row_array();
?>

<div class="row">
	<div class="col">
		<label for="nama">Produk</label>
		<input type="text" name="nama" value="<?php echo $b['produk_nama']; ?>" class="form-control" disabled>
	</div>
	<div class="col">
		<label for="harga">Harga</label>
		<input type="text" name="harga" id="harga" value="<?php echo $b['produk_harga']; ?>" class="form-control input-sm" disabled>
	</div>
	<div class="col-1">
		<label for="qty">Qty</label>
		<input type="text" name="qty" id="qty" class="form-control input-sm" required>
	</div>
	<div class="col-1">
		<label for="">&nbsp;</label>
		<button type="submit" class="btn btn-primary form-control">Add</button>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$('#harga').priceFormat({
			prefix: '',
			//centsSeparator: '',
			centsLimit: 0,
			thousandsSeparator: ','
		});
	});
</script>