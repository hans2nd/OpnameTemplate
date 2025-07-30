<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	public function get_allLocation()
	{
		$locations = $this->db->get('location')->result_array();
		return $locations;
	}

	public function get_byIDLocation($id)
	{
		$locations = $this->db->get_where('location', ['id' => $id])->row_array();
		return $locations;
	}

	public function add_location($data)
	{
		$result = $this->db->insert('location', $data);
		return $result;
	}

	public function edit_location($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('location', $data);
	}

	public function delete_location($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('location');
	}

	public function totalLocation()
	{
		$sql = "SELECT count(id) as id FROM location";
		$result = $this->db->query($sql);
		return $result->row()->id;
	}

	public function insertBatch($data){
		$res = $this->db->insert_batch('location', $data);
		if ($res) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deleteSelected($checked_id)
	{
		$this->db->where_in('id', $checked_id);
		return $this->db->delete('location');
	}
}


/* End of file Location_model.php and path \application\models\Location_model.php */
