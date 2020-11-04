<?php
// Error upload
if(isset($error)) {
	echo '<p class="alert alert-warning">';
	echo $error;
	echo '</p>';
}
// Notifikasi
if($this->session->flashdata('sukses')){
	echo '<p class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	// echo '</div>';
}

// Notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Form open
echo form_open_multipart(base_url('admin/resep/tambahstepresep/'.$resep->id),' class="form-horizontal"');
?>

<p>
	<a href="<?php echo base_url('admin/resep/detail/'.$resep->id) ?>" class="btn btn-primary btn-lg">
		<i class="fa fa-angle-left"></i> Kembali
	</a>
</p>

<div class="form-group row">
	<label class="col-md-2 control-label" for="nomor_step">Nomor Step</label>
	<div class="col-md-5">
		<input type="number" name="nomor_step" id="nomor_step" class="form-control" placeholder=" <?php echo $nomor_step ?>" value="<?php echo $nomor_step ?>" required readonly>
	</div>
</div>
<hr>

<div class="form-group form-group row">
	<label class="col-md-2 control-label" for="instruksi">Instruksi Resep</label>
	<div class="col-md-5">
		<textarea name="instruksi" id="instruksi" class="form-control" placeholder="Instruksi Resep (Contoh: Masak bahan hingga matang)" required></textarea>
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