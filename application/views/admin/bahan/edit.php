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
echo form_open_multipart(base_url('admin/bahan/edit/'.$bahan->id),' class="form-horizontal"');
?>

<p>
	<a href="<?php echo base_url('admin/bahan/') ?>" class="btn btn-primary btn-lg">
		<i class="fa fa-angle-left"></i> Kembali
	</a>
</p>

<div class="form-group form-group row">
	<label class="col-md-2 control-label" for="nama_bahan">Nama Bahan</label>
	<div class="col-md-5">
		<input type="text" name="nama_bahan" id="nama_bahan" class="form-control" placeholder="Nama Bahan" value="<?php echo $bahan->nama ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="gambar">Edit Gambar Bahan</label>
	<div class="col-md-5">
		<input type="file" name="gambar" id="gambar" class="form-control">
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label">Gambar Sebelumnya</label>
	<div class="col-md-5">
		<img src="<?php echo base_url('assets/img/bahan/thumbs/').$bahan->gambar ?>" class="img img-responsive img-thumbnail" width="200" alt="No Picture">
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