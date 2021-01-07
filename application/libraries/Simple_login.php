<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_login
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        // Load data model user
        $this->CI->load->model('admin_model');
	}

	// Fungsi login
	public function login($username, $password)
	{
		$check = $this->CI->admin_model->login($username, $password);
		// Jika ada data user, maka create session login
		if($check) {
			$id_user		= $check->id_user;
			$nama			= $check->nama;
			$akses_level	= $check->akses_level;
			// Create session
			$this->CI->session->set_userdata('id_user',$id_user);
			$this->CI->session->set_userdata('nama',$nama);
			$this->CI->session->set_userdata('username',$username);
			$this->CI->session->set_userdata('akses_level',$akses_level);
			// Update last login
			$data = array(	'id_user'		=> $id_user,
							'last_login'	=> date('Y-m-d H:i:s'),
					);
			$this->CI->admin_model->update_last_login($data);
			// redirect ke halaman admin yang diproteksi
			redirect(base_url('admin/dasbor'),'refresh');
		}else{
			// Kalau tidak ada (username password salah), maka suruh login lagi
			$this->CI->session->set_flashdata('warning', 'Username atau password salah');
			redirect(base_url('login'),'refresh');
		}
	}

	// Fungsi cek login
	public function cek_login()
	{
		// Memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
		if($this->CI->session->userdata('username') == "") {
			$this->CI->session->set_flashdata('warning', 'Anda belum login');
			redirect(base_url('login'),'refresh');
		}
	}

	// Fungsi cek login session di halaman login
	public function sudah_login()
	{
		// Memeriksa apakah session sudah atau belum, jika sudah alihkan ke halaman dasbor
		if(!($this->CI->session->userdata('username') == '')) {
			redirect(base_url('admin/dasbor'),'refresh');
		}
	}

	// Fungsi logout
	public function logout()
	{
		// Membuang semua session yang telah diset pada saat login
		$this->CI->session->unset_userdata('id_user');
		$this->CI->session->unset_userdata('nama');
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('akses_level');
		// Setelah session dibuang, makaa redirect ke login
		$this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
		redirect(base_url('login'),'refresh');
	}

	// Fungsi logout ketika menghapus diri sendiri
	public function logout_self_destroy()
	{
		// Membuang semua session yang telah diset pada saat login
		$this->CI->session->unset_userdata('id_user');
		$this->CI->session->unset_userdata('nama');
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('akses_level');
		// Setelah session dibuang, makaa redirect ke login
		$this->CI->session->set_flashdata('sukses', 'Data anda berhasil dihapus. Anda dipaksa logout dari sistem');
		redirect(base_url('login'),'refresh');
	}

	function time_elapsed_string($datetime, $full = false)
	{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

}

/* End of file Simple_login.php */
/* Location: ./application/libraries/Simple_login.php */
