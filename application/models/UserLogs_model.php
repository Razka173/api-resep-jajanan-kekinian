<?php

class UserLogs_model extends CI_model
{

    public function getUserLogs($id = null, $user_id = null, $action = null, $timestamp = null)
    {
        if ($id != null) {
            return $this->db->get_where('user_logs', ['id' => $id])->result_array();
        }
        $data = array();
        if ($user_id != null) {
            $data['user_id'] = $user_id;
        }

        if ($action != null) {
            $data['action'] = $action;
        }

        if ($timestamp != null) {
            $data['timestamp'] = $timestamp;
        }
        if ($data != null) return $this->db->get_where('user_logs', $data)->result_array();
        return $this->db->get('user_logs')->result_array();
    }

    public function createUserLog($data)
    {
        $this->db->insert('user_logs', $data);
        return $this->db->affected_rows();
    }

    public function updateUserLog($data, $id)
    {
        $this->db->update('user_logs', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteUserLog($id)
    {
        $this->db->delete('user_logs', ['id' => $id]);
        return $this->db->affected_rows();
    }

    // Detail
    public function detail($id_user)
    {
        $this->db->select('*');
        $this->db->from('user_logs');
        $this->db->where('id', $id_user);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    // Listing all user
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('user_logs');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}