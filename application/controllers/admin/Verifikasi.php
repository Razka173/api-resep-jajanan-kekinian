<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resep_users_model');
		$this->load->model('Users_model');
		$this->load->model('Resep_model');
		$this->load->model('Bahan_model');
		// Proteksi halaman
		$this->simple_login->cek_login();
	}

	public function index()
	{
		$resep = $this->Resep_users_model->listing();
		$data = array(	'title' 	=> 'Data Verifikasi',
						'resep'		=> $resep,
						'isi'		=> 'admin/verifikasi/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Detail Resep
	public function detail($id_resep)
	{
		$resep = $this->Resep_users_model->detail($id_resep);
		$id_users = $resep->id_users;
		$users = $this->Users_model->detail($id_users);
		$bahan = $this->Resep_users_model->listingBahan($id_resep);
		$stepresep = $this->Resep_users_model->listingStep($id_resep);
		$data = array(	'title' 	=> 'Data Verifikasi',
						'resep'		=> $resep,
						'bahan'		=> $bahan,
						'stepresep'	=> $stepresep,
						'users'		=> $users,
						'isi'		=> 'admin/verifikasi/detail'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Approve Resep
	public function approve($id_resep){
		$resep = $this->Resep_users_model->detail($id_resep);
		$id_users = $resep->id_users;
		$bahan = $this->Resep_users_model->listingBahan($id_resep);
		$stepresep = $this->Resep_users_model->listingStep($id_resep);

		$dataresep = array(	'id_users'		=> $id_users,
							'nama'			=> $resep->nama_resep,
							'waktu_memasak'	=> $resep->waktu_memasak,
							'porsi'			=> $resep->porsi,
							'harga'			=> $resep->harga,
							);
		if($resep->is_approve == null){
			$this->Resep_model->tambah($dataresep);
			$id = $this->db->insert_id();
			$data = array(	'id_approve' => $id,
							'is_approve' => 1
						);
			$this->Resep_users_model->updateResep($data, $id_resep);
			foreach ($stepresep as $stepresep){
			$datastep = array(	'resep_id'		=> $id,
								'nomor_step'	=> $stepresep->nomor_step,
								'intruksi'		=> $stepresep->intruksi,
							);
			$this->Resep_model->tambahStepResep($datastep);
			$this->session->set_flashdata('sukses', 'Data resep users BERHASIL diverifikasi, silahkan verifikasi bahan resep');
			redirect(base_url('admin/verifikasi/bahan/'.$id_resep),'refresh');
			}
		}else{
			$this->session->set_flashdata('sukses', 'Data resep users SUDAH PERNAH diverifikasi, silahkan verifikasi bahan resep');
			redirect(base_url('admin/verifikasi'),'refresh');
		}
	}

	// Proses approve bahan
	public function bahan($resep_id)
	{
		$resep = $this->Resep_users_model->detail($resep_id);
		$is_migrated = $this->Resep_users_model->is_migrated($resep_id);
		if($resep->id_approve==null){
			$this->session->set_flashdata('sukses', 'Resep BELUM diverifikasi, silahkan klik verifikasi Resep terlebih dahulu');
			redirect(base_url('admin/verifikasi'),'refresh');
		}
		if($is_migrated){
			$this->session->set_flashdata('sukses', 'Bahan Resep SUDAH TERVERIFIKASI');
			redirect(base_url('admin/verifikasi'),'refresh');
		}
		$bahan = $this->Resep_users_model->listingBahan($resep_id);
		$listbahan = $this->Bahan_model->listingSort();
		$data = array(	'title' 	=> 'Data Verifikasi Bahan',
						'listbahan'	=> $listbahan,
						'bahan'		=> $bahan,
						'resep_id'	=> $resep_id,
						'resep'		=> $resep,
						'isi'		=> 'admin/verifikasi/bahan'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Approve Bahan Resep
	public function approvebahan($id_bahan_resep, $id_approve)
	{
		$bahan_resep = $this->Resep_users_model->detailBahanResep($id_bahan_resep);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('takaran','Takaran','required',
			array(	'required'		=> '%s harus diisi'));
		
		// Masuk database
		$i = $this->input;
		$data = array(	'bahan_id'			=> $i->post('id'),
						'resep_id'			=> $id_approve,
						'takaran'			=> $i->post('takaran'));
		$this->Resep_model->tambahBahanResep($data);
		$data = array(	'id'			=> $id_bahan_resep,
						'is_approve'	=> 1,
					);
		$this->Resep_users_model->updateBahanResep($data);
		$this->session->set_flashdata('sukses', 'Data Bahan BERHASIL diverifikasi');
		redirect(base_url('admin/verifikasi/bahan/'.$bahan_resep->resep_users_id),'refresh');
		// End masuk database
	}

	public function tambahbahan($namabahan, $resep_id) 
	{
		$data = array(	'nama'	=> $namabahan);
		$this->Bahan_model->createBahan($data);
		$this->session->set_flashdata('sukses', 'Data Bahan BERHASIL diverifikasi');
		redirect(base_url('admin/verifikasi/bahan/'.$resep_id),'refresh');
	}

	//hapus resep
	public function delete($id_resep)
	{
		$resep = $this->Resep_users_model->detail($id_resep);
		$bahan = $this->Resep_users_model->listingBahan($id_resep);
		$step = $this->Resep_users_model->listingStep($id_resep);
		// Proses hapus gambar
		$gambar = $resep->gambar;
		if($gambar != null){
			$nama_file = strtolower(str_replace(base_url(), '', $gambar));
			if(file_exists('./assets/img/users/resep/'.$nama_file)){
    			unlink('./assets/img/users/resep/'.$nama_file);
    		}
    		if(file_exists('./assets/img/thumbs/'.$nama_file)){
    			unlink('./assets/img/thumbs/'.$nama_file);
    		}
    	}
		
		foreach ($bahan as $bahan) {
			$data = array('id'	=> $bahan->id);
			$this->Resep_users_model->deleteBahanResep($data);
		}
		foreach ($step as $step){
			$data = array('id'	=> $step->id);
			$this->Resep_users_model->deleteStepResep($data);
		}
		// End proses hapus
		$this->Resep_users_model->deleteResep($id_resep);
		$this->session->set_flashdata('sukses', 'Data resep users telah dihapus');
		redirect(base_url('admin/verifikasi'),'refresh');
	}

	// Edit Bahan Resep
	public function editbahanresep($id_bahan_resep)
	{
		$bahan_resep = $this->Resep_users_model->detailBahanResep($id_bahan_resep);
		if($bahan_resep->is_approve==1){
			$this->session->set_flashdata('notif', 'Bahan yang SUDAH terverifikasi tidak bisa diubah');
			redirect(base_url('admin/verifikasi/detail/'.$bahan_resep->resep_users_id),'refresh');
		}
		
		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('takaran','Takaran','required',
			array(	'required'		=> '%s harus diisi'));
		$valid->set_rules('nama_bahan','Nama Bahan','required',
			array(	'required'		=> '%s harus diisi'));
		
		if($valid->run()===FALSE) {
			// End validasi
			$data = array(	'title' 		=> 'Edit Verifikasi Data',
							'bahan_resep'	=> $bahan_resep,
							'isi'			=> 'admin/verifikasi/editbahanresep',
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		
		}else{
			// Masuk database
			$i = $this->input;
			$data = array(	'id'			=> $id_bahan_resep,
							'nama_bahan'	=> $i->post('nama_bahan'),
							'takaran'		=> $i->post('takaran'));
			$this->Resep_users_model->updateBahanResep($data);
			$this->session->set_flashdata('sukses', 'Data bahan telah diedit');
			redirect(base_url('admin/verifikasi/detail/'.$bahan_resep->resep_users_id),'refresh');
		}
		// End masuk database
	}

	// Edit Step Resep
	public function editstepresep($id_step_resep)
	{
		$step_resep = $this->Resep_users_model->detailStepResep($id_step_resep);
		$resep_users = $this->Resep_users_model->detail($step_resep->resep_users_id);
		if($resep_users->is_approve==1){
			$this->session->set_flashdata('notif', 'RESEP yang SUDAH terverifikasi tidak bisa diubah');
			redirect(base_url('admin/verifikasi/detail/'.$step_resep->resep_users_id),'refresh');
		}

		// Validasi input
		$valid = $this->form_validation;
		$valid->set_rules('intruksi','Intruksi','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()===FALSE) {
			// End validasi
			$data = array(	'title' 		=> 'Edit Verifikasi Data',
							'step_resep'	=> $step_resep,
							'isi'			=> 'admin/verifikasi/editstepresep',
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		
		}else{
			// Masuk database
			$i = $this->input;
			$data = array(	'id'			=> $id_step_resep,
							'nomor_step'	=> $i->post('nomor_step'),
							'intruksi'		=> $i->post('intruksi')
						);
			$this->Resep_users_model->updateStepResep($data);
			$this->session->set_flashdata('sukses', 'Data step resep BERHASIL diubah');
			redirect(base_url('admin/verifikasi/detail/'.$step_resep->resep_users_id),'refresh');
		}
		// End masuk database
	}
}

/* End of file Verifikasi.php */
/* Location: ./application/controllers/admin/Verifikasi.php */