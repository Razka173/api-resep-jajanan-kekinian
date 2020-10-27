<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Resep_model');
		$this->load->model('Bahan_model');
		// Proteksi halaman
		$this->simple_login->cek_login();
	}

  	// Data Bahan
	public function index()
	{
		$bahan = $this->Bahan_model->listing();
		$data = array(	'title' 	=> 'Data Bahan',
						'bahan'		=> $bahan,
						'isi'		=> 'admin/bahan/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah Bahan
	public function tambah()
	{
		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_bahan','Nama Bahan','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()) {
			$nama_bahan = $this->input->post('nama_bahan');
			$nama_file = strtolower(str_replace(' ', '', $nama_bahan));
			$config['file_name']		= $nama_file;
			$config['upload_path'] 		= './assets/img/bahan/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '5400';//Dalam KB
			$config['max_width']  		= '3048';
			$config['max_height']  		= '3048';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar') ){
			// End validasi
			$data = array(	'title' 	=> 'Tambah Bahan',
							'error'		=> $this->upload->display_errors(),
							'isi'		=> 'admin/bahan/tambah',
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);

			// Masuk database
			}else{
				$upload_gambar = array('upload_data' => $this->upload->data());

				// Create thumbnail gambar
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= './assets/img/bahan/'.$upload_gambar['upload_data']['file_name'];
				// lokasi folder thumbnail
				$config['new_image']		= './assets/img/bahan/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 250;//Pixel
				$config['height']       	= 250;//Pixel
				$config['thumb_marker']		= '';

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();
				// End create thumbnail

				$i = $this->input;
				$data = array(	'nama'		=> $i->post('nama_bahan'),
								// Disimpan nama file gambar
								'gambar'	=> $upload_gambar['upload_data']['file_name'],
							);
				$this->Bahan_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/bahan'),'refresh');
			}
		}
		// End masuk database
		$data = array(	'title' 	=> 'Tambah Bahan',
						'isi'		=> 'admin/bahan/tambah',
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit Bahan
	public function edit($id_bahan)
	{
		// Ambil data bahan yang akan diedit
		$bahan = $this->Bahan_model->detail($id_bahan);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_bahan','Nama Bahan','required',
			array(	'required'		=> '%s harus diisi'));

		if($valid->run()) {
			// Check jika gambar diganti
			if( !empty($_FILES['gambar']['name']) ) {
				$nama_bahan = $this->input->post('nama_bahan');
				$nama_file = strtolower(str_replace(' ', '', $nama_bahan));
				$config['file_name']		= $nama_file;
				$config['upload_path'] 		= './assets/img/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['max_size']  		= '5400';//Dalam KB
				$config['max_width']  		= '3048';
				$config['max_height']  		= '3048';
			
				$this->load->library('upload', $config);
				
				if ( !$this->upload->do_upload('gambar') ){
					// End validasi
					$data = array(	'title' 	=> 'Edit Bahan: '.$bahan->nama,
									'bahan'		=> $bahan,
									'error'		=> $this->upload->display_errors(),
									'isi'		=> 'admin/bahan/edit',
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

					$data = array(	'id'				=> $bahan->id,
									'nama'				=> $i->post('nama_bahan'),
									// Disimpan nama file gambar
									'gambar'			=> $upload_gambar['upload_data']['file_name'],
								);
					$this->Bahan_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/bahan'),'refresh');
				}
			}else{
			// Edit bahan tanpa ganti gambar
				$i = $this->input;
			
				$data = array(	'id'				=> $bahan->id,
								'nama'				=> $i->post('nama_bahan'),
							);
			$this->Bahan_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/bahan'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 	=> 'Edit Bahan: '.$bahan->nama,
						'bahan'		=> $bahan,
						'isi'		=> 'admin/bahan/edit',
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Delete Bahan
	public function delete($id_bahan)
	{
		$bahan = $this->Bahan_model->detail($id_bahan);
		// Proses hapus gambar
		$gambar = $bahan->gambar;
		$nama_file = strtolower(str_replace(base_url(), '', $gambar));
		if(file_exists('./assets/img/bahan/'.$nama_file)){
    		unlink('./assets/img/bahan/'.$nama_file);
    	}
    	if(file_exists('./assets/img/bahan/thumbs/'.$nama_file)){
    		unlink('./assets/img/bahan/thumbs/'.$nama_file);
    	}
		// End proses hapus
		$data = array('id'	=> $id_bahan);
		$this->Bahan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/bahan'),'refresh');
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/admin/Produk.php */