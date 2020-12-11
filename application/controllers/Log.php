<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Log extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Log_model', 'log');
    }

    public function index_get()
    {
        $id         = $this->get('id');
        $user_id    = $this->get('user_id');
        $action     = $this->get('action');
        $type       = $this->get('type');

        if ($id === null && $user_id === null && $action === null && $type === null) {
            $log = $this->log->getLog();

        if ($log) {
            // Set the response and exit
            $this->response($log, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No Log were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'user_id'    => $this->post('user_id'),
            'action'     => $this->post('action'),
            'type'       => $this->post('type'),
        ];

        if ($this->log->createLog($data) > 0) {
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
        if ($this->put('user_id')) $data['user_id'] = $this->put('user_id');
        if ($this->put('action')) $data['action'] = $this->put('action');
        if ($this->put('type')) $data['type'] = $this->put('type');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        } else {
            if ($this->log->updateLog($data, $id) > 0) {
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
            if ($this->log->deletelog($id) > 0) {
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