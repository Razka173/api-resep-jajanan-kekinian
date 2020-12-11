<?php

class Log_model extends CI_model
{

    public function getLog($id = null, $user_id = null, $action = null, $type = null, $limit = null, $order = null)
    {
        if ($limit === null) {
            $limit = 10;
        }
        if ($id != null) {
            # Info
            $log['log_id'] = $this->db->get_where('user_logs', ['id' => $id])->result_array();
            return $log;
        } else if ($user_id != null) {
            if ($order) $this->db->order_by($order, "DESC");
            $this->db->select('*');
            $this->db->from('user_logs');
            $this->db->where('user_id', $user_id);
        } else if ($action != null) {
            $this->db->select('*');
            $this->db->from('user_logs');
            $this->db->like('action', $action);
            if ($order) $this->db->order_by($order, "DESC");
            return $this->db->get()->result_array();
        } else if ($type != null) {
            $this->db->select('*');
            $this->db->from('user_logs');
            $this->db->like('type', $type);
            if ($order) $this->db->order_by($order, "DESC");
            return $this->db->get()->result_array();
        }
        $this->db->limit($limit);
        if ($order) $this->db->order_by($order, "DESC");
        return $this->db->get('user_logs')->result_array();
    }

    public function createLog($data)
    {
        $this->db->insert('user_logs', $data);
        return $this->db->affected_rows();
    }

    public function updateLog($data, $id)
    {
        $this->db->update('user_logs', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteLog($id)
    {
        $this->db->delete('user_logs', ['id' => $id]);
        return $this->db->affected_rows();
    }

    // Listing all Log
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('user_logs');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Resep
    public function detail($id_log)
    {
        $this->db->select('*');
        $this->db->from('user_logs');
        $this->db->where('id', $id_log);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }
}