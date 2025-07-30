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
						<li class="breadcrumb-item"><a href="<?= site_url('user') ?>">User</a></li>
						<li class="breadcrumb-item active"><?= $breadcrumb ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<form action="" method="post" id="quickForm">
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
					<div class="form-group row <?= form_error('inputUsername') ? 'has-error' : null ?>">
						<label for="inputUsername" class="col-sm-1 col-form-label">Username</label>
						<div class="col-sm-10">
							<input type="hidden" class="form-control" value="<?= $rowUser['id'] ?>">
							<input type="Username" class="form-control" value="<?= $this->input->post('inputUsername') ? $rowUser['username'] : $rowUser['username'] ?>" id="inputUsername" name="inputUsername" placeholder="Username">
							<?= form_error('inputUsername') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputPassword') ? 'has-error' : null ?>">
						<label for="inputPassword" class="col-sm-1 col-form-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" value="<?= $this->input->post('inputPassword') ? $rowUser['password'] : $rowUser['password'] ?>" id="inputPassword" name="inputPassword" placeholder="Password">
							<?= form_error('inputPassword') ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputLevel" class="col-sm-1 col-form-label">Level</label>
						<div class="col-sm-2">
							<select class="form-control" id="inputLevel" name="inputLevel">
								<option value="Admin" <?= $rowUser['level'] == 'Admin' ? 'selected' : null ?>>Administrator</option>
								<option value="User" <?= $rowUser['level'] == 'User' ? 'selected' : null ?>>User</option>
							</select>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Save</button>
					<a href="<?= site_url('user') ?>" class="btn btn-default float-right">Cancel</a>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
		</form>
	</section>
	<!-- /.content -->
</div>
