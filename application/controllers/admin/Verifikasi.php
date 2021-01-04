<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resep_users_model');
		$this->load->model('Users_model');
		$this->load->model('Resep_model');
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
	public function detail($id_resep){
		$resep = $this->Resep_users_model->detail($id_resep);
		$id_users = $resep->id_users;
		$users = $this->users_model->detail($id_users);
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
		$this->Resep_model->tambah($dataresep);
		foreach ($bahan as $bahan){
			$databahan = array(
						);
		}
		 
		
		$this->session->set_flashdata('sukses', 'Data resep users telah disetujui');
		redirect(base_url('admin/verifikasi'),'refresh');
	}

}

/* End of file Verifikasi.php */
/* Location: ./application/controllers/admin/Verifikasi.php */