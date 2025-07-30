<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
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
			'title' => 'Listing Items',
			'breadcrumb' => 'List Items',
			'getItem' => $this->Item_model->get_allItem()
		];
		$this->template->load('template', '/pages/Items/index', $data);
	}

	public function addItem()
	{
		$this->form_validation->set_rules('inputItemname', 'Item Name', 'required|min_length[4]|numeric');
		$this->form_validation->set_rules('inputDescription', 'Warehouse', 'required|min_length[6]');
		$this->form_validation->set_rules('inputWholeUOM', 'Whole UOM', 'required');
		$this->form_validation->set_rules('inputLooseUOM', 'Loose UOM', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('min_length[4]', '{field} minimal 4 karakter');
		$this->form_validation->set_message('min_length[6]', '{field} minimal 6 karakter');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$data = [
				'title' => 'Add Items',
				'breadcrumb' => 'Add Items'
			];
			$this->template->load('template', '/pages/Items/create', $data);
		} else {

			$ArrInsert = array(
				'inventoryid' => $this->input->post('inputItemname'),
				'description' => $this->input->post('inputDescription'),
				'wholeuom' => $this->input->post('inputWholeUOM'),
				'looseuom' => $this->input->post('inputLooseUOM'),
				'updated' => date('Y/m/d H:i:s', time())
			);

			$this->Item_model->add_Item($ArrInsert);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Itemname ' . $this->input->post('inputItemname') . ' Berhasil Disimpan!');
				// $this->session->set_flashdata('flash', 'Ditambahkan');
			}
			redirect('Item');
		}
	}

	public function editItem($id)
	{
		$this->form_validation->set_rules('inputItemname', 'Item Name', 'required|min_length[4]|numeric');
		$this->form_validation->set_rules('inputDescription', 'Warehouse', 'required|min_length[6]');
		$this->form_validation->set_rules('inputWholeUOM', 'Branch', 'required');
		$this->form_validation->set_rules('inputLooseUOM', 'Branch', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('min_length[4]', '{field} minimal 4 karakter');
		$this->form_validation->set_message('min_length[6]', '{field} minimal 6 karakter');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$data = [
				'title' => 'Edit Item',
				'breadcrumb' => 'Edit Item',
				'rowItem' => $this->Item_model->get_byIDItem($id)
			];
			$this->template->load('template', '/pages/Items/update', $data);
		} else {

			$ArrUpdate = array(
				// 'id' => $id,
				'inventoryid' => $this->input->post('inputItemname'),
				'description' => $this->input->post('inputDescription'),
				'wholeuom' => $this->input->post('inputWholeUOM'),
				'looseuom' => $this->input->post('inputLooseUOM'),
				'updated' => date('Y/m/d H:i:s', time())
			);

			$this->Item_model->edit_Item($id, $ArrUpdate);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Item ' . $this->input->post('inputItemname') . ' Berhasil DiUpdate!');
				// $this->session->set_flashdata('flash', 'Ditambahkan');
			}
			redirect('Item');
		}
	}

	public function deleteItem($id)
	{
		$this->Item_model->delete_Item($id);
		// $this->session->set_flashdata('flash', 'Di Hapus!');
		redirect('Item');
	}

	public function uploadExcel() {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 5096;
        $config['file_name'] = 'import_' . time();

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileExcel')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('Item');
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
                    'inventoryid' => $sheet->getCell('B' . $row)->getValue(),
                    'description' => $sheet->getCell('C' . $row)->getValue(),
                    'wholeuom' => $sheet->getCell('D' . $row)->getValue(),
                    'looseuom' => $sheet->getCell('E' . $row)->getValue(),
					'created' => date('Y-m-d H:i:s'),
                    'updated' => date('Y-m-d H:i:s')
                ];
            }

            unlink($filePath); // Hapus file setelah diproses
            $this->Item_model->insertBatch($data);
            $this->session->set_flashdata('success', 'Data berhasil diimport!');
            redirect('Item');
        }
	}

	public function downloadTemplate() {
		if (function_exists('libxml_disable_entity_loader')) {
			libxml_disable_entity_loader(false);
		}
		// Path ke file template
		$file_path = FCPATH . 'assets/uploads/templateitem.xlsx';
	
		// Cek apakah file ada
		if (!file_exists($file_path)) {
			show_404(); // Tampilkan error jika file tidak ditemukan
			return;
		}
	
		// Set header untuk download file
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="templateItem.xlsx"');
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
				$this->Item_model->deleteSelected($checked_id);
				$this->session->set_flashdata('success', 'Has Deleted');
				redirect('Item');
			}
		}
	}
}

/* End of file Item.php and path \application\controllers\Item.php */
