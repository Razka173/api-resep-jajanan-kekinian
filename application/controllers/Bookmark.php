<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Bookmark extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Bookmarks_model', 'Bookmarks');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $user_id = $this->get('user_id');

        if ($id === null && $user_id === null) {
            $Bookmarks = $this->Bookmarks->getBookmark();
        } elseif ($id !== null && $user_id !== null) {
            $this->response([
                'status' => false,
                'message' => 'Bad Request data'
            ], 400);
        } else {
            if ($user_id != null) {
                $Bookmarks = $this->Bookmarks->getBookmark($id = null, $user_id);
            } else {
                $Bookmarks = $this->Bookmarks->getBookmark($id);
            }
        }

        if ($Bookmarks) {
            // Set the response and exit
            $this->response($Bookmarks, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No Bookmark were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'user_id' => $this->post('user_id'),
            'resep_id' => $this->post('resep_id'),
        ];

        if ($this->Bookmarks->createBookmark($data) > 0) {
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
            'resep_id' => $this->put('resep_id'),
        ];

        if ($this->Bookmarks->updateBookmark($data, $id) > 0) {
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
        $user_id = $this->delete('user_id');
        $resep_id = $this->delete('resep_id');

        if ($id === null) {
            if ($user_id === null || $resep_id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
            } else {
                if ($this->Bookmarks->deleteBookmark($id = null, $user_id, $resep_id) > 0) {
                // Success
                $this->response([
                    'status' => true,
                    'user_id' => $user_id,
                    'resep_id' => $resep_id,
                    'message' => 'Successfully deleted'
                ], 202);
            } else {
                // id not found
                $this->response([
                    'status' => false,
                    'message' => 'Id not found'
                ], 400);
            }
            }
        } else {
            if ($this->Bookmarks->deleteBookmark($id) > 0) {
                // Success
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Successfully deleted'
                ], 202);
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