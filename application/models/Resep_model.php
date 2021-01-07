<?php

class Resep_model extends CI_model
{

    public function getResep($id = null, $nama = null, $limit = null, $bahan = null, $order = null, $user = null)
    {
        if ($id === null && $nama === null && $bahan === null && $order === null && $user === null) {
        } else {
            $limit = 10;
        }
        if ($id != null) {
            # Info resep
            $resep['info'] = $this->db->get_where('resep', ['id' => $id])->result_array();

            # Bahan-bahan resep
            $this->db->select('`bahan`.`nama`, takaran');
            $this->db->from('bahan_resep');
            $this->db->join('bahan', 'bahan_id = bahan.id', 'inner');
            $this->db->where('resep_id', $id);
            $resep['bahan'] = $this->db->get()->result_array();

            # Step resep
            $this->db->select('nomor_step, intruksi');
            $resep['step'] = $this->db->get_where('step_resep', ['resep_id' => $id])->result_array();

            # Diskusi
            $this->db->select("`diskusi`.`id`, `diskusi`.`isi`,`diskusi`.`user_id`,`users`.`nama`,`diskusi`.`disukai`, `diskusi`.`tanggal`");
            $this->db->from('diskusi');
            $this->db->join('users', '`users`.`id`= `diskusi`.`user_id`', 'inner');
            $this->db->where('resep_id', $id);
            $resep['diskusi'] = $this->db->get()->result_array();

            # Bookmark
            $this->db->select("`bookmark`.`user_id`, `users`.`nama`");
            $this->db->from('bookmark');
            $this->db->join('users', '`users`.`id`= `bookmark`.`user_id`', 'inner');
            $this->db->where('resep_id', $id);
            $resep['bookmark'] = $this->db->get()->result_array();
            return $resep;
        } else if ($nama != null) {
            if ($order) $this->db->order_by($order, "DESC");
            $this->db->like('nama', $nama);
        } else if ($bahan != null) {
            $this->db->select('`bahan`.`id`');
            $this->db->from('bahan');
            $this->db->like('nama', $bahan);
            $bahan_ids = $this->db->get()->result_array();
            $bahan_id = array();
            foreach ($bahan_ids as $id) {
                array_push($bahan_id, (int) $id['id']);
            }
            $this->db->select('`bahan_resep`.`resep_id`');
            $this->db->from('bahan_resep');
            $this->db->where_in('bahan_id', $bahan_id);
            $resep_ids = $this->db->get()->result_array();
            $resep_id = array();
            foreach ($resep_ids as $id) {
                array_push($resep_id, (int)$id['resep_id']);
            }
            $this->db->select('*');
            $this->db->from('resep');
            $this->db->where_in('id', $resep_id);
            $this->db->limit($limit);
            if ($order) $this->db->order_by($order, "DESC");
            return $this->db->get()->result_array();
        } else if ($user != null) {
            # Info resep
            if (strtolower($user) === "null") $resep = $this->db->get_where('resep', ['id_users' => NULL])->result_array();
            else $resep = $this->db->get_where('resep', ['id_users' => $user])->result_array();
            if (count($resep) > 0) {
                foreach ($resep as $resep_info_key => $resep_info_val) {
                    $resep_id = $resep_info_val['id'];
                    # Bahan-bahan resep
                    $this->db->select('`bahan`.`nama`, takaran');
                    $this->db->from('bahan_resep');
                    $this->db->join('bahan', 'bahan_id = bahan.id', 'inner');
                    $this->db->where('resep_id', $resep_id);
                    $resep[$resep_info_key]['bahan'] = $this->db->get()->result_array();

                    # Step resep
                    $this->db->select('nomor_step, intruksi');
                    $resep[$resep_info_key]['step'] = $this->db->get_where('step_resep', ['resep_id' => $id])->result_array();

                    # Diskusi
                    $this->db->select("`diskusi`.`id`, `diskusi`.`isi`,`diskusi`.`user_id`,`users`.`nama`,`diskusi`.`disukai`, `diskusi`.`tanggal`");
                    $this->db->from('diskusi');
                    $this->db->join('users', '`users`.`id`= `diskusi`.`user_id`', 'inner');
                    $this->db->where('resep_id', $resep_id);
                    $resep[$resep_info_key]['diskusi'] = $this->db->get()->result_array();

                    # Bookmark
                    $this->db->select("`bookmark`.`user_id`, `users`.`nama`");
                    $this->db->from('bookmark');
                    $this->db->join('users', '`users`.`id`= `bookmark`.`user_id`', 'inner');
                    $this->db->where('resep_id', $resep_id);
                    $resep[$resep_info_key]['bookmark'] = $this->db->get()->result_array();
                }
                return $resep;
            }
            return null;
        }
        $this->db->limit($limit);
        if ($order) $this->db->order_by($order, "DESC");
        return $this->db->get('resep')->result_array();
    }

