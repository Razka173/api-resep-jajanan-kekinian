<p>
	<a href="<?php echo base_url('admin/bahan/tambah') ?>" class="btn btn-success btn-lg">
		<i class="fa fa-plus"></i> Tambah baru
	</a>
</p>

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
			<th>GAMBAR</th>
			<th>NAMA</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($bahan as $bahan) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td>
				<img src="<?php echo $bahan->gambar ?>" class="img img-responsive img-thumbnail" width=60 alt="">
			</td>
			<td><?php echo $bahan->nama ?></td>
			<td>
				<a href="<?php echo base_url('admin/bahan/edit/'.$bahan->id) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>

				<?php include('delete.php') ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>