<?php

class Diskusi_model extends CI_model
{

    public function getDiskusi($id = null, $resep_id = null)
    {
        if ($id != null) {
            return $this->db->get_where('diskusi', ['id' => $id])->result_array();
        } else {
            return $this->db->get_where('diskusi', ['resep_id' => $resep_id])->result_array();
        }
        return $this->db->get('diskusi')->result_array();
    }

    public function createDiskusi($data)
    {
        $this->db->insert('diskusi', $data);
        return $this->db->affected_rows();
    }

    public function updateDiskusi($data, $id)
    {
        $this->db->update('diskusi', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteDiskusi($id)
    {
        $this->db->delete('diskusi', ['id' => $id]);
        return $this->db->affected_rows();
    }
}