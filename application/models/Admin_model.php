<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing all user
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->order_by('id_user', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail user
	public function detail($id_user)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('id_user', $id_user);
		$this->db->order_by('id_user', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Login user
	public function login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where(array( 'username'	=> $username,
								'password'	=> $password));
		$this->db->order_by('id_user', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function update_last_login($data)
	{
		$this->db->where('id_user', $data['id_user']);
		$this->db->update('admin', $data);
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('admin', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_user', $data['id_user']);
		$this->db->update('admin',$data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_user', $data['id_user']);
		$this->db->delete('admin',$data);
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */