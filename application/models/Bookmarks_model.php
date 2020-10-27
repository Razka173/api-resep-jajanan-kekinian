<?php

class Bookmarks_model extends CI_model
{

    public function getBookmark($id = null, $user_id = null)
    {
        if ($id != null) {
            return $this->db->get_where('bookmark', ['id' => $id])->result_array();
        } else if ($user_id != null) {
            $data = $this->db->get_where('bookmark', ['user_id' => $user_id])->result_array();
            $reseps = array();
            foreach ($data as $key => $value) {
                $resep_id = $value["resep_id"];
                $data_resep = $this->db->get_where('resep', ['id' => $resep_id])->result_array();
                $data_resep = $data_resep[0];
                array_push($reseps, $data_resep);
            }
            return $reseps;
        }
        return $this->db->get('bookmark')->result_array();
    }

    public function createBookmark($data)
    {
        $this->db->insert('bookmark', $data);
        return $this->db->affected_rows();
    }

    public function updateBookmark($data, $id)
    {
        $this->db->update('bookmark', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteBookmark($id)
    {
        $this->db->delete('bookmark', ['id' => $id]);
        return $this->db->affected_rows();
    }
}