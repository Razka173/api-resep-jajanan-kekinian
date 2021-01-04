<?php 
// Notifikasi
if($this->session->flashdata('sukses')){
	echo '<p class="alert alert-success">';
	echo $this->session->flashdata('sukses');
}
?>

<table class="table table-bordered" id="dataTable">
	<thead>
		<tr>
			<th class="col-1">NO</th>
			<th class="col-2">GAMBAR</th>
			<th class="col-2">NAMA RESEP</th>
			<th class="col-1">ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($resep as $resep) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td>
				<img src="<?php echo base_url('assets/img/bahan/thumbs/').$resep->gambar ?>" class="img img-responsive img-thumbnail" width=60 alt="">
			</td>
			<td><?php echo $resep->nama_resep ?></td>
			<td>
				<a href="<?php echo base_url('admin/verifikasi/detail/'.$resep->id) ?>" class="btn btn-info btn-xs col-12"><i class="fa fa-eye"></i> Detail</a>
				<?php include('submit.php') ?>
				<a href="<?php echo base_url('admin/verifikasi/edit/'.$resep->id) ?>" class="btn btn-warning btn-xs col-12 mt-1"><i class="fa fa-edit"></i> Edit</a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>