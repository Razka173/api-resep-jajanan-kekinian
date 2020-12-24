<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserLogs extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('UserLogs_model', 'UserLogs');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $user_id = $this->get('user_id');
        $action = $this->get('action');
        $timestamp = $this->get('timestamp');

        if ($id == null && $user_id == null && $action == null && $timestamp == null) {
            $UserLogs = $this->UserLogs->getUserLogs();
        }

        // elseif (($id !== null && $user_id !== null) || ($id !== null && $action !== null) || ($id !== null && $action !== null)) {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Bad Request data'
        //     ], 400);
        // } 

        else {
            if ($id == null) {
                $UserLogs = $this->UserLogs->getUserLogs($id = null, $user_id, $action, $timestamp);
            } else {
                $UserLogs = $this->UserLogs->getUserLogs($id);
            }
        }

        if ($UserLogs) {
            // Set the response and exit
            $this->response($UserLogs, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No UserLogs were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'user_id' => $this->post('user_id'),
            'action' => $this->post('action'),
        ];

        if ($this->UserLogs->createUserLog($data) > 0) {
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

        if ($this->UserLogs->updateUserLog($data, $id) > 0) {
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
            if ($this->UserLogs->deleteUserLog($id) > 0) {
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