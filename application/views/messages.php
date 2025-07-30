<?php if ($this->session->has_userdata('success')) { ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-success"></i>
		<?= $this->session->flashdata('success'); ?>
	</div>

<?php } elseif ($this->session->has_userdata('warning')) { ?>

	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-warning"></i>
		<?= $this->session->flashdata('pending'); ?>
	</div>

<?php } elseif ($this->session->has_userdata('information')) { ?>

	<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-info"></i> Informasi!</h4>
		<?= $this->session->flashdata('pajak'); ?>
	</div>

<?php } elseif ($this->session->has_userdata('danger')) { ?>

	<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-danger"></i> Informasi!</h4>
		<?= $this->session->flashdata('informasi'); ?>
	</div>

<?php } ?>