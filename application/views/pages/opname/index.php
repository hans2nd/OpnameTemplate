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
						<li class="breadcrumb-item"><a href="#">Opname</a></li>
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
			<?php //$this->view('messages') 
			?>
			<div class="card">
				<form action="<?= site_url('Opname/printPdf') ?>" method="post">
					<div class="card-header border-0">
						<h3 class="card-title">
							<!-- <a href="<?php //site_url('Opname/addOpname') 
											?>" class="btn btn-success btn-sm"><i class="fas fa-plus-square mr-1"></i>
								Add Opname</a> -->
							<?php
							$level = $this->fungsi->user_login()->level;
							if ($level == 'Admin') { ?>
								<!-- <button type="submit" name="deleteAllBtn" class="btn btn-warning btn-sm"><i class="fas fa-trash-alt mr-1"></i>Delete All</button> -->
								<div class="btn-group">
									<button type="button" class="btn btn-primary btn-flat">Action</button>
									<button type="button" class="btn btn-primary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<button type="submit" name="viewSelectedBtn" class="dropdown-item btn btn-info btn-sm" formtarget="_blank" onclick="document.location.reload(true);"><i class=" fas fa-print mr-1"></i>Print Batch</button>
										<button type="button" class="dropdown-item btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
											<i class="fas fa-file-excel mr-1"></i>Upload Opname
										</button>
										<!-- <a class="dropdown-item" href="#">Something else here</a> -->
										<!-- <button type="submit" name="viewSelectedBtn" class=" dropdown-item btn btn-info btn-sm" formtarget="_blank" onclick="document.location.reload(true);"><i class=" fas fa-print mr-1"></i>Print Batch</button> -->
										<div class="dropdown-divider"></div>
										<button type="submit" name="deleteAllBtn" class="dropdown-item btn btn-warning btn-sm"><i class="fas fa-trash-alt mr-1"></i>Delete Batch</button>
									</div>
								</div>
							<?php } ?>
							<!-- <button type="submit" name="viewSelectedBtn" class="btn btn-info btn-sm" formtarget="_blank" onclick="document.location.reload(true);"><i class=" fas fa-print mr-1"></i>Print Batch</button> -->
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
									<th style="width: fit-content;">
										<input type="checkbox" onchange="checkAll(this)" name="chk[]">
									</th>
									<th>Branch</th>
									<th>Type</th>
									<th>Inventory ID</th>
									<th>Description</th>
									<th>Location</th>
									<th>Whole Qty</th>
									<th>Whole UOM</th>
									<th>Loose Qty</th>
									<th>Loose UOM</th>
									<th>Expired</th>
									<th>Lot Number</th>
									<th>Notes</th>
									<th>PIC</th>
									<th>Create On</th>
									<th>x</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($getOpname as $row) :
								?>
									<tr>
										<td><?= $no++; ?></td>
										<td><input type="checkbox" name="checkbox_value[]" value="<?= $row['lotnumber'] ?>"><?= ($row['print'] == '1') ? "<span class='badge bg-danger'>print</span>" : ""; ?></td>
										<td><?= $row['branchid']; ?></td>
										<td><?= ($row['typeid'] == 'OP02') ? 'RT01' : $row['typeid']; ?>
										</td>
										<td><?= $row['inventoryid']; ?></td>
										<td><?= $row['description']; ?></td>
										<td><?= $row['locationid']; ?></td>
										<td style="text-align: right;"><?= $row['wholeqty']; ?></td>
										<td><?= $row['wholeuom']; ?></td>
										<td style="text-align: right;"><?= $row['looseqty']; ?></td>
										<td><?= $row['looseuom']; ?></td>
										<td><?= ($row['expired'] == '0000-00-00') ? null : date('d-M-Y', strtotime($row['expired'])); ?></td>
										<td><?= $row['lotnumber']; ?></td>
										<td><?= $row['notes']; ?></td>
										<td><?= $row['userupdated'] ?></td>
										<td><?= $row['created'] ?></td>
										<td><?php
											$level = $this->fungsi->user_login()->level;
											if ($row['typeid'] == 'OP02' || $level == 'Admin') { ?>
												<a class="btn btn-sm btn-danger" href="<?= site_url('opname/deleteOpname/' . $row['lotnumber']) ?>" onclick="confirmation(event)">
													<i class="fas fa-trash-alt"></i>
												</a>
											<?php } else { ?>
												&nbsp;
											<?php } ?>
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

<!-- Modal Konfirmasi -->
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?= site_url('Opname/uploadExcel') ?>" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Upload Opname</h4>
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
						<a href="<?= site_url('Opname/downloadTemplate'); ?>" class="btn btn-success">Download Template</a>
					</div>
				</div>
			</form>
	</div>
</div>
