<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
	}

	public function index()
	{
		$data = [
			'title' => 'Listing lokasi',
			'breadcrumb' => 'List lokasi',
			'getLocation' => $this->Location_model->get_allLocation()
		];
		$this->template->load('template', '/pages/lokasi/index', $data);
	}

	public function addLocation()
	{
		$this->form_validation->set_rules('inputLocationname', 'Location Name');
		$this->form_validation->set_rules('inputWarehouse', 'Warehouse', 'required|min_length[5]');
		$this->form_validation->set_rules('inputBranch', 'Branch', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$data = [
				'title' => 'Add lokasi',
				'breadcrumb' => 'Add lokasi'
			];
			$this->template->load('template', '/pages/lokasi/create', $data);
		} else {

			$ArrInsert = array(
				'locationid' => $this->input->post('inputLocationname'),
				'warehouse' => $this->input->post('inputWarehouse'),
				'branch' => $this->input->post('inputBranch'),
				'updated' => date('Y/m/d H:i:s', time())
			);

			$this->Location_model->add_Location($ArrInsert);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Location ' . $this->input->post('inputLocationname') . ' Berhasil Disimpan!');
				// $this->session->set_flashdata('flash', 'Ditambahkan');
			}
			redirect('Location');
		}
	}

	public function editLocation($id)
	{
		$this->form_validation->set_rules('inputLocationname', 'Location Name', 'required|min_length[5]');
		$this->form_validation->set_rules('inputWarehouse', 'Warehouse', 'required|min_length[5]');
		$this->form_validation->set_rules('inputBranch', 'Branch', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$data = [
				'title' => 'Edit Location',
				'breadcrumb' => 'Edit Location',
				'rowLocation' => $this->Location_model->get_byIDLocation($id)
			];
			$this->template->load('template', '/pages/lokasi/update', $data);
		} else {

			$ArrUpdate = array(
				// 'id' => $id,
				'locationid' => $this->input->post('inputLocationname'),
				'warehouse' => $this->input->post('inputWarehouse'),
				'branch' => $this->input->post('inputBranch'),
				'updated' => date('Y/m/d H:i:s', time())
			);

			$this->Location_model->edit_Location($id, $ArrUpdate);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Location ' . $this->input->post('inputLocationname') . ' Berhasil DiUpdate!');
				// $this->session->set_flashdata('flash', 'Ditambahkan');
			}
			redirect('location');
		}
	}

	public function deleteLocation($id)
	{
		$this->Location_model->delete_location($id);
		// $this->session->set_flashdata('flash', 'Di Hapus!');
		redirect('location');
	}
}

/* End of file Location.php and path \application\controllers\Location.php */
