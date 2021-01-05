<?php 
// Notifikasi
if($this->session->flashdata('sukses')){
	echo '<p class="alert alert-success">';
	echo $this->session->flashdata('sukses');
}

?>

<table class="table table-hover table-info" id="dataTable">
<tbody>
		<tr>
			<th class="col-2">Rekomendasi Takaran</th>
			<th class="col-2">100 ml</th>
			<th class="col-2">100 Gram</th>
			<th class="col-2">1 Sendok Makan</th>
			<th class="col-2">1 Sendok Teh</th>
			<th class="col-2">1 Butir</th>
			<th class="col-2">Secukupnya</th>
		</tr>
</tbody>
</table>

<table class="table table-bordered" id="dataTable">
	<thead>
		<tr>
			<th class="col-1">NO</th>
			<th class="col-2">BAHAN USER</th>
			<th class="col-2">TAKARAN USER</th>
			<th class="col-5">VERIFIKASI BAHAN & TAKARAN</th>
			<th class="col-2">ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($bahan as $bahan){
		// Notifikasi error
		echo validation_errors('<div class="alert alert-warning">','</div>');

		// Form open
		echo form_open_multipart(base_url('admin/verifikasi/bahan/'.$resep_id.'/'.$id),' class="form-horizontal"');
		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $bahan->nama_bahan ?></td>
			<td><?php echo $bahan->takaran ?></td>
			<td>
				<div class="form-group form-group row">
					<div class="col-6">
						<select name="id" class="form-control" id="id">
							<?php $list = $this->Bahan_model->search($bahan->nama_bahan);
							foreach($list as $list){?>
								<option class="form-control border border-dark" value="<?php echo $list->id?>"><?php echo $list->nama ?></option><?php }?>
						</select>
					</div>
					<div class="col-6">
						<input type="text" name="takaran" id="takaran" class="form-control" placeholder="Silahkan lihat rekomendasi input dibawah" value="<?php echo set_value('takaran') ?>" required>
					</div>
				</div>
			</td>

			<td>
				
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>