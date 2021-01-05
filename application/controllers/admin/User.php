<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    // Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        // Proteksi halaman
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $user = $this->Users_model->listing();
        $data = array(
            'title'     => 'Data Pengguna',
            'user'        => $user,
            'isi'        => 'admin/user/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}