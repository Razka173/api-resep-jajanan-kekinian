<?php

class Diskusi_model extends CI_model
{

    public function getDiskusi($id = null, $resep_id = null)
    {
        if ($id != null) {
            return $this->db->get_where('diskusi', ['id' => $id])->result_array();
        } else {
            $this->db->select("`diskusi`.`id`, `diskusi`.`isi`,`diskusi`.`user_id`,`users`.`nama`,`diskusi`.`disukai`, `diskusi`.`tanggal`");
            $this->db->from('diskusi');
            $this->db->join('users', '`users`.`id`= `diskusi`.`user_id`', 'inner');
            $this->db->where('resep_id', $resep_id);
            return $this->db->get()->result_array();
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