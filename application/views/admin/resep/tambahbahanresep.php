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
echo form_open_multipart(base_url('admin/resep/tambahbahanresep/'.$resep->id),' class="form-horizontal"');
?>

<p>
	<a href="<?php echo base_url('admin/resep/detail/'.$resep->id) ?>" class="btn btn-primary btn-lg">
		<i class="fa fa-angle-left"></i> Kembali
	</a>
</p>

<div class="form-group form-group row">
	<label class="col-md-2 control-label" for="id">Pilih Bahan</label>
	<div class="col-md-5">
		<select name="id" class="form-control" id="id">
			<?php foreach($listbahan as $listbahan) { ?>
			<option class="form-control border border-dark" value="<?php echo $listbahan->id ?>">
			<?php echo $listbahan->nama ?>
			</option>
			<?php } ?>
		</select>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label" for="takaran">Takaran</label>
	<div class="col-md-5">
		<input type="text" name="takaran" id="takaran" class="form-control" placeholder="Silahkan lihat rekomendasi input dibawah" value="<?php echo set_value('takaran') ?>" required>
	</div>
</div>
<hr>

<div class="form-group row">
	<label class="col-md-2 control-label">Rekomendasi Input Takaran</label>
	<div class="col-md-5">
		<p>100 mL</p>
		<p>100 Gram</p>
		<p>2 Sendok Makan</p>
		<p>5 Sendok Teh</p>
		<p>3 Butih</p>
		<p>Secukupnya</p>
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