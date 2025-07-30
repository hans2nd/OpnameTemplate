<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
	}

	public function index()
	{
		$data = [
			'title' => 'Main Page',
			'breadcrumb' => 'Main Page',
			'totalUsers' => $this->User_model->totalUser(),
			'totalLotnumber' => $this->Opname_model->totalLotnumber(),
			'totalItem' => $this->Item_model->totalItem(),
			'totalLocation' => $this->Location_model->totalLocation()
		];

		$this->template->load('template', '/pages/home', $data);
	}
}

/* End of file Home.php and path \application\controllers\Home.php */
