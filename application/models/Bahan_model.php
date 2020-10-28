<?php

class Bahan_model extends CI_model
{

    public function getBahan($id = null, $nama = null, $order = null)
    {
        if ($id != null) {
            # Info Bahan
            return $this->db->get_where('bahan', ['id' => $id])->result_array();
        } else if ($nama != null) {
            $this->db->like('nama', $nama);
        } else if ($order != null) {
            $this->db->order_by('nama', $order);
        }
        return $this->db->get('bahan')->result_array();
    }

    public function createBahan($data)
    {
        $this->db->insert('bahan', $data);
        return $this->db->affected_rows();
    }

    public function updateBahan($data, $id)
    {
        $this->db->update('bahan', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteBahan($id)
    {
        $this->db->delete('bahan', ['id' => $id]);
        return $this->db->affected_rows();
    }

    // Listing all
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('bahan');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing all
    public function listingSort()
    {
        $this->db->select('*');
        $this->db->from('bahan');
        $this->db->order_by('nama', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail
    public function detail($id_bahan)
    {
        $this->db->select('*');
        $this->db->from('bahan');
        $this->db->where('id', $id_bahan);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah
    public function tambah($data)
    {
        $this->db->insert('bahan', $data);
    }

    // Edit
    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('bahan',$data);
    }

    // Delete
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('bahan',$data);
    }
}
?>