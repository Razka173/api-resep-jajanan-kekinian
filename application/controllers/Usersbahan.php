<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Usersbahan extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Resep_users_model', 'resep');
    }

    public function index_post()
    {
        $data = [
            'nama_bahan'        => $this->post('nama_bahan'),
            'takaran'           => $this->post('takaran'),
            'resep_users_id'    => $this->post('resep_users_id'),
        ];

        if ($this->resep->createBahanResep($data) > 0) {
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
            ], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        if ($this->put('nama_bahan')) $data['nama_bahan']           = $this->put('nama_bahan');
        if ($this->put('takaran')) $data['takaran']                 = $this->put('takaran');
        if ($this->put('resep_users_id')) $data['resep_users_id']   = $this->put('resep_users_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        } else {
            if ($this->resep->updateBahanResep($data, $id) > 0) {
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
                ], 404);
            }
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
            if ($this->resep->deleteBahanResep($id) > 0) {
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
                ], 404);
            }
        }
    }
}