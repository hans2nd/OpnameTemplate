<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	public function get_allItem()
	{
		$Items = $this->db->get('Item')->result_array();
		return $Items;
	}

	public function get_byIDItem($id)
	{
		$Items = $this->db->get_where('Item', ['id' => $id])->row_array();
		return $Items;
	}

	public function add_Item($data)
	{
		$result = $this->db->insert('Item', $data);
		return $result;
	}

	public function edit_Item($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('Item', $data);
	}

	public function delete_Item($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('Item');
	}

	public function totalItem()
	{
		$sql = "SELECT count(id) as id FROM Item";
		$result = $this->db->query($sql);
		return $result->row()->id;
	}

	public function insertBatch($data){
		$res = $this->db->insert_batch('Item', $data);
		if ($res) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deleteSelected($checked_id)
	{
		$this->db->where_in('id', $checked_id);
		return $this->db->delete('Item');
	}
}


/* End of file Item_model.php and path \application\models\Item_model.php */
