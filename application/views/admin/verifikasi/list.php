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
			<th width=5%>NO</th>
			<th>NAMA RESEP</th>
			<th>PENULIS</th>
			<th width=20%>STATUS</th>
			<th width=20%>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($resep as $resep) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $resep->nama_resep ?></td>
			<td><?php echo $resep->nama_penulis ?></td>
			<td><?php 
				if($resep->is_approve==1){echo '<div class="btn btn-success btn-xs col-12"><i class="fa fa-check"></i> Resep Terverifikasi</div>';}else{echo '<div class="btn btn-danger btn-xs col-12"><i class="fa fa-times"></i> Verifikasi Resep</div>';} 
				
				if($resep->is_migrated==1){echo '<div class="btn btn-success btn-xs col-12 mt-1"><i class="fa fa-check"></i> Bahan Terverifikasi</div>';}else{echo '<div class="btn btn-danger btn-xs col-12 mt-1"><i class="fa fa-times"></i> Verifikasi Bahan</div>';}
				?>
			</td>
			<td>
				<a href="<?php echo base_url('admin/verifikasi/detail/'.$resep->id) ?>" class="btn btn-info btn-xs col-12"><i class="fa fa-eye"></i> Detail</a>

				<?php include('submit.php') ?>

				<a href="<?php echo base_url('admin/verifikasi/bahan/'.$resep->id) ?>" class="btn btn-warning btn-xs col-12 mt-1"><i class="fa fa-edit"></i> Verifikasi Bahan</a>

				<?php include('delete.php') ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>