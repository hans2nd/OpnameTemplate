<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('lokasi') ?>">Location</a></li>
						<li class="breadcrumb-item active"><?= $breadcrumb ?></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content-header -->
	<?php if ($this->session->has_userdata('success')) { ?>
		<div class="flash-data" data-flashsuccess="<?= $this->session->flashdata('success'); ?>"></div>
	<?php } ?>
	<?php if ($this->session->has_userdata('error')) { ?>
		<div class="flash-data" data-flashgagal="<?= $this->session->flashdata('error'); ?>"></div>
	<?php } ?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<form action="<?= site_url('Lokasi/ProcessSelected') ?>" method="POST">
					<div class="card-header border-0">
						<h3 class="card-title">
							<a href="<?= site_url('lokasi/addLocation') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus-square mr-1"></i>
								Add Location</a>
							<button type="submit" name="deleteAllBtn" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt mr-1"></i>Delete Batch</button>
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
								Upload Location
							</button>
						</h3>
						<!-- card tools -->
						<div class="card-tools">
							<button type="button" class="btn btn-sm btn-xs" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
						<!-- /.card-tools -->
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th width="10px">No.</th>
									<th style="width: 2px;">
										<input type="checkbox" onchange="checkAll(this)" name="chk[]">
									</th>
									<th>Location</th>
									<th>Warehouse</th>
									<th>Branch</th>
									<th width="100px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($getLocation as $row) :
								?>
									<tr>
										<td><?= $no++; ?></td>
										<td>
											<input type="checkbox" name="checkbox_value[]" value="<?= $row['id'] ?>">
										</td>
										<td><?= $row['locationid']; ?></td>
										<td><?= $row['warehouse']; ?></td>
										<td><?= $row['branch']; ?></td>
										<td>
											<a class="btn btn-xs btn-warning" href="<?= site_url('lokasi/editLocation/' . $row['id']) ?>">
												<i class="fas fa-edit"></i> Edit
											</a>
											<a class="btn btn-xs btn-danger" href="<?= site_url('lokasi/deleteLocation/' . $row['id']) ?>" onclick="confirmation(event)">
												<i class="fas fa-trash-alt"></i> Delete
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>


<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?= site_url('lokasi/uploadExcel') ?>" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Upload Location</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body justify-content-between">
						<div class="mb-3">
							<label class="form-label">Pilih File Excel</label>
							<input type="file" name="fileExcel" class="form-control" required>
						</div>
						
					</div>
					<div class="modal-footer justify-content-between">
						<button type="submit" name="submit" class="btn btn-primary">Import</button>
						<a href="<?= site_url('lokasi/downloadTemplate'); ?>" class="btn btn-success">Download Template</a>
					</div>
				</div>
			</form>
	</div>
</div>

<script>
	function checkAll(ele) {
		var checkboxes = document.getElementsByTagName('input');
		if (ele.checked) {
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].type == 'checkbox') {
					checkboxes[i].checked = true;
				}
			}
		} else {
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].type == 'checkbox') {
					checkboxes[i].checked = false;
				}
			}
		}
	}
</script>
