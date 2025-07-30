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
						<li class="breadcrumb-item"><a href="#">User</a></li>
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
				<form action="<?= site_url('user/ProcessSelected') ?>" method="POST">
					<div class="card-header border-0">
						<h3 class="card-title">
							<a href="<?= site_url('user/addUser') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus-square mr-1"></i>
								Add User</a>
							<button type="submit" name="deleteAllBtn" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt mr-1"></i>Delete All</button>
							<button type="submit" name="viewSelectedBtn" class="btn btn-info btn-sm"><i class="fas fa-eye mr-1"></i>Selected</button>
							<button type="submit" name="SelectedPrint" class="btn btn-warning btn-sm" formtarget="_blank"><i class="fas fa-print mr-1"></i>Selected</button>
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
									<th width="5px">x</th>
									<th>Username</th>
									<th>Level</th>
									<th>Branch</th>
									<th>Created</th>
									<th width="100px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($getUsers as $row) :
								?>
									<tr>
										<td><?= $no++; ?></td>
										<td>
											<input type="checkbox" name="checkbox_value[]" value="<?= $row['id'] ?>">
										</td>
										<td><?= $row['username']; ?></td>
										<td><?= $row['level']; ?></td>
										<td><?= $row['branch']; ?></td>
										<td><?= $row['created']; ?></td>
										<td>
											<a class="btn btn-xs btn-warning" href="<?= site_url('user/editUsers/' . $row['id']) ?>">
												<i class="fas fa-edit"></i> Edit
											</a>
											<a class="btn btn-xs btn-danger" href="<?= site_url('user/deleteUsers/' . $row['id']) ?>" id="btn-delete" onclick="confirmation(event)">
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