<p>
	<a href="<?php echo base_url('admin/resep') ?>" class="btn btn-primary btn-lg">
		<i class="fa fa-angle-left"></i> Kembali
	</a>
	<a href="<?php echo base_url('admin/resep/tambahbahanresep/'.$resep->id) ?>" class="btn btn-success btn-lg">
		<i class="fa fa-plus"></i> Tambah Bahan
	</a>
	<a href="<?php echo base_url('admin/resep') ?>" class="btn btn-info btn-lg">
		<i class="fa fa-plus"></i> Tambah Step
	</a>
	<a href="<?php echo base_url('admin/resep/edit/'.$resep->id) ?>" class="btn btn-warning btn-lg"><i class="fa fa-edit"></i> Edit Resep
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

<div>
	<p class="text-lg">DETAIL RESEP:</p>
</div>

<table class="table table-borderless" id="">
	<thead>
		<tr>
			<th>GAMBAR</th>
			<th>NAMA</th>
			<th>WAKTU MEMASAK</th>
			<th>PORSI</th>
			<th>HARGA</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<img src="<?php echo $resep->gambar ?>" class="img img-responsive img-thumbnail" width=200 alt="">
			</td>
			<td><?php echo $resep->nama ?></td>
			<td><?php echo $resep->waktu_memasak ?></td>
			<td><?php echo $resep->porsi ?></td>
			<td><?php echo $resep->harga ?></td>
		</tr>
	</tbody>
</table>

<div>
	<p class="text-lg">DETAIL BAHAN:</p>
</div>

<table class="table table-hover-sm" id="">
	<thead>
		<tr>
			<th>NO</th>
			<th>GAMBAR</th>
			<th>NAMA</th>
			<th>TAKARAN</th>
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
			<td><?php echo $bahan->takaran ?></td>
			<td>
				<a href="<?php echo base_url('admin/resep/editbahanresep/'.$bahan->id) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>

				<?php include('deletebahanresep.php') ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>

<div>
	<p class="text-lg">DETAIL INTRUKSI:</p>
</div>

<table class="table table-borderless" id="">
	<thead>
		<tr>
			<th class="col-sm-1">NOMOR</th>
			<th class="col-sm-7">INSTRUKSI</th>
			<th class="col-sm-4">ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($stepresep as $stepresep) {?>
		<tr>
			<td><?php echo $stepresep->nomor_step ?></td>
			<td><?php echo $stepresep->intruksi ?></td>
			<td>
				<a href="<?php echo base_url('admin/resep/editstepresep/'.$stepresep->id) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>

				<?php include('deletestepresep.php') ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>