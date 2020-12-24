<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Usersresep extends RESTController
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
            'id_users'          => $this->post('id_users'),
            'nama_resep'        => $this->post('nama'),
            'waktu_memasak'     => $this->post('waktu_memasak'),
            'porsi'             => $this->post('porsi'),
            'harga'             => $this->post('harga'),
            'favorit'           => $this->post('favorit'),
            'dilihat'           => $this->post('dilihat'),
        ];
        
        $gambar = $this->post('gambar');
        $id =$this->post('id_users');
        if ($gambar != null) {
            $path = "assets/img/users/resep/";
            $n = 10;
            $result = bin2hex(random_bytes($n));
            $filename = $id .'img_resep_'.$result.'.' . 'jpeg';
            if(file_put_contents($path . $filename, base64_decode($gambar))) {
                $data['gambar'] = $filename;
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Provide an image'
            ], 400);
        }

        if ($this->resep->createResep($data) > 0) {
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
        if ($this->put('nama')) $data['nama_resep'] = $this->put('nama');
        if ($this->put('waktu_memasak')) $data['waktu_memasak'] = $this->put('waktu_memasak');
        if ($this->put('porsi')) $data['porsi'] = $this->put('porsi');
        if ($this->put('harga')) $data['harga'] = $this->put('harga');
        if ($this->put('favorit')) $data['favorit'] = $this->put('favorit');
        if ($this->put('dilihat')) $data['dilihat'] = $this->put('dilihat');
        if ($this->put('gambar')) $data['gambar'] = $this->put('gambar');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        } else {
            if ($this->resep->updateResep($data, $id) > 0) {
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
            if ($this->resep->deleteResep($id) > 0) {
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