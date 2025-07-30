  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<div class="row">
  			<div class="col-12 col-sm-6 col-md-3">
  				<div class="info-box">
  					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-pallet"></i></span>

  					<div class="info-box-content">
  						<span class="info-box-text">Total Lot Number</span>
  						<span class="info-box-number"><?= number_format($totalLotnumber, 0, ',', '.') ?> Lot</span>
  					</div>
  					<!-- /.info-box-content -->
  				</div>
  				<!-- /.info-box -->
  			</div>
  			<!-- /.col -->
  			<div class="col-12 col-sm-6 col-md-3">
  				<div class="info-box mb-3">
  					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-archive"></i></span>

  					<div class="info-box-content">
  						<span class="info-box-text">Total Inventory</span>
  						<span class="info-box-number"><?= number_format($totalItem, 0, ',', '.') ?> Item</span>
  					</div>
  					<!-- /.info-box-content -->
  				</div>
  				<!-- /.info-box -->
  			</div>
  			<!-- /.col -->

  			<!-- fix for small devices only -->
  			<div class="clearfix hidden-md-up"></div>

  			<div class="col-12 col-sm-6 col-md-3">
  				<div class="info-box mb-3">
  					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-location-arrow"></i></span>

  					<div class="info-box-content">
  						<span class="info-box-text">Total Location</span>
  						<span class="info-box-number"><?= number_format($totalLocation, 0, ',', '.') ?> Location</span>
  					</div>
  					<!-- /.info-box-content -->
  				</div>
  				<!-- /.info-box -->
  			</div>
  			<!-- /.col -->
  			<div class="col-12 col-sm-6 col-md-3">
  				<div class="info-box mb-3">
  					<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

  					<div class="info-box-content">
  						<span class="info-box-text">Total Users</span>
  						<span class="info-box-number"><?= number_format($totalUsers, 0, ',', '.') ?> user</span>
  					</div>
  					<!-- /.info-box-content -->
  				</div>
  				<!-- /.info-box -->
  			</div>
  			<!-- /.col -->
  		</div>
  	</section>

  	<!-- Main content -->
  	<!-- <section class="content">
  		<div class="card">
  			<div class="card-header">
  				<h3 class="card-title">Title</h3>

  				<div class="card-tools">
  					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
  						<i class="fas fa-minus"></i>
  					</button>
  					<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
  						<i class="fas fa-times"></i>
  					</button>
  				</div>
  			</div>
  			<div class="card-body">
  				Start creating your amazing application!
  			</div>
  			<div class="card-footer">
  				Footer
  			</div>
  		</div>
  	</section> -->
  	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->