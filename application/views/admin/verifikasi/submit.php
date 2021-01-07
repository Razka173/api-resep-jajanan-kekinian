<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-xs col-12 mt-1" data-toggle="modal" data-target="#submit-<?php echo $resep->id ?>">
	<i class="fa fa-check"></i> Verifikasi Resep
</button>

<!-- Modal -->
<div class="modal fade" id="submit-<?php echo $resep->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
      		<div class="modal-header">
        		<h4 class="modal-title " id="modalLabel">SETUJUI DATA RESEP</h4>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
				<div class="alert alert-warning">
					<h4>Peringatan!</h4>
					Yakin ingin menyetujui data ini?
				</div>
      		</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        	<a href="<?php echo base_url('admin/verifikasi/approve/'.$resep->id) ?>" class="btn btn-success"><i class="fa fa-check"></i> Ya, Tambahkan Data Resep Ini</a>
      	</div>
    	</div>
  </div>
</div>