	<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	public function login($post)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $post['txtusername']);
		$this->db->where('password', sha1($post['txtpassword']));
		$query = $this->db->get();
		return $query;
	}

	public function get_allusers($id = null)
	{
		// $this->db->select('*');
		$this->db->from('users');
		if ($id != null) {
			# code...
			$this->db->where('id', $id);
		}
		$users = $this->db->get();
		return $users;
	}

	public function get_byidusers($id)
	{
		$users = $this->db->get_where('users', ['id' => $id])->row_array();
		return $users;
	}

	public function add_users($data)
	{
		$result = $this->db->insert('users', $data);
		return $result;
	}

	public function edit_users($id, $data)
	{
		// $data = [
		// 	'username' => $this->input->post('username'),
		// 	'password' => $this->input->post('password'),
		// 	'level' => $this->input->post('level'),
		// 	'updated' => $this->input->post('updated')
		// ];

		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	public function delete_users($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

	public function deleteSelected($checked_id)
	{
		$this->db->where_in('id', $checked_id);
		return $this->db->delete('users');
	}

	public function viewSelected($checked_id2)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('id', $checked_id2);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function totalUser()
	{
		$sql = "SELECT count(id) as id FROM users";
		$result = $this->db->query($sql);
		return $result->row()->id;
	}
}


/* End of file User_model.php and path \application\models\User_model.php */
