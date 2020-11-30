<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_Policy extends CI_Controller {

	public function index()
	{
		$data = array(	'title' 	=> 'Privacy Policy',
						'isi'		=> 'about/privacy_policy/list'
					);
		$this->load->view('about/layout/wrapper', $data, FALSE);
	}

}

/* End of file Privacy_Policy.php */
/* Location: ./application/controllers/Privacy_Policy.php */