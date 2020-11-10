<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Diskusi_model');
		// Proteksi halaman
		$this->simple_login->cek_login();
	}

	public function index()
	{
		$diskusi = $this->Diskusi_model->listing();
		$data = array(	'title' 	=> 'Data Diskusi',
						'diskusi'	=> $diskusi,
						'isi'		=> 'admin/diskusi/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Delete Diskusi
	public function delete($id_diskusi)
	{
		$data = array('id'	=> $id_diskusi);
		$this->Diskusi_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/diskusi'),'refresh');
	}

}

/* End of file Diskusi.php */
/* Location: ./application/controllers/admin/Diskusi.php */