<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $title ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('Opname') ?>">Opname</a></li>
						<li class="breadcrumb-item active"><?= $breadcrumb ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<?php if ($this->session->has_userdata('success')) { ?>
		<div class="flash-data" data-flashsuccess="<?= $this->session->flashdata('success'); ?>"></div>
	<?php } ?>
	<?php if ($this->session->has_userdata('error')) { ?>
		<div class="flash-data" data-flashgagal="<?= $this->session->flashdata('error'); ?>"></div>
	<?php } ?>
	<!-- Main content -->
	<section class="content">
		<form action="<?= site_url('Opname/process') ?>" method="post" id="quickForm">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">&nbsp;</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-sm btn-xs" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<label for="txtInventoryid" class="col-sm-1 col-form-label">Inventory ID</label>
						<div class="input-group col-sm-2">
							<input type="hidden" name="txtID" id="id_inventory">
							<input type="hidden" name="textBranch" id="txtBranch" value="<?= $this->fungsi->user_login()->branch ?>">
							<!-- <input class="form-control" id="txtInventoryid" name="txtInventoryid" autofocus required>
							<span class="input-group-append">
								<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item"><i class="fas fa-search"></i></button>
							</span> -->
							<select id="txtInventoryid" name="txtInventoryid" class="form-control select2bs4" autofocus required>
								<option value="">&nbsp;</option>
								<?php foreach ($getItem as $value) : ?>
									<option value="<?= $value['inventoryid'] ?>"><?= $value['inventoryid'] . ' - ' . $value['description'] ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('txtInventoryid') ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputDescription" class="col-sm-1 col-form-label">Description</label>
						<div class="col-sm-5">
							<textarea class="form-control" id="inputDescription" name="inputDescription" readonly></textarea>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputWholeQty') ? 'has-error' : null ?>">
						<label for="inputWholeQty" class="col-sm-1 col-form-label">Whole Qty</label>
						<div class="input-group col-sm-2">
							<input type="number" class="form-control" step="0.01" value="<?= set_value('inputWholeQty') ?>" id="inputWholeQty" name="inputWholeQty" placeholder="Whole Qty">
							<div class="input-group-append">
								<input type="button" class="input-group-text" id="txtWholeUOM" readonly>
							</div>
							<?= form_error('inputWholeQty') ?>
						</div>
					</div>
					<div class=" form-group row <?= form_error('inputLooseQty') ? 'has-error' : null ?>">
						<label for="inputLooseQty" class="col-sm-1 col-form-label">Loose Qty</label>
						<div class="input-group col-sm-2">
							<input type="number" class="form-control" step="0.01" value="<?= set_value('inputLooseQty') ?>" id="inputLooseQty" name="inputLooseQty" placeholder="Loose Qty">
							<div class="input-group-append">
								<input type="button" class="input-group-text" id="txtLooseUOM" readonly>
							</div>
							<?= form_error('inputLooseQty') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputExpired') ? 'has-error' : null ?>">
						<label for="inputExpired" class="col-sm-1 col-form-label">Expired Date</label>
						<div class="col-sm-2">
							<input type="date" class="form-control" id="inputExpired" name="inputExpired" value="  /  /  " min="1997-01-01" max="2030-12-31">
							<?= form_error('inputExpired') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputLotNumber') ? 'has-error' : null ?>">
						<label for="inputLotNumber" class="col-sm-1 col-form-label">Lot Number</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" value="<?= $AutoLotNumber ?>" id="inputLotNumber" name="inputLotNumber" placeholder="Lot Number">
							<?= form_error('inputLotNumber') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputLocation') ? 'has-error' : null ?>">
						<label for="inputLocation" class="col-sm-1 col-form-label">Location</label>
						<div class="col-sm-2">
							<select id="inputLocation" class="form-control select2bs4" name="inputLocation" required>
								<option value="">&nbsp;</option>
								<?php foreach ($getLocation as $key) : ?>
									<option value="<?= $key['locationid'] ?>"><?= $key['locationid'] ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('inputLocation') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputNotes') ? 'has-error' : null ?>">
						<label for="inputNotes" class="col-sm-1 col-form-label">Notes</label>
						<div class="col-sm-5">
							<textarea class="form-control" id="inputNotes" name="inputNotes"><?= set_value('inputNotes') ?></textarea>
							<?= form_error('inputNotes') ?>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" name="add_opname" class="btn btn-success">Save</button>
					<a href="<?= site_url('Opname') ?>" class="btn btn-default float-right">Cancel</a>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
		</form>
	</section>
	<!-- /.content -->

	<div class="modal fade" id="modal-item">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">List Item</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body table-responsive-sm">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>InventoryID</th>
								<th>Description</th>
								<th width="100px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($getItem as $row) :
							?>
								<tr>
									<td><?= $row['inventoryid']; ?></td>
									<td><?= $row['description']; ?></td>
									<td>
										<button class="btn btn-xs btn-info" id="select_item" data-id="<?= $row['id']; ?>" data-inventoryid="<?= $row['inventoryid']; ?>" data-description="<?= $row['description']; ?>" data-wholeuom="<?= $row['wholeuom']; ?>" data-looseuom="<?= $row['looseuom']; ?>">
											<i class="fas fa-edit"></i> Select
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>