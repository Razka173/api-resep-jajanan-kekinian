<?php

class Diskusi_model extends CI_model
{

    public function getDiskusi($id = null, $resep_id = null)
    {
        if ($id != null) {
            return $this->db->get_where('diskusi', ['id' => $id])->result_array();
        } else {
            $this->db->select("`diskusi`.`id`, `diskusi`.`isi`,`diskusi`.`user_id`,`users`.`nama`,`users`.`foto`,`diskusi`.`disukai`, `diskusi`.`tanggal`");
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

    // Listing all Diskusi
    public function listing()
    {
        $this->db->select(  'diskusi.*,
                            resep.nama as nama_resep,
                            users.nama as nama_user
                            ');
        $this->db->from('diskusi');
        $this->db->join('resep', 'resep_id = resep.id', 'left');
        $this->db->join('users', 'user_id = users.id', 'left');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // Tambah
    public function tambah($data)
    {
        $this->db->insert('diskusi', $data);
    }

    // Edit
    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('diskusi',$data);
    }

    // Delete
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('diskusi',$data);
    }
}