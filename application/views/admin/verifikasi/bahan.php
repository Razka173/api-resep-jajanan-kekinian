<p>
	<a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-primary btn-lg">
		<i class="fa fa-angle-left"></i> Kembali
	</a>
</p>

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
			<th width=10%>Rekomendasi Takaran</th>
			<th width=5%>100 ml</th>
			<th width=5%>100 Gram</th>
			<th width=5%>1 Sendok Makan</th>
			<th width=5%>1 Sendok Teh</th>
			<th width=5%>1 Butir</th>
			<th width=5%>Secukupnya</th>
		</tr>
</tbody>
</table>

<table class="table table-bordered" id="dataTable">
	<thead>
		<tr>
			<th width=5%>NO</th>
			<th>BAHAN USER</th>
			<th>TAKARAN USER</th>
			<th width=40%>VERIFIKASI BAHAN & TAKARAN</th>
			<th width=20%>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($bahan as $bahan){
		// Notifikasi error
		echo validation_errors('<div class="alert alert-warning">','</div>');

		// Form open
		echo form_open_multipart(base_url('admin/verifikasi/approvebahan/'.$bahan->id.'/'.$resep->id_approve),' class="form-horizontal"');
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
						<input type="text" name="takaran" id="takaran" class="form-control" placeholder="Silahkan lihat rekomendasi input dibawah" value="<?php echo $bahan->takaran ?>" required>
					</div>
				</div>
			</td>

			<td>
				<?php if($bahan->is_approve == null && $list != null){?>
				<button class="btn btn-success btn-xs col-12" name="submit" type="submit"><i class="fa fa-check"></i> Verifikasi Bahan</button><?php }else if($bahan->is_approve != null){ ?>
				<div class="btn btn-outline-success btn-xs col-12"><i class="fa fa-check"></i> Terverifikasi</div>
				<?php }else if($list == null){?>
				<a href="<?php echo base_url('admin/verifikasi/tambahbahan/'.$bahan->nama_bahan.'/'.$resep_id) ?>" class="btn btn-success btn-xs col-12" name="submit" type="submit"><i class="fa fa-plus"></i> Tambah Bahan ke Kulkas</a>
				<a href="<?php echo base_url('admin/verifikasi/editbahanresep/'.$bahan->id) ?>" class="btn btn-warning btn-xs col-12 mt-1"><i class="fa fa-edit"></i> Edit bahan</a>
				<?php }?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		<?php $no++; } ?>
	</tbody>
</table>