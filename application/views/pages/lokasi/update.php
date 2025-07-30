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
						<li class="breadcrumb-item"><a href="<?= site_url('Location') ?>">Location</a></li>
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
					<div class="form-group row <?= form_error('inputLocationname') ? 'has-error' : null ?>">
						<label for="inputLocationname" class="col-sm-1 col-form-label">Locationname</label>
						<div class="col-sm-10">
							<input type="hidden" class="form-control" value="<?= $rowLocation['id'] ?>">
							<input type="text" class="form-control" value="<?= $this->input->post('inputLocationname') ? $rowLocation['locationid'] : $rowLocation['locationid'] ?>" id="inputLocationname" name="inputLocationname" placeholder="Location ID">
							<?= form_error('inputLocationname') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputWarehouse') ? 'has-error' : null ?>">
						<label for="text" class="col-sm-1 col-form-label">Warehouse</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="<?= $this->input->post('inputWarehouse') ? $rowLocation['warehouse'] : $rowLocation['warehouse'] ?>" id="inputWarehouse" name="inputWarehouse" placeholder="Warehouse">
							<?= form_error('inputWarehouse') ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputBranch" class="col-sm-1 col-form-label">Branch</label>
						<div class="col-sm-2">
							<select class="form-control" id="inputBranch" name="inputBranch">
								<option value="SIDOARJO" <?= $rowLocation['branch'] == 'SIDOARJO' ? 'selected' : null ?>>SIDOARJO</option>
								<option value="SEMARANG" <?= $rowLocation['branch'] == 'SEMARANG' ? 'selected' : null ?>>SEMARANG</option>
								<option value="DENPASAR" <?= $rowLocation['branch'] == 'DENPASAR' ? 'selected' : null ?>>DENPASAR</option>
								<option value="BANDUNG" <?= $rowLocation['branch'] == 'BANDUNG' ? 'selected' : null ?>>BANDUNG</option>
								<option value="JAKARTA" <?= $rowLocation['branch'] == 'JAKARTA' ? 'selected' : null ?>>JAKARTA</option>
								<option value="YOGYAKARTA" <?= $rowLocation['branch'] == 'YOGYAKARTA' ? 'selected' : null ?>>YOGYAKARTA</option>
							</select>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Save</button>
					<a href="<?= site_url('Location') ?>" class="btn btn-default float-right">Cancel</a>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
		</form>
	</section>
	<!-- /.content -->
</div>