<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clear extends CI_Controller {

	public function index()
	{
		$this->simple_login->cek_login();
		$this->simple_login->logout();
		redirect(base_url('login'),'refresh');
	}

}

/* End of file Clear.php */
/* Location: ./application/controllers/Clear.php */