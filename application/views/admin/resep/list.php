<p>
	<a href="<?php echo base_url('admin/resep/tambah') ?>" class="btn btn-success btn-lg">
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
			<th>WAKTU</th>
			<th>PORSI</th>
			<th>HARGA</th>
			<th>FAVORIT</th>
			<th>DILIHAT</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($resep as $resep) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td>
				<img src="<?php echo base_url('assets/img/thumbs/').$resep->gambar ?>" class="img img-responsive img-thumbnail" width=60 alt="">
			</td>
			<td><?php echo $resep->nama ?></td>
			<td><?php echo $resep->waktu_memasak ?></td>
			<td><?php echo $resep->porsi ?></td>
			<td><?php echo number_format($resep->harga,'0',',',',') ?></td>
			<td><?php echo $resep->favorit ?></td>
			<td><?php echo $resep->dilihat ?></td>
			<td>
				<a href="<?php echo base_url('admin/resep/edit/'.$resep->id) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>

				<?php include('delete.php') ?>

				<a href="<?php echo base_url('admin/resep/detail/'.$resep->id) ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Detail</a>

				<a href="<?php echo base_url('admin/resep/tambahstepresep/'.$resep->id) ?>" class="btn btn-secondary btn-xs"><i class="fa fa-plus"></i> Step</a>

				<a href="<?php echo base_url('admin/resep/tambahbahanresep/'.$resep->id) ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Bahan</a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>