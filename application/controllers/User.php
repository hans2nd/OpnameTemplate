<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('form_validation');
		check_not_login();
		check_admin();
	}

	public function index()
	{
		$data = [
			'title' => 'Listing Users',
			'breadcrumb' => 'List Users',
			'getUsers' => $this->User_model->get_allusers()->result_array()
		];

		$this->template->load('template', '/pages/users/index', $data);
	}

	public function addUser()
	{
		$this->form_validation->set_rules('inputUsername', 'Username', 'required|min_length[3]|is_unique[users.username]');
		$this->form_validation->set_rules('inputPassword', 'Password', 'required|min_length[3]');
		$this->form_validation->set_rules('inputLevel', 'Level', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('min_length', '{field} minimal 4 karakter');
		$this->form_validation->set_message('is_unique', '{field} sudah pernah dibuat sebelumnya.');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$data = [
				'title' => 'Add Users',
				'breadcrumb' => 'Add Users'
			];
			$this->template->load('template', '/pages/users/create', $data);
		} else {

			$ArrInsert = array(
				'username' => $this->input->post('inputUsername'),
				'password' => sha1($this->input->post('inputPassword')),
				'level' => $this->input->post('inputLevel'),
				'branch' => $this->input->post('inputBranch'),
				'updated' => date('Y/m/d H:i:s', time())
			);

			$this->User_model->add_users($ArrInsert);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Username ' . $this->input->post('inputUsername') . ' Berhasil Disimpan!');
				// $this->session->set_flashdata('flash', 'Ditambahkan');
			}
			redirect('user');
		}
	}

	// public function edit($id)
	// {
	// }

	public function editUsers($id)
	{
		$this->form_validation->set_rules('inputUsername', 'Username', 'required');
		$this->form_validation->set_rules('inputPassword', 'Password', 'required');
		$this->form_validation->set_rules('inputLevel', 'Level', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} sudah pernah dibuat sebelumnya.');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$data = [
				'title' => 'Edit Users',
				'breadcrumb' => 'Edit Users',
				'rowUser' => $this->User_model->get_byidusers($id)
			];
			$this->template->load('template', '/pages/users/update', $data);
		} else {

			$ArrUpdate = array(
				// 'id' => $id,
				'username' => $this->input->post('inputUsername'),
				'password' => sha1($this->input->post('inputPassword')),
				'level' => $this->input->post('inputLevel'),
				'updated' => date('Y/m/d H:i:s', time())
			);

			$this->User_model->edit_users($id, $ArrUpdate);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Username ' . $this->input->post('inputUsername') . ' Berhasil DiUpdate!');
				// $this->session->set_flashdata('flash', 'Ditambahkan');
			}
			redirect('user');
		}
	}

	public function deleteUsers($id)
	{
		unlink('assets/uploads/qrCode/' . $id . '.png');
		$this->User_model->delete_users($id);
		// $this->session->set_flashdata('flash', 'Di Hapus!');
		redirect('user');
	}

	public function ProcessSelected()
	{
		// jika tombol delete all di klik
		if (isset($_POST['deleteAllBtn'])) {
			// dan checkbox tidak kosong
			if (!empty($this->input->post('checkbox_value'))) {
				$checkedEmp = $this->input->post('checkbox_value');
				$checked_id = [];

				foreach ($checkedEmp as $row) {
					array_push($checked_id, $row);
					echo $row;
				}
				// $this->User_model->deleteSelected($checked_id);
				// $this->session->set_flashdata('flash', 'Has Deleted');
				// redirect('user');
			} else {
				$this->session->set_flashdata('success', 'Pilih beberapa ID');
				redirect('user');
			}
		}

		//jika tombol selected view di klik
		if (isset($_POST['viewSelectedBtn'])) {
			//dan checkbox tidak kosong
			if (!empty($this->input->post('checkbox_value'))) {
				$checkedAll = $this->input->post('checkbox_value');
				$checked_id2 = [];

				foreach ($checkedAll as $key) {
					array_push($checked_id2, $key);
					echo $key;
				}

				$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
				// echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
				//tampilkan data di page viewslected
				$data = [
					'title' => 'Print Users',
					'breadcrumb' => 'Print Users',
					'selectedUser' => $this->User_model->viewSelected($checked_id2),
					'barcodeGen' => $generator->getBarcode('081231723897', $generator::TYPE_CODE_128)
				];
				$this->template->load('template', '/pages/users/viewselected', $data);
			}
		}

		if (isset($_POST['SelectedPrint'])) {
			if (!empty($this->input->post('checkbox_value'))) {
				$checked_1 = $this->input->post('checkbox_value');
				$checked_id3 = [];

				foreach ($checked_1 as $key) {
					array_push($checked_id3, $key);
					echo $key;
				}

				$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
				// echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
				//tampilkan data di page viewslected
				$data = [
					'title' => 'Print Users',
					'breadcrumb' => 'Print Users',
					'selectedUser' => $this->User_model->viewSelected($checked_id3),
					'barcodeGen' => $generator->getBarcode('081231723897', $generator::TYPE_CODE_128)
				];
				$html = $this->load->view('/pages/users/print', $data, true);
				// $html = $this->template->load('template', '/pages/users/print', $data,true);
				$this->fungsi->PdfGenerator($html, 'barcode - Username', 'A4', 'Potrait');
			}
		}
	}

	public function printPDF()
	{
		if (!empty($this->input->post('checkbox_value'))) {
			# code...
			$checkAll = $this->input->post('checkbox_value');
			$checkid = [];
			foreach ($checkAll as $key) {
				# code...
				echo $key;
			}
		}

		// $html = $this->template->load('template', '/pages/users/viewselected');
		// $this->fungsi->PdfGenerator($html, 'barcode - Username', 'A4', 'Potrait');
	}
}

/* End of file User.php and path \application\controllers\User.php */
