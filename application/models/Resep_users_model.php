<?php

class Resep_users_model extends CI_model
{

    public function getResep($id = null, $nama = null, $limit = null, $bahan = null, $order = null, $user = null)
    {
        if ($limit === null) {
            $limit = 10;
        }
        if ($id != null) {
            # Info resep
            $resep['info'] = $this->db->get_where('resep_users', ['id' => $id])->result_array();

            # Bahan-bahan resep
            $this->db->select('`bahan`.`nama`, takaran');
            $this->db->from('bahan_resep_users');
            $this->db->join('bahan', 'bahan_id = bahan.id', 'inner');
            $this->db->where('resep_users_id', $id);
            $resep['bahan'] = $this->db->get()->result_array();

            # Step resep
            $this->db->select('nomor_step, intruksi');
            $resep['step'] = $this->db->get_where('step_resep_users', ['resep_users_id' => $id])->result_array();
            return $resep;
        } else if ($nama != null) {
            if ($order) $this->db->order_by($order, "DESC");
            $this->db->like('nama_resep', $nama);
        } else if ($bahan != null) {
            $this->db->select('`bahan`.`id`');
            $this->db->from('bahan');
            $this->db->like('nama', $bahan);
            $bahan_ids = $this->db->get()->result_array();
            $bahan_id = array();
            foreach ($bahan_ids as $id) {
                array_push($bahan_id, (int) $id['id']);
            }
            $this->db->select('`bahan_resep_users`.`resep_users_id`');
            $this->db->from('bahan_resep_users');
            $this->db->where_in('bahan_id', $bahan_id);
            $resep_ids = $this->db->get()->result_array();
            $resep_id = array();
            foreach ($resep_ids as $id) {
                array_push($resep_id, (int)$id['resep_users_id']);
            }
            $this->db->select('*');
            $this->db->from('resep_users');
            $this->db->where_in('id', $resep_id);
            $this->db->limit($limit);
            if ($order) $this->db->order_by($order, "DESC");
            return $this->db->get()->result_array();
        } else if ($user != null) {
            $this->db->select('*');
            $this->db->from('resep_users');
            $this->db->where('id_users', $user);
            $this->db->limit($limit);
            if ($order) $this->db->order_by($order, "DESC");
            return $this->db->get()->result_array();
        }
        $this->db->limit($limit);
        if ($order) $this->db->order_by($order, "DESC");
        return $this->db->get('resep_users')->result_array();
    }

    public function createResep($data)
    {
        $this->db->insert('resep_users', $data);
        return $this->db->affected_rows();
    }

    public function updateResep($data, $id)
    {
        $this->db->update('resep_users', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteResep($id)
    {
        $this->db->delete('resep_users', ['id' => $id]);
        return $this->db->affected_rows();
    }

    // Listing all Resep
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('resep_users');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Resep
    public function detail($id_resep)
    {
        $this->db->select('*');
        $this->db->from('resep_users');
        $this->db->where('id', $id_resep);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    // Listing Bahan dalam suatu Resep
    public function listingBahan($id_resep)
    {
        $this->db->select('bahan_resep_users.*,
                        bahan.nama,
                        bahan.gambar,');
        $this->db->from('bahan_resep_users');
        $this->db->where('resep_users_id', $id_resep);
        $this->db->join('bahan', 'bahan.id = bahan_resep_users.bahan_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Bahan Resep
    public function detailBahanResep($id_bahan_resep)
    {
        $this->db->select('*');
        $this->db->from('bahan_resep_users');
        $this->db->where('id', $id_bahan_resep);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah Bahan Resep
    public function createBahanResep($data)
    {
        $this->db->insert('bahan_resep_users', $data);
        return $this->db->affected_rows();
    }

    // Edit Bahan Resep
    public function updateBahanResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('bahan_resep_users',$data);
        return $this->db->affected_rows();
    }

    // Delete Bahan Resep
    public function deleteBahanResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('bahan_resep_users');
        return $this->db->affected_rows();
    }

    // Listing Step Resep 
    public function listingStep($id_resep)
    {
        $this->db->select('*');
        $this->db->from('step_resep_users');
        $this->db->where('resep_users_id', $id_resep);
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Step Resep
    public function detailStepResep($id_step_resep)
    {
        $this->db->select('*');
        $this->db->from('step_resep_users');
        $this->db->where('id', $id_step_resep);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah Step Resep
    public function createStepResep($data)
    {
        $this->db->insert('step_resep_users', $data);
    }

    // Edit Step Resep
    public function updateStepResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('step_resep_users',$data);
    }

    // Delete Step Resep
    public function deleteStepResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('step_resep_users');
    }
}