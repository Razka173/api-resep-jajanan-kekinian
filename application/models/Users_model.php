<?php

class Users_model extends CI_model
{

    public function getUsers($id = null, $s = null, $email = null, $pass = null)
    {
        if ($pass != null) {
            if ($email != null) {
                $user = $this->db->get_where('users', ['email' => $email])->result_array();
                if ($user != null) {
                    if (password_verify($pass, $user[0]['password'])) {
                        return $user;
                    }
                }
            } else if ($s != null) {
                $user = $this->db->get_where('users', ['nama' => $s])->result_array();
                if ($user != null) {
                    if (password_verify($pass, $user[0]['password'])) {
                        return $user;
                    }
                }
            } else if ($id != null) {
                $user = $this->db->get_where('users', ['id' => $id])->result_array();
                if ($user != null) {
                    if (password_verify($pass, $user[0]['password'])) {
                        return $user;
                    }
                }
            }
        } else {
            $this->db->select('id, nama, email, foto');
            if ($id != null) {
                return $this->db->get_where('users', ['id' => $id])->result_array();
            } else if ($s != null) {
                $this->db->like('nama', $s);
                return $this->db->get('users')->result_array();
            }
            return $this->db->get('users')->result_array();
        }
    }

    public function createUser($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    public function updateUser($data, $id, $pass)
    {
        $user = $this->db->get_where('users', ['id' => $id])->result_array();
        if (password_verify($pass, $user[0]['password'])) {
            $this->db->update('users', $data, ['id' => $id]);
        } else {
            return NULL;
        }
        return $this->db->affected_rows();
    }

    public function deleteUser($id, $pass)
    {
        $user = $this->db->get_where('users', ['id' => $id])->result_array();
        if (password_verify($pass, $user[0]['password'])) {
            $this->db->delete('users', ['id' => $id]);
        }
        return $this->db->affected_rows();
    }
    
    // Detail
    public function detail($id_user)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id_user);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }
}