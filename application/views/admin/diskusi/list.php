<?php 
// Notifikasi
if($this->session->flashdata('sukses')){
	echo '<p class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	// echo '</div>';
}
?>

<table class="table table-bordered" id="dataTable">
	<thead>
		<tr>
			<th>NO</th>
			<th>NAMA USER</th>
			<th>RESEP DISKUSI</th>
			<th>ISI</th>
			<th>DISUKAI</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($diskusi as $diskusi) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $diskusi->nama_user ?></td>
			<td>
				<a href="<?php echo base_url('admin/resep/detail/'.$diskusi->resep_id)?>">
					<?php echo $diskusi->nama_resep ?>
				</a>
			</td>
			<td><?php echo $diskusi->isi ?></td>
			<td><?php echo $diskusi->disukai ?></td>
			<td>
				<!-- <a href="<?php echo base_url('admin/diskusi/edit/'.$diskusi->id)?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a> -->

				<?php include('delete.php') ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>