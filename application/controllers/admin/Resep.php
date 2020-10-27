<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resep_model');
		$this->load->model('Bahan_model');
		// Proteksi halaman
		$this->simple_login->cek_login();
	}

  	// Data Resep
	public function index()
	{
		$resep = $this->Resep_model->listing();
		$data = array(	'title' 	=> 'Data Resep',
						'resep'		=> $resep,
						'isi'		=> 'admin/resep/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah Resep
	public function tambah()
	{
		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_resep','Nama Resep','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()) {
			$nama_resep = $this->input->post('nama_resep');
			$nama_file = strtolower(str_replace(' ', '', $nama_resep));
			$config['file_name']		= $nama_file;
			$config['upload_path'] 		= './assets/img/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '5400';//Dalam KB
			$config['max_width']  		= '3048';
			$config['max_height']  		= '3048';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar') ){
			// End validasi
			$data = array(	'title' 	=> 'Tambah Resep',
							'error'		=> $this->upload->display_errors(),
							'isi'		=> 'admin/resep/tambah',
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);

			// Masuk database
			}else{
				$upload_gambar = array('upload_data' => $this->upload->data());

				// Create thumbnail gambar
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= './assets/img/'.$upload_gambar['upload_data']['file_name'];
				// lokasi folder thumbnail
				$config['new_image']		= './assets/img/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 250;//Pixel
				$config['height']       	= 250;//Pixel
				$config['thumb_marker']		= '';

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();
				// End create thumbnail

				$i = $this->input;
				$data = array(	'nama'				=> $i->post('nama_resep'),
								'waktu_memasak'		=> $i->post('waktu_memasak'),
								'porsi'				=> $i->post('porsi'),
								'harga'				=> $i->post('harga'),
								// Disimpan nama file gambar
								'gambar'			=> base_url('assets/img/'.$upload_gambar['upload_data']['file_name']),
							);
				$this->Resep_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/resep'),'refresh');
			}
		}
		// End masuk database
		$data = array(	'title' 	=> 'Tambah Resep',
						'isi'		=> 'admin/resep/tambah',
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit Resep
	public function edit($id_resep)
	{
		// Ambil data resep yang akan diedit
		$resep 	= $this->Resep_model->detail($id_resep);

		// Validasi input
		$valid 		= $this->form_validation;

		$valid->set_rules('nama_resep','Nama Resep','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()) {
			// Check jika gambar diganti
			if( !empty($_FILES['gambar']['name']) ) {
				$nama_resep = $this->input->post('nama_resep');
				$nama_file = strtolower(str_replace(' ', '', $nama_resep));
				$config['file_name']		= $nama_file;
				$config['upload_path'] 		= './assets/img/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['max_size']  		= '5400';//Dalam KB
				$config['max_width']  		= '3048';
				$config['max_height']  		= '3048';
			
				$this->load->library('upload', $config);
				
				if ( !$this->upload->do_upload('gambar') ){
					// End validasi
					$data = array(	'title' 	=> 'Edit Resep: '.$resep->nama,
									'resep'		=> $resep,
									'error'		=> $this->upload->display_errors(),
									'isi'		=> 'admin/resep/edit',
								);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				}else{
					$upload_gambar = array('upload_data' => $this->upload->data());

					// Create thumbnail gambar
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= './assets/img/'.$upload_gambar['upload_data']['file_name'];
					// lokasi folder thumbnail
					$config['new_image']		= './assets/img/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['maintain_ratio'] 	= TRUE;
					$config['width']         	= 250;//Pixel
					$config['height']       	= 250;//Pixel
					$config['thumb_marker']		= '';

					$this->load->library('image_lib', $config);

					$this->image_lib->resize();
					// End create thumbnail

					$i = $this->input;

					$data = array(	'id'				=> $resep->id,
									'nama'				=> $i->post('nama_resep'),
									'waktu_memasak'		=> $i->post('waktu_memasak'),
									'porsi'				=> $i->post('porsi'),
									'harga'				=> $i->post('harga'),
									// Disimpan nama file gambar
									'gambar'			=> base_url($nama_file),
								);
					$this->Resep_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/resep'),'refresh');
				}
			}else{
			// Edit resep tanpa ganti gambar
				$i = $this->input;
			
				$data = array(	'id'				=> $resep->id,
								'nama'				=> $i->post('nama_resep'),
								'waktu_memasak'		=> $i->post('waktu_memasak'),
								'porsi'				=> $i->post('porsi'),
								'harga'				=> $i->post('harga'),
							);
			$this->Resep_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/resep'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 	=> 'Edit Resep: '.$resep->nama,
						'resep'		=> $resep,
						'isi'		=> 'admin/resep/edit',
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Delete Resep
	public function delete($id_resep)
	{
		$resep = $this->Resep_model->detail($id_resep);
		// Proses hapus gambar
		$gambar = $resep->gambar;
		$nama_file = strtolower(str_replace(base_url(), '', $gambar));
		if(file_exists('./assets/img/'.$nama_file)){
    		unlink('./assets/img/'.$nama_file);
    	}
    	if(file_exists('./assets/img/thumbs/'.$nama_file)){
    		unlink('./assets/img/thumbs/'.$nama_file);
    	}
		// End proses hapus
		$data = array('id'	=> $id_resep);
		$this->Resep_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/resep'),'refresh');
	}

	// Detail Resep
	public function detail($id_resep){
		$resep = $this->Resep_model->detail($id_resep);
		$bahan = $this->Resep_model->listingBahan($id_resep);
		$stepresep = $this->Resep_model->listingStep($id_resep);
		$data = array(	'title' 	=> 'Data Resep',
						'resep'		=> $resep,
						'bahan'		=> $bahan,
						'stepresep'	=> $stepresep,
						'isi'		=> 'admin/resep/detail'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah Bahan Resep
	public function tambahbahanresep($id_resep)
	{
		// Passing Data
		$resep = $this->Resep_model->detail($id_resep);
		$listbahan = $this->Bahan_model->listing();

		// Validasi input
		$valid = $this->form_validation;
		$valid->set_rules('takaran','Takaran','required',
			array(	'required'		=> '%s harus diisi'));
		if($valid->run()===FALSE) {
			// End validasi
			$data = array(	'title' 	=> 'Tambah Ingredient Resep',
							'listbahan'	=> $listbahan,
							'resep'		=> $resep,
							'isi'		=> 'admin/resep/tambahbahanresep'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			// Masuk database
			$i = $this->input;
			$data = array(	'bahan_id'		=> $i->post('id'),
							'takaran'		=> $i->post('takaran'),
							'resep_id'		=> $id_resep
						);
			$this->Resep_model->tambahbahanresep($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/resep/detail/'.$id_resep),'refresh');
		}
		// End masuk database
	}

	// Delete Bahan Resep
	public function deletebahanresep($id_bahan_resep)
	{
		$bahan_resep = $this->Resep_model->detailBahanResep($id_bahan_resep);
		$resep_id = $bahan_resep->resep_id;
		$data = array('id'	=> $id_bahan_resep);
		$this->Resep_model->deleteBahanResep($data);
		$this->session->set_flashdata('sukses', 'Data bahan resep telah dihapus');
		redirect(base_url('admin/resep/detail/'.$resep_id),'refresh');
	}

	// Edit Bahan Resep
	public function editbahanresep($id_bahan_resep)
	{
		$bahanresep = $this->Resep_model->detailBahanResep($id_bahan_resep);
		$bahan_id = $bahanresep->bahan_id;
		$bahan = $this->Bahan_model->detail($bahan_id);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('takaran','Takaran','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()===FALSE) {
			// End validasi
			$data = array(	'title' 		=> 'Edit Bahan Resep',
							'bahanresep'	=> $bahanresep,
							'bahan'			=> $bahan,
							'isi'			=> 'admin/resep/editbahanresep',
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		
		}else{
			// Masuk database
			$i = $this->input;
			$data = array(	'id'			=> $id_bahan_resep,
							'takaran'		=> $i->post('takaran'));
			$this->Resep_model->editBahanResep($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/resep/detail/'.$bahanresep->resep_id),'refresh');
		}
		// End masuk database
	}

	// Delete Step Resep
	public function deletestepresep($id_step_resep)
	{
		$step_resep = $this->Resep_model->detailStepResep($id_step_resep);
		$resep_id = $step_resep->resep_id;
		$data = array('id'	=> $id_step_resep);
		$this->Resep_model->deleteStepResep($data);
		$this->session->set_flashdata('sukses', 'Data step resep telah dihapus');
		redirect(base_url('admin/resep/detail/'.$resep_id),'refresh');
	}
}

/* End of file Produk.php */
/* Location: ./application/controllers/admin/Produk.php */