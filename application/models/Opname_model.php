<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opname_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	public function get_allOpname()
	{
		// $opnames = $this->db->get('opname')->result_array();
		// return $opnames;
		$this->db->select('opname.id,opname.branchid,opname.inventoryid,opname.typeid,item.description,opname.locationid,opname.wholeqty,opname.looseqty,opname.created,item.wholeuom,item.looseuom,opname.lotnumber,opname.expired,opname.notes,opname.userupdated,location.warehouse,opname.print');
		$this->db->from('opname');
		$this->db->join('item', 'opname.inventoryid = item.inventoryid', 'LEFT OUTER');
		$this->db->join('location', 'opname.locationid = location.locationid AND opname.branchid = location.branch', 'LEFT OUTER');
		$this->db->order_by('opname.created,opname.inventoryid', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_byIdOpname($id)
	{
		$opnames = $this->db->get_where('opname', ['id' => $id])->row_array();
		return $opnames;
	}

	public function add_opname($data)
	{
		$result = $this->db->insert('opname', $data);
		return $result;
	}

	public function edit_opname($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('opname', $data);
	}

	public function delete_opname($id)
	{
		$this->db->where('lotnumber', $id);
		$this->db->delete('opname');
	}

	public function printSelected($checked_id)
	{
		$this->db->select('opname.id,opname.branchid,opname.typeid,opname.inventoryid,item.description,opname.locationid,opname.wholeqty,opname.looseqty,item.wholeuom,item.looseuom,opname.lotnumber,opname.expired,opname.notes,opname.userupdated,opname.created,location.warehouse');
		$this->db->from('opname');
		$this->db->join('item', 'opname.inventoryid = item.inventoryid', 'LEFT OUTER');
		$this->db->join('location', 'opname.locationid = location.locationid AND location.branch = opname.branchid', 'LEFT OUTER');
		$this->db->where_in('opname.lotnumber', $checked_id);
		$this->db->order_by('opname.inventoryid', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function update_print($checked_id)
	{
		$this->db->set('print', '+1');
		$this->db->where_in('lotnumber', $checked_id);
		$this->db->update('opname');
	}

	public function AutoLotNumber()
	{
		$this->db->select('MAX(RIGHT(opname.lotnumber,4)) as kode_lot', false);
		$this->db->order_by('lotnumber', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('opname');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			// $cab  = $data->branchid;
			$kode = intval($data->kode_lot) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		// if ($cab == "SIDOARJO") {
		// 	$kodetampil = "01" . date('y') . '-' . $batas;
		// } elseif ($cab == "JAKARTA") {
		// 	$kodetampil = "02" . date('y') . '-' . $batas;
		// } elseif ($cab == "BANDUNG") {
		// 	$kodetampil = "03" . date('y') . '-' . $batas;
		// } elseif ($cab == "SEMARANG") {
		// 	$kodetampil = "04" . date('y') . '-' . $batas;
		// } elseif ($cab == "YOGYAKARTA") {
		// 	$kodetampil = "05" . date('y') . '-' . $batas;
		// } elseif ($cab == "MALANG") {
		// 	$kodetampil = "06" . date('y') . '-' . $batas;
		// } elseif ($cab == "DENPASAR") {
		// 	$kodetampil = "07" . date('y') . '-' . $batas;
		// } elseif ($cab == "JEMBER") {
		// 	$kodetampil = "08" . date('y') . '-' . $batas;
		// } else {
		$kodetampil = 'OP01-' . substr(strtoupper($this->fungsi->user_login()->username), 0, 3) . '-' . $batas;
		// }

		return $kodetampil;
	}

	public function AutoLotNumber2()
	{
		$this->db->select('MAX(RIGHT(opname.lotnumber,4)) as kode_lot', false);
		$this->db->where('LEFT(opname.lotnumber,4)', 'RT01');
		$this->db->order_by('lotnumber', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('opname');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			// $cab  = $data->branchid;
			$kode = intval($data->kode_lot) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodetampil = 'RT01-' . substr(strtoupper($this->fungsi->user_login()->username), 0, 3) . '-' . $batas;
		return $kodetampil;
	}

	public function AutoLotNumber3()
	{
		$this->db->select('MAX(RIGHT(opname.lotnumber,4)) as kode_lot', false);
		$this->db->where('LEFT(opname.lotnumber,5)', 'RCV01');
		$this->db->order_by('lotnumber', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('opname');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			// $cab  = $data->branchid;
			$kode = intval($data->kode_lot) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodetampil = 'RCV01-' . substr(strtoupper($this->fungsi->user_login()->username), 0, 3) . '-' . $batas;
		return $kodetampil;
	}

	public function totalLotnumber()
	{
		$sql = "SELECT count(lotnumber) as lotnumber FROM opname";
		$result = $this->db->query($sql);
		return $result->row()->lotnumber;
	}

	public function getItem($id)
	{
		return $this->db->get_where('item', array('inventoryid' => $id))->row();
	}

	public function deleteSelected($checked_id)
	{
		$this->db->where_in('id', $checked_id);
		return $this->db->delete('opname');
	}

	public function delete_lotpng($checked_id)
	{
		$this->db->where_in('lotnumber', $checked_id);
		$this->db->delete('opname');
	}

	public function kosongkan_tabel()
	{
		// Empty Table
		$this->db->truncate('opname');
	}

	public function insertBatch($data){
		$res = $this->db->insert_batch('opname', $data);
		if ($res) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}


/* End of file Opname_model.php and path \application\models\Opname_model.php */
