<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Usersstep extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Resep_users_model', 'resep');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $nama = $this->get('nama');
        $limit = $this->get('limit');
        $bahan = $this->get('bahan');
        $order = $this->get('order');
        $user = $this->get('user');

        if ($id === null && $nama === null && $bahan === null && $order === null && $user === null) {
            $resep = $this->resep->getResep();
        } elseif ($id !== null && $nama !== null && $bahan !== null) {
            $this->response([
                'status' => false,
                'message' => 'Bad Request data'
            ], 400);
        } else {
            if ($nama != null) {
                if ($limit != null) {
                    if ($order != null) {
                        $resep = $this->resep->getResep($id = null, $nama, $limit, $bahan = null, $order, $user = null);
                    } else {
                        $resep = $this->resep->getResep($id = null, $nama, $limit);
                    }
                } else {
                    if ($order != null) {
                        $resep = $this->resep->getResep($id = null, $nama, $limit = null, $bahan = null, $order);
                    } else {
                        $resep = $this->resep->getResep($id = null, $nama);
                    }
                }
            } else if ($bahan != null) {
                if ($limit != null) {
                    if ($order != null) {
                        $resep = $this->resep->getResep($id = null, $nama = null, $limit, $bahan, $order);
                    } else {
                        $resep = $this->resep->getResep($id = null, $nama = null, $limit, $bahan);
                    }
                } else {
                    $resep = $this->resep->getResep($id = null, $nama = null, $limit = null, $bahan);
                }
            } else if ($user != null) {
                if ($limit != null) {
                    if ($order != null) {
                        $resep = $this->resep->getResep($id = null, $nama = null, $limit, $bahan = null, $order, $user);
                    } else {
                        $resep = $this->resep->getResep($id = null, $nama = null, $limit, $bahan = null, $order = null, $user);
                    }
                } else {
                    $resep = $this->resep->getResep($id = null, $nama = null, $limit = null, $bahan = null, $order = null, $user);
                } 
            } else if ($limit != null) {
                if ($order != null) {
                    $resep = $this->resep->getResep($id = null, $nama = null, $limit, $bahan = null, $order);
                } else {
                    $resep = $this->resep->getResep($id = null, $nama = null, $limit);
                }
            } else if ($order != null) {
                $resep = $this->resep->getResep($id = null, $nama = null, $limit = null, $bahan = null, $order);
            } else {
                $resep = $this->resep->getResep($id);
            }
        }

        if ($resep) {
            // Set the response and exit
            $this->response($resep, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No Resep were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'nomor_step'          => $this->post('nomor_step'),
            'intruksi'           => $this->post('intruksi'),
            'resep_users_id'    => $this->post('resep_users_id'),
        ];

        if ($this->resep->createStepResep($data) > 0) {
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
        if ($this->put('nomor_step')) $data['nomor_step'] = $this->put('nomor_step');
        if ($this->put('intruksi')) $data['intruksi'] = $this->put('intruksi');
        if ($this->put('resep_users_id')) $data['resep_users_id'] = $this->put('resep_users_id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        } else {
            if ($this->resep->updateStepResep($data, $id) > 0) {
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
            if ($this->resep->deleteStepResep($id) > 0) {
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