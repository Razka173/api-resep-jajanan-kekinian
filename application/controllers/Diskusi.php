<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Diskusi extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Diskusi_model', 'Diskusi');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $resep_id = $this->get('resep_id');

        if ($id === null && $resep_id === null) {
            //$Diskusi = $this->Diskusi->getDiskusi();
            $this->response([
                'status' => false,
                'message' => 'Bad Request data'
            ], 400);
        } else if ($id != null && $resep_id != null) {
            $this->response([
                'status' => false,
                'message' => 'Bad Request data'
            ], 400);
        } else {
            if ($id != null) {
                $Diskusi = $this->Diskusi->getDiskusi($id);
            } else {
                $Diskusi = $this->Diskusi->getDiskusi($id = null, $resep_id);
            }
        }

        if ($Diskusi) {
            // Set the response and exit
            $this->response($Diskusi, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No Diskusi were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'isi' => $this->post('isi'),
            'resep_id' => $this->post('resep_id'),
            'user_id' => $this->post('user_id'),
            'disukai' => 0,
            'tanggal' => $this->post('tanggal'),
        ];

        if ($this->Diskusi->createDiskusi($data) > 0) {
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
            'isi' => $this->put('isi'),
            'resep_id' => $this->put('resep_id'),
            'user_id' => $this->put('user_id'),
            'disukai' => $this->put('disukai'),
            'tanggal' => $this->put('tanggal'),
        ];
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        } else {
            if ($this->Diskusi->updateDiskusi($data, $id) > 0) {
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
            if ($this->Diskusi->deleteDiskusi($id) > 0) {
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