<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->library('upload');
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
			redirect('lokasi');
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
			redirect('lokasi');
		}
	}

	public function deleteLocation($id)
	{
		$this->Location_model->delete_location($id);
		// $this->session->set_flashdata('flash', 'Di Hapus!');
		redirect('lokasi');
	}

	public function uploadExcel() {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 5096;
        $config['file_name'] = 'import_' . time();

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileExcel')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('Lokasi');
			// echo $this->upload->display_errors();
        } else {
            $fileData = $this->upload->data();
            $filePath = './assets/uploads/' . $fileData['file_name'];

            // Load PHPExcel
            require_once APPPATH . "/third_party/PHPExcel.php";
            $objPHPExcel = PHPExcel_IOFactory::load($filePath);
            $sheet = $objPHPExcel->getActiveSheet();
            $highestRow = $sheet->getHighestRow();

            $data = [];
            for ($row = 2; $row <= $highestRow; $row++) {
                $data[] = [
                    // 'id' => $sheet->getCell('A' . $row)->getValue(),
                    'locationid' => $sheet->getCell('B' . $row)->getValue(),
                    'warehouse' => $sheet->getCell('C' . $row)->getValue(),
                    'branch' => $sheet->getCell('D' . $row)->getValue(),
                    'created' => date('Y-m-d H:i:s'),
                    'updated' => date('Y-m-d H:i:s')
                ];
            }

            unlink($filePath); // Hapus file setelah diproses
            $this->Location_model->insertBatch($data);
            $this->session->set_flashdata('success', 'Data berhasil diimport!');
            redirect('Lokasi');
        }
	}

	public function downloadTemplate() {
		if (function_exists('libxml_disable_entity_loader')) {
			libxml_disable_entity_loader(false);
		}
		// Path ke file template
		$file_path = FCPATH . 'assets/uploads/template.xlsx';
	
		// Cek apakah file ada
		if (!file_exists($file_path)) {
			show_404(); // Tampilkan error jika file tidak ditemukan
			return;
		}
	
		// Set header untuk download file
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="template.xlsx"');
		header('Content-Length: ' . filesize($file_path));
	
		// Kirim file ke pengguna
		readfile($file_path);
		exit;
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
				$this->Location_model->deleteSelected($checked_id);
				$this->session->set_flashdata('success', 'Has Deleted');
				redirect('Lokasi');
			}
		}
	}
	
}

/* End of file Lokasi.php and path \application\controllers\Lokasi.php */
