<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-5">
	<!-- Brand Logo -->
	<a href="<?= site_url('home') ?>" class="brand-link">
		<img src="<?= base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">PL-Jakarta</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= site_url('home') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p class="text">Main Menu</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-copy"></i>
						<p>
							Opname Stock
							<i class="fas fa-angle-left right"></i>
							<span class="badge badge-info right">4</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('Opname/addOpname') ?>" class="nav-link">
								<i class="fas fa-paper-plane mr-1 text-success nav-icon"></i>
								<p>Input Opname</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('Opname/addOpname2') ?>" class="nav-link">
								<i class="fas fa-paper-plane mr-1 text-primary nav-icon"></i>
								<p>Input Opname Retur</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('Opname/addReceipt') ?>" class="nav-link">
								<i class="fas fa-pallet mr-1 text-warning nav-icon"></i>
								<p>Input Receiving</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('Opname') ?>" class="nav-link">
								<i class="fas fa-stream mr-1 text-info nav-icon"></i>
								<p>List Opname</p>
							</a>
						</li>
					</ul>
				</li>
				<?php if ($this->fungsi->user_login()->level == 'Admin') { ?>
					<li class="nav-header">MASTER</li>
					<li class="nav-item">
						<a href="<?= site_url('item') ?>" class="nav-link">
							<i class="nav-icon fas fa-archive text-danger"></i>
							<p class="text">Master Item</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= site_url('Lokasi') ?>" class="nav-link">
							<i class="nav-icon fas fa-map-marker-alt mr-1 text-warning"></i>
							<p>Master Location</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= site_url('user') ?>" class="nav-link">
							<i class="nav-icon fas fa-users text-info"></i>
							<p>User</p>
						</a>
					</li>
				<?php } ?>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
