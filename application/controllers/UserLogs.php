<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Userlogs extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Log_model', 'logs');
    }

    public function index_get()
    {
        // $id = $this->get('id');
        // $user_id = $this->get('user_id');
        // $action = $this->get('action');
        // $timestamp = $this->get('timestamp');

        // if ($id == null && $user_id == null && $action == null && $timestamp == null) {
        //     $logs = $this->logs->getlogs();
        // } else {
        //     if ($id == null) {
        //         $logs = $this->logs->getlogs($id = null, $user_id, $action, $timestamp);
        //     } else {
        //         $log = $this->logs->getlogs($id);
        //     }
        // }

        $group = $this->get("group");
        $limit = $this->get('limit');

        $logs = $this->logs->count($group, $limit);

        if ($logs) {
            // Set the response and exit
            $this->response($logs, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No logs were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'user_id' => $this->post('user_id'),
            'action' => $this->post('action'),
        ];

        if ($this->logs->createUserlogs($data) > 0) {
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
            'user_id' => $this->put('user_id'),
            'action' => $this->put('action'),
        ];

        if ($this->logs->updateUserlogs($data, $id) > 0) {
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
            if ($this->logs->deleteUserlogs($id) > 0) {
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