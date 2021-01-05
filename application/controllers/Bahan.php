<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Bahan extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Bahan_model', 'Bahan');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $nama = $this->get('nama');
        $order = strtolower($this->get('order'));

        if ($id === null && $nama === null && $order === null) {
            $Bahan = $this->Bahan->getBahan();
        } else if ($id === null && $nama === null && ($order === 'asc' || $order === 'desc')) {
            $Bahan = $this->Bahan->getBahan($id = null, $nama = null, $order);
        } elseif (($id !== null && $nama !== null)) {
            $this->response([
                'status' => false,
                'message' => 'Bad Request data'
            ], 400);
        } else {
            if ($nama != null && $order === null) {
                $Bahan = $this->Bahan->getBahan($id = null, $nama);
            } else if ($nama != null && ($order === 'asc' || $order === 'desc')) {
                $Bahan = $this->Bahan->getBahan($id = null, $nama, $order);
            } else {
                $Bahan = $this->Bahan->getBahan($id);
            }
        }

        if ($Bahan) {
            // Set the response and exit
            $this->response($Bahan, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No Bahan were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'gambar' => $this->post('gambar'),
        ];

        if ($this->Bahan->createBahan($data) > 0) {
            // Success
            $this->response([
                'status' => true,
                'message' => 'Successfully Created'
            ], 201);
        } else {
            // id not found
            $this->response([
                'status' => false,
                'message' => 'Fail created new data'
            ], 400);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'gambar' => $this->put('gambar'),
        ];

        if ($this->Bahan->updateBahan($data, $id) > 0) {
            // Success
            $this->response([
                'status' => true,
                'message' => 'Successfully Updated'
            ], 202);
        } else {
            // id not found
            $this->response([
                'status' => false,
                'message' => 'Fail updated data'
            ], 400);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        } else {
            if ($this->Bahan->deleteBahan($id) > 0) {
                // Success
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Successfully deleted'
                ], 204);
            } else {
                // id not found
                $this->response([
                    'status' => false,
                    'message' => 'Id not found'
                ], 400);
            }
        }
    }
}