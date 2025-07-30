<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		check_already_login();
		$this->load->view('login');
	}

	public function process()
	{
		$post = $this->input->post(null, true);
		if (isset($post['btnLogin'])) {
			# code...
			$query = $this->User_model->login($post);
?>
			<!-- SweetAlert2 -->
			<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
			<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
			<style>
				body {
					font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 1.124em;
					font-weight: normal;
				}
			</style>

			<body></body>

			<?php
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$params = [
					'userid' => $row->id,
					'username' => $row->username,
					'level' => $row->level,
					'branch' => $row->branch
				];
				$this->session->set_userdata($params);

			?>
				<script>
					Swal.fire({
						icon: 'success',
						title: 'success',
						text: 'Login Successfully!'
					}).then((result) => {
						window.location = '<?= site_url('home') ?>';
					})
				</script>
			<?php
			} else {
			?>
				<script>
					Swal.fire({
						icon: 'error',
						title: 'Failure',
						text: 'Login Failed, please check username and password!'
					}).then((result) => {
						window.location = '<?= site_url('auth') ?>';
					})
				</script>
<?php
			}
		}
	}

	public function logout()
	{
		$params = ['userid', 'username', 'level', 'branch'];
		$this->session->unset_userdata($params);
		redirect('auth');
	}
}

/* End of file Auth.php and path \application\controllers\Auth.php */
