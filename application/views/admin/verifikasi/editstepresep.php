<?php
// Error upload
if (isset($error)) {
	echo '<p class="alert alert-warning">';
	echo $error;
	echo '</p>';
}

// Notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Form open
echo form_open_multipart(base_url('admin/verifikasi/editstepresep/'.$step_resep->id), ' class="form-horizontal"');
?>

<p>
    <a href="<?php echo base_url('admin/verifikasi/detail/'.$step_resep->resep_users_id) ?>" class="btn btn-primary btn-lg">
        <i class="fa fa-angle-left"></i> Kembali
    </a>
</p>

<div class="form-group row">
    <label class="col-md-2 control-label" for="nomor_step">Nomor Step</label>
    <div class="col-md-5">
        <input type="number" name="nomor_step" id="nomor_step" class="form-control"
            placeholder=" <?php echo $step_resep->nomor_step ?>" value="<?php echo $step_resep->nomor_step ?>" required>
    </div>
</div>
<hr>

<div class="form-group form-group row">
    <label class="col-md-2 control-label" for="intruksi">Intruksi Resep</label>
    <div class="col-md-5">
        <textarea name="intruksi" id="intruksi" class="form-control"
            placeholder="Instruksi Resep (Contoh: Masak bahan hingga matang)"
            required><?php echo $step_resep->intruksi ?></textarea>
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