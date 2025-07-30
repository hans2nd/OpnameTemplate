<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opname extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Item_model');
	}

	public function index()
	{
		$data = [
			'title' => 'Listing Opname',
			'breadcrumb' => 'List Opname',
			'getOpname' => $this->Opname_model->get_allOpname()
		];
		$this->template->load('template', '/pages/Opname/index', $data);
	}

	public function addOpname()
	{
		$items = $this->Item_model->get_allItem();
		$locations = $this->Location_model->get_allLocation();
		$data = [
			'title' => 'Add Opname',
			'breadcrumb' => 'Add Opname',
			'getItem' => $items,
			'getLocation' => $locations,
			'AutoLotNumber' => $this->Opname_model->AutoLotNumber()
		];
		$this->template->load('template', '/pages/Opname/create', $data);
	}

	public function addOpname2()
	{
		$items = $this->Item_model->get_allItem();
		$locations = $this->Location_model->get_allLocation();
		$data = [
			'title' => 'Add Opname Retur',
			'breadcrumb' => 'Opname Retur',
			'getItem' => $items,
			'getLocation' => $locations,
			'AutoLotNumber' => $this->Opname_model->AutoLotNumber2()
		];
		$this->template->load('template', '/pages/Opname/create2', $data);
	}

	public function addReceipt()
	{
		$items = $this->Item_model->get_allItem();
		$locations = $this->Location_model->get_allLocation();
		$data = [
			'title' => 'Add Receipt',
			'breadcrumb' => 'Add Receipt',
			'getItem' => $items,
			'getLocation' => $locations,
			'AutoLotNumber' => $this->Opname_model->AutoLotNumber3()
		];
		$this->template->load('template', '/pages/Opname/receipt', $data);
	}

	public function process()
	{
		$this->form_validation->set_rules('txtInventoryid', 'InventoryID', 'required');
		$this->form_validation->set_rules('inputWholeQty', 'WholeQty', 'required');
		$this->form_validation->set_rules('inputLooseQty', 'LooseQty', 'required');
		$this->form_validation->set_rules('inputLotNumber', 'Lot Numbet', 'is_unique[opname.lotnumber]|required');
		$this->form_validation->set_rules('txtWholeUOM', 'LooseQty');
		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('is_unique', '{field} sudah pernah dibuat sebelumnya.');
		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$items = $this->Item_model->get_allItem();
			$locations = $this->Location_model->get_allLocation();
			$data = [
				'title' => 'Add Opname',
				'breadcrumb' => 'Add Opname',
				'getItem' => $items,
				'getLocation' => $locations,
				'AutoLotNumber' => $this->Opname_model->AutoLotNumber()
			];
			$this->template->load('template', '/pages/Opname/create', $data);
		} else {

			if (isset($_POST['add_opname'])) {
				$ArrInsert = [
					'branchid' => $this->input->post('textBranch'),
					'typeid' => 'OP01',
					'inventoryid' => $this->input->post('txtInventoryid'),
					'locationid' => $this->input->post('inputLocation'),
					'wholeqty' => $this->input->post('inputWholeQty'),
					'looseqty' => $this->input->post('inputLooseQty'),
					'expired' => $this->input->post('inputExpired'),
					'lotnumber' => $this->input->post('inputLotNumber'),
					'userupdated' => $this->session->userdata('username'),
					'notes' => $this->input->post('inputNotes'),
					'updated' => date('Y/m/d H:i:s', time())
				];
				$qrCodeInventory = new Endroid\QrCode\QrCode($this->input->post('txtInventoryid')); //get inventoryid
				$qrCodeInventory->writeFile('assets/uploads/qrCode/' . $this->input->post('txtInventoryid') . '.png'); //simpan di folder assets
				$qrCodeLotNumber = new Endroid\QrCode\QrCode($this->input->post('inputLotNumber')); //get lotnumber
				$qrCodeLotNumber->writeFile('assets/uploads/qrCode/' . $this->input->post('inputLotNumber') . '.png'); //simpan di folder assets

				$this->Opname_model->add_opname($ArrInsert);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Berhasil DiSimpan!');
				}
				redirect('Opname/addOpname');
			}
			redirect('Opname/addOpname');
		}
	}

	public function process2()
	{
		$this->form_validation->set_rules('txtInventoryid', 'InventoryID', 'required');
		$this->form_validation->set_rules('inputWholeQty', 'WholeQty', 'required');
		$this->form_validation->set_rules('inputLooseQty', 'LooseQty', 'required');
		$this->form_validation->set_rules('inputLotNumber', 'Lot Numbet', 'is_unique[opname.lotnumber]|required');
		$this->form_validation->set_rules('txtWholeUOM', 'LooseQty');
		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('is_unique', '{field} sudah pernah dibuat sebelumnya.');
		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$items = $this->Item_model->get_allItem();
			$locations = $this->Location_model->get_allLocation();
			$data = [
				'title' => 'Add Opname',
				'breadcrumb' => 'Add Opname',
				'getItem' => $items,
				'getLocation' => $locations,
				'AutoLotNumber' => $this->Opname_model->AutoLotNumber2()
			];
			$this->template->load('template', '/pages/Opname/create2', $data);
		} else {

			if (isset($_POST['add_opname'])) {
				$ArrInsert = [
					'branchid' => $this->input->post('textBranch'),
					'typeid' => 'RT01',
					'inventoryid' => $this->input->post('txtInventoryid'),
					'locationid' => $this->input->post('inputLocation'),
					'wholeqty' => $this->input->post('inputWholeQty'),
					'looseqty' => $this->input->post('inputLooseQty'),
					'expired' => $this->input->post('inputExpired'),
					'lotnumber' => $this->input->post('inputLotNumber'),
					'userupdated' => $this->session->userdata('username'),
					'notes' => $this->input->post('inputNotes'),
					'updated' => date('Y/m/d H:i:s', time())
				];
				$qrCodeInventory = new Endroid\QrCode\QrCode($this->input->post('txtInventoryid')); //get inventoryid
				$qrCodeInventory->writeFile('assets/uploads/qrCode/' . $this->input->post('txtInventoryid') . '.png'); //simpan di folder assets
				$qrCodeLotNumber = new Endroid\QrCode\QrCode($this->input->post('inputLotNumber')); //get lotnumber
				$qrCodeLotNumber->writeFile('assets/uploads/qrCode/' . $this->input->post('inputLotNumber') . '.png'); //simpan di folder assets

				$this->Opname_model->add_opname($ArrInsert);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Berhasil DiSimpan!');
				}
				redirect('Opname/addOpname2');
			}
		}
	}

	public function process3()
	{
		$this->form_validation->set_rules('txtInventoryid', 'InventoryID', 'required');
		$this->form_validation->set_rules('inputWholeQty', 'WholeQty', 'required');
		$this->form_validation->set_rules('inputLooseQty', 'LooseQty', 'required');
		$this->form_validation->set_rules('inputLotNumber', 'Lot Numbet', 'is_unique[opname.lotnumber]|required');
		$this->form_validation->set_rules('txtWholeUOM', 'LooseQty');
		$this->form_validation->set_message('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_message('is_unique', '{field} sudah pernah dibuat sebelumnya.');
		$this->form_validation->set_error_delimiters('<span class="help-block text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {

			$items = $this->Item_model->get_allItem();
			$locations = $this->Location_model->get_allLocation();
			$data = [
				'title' => 'Add Receipt',
				'breadcrumb' => 'Add Receipt',
				'getItem' => $items,
				'getLocation' => $locations,
				'AutoLotNumber' => $this->Opname_model->AutoLotNumber3()
			];
			$this->template->load('template', '/pages/Opname/receipt', $data);
		} else {

			if (isset($_POST['add_opname'])) {
				$ArrInsert = [
					'branchid' => $this->input->post('textBranch'),
					'typeid' => 'RCV01',
					'inventoryid' => $this->input->post('txtInventoryid'),
					'locationid' => $this->input->post('inputLocation'),
					'wholeqty' => $this->input->post('inputWholeQty'),
					'looseqty' => $this->input->post('inputLooseQty'),
					'expired' => $this->input->post('inputExpired'),
					'lotnumber' => $this->input->post('inputLotNumber'),
					'userupdated' => $this->session->userdata('username'),
					'notes' => $this->input->post('inputNotes'),
					'updated' => date('Y/m/d H:i:s', time())
				];
				$qrCodeInventory = new Endroid\QrCode\QrCode($this->input->post('txtInventoryid')); //get inventoryid
				$qrCodeInventory->writeFile('assets/uploads/qrCode/' . $this->input->post('txtInventoryid') . '.png'); //simpan di folder assets
				$qrCodeLotNumber = new Endroid\QrCode\QrCode($this->input->post('inputLotNumber')); //get lotnumber
				$qrCodeLotNumber->writeFile('assets/uploads/qrCode/' . $this->input->post('inputLotNumber') . '.png'); //simpan di folder assets

				$this->Opname_model->add_opname($ArrInsert);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Berhasil DiSimpan!');
				}
				redirect('Opname/addReceipt');
			}
		}
	}

	public function printPdf()
	{
		if (isset($_POST['viewSelectedBtn'])) {
			# code...
			if (!empty($this->input->post('checkbox_value'))) {
				# code...
				$checkedAll = $this->input->post('checkbox_value');
				$checked_id = [];
				foreach ($checkedAll as $row) {
					# code...
					array_push($checked_id, $row);
					// echo $row;
				}
				$data = [
					'title' => 'Print Hasil Opname',
					'getOpname' => $this->Opname_model->printSelected($checked_id),
					'getPrint' => $this->Opname_model->update_print($checked_id)
				];
				$html = $this->load->view('/pages/Opname/print', $data, true);
				$paper = [0, 0, 320, 480];
				$this->fungsi->PdfGenerator($html, '', $paper, 'landscape');
			}
		}

		if (isset($_POST['deleteAllBtn'])) {
			// dan checkbox tidak kosong
			if (!empty($this->input->post('checkbox_value'))) {
				$checkedEmp = $this->input->post('checkbox_value');
				$checked_id = [];

				foreach ($checkedEmp as $row) {
					array_push($checked_id, $row);
					echo $row;
					unlink('assets/uploads/qrCode/' . $row . '.png');
				}
				$this->Opname_model->deleteSelected($checked_id);
				$this->Opname_model->delete_lotpng($checked_id);
				$this->session->set_flashdata('success', 'Has Deleted');
				redirect('opname');
			}
		}
		redirect('Opname');
	}

	public function cekPdf()
	{
		$data = [
			'title' => 'Print Hasil Opname',
			'getOpname' => $this->Opname_model->get_allOpname()
		];
		$this->load->view('/pages/Opname/print', $data);
		// $this->fungsi->PdfGenerator($html, 'barcode - Username', 'A4', 'Potrait');
	}

	public function deleteOpname($id)
	{
		unlink('assets/uploads/qrCode/' . $id . '.png');
		$this->Opname_model->delete_opname($id);
		// $this->session->set_flashdata('flash', 'Di Hapus!');
		redirect('opname');
	}

	public function Autonumber()
	{
		echo $this->Opname_model->AutoLotNumber();
	}


	public function getItemDescription($id)
	{
		$response = $this->Opname_model->getItem($id);
		echo json_encode($response);
	}

	public function kosongkan_tabel()
	{
		// Memanggil fungsi untuk mengosongkan tabel di model
		$this->Opname_model->kosongkan_tabel();

		// Mengembalikan respons JSON sukses
		echo json_encode(['status' => 'success']);
	}

	public function uploadExcel() {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 5096;
        $config['file_name'] = 'import_' . time();

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileExcel')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('Opname');
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
				// Ambil data dari Excel
				$expiredValue = $sheet->getCell('H' . $row)->getValue();

				// Konversi jika berupa serial number Excel
				if (is_numeric($expiredValue)) {
					$date = \PHPExcel_Shared_Date::ExcelToPHPObject($expiredValue);
					$expired = $date->format('Y-m-d'); // Format sesuai kebutuhan
				} else {
					// Jika sudah dalam format teks YYYY-MM-DD, pastikan tetap valid
					$expired = date('Y-m-d', strtotime($expiredValue));
				}

                $data[] = [
                    // 'id' => $sheet->getCell('A' . $row)->getValue(),
                    'branchid' => $sheet->getCell('B' . $row)->getValue(),
                    'typeid' => $sheet->getCell('C' . $row)->getValue(),
                    'inventoryid' => $sheet->getCell('D' . $row)->getValue(),
					'locationid' => $sheet->getCell('E' . $row)->getValue(),
                    'wholeqty' => $sheet->getCell('F' . $row)->getValue(),
					'looseqty' => $sheet->getCell('G' . $row)->getValue(),
                    'expired' => $expired,
					'lotnumber' => $sheet->getCell('I' . $row)->getValue(),
                    'notes' => $sheet->getCell('J' . $row)->getValue(),
					'userupdated' => $sheet->getCell('K' . $row)->getValue(),
                    'created' => date('Y-m-d H:i:s'),
                    'updated' => date('Y-m-d H:i:s')
                ];
				//insert masal barcode
				$qrCodeInventory = new Endroid\QrCode\QrCode($sheet->getCell('D' . $row)->getValue()); //get inventoryid
				$qrCodeInventory->writeFile('assets/uploads/qrCode/' . $sheet->getCell('D' . $row)->getValue() . '.png'); //simpan di folder assets
				$qrCodeLotNumber = new Endroid\QrCode\QrCode($sheet->getCell('I' . $row)->getValue()); //get lotnumber
				$qrCodeLotNumber->writeFile('assets/uploads/qrCode/' . $sheet->getCell('I' . $row)->getValue() . '.png'); //simpan di folder assets
            }

            unlink($filePath); // Hapus file setelah diproses
            $this->Opname_model->insertBatch($data);
            $this->session->set_flashdata('success', 'Data berhasil diimport!');
            redirect('Opname');
        }
	}

	public function downloadTemplate() {
		if (function_exists('libxml_disable_entity_loader')) {
			libxml_disable_entity_loader(false);
		}
		// Path ke file template
		$file_path = FCPATH . 'assets/uploads/templateOpname.xlsx';
	
		// Cek apakah file ada
		if (!file_exists($file_path)) {
			show_404(); // Tampilkan error jika file tidak ditemukan
			return;
		}
	
		// Set header untuk download file
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="templateOpname.xlsx"');
		header('Content-Length: ' . filesize($file_path));
	
		// Kirim file ke pengguna
		readfile($file_path);
		exit;
	}
}

/* End of file Opname.php and path \application\controllers\Opname.php */
