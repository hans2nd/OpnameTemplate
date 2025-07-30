<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fungsi
{
	protected $ci;
	public function __construct()
	{
		$this->ci = &get_instance();
	}

	public function user_login()
	{
		$this->ci->load->model('User_model');
		$userid = $this->ci->session->userdata('userid');
		$user_data = $this->ci->User_model->get_allusers($userid)->row();
		return $user_data;
	}

	public function PdfGenerator($html, $filename, $paper, $orientation)
	{
		// reference the Dompdf namespace
		// use Dompdf\Dompdf;

		// instantiate and use the dompdf class
		$dompdf = new Dompdf\Dompdf();
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper($paper, $orientation);

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream($filename, array('Attachment' => 0));
	}
}


/* End of file Fungsi.php and path \application\libraries\Fungsi.php */
