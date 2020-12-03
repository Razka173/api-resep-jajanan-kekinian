<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Users extends RESTController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Users_model', 'Users');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $s = $this->get('nama');
        $email = $this->get('email');
        $pass = $this->get('pass');

        if ($id === null && $s === null && $email == null && $pass == null) {
            $Users = $this->Users->getUsers();
        } elseif (($id !== null && $s !== null) || ($email !== null && $s !== null) || ($id !== null && $email !== null)) {
            $this->response([
                'status' => false,
                'message' => 'Bad Request data'
            ], 400);
        } else {
            if ($pass === null) {
                if ($s != null) {
                    $this->response([
                        'status' => false,
                        'message' => 'Bad Request data'
                    ], 400);
                } else if ($id != null) {
                    $Users = $this->Users->getUsers($id);
                } else if ($email != null) {
                    $this->response([
                        'status' => false,
                        'message' => 'Bad Request data'
                    ], 400);
                }
            } else {
                if ($email != null) {
                    $Users = $this->Users->getUsers($id = null, $s = null, $email, $pass);
                } else if ($s != null) {
                    $Users = $this->Users->getUsers($id = null, $s, $email = null, $pass);
                } else if ($id != null) {
                    $Users = $this->Users->getUsers($id, $s = null, $email = null, $pass);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Bad Request data'
                    ], 400);
                }
            }
        }

        if ($Users) {
            // Set the response and exit
            $this->response($Users, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No Users were found'
            ], 404);
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'password' => password_hash($this->post('pass'), PASSWORD_DEFAULT),
        ];

        if ($this->Users->createUser($data) > 0) {
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
        $pass = $this->put('pass_old');
        $foto = $this->put('foto');
        if ($this->put('nama') != null) $data['nama'] = $this->put('nama');
        if ($this->put('email')!= null) $data['email'] = $this->put('email');
        if ($this->put('pass_new') != null) $data['password'] = password_hash($this->put('pass_new'), PASSWORD_DEFAULT);
        if ($foto != null) {
            $path = "assets/img/users/";
            $n = 10;
            $result = bin2hex(random_bytes($n));
            $filename = $id .'img'.$result.'.' . 'jpeg';
            if(file_put_contents($path . $filename, base64_decode($foto))) {
                $data['foto'] = $filename;
                $users = $this->users->detail($id);
                // Proses hapus foto
                $gambar = $users->foto;
                if(file_exists('./assets/img/users/'.$gambar)){
                    unlink('./assets/img/users/'.$gambar);
                }
            }
        }

        if ($this->Users->updateUser($data, $id, $pass) > 0) {
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
        $pass = $this->delete('pass');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id'
            ], 400);
        } else {
            if ($this->Users->deleteUser($id, $pass) > 0) {
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
?>