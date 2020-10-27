<?php
// Error upload
if(isset($error)) {
	echo '<p class="alert alert-warning">';
	echo $error;
	echo '</p>';
}

// Notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Form open
echo form_open_multipart(base_url('admin/resep/tambah'),' class="form-horizontal"');
?>

<p>
	<a href="<?php echo base_url('admin/resep') ?>" class="btn btn-primary btn-lg">
		<i class="fa fa-angle-left"></i> Kembali
	</a>
</p>

<div class="form-group form-group row">
	<label class="col-md-2 control-label" for="nama_resep">Nama Resep</label>
	<div class="col-md-5">
		<input type="text" name="nama_resep" id="nama_resep" class="form-control" placeholder="Nama Resep (Contoh: Kue Balok)" value="<?php echo set_value('nama_resep') ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="waktu_memasak">Waktu Memasak</label>
	<div class="col-md-5">
		<input type="text" name="waktu_memasak" id="waktu_memasak" class="form-control" placeholder="Waktu Memasak (Contoh: 30 Menit)" value="<?php echo set_value('waktu_memasak') ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="porsi">Porsi</label>
	<div class="col-md-5">
		<input type="number" name="porsi" id="porsi" class="form-control" placeholder="Porsi (Contoh: 1)" value="<?php echo set_value('porsi') ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="harga">Harga</label>
	<div class="col-md-5">
		<input type="number" name="harga" id="harga" class="form-control" placeholder="Harga (Contoh: 45000)" value="<?php echo set_value('harga') ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="gambar">Upload Gambar Resep</label>
	<div class="col-md-5">
		<input type="file" name="gambar" id="gambar" class="form-control" required="required">
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label"></label>
	<div class="col-md-5">
		<button class="btn btn-success btn-lg" name="submit" type="submit">
			<i class="fa fa-save"></i> Simpan
		</button>
		<button class="btn btn-info btn-lg" name="reset" type="reset">
			<i class="fa fa-times"></i> Reset
		</button>
	</div>
</div>

<?php echo form_close(); ?>