    public function getResep2Bahan($id = null, $nama = null, $limit = null, $bahan1 = null, $bahan2 = null, $order = null)
    {
        if ($limit === null) {
            $limit = 10;
        }
        if ($id != null) {
            # Info resep
            $resep['info'] = $this->db->get_where('resep', ['id' => $id])->result_array();
            return $resep;
        } else if ($nama != null) {
            if ($order) $this->db->order_by($order, "DESC");
            $this->db->like('nama', $nama);
        } else if ($bahan1 != null && $bahan2 != null) {
            // Find input to 'bahan' table
            $bahan = array($bahan1, $bahan2);
            $this->db->select('bahan.id');
            $this->db->from('bahan');
            $this->db->where_in('nama', $bahan);

            // Place ID target to an 'bahan' array
            $bahan_ids = $this->db->get()->result_array();
            $bahan_id = array();
            foreach ($bahan_ids as $id) {
                array_push($bahan_id, (int) $id['id']);
            }
            if (count($bahan_id) == 2) {
                // Find the 'bahan' in 'bahan_resep' table
                $this->db->select('bahan_resep.resep_id');
                $this->db->from('bahan_resep');
                $this->db->where('bahan_id', $bahan_id[0]);

                // Place result into an array
                $resep_ids = $this->db->get()->result_array();
                $result = array();
                foreach ($resep_ids as $resep_id) {
                    $this->db->select('*');
                    $this->db->from('bahan_resep');
                    $this->db->where('resep_id', $resep_id['resep_id']);
                    $this->db->where('bahan_id', $bahan_id[1]);
                    $query = $this->db->get()->row();
                    if ($query == null) {
                        continue;
                    }
                    array_push($result, $query->resep_id);
                }
                if (count($result) > 0) {
                    $this->db->select('*');
                    $this->db->from('resep');
                    $this->db->where_in('id', $result);
                    $this->db->limit($limit);
                    if ($order) $this->db->order_by($order, "DESC");
                    return $this->db->get()->result_array();
                }
            }
        }
    }

    public function createResep($data)
    {
        $this->db->insert('resep', $data);
        return $this->db->affected_rows();
    }

    public function updateResep($data, $id)
    {
        $this->db->update('resep', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteResep($id)
    {
        $this->db->delete('resep', ['id' => $id]);
        return $this->db->affected_rows();
    }

    // Listing all Resep
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('resep');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Resep
    public function detail($id_resep)
    {
        $this->db->select('*');
        $this->db->from('resep');
        $this->db->where('id', $id_resep);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah Resep
    public function tambah($data)
    {
        $this->db->insert('resep', $data);
    }

    // Edit Resep
    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('resep', $data);
    }

    // Delete Resep
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('resep', $data);
    }

    // Listing Bahan dalam suatu Resep
    public function listingBahan($id_resep)
    {
        $this->db->select('bahan_resep.*,
                        bahan.nama,
                        bahan.gambar,');
        $this->db->from('bahan_resep');
        $this->db->where('resep_id', $id_resep);
        $this->db->join('bahan', 'bahan.id = bahan_resep.bahan_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Bahan Resep
    public function detailBahanResep($id_bahan_resep)
    {
        $this->db->select('*');
        $this->db->from('bahan_resep');
        $this->db->where('id', $id_bahan_resep);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah Bahan Resep
    public function tambahBahanResep($data)
    {
        $this->db->insert('bahan_resep', $data);
    }

    // Edit Bahan Resep
    public function editBahanResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('bahan_resep', $data);
    }

    // Delete Bahan Resep
    public function deleteBahanResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('bahan_resep');
    }

    // Listing Step Resep 
    public function listingStep($id_resep)
    {
        $this->db->select('*');
        $this->db->from('step_resep');
        $this->db->where('resep_id', $id_resep);
        $query = $this->db->get();
        return $query->result();
    }

    // Detail Step Resep
    public function detailStepResep($id_step_resep)
    {
        $this->db->select('*');
        $this->db->from('step_resep');
        $this->db->where('id', $id_step_resep);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah Step Resep
    public function tambahStepResep($data)
    {
        $this->db->insert('step_resep', $data);
    }

    // Edit Step Resep
    public function editStepResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('step_resep', $data);
    }

    // Delete Step Resep
    public function deleteStepResep($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('step_resep');
    }
}