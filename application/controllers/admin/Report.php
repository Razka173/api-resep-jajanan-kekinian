<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    // Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
        // Proteksi halaman
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $log = $this->Log_model->listing();
        $data = array(
            'title'     => 'Report',
            'log'        => $log,
            'isi'        => 'admin/report/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}