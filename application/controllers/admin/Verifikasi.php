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
		// foreach ($bahan as $bahan){
		// 	$nama_bahan = $this->$bahan->nama_bahan;
		// 	if ($this->Bahan_model->search($nama_bahan)){
		// 		$bahan_hasil = $this->Bahan_model->search($search_bahan);
		// 		$databahan = array( 'bahan_id'	=> $bahan_hasil->id,
		// 							'takaran'	=> $bahan->takaran,
		// 							'resep_id'	=> $id,
		// 							);
		// 		$this->Resep_model->tambahBahanResep($databahan);
		// 	}	
		// }
	}

	public function bahan($resep_id)
	{
		$resep = $this->Resep_users_model->detail($resep_id);
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
		$bahanresep = $this->Resep_users_model->detailBahanResep($id_bahan_resep);
		$bahan_id = $bahanresep->bahan_id;
		$bahan = $this->Bahan_model->detail($bahan_id);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('takaran','Takaran','required',
			array(	'required'		=> '%s harus diisi'));
		
		// Masuk database
		$i = $this->input;
		$data = array(	'id'			=> $id_bahan_resep,
						'takaran'		=> $i->post('takaran'));
		$this->Resep_model->editBahanResep($data);
		$this->session->set_flashdata('sukses', 'Data telah diedit');
		redirect(base_url('admin/resep/detail/'.$bahanresep->resep_id),'refresh');
		// End masuk database
	}

}

/* End of file Verifikasi.php */
/* Location: ./application/controllers/admin/Verifikasi.php */