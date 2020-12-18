<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Caribahan extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Resep_model', 'resep');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $nama = $this->get('nama');
        $limit = $this->get('limit');
        $bahan1 = $this->get('bahan1');
        $bahan2 = $this->get('bahan2');
        $order = $this->get('order');

        if ($id === null && $nama === null && $bahan1 === null && $bahan2 === null && $order === null) {
            $resep = $this->resep->getResep2Bahan();
        } 
        else if ($id !== null && $nama !== null && $bahan1 !== null && $bahan2 !== null) {
            $this->response([
                'status' => false,
                'message' => 'Bad Request data'
            ], 400);
        } 
        else {
            if ($nama != null) {
                if ($limit != null) {
                    if ($order != null) {
                        $resep = $this->resep->getResep2Bahan($id = null, $nama, $limit, $bahan1 = null, $bahan2 = null, $order);
                    } 
                    else {
                        $resep = $this->resep->getResep2Bahan($id = null, $nama, $limit);
                    }
                } 
                else {
                    if ($order != null) {
                        $resep = $this->resep->getResep2Bahan($id = null, $nama, $limit = null, $bahan1 = null, $bahan2 = null, $order);
                    } 
                    else {
                        $resep = $this->resep->getResep2Bahan($id = null, $nama);
                    }
                }
            }
            else if ($bahan1 != null && $bahan2 != null) {
                if ($limit != null) {
                    if ($order != null) {
                        $resep = $this->resep->getResep2Bahan($id = null, $nama = null, $limit, $bahan1, $bahan2, $order);
                    } 
                    else {
                        $resep = $this->resep->getResep2Bahan($id = null, $nama = null, $limit, $bahan1, $bahan2);
                    }
                } 
                else {
                    $resep = $this->resep->getResep2Bahan($id = null, $nama = null, $limit = null, $bahan1, $bahan2);
                }
            } 
            else if ($limit != null) {
                if ($order != null) {
                    $resep = $this->resep->getResep2Bahan($id = null, $nama = null, $limit, $bahan1 = null, $bahan2 = null, $order);
                } 
                else {
                    $resep = $this->resep->getResep2Bahan($id = null, $nama = null, $limit);
                }
            } 
            else if ($order != null) {
                $resep = $this->resep->getResep2Bahan($id = null, $nama = null, $limit = null, $bahan1 = null, $bahan2 = null, $order);
            } 
            else {
                $resep = $this->resep->getResep2Bahan($id);
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

}