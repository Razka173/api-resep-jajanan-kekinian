<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-<?php echo $resep->id ?>">
	<i class="fa fa-trash"></i> Hapus
</button>

<!-- Modal -->
<div class="modal fade" id="delete-<?php echo $resep->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      		<div class="modal-header">
        		<h4 class="modal-title " id="modalLabel">HAPUS DATA RESEP</h4>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
				<div class="alert alert-warning">
					<h4>Peringatan!</h4>
					Yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan.
				</div>
      		</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
        	<a href="<?php echo base_url('admin/resep/delete/'.$resep->id) ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Ya, Hapus Data Ini</a>
      	</div>
    	</div>
  </div>
</div>