<?php $this->load->view('layout/header'); ?>

<div class="wrapper">
	<?php $this->load->view('layout/navbar'); ?>
	<?php $this->load->view('layout/sidebar'); ?>
	<?php echo $contents ?>
</div>

<?php $this->load->view('layout/footer'); ?>