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
						<li class="breadcrumb-item"><a href="<?= site_url('Item') ?>">Item</a></li>
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
					<div class="form-group row <?= form_error('inputItemname') ? 'has-error' : null ?>">
						<label for="inputItemname" class="col-sm-1 col-form-label">Item ID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="<?= set_value('inputItemname') ?>" id="inputItemname" name="inputItemname" placeholder="Item ID">
							<?= form_error('inputItemname') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputDescription') ? 'has-error' : null ?>">
						<label for="inputDescription" class="col-sm-1 col-form-label">Description</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="<?= set_value('inputDescription') ?>" id="inputDescription" name="inputDescription" placeholder="Description">
							<?= form_error('inputDescription') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputWholeUOM') ? 'has-error' : null ?>">
						<label for="inputWholeUOM" class="col-sm-1 col-form-label">Whole UOM</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="<?= set_value('inputWholeUOM') ?>" id="inputWholeUOM" name="inputWholeUOM" placeholder="Whole UOM">
							<?= form_error('inputWholeUOM') ?>
						</div>
					</div>
					<div class="form-group row <?= form_error('inputLooseUOM') ? 'has-error' : null ?>">
						<label for="inputLooseUOM" class="col-sm-1 col-form-label">Loose UOM</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="<?= set_value('inputLooseUOM') ?>" id="inputLooseUOM" name="inputLooseUOM" placeholder="Loose UOM">
							<?= form_error('inputLooseUOM') ?>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Save</button>
					<a href="<?= site_url('Item') ?>" class="btn btn-default float-right">Cancel</a>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
		</form>
	</section>
	<!-- /.content -->
</div>