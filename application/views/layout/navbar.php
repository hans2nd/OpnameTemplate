  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  	<!-- Left navbar links -->
  	<ul class="navbar-nav">
  		<li class="nav-item">
  			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
  		</li>
  		<li class="nav-item d-none d-sm-inline-block">
  			<!-- <a href="../../index3.html" class="nav-link">Home</a> -->
			  <?php
			  $level = $this->fungsi->user_login()->level;
			  $user = $this->fungsi->user_login()->username;
				if ($user == 'admin') { ?>
					<button id="kosongkan-tabel-btn" class="nav-link btn btn-default btn-xs">Drop Table Opname</button>
				<?php } ?>
				<script>
					document.getElementById('kosongkan-tabel-btn').addEventListener('click', function() {
						Swal.fire({
							title: 'Apakah Anda yakin?',
							text: "Tindakan ini tidak bisa dibatalkan!",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Ya, kosongkan!'
						}).then((result) => {
							if (result.isConfirmed) {
								// Kirim form POST untuk mengosongkan tabel
								fetch('<?= site_url('opname/kosongkan_tabel'); ?>', {
										method: 'POST'
									}).then(response => response.json())
									.then(data => {
										Swal.fire(
											'Dikosongkan!',
											'Tabel berhasil dikosongkan.',
											'success'
										).then(() => {
											location.reload(); // Reload halaman setelah sukses
										});
									}).catch(error => {
										Swal.fire(
											'Gagal!',
											'Tabel gagal dikosongkan.',
											'error'
										);
									});
							}
						});
					});
				</script>
  		</li>
  		<!-- <li class="nav-item d-none d-sm-inline-block">
  			<a href="#" class="nav-link">Contact</a>
  		</li> -->
  	</ul>

  	<!-- Right navbar links -->
  	<ul class="navbar-nav ml-auto">
  		<li class="nav-item">
  			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
  				<i class="fas fa-expand-arrows-alt"></i>
  			</a>
  		</li>
  		<li class="nav-item dropdown">
  			<a class="nav-link" data-toggle="dropdown" href="#">
  				<i class="nav-icon fas fa-cog"></i>
  				Hello, <?= strtoupper($this->fungsi->user_login()->username) ?>
  			</a>
  			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
  				<div class="dropdown-divider"></div>
  				<a href="#" class="dropdown-item">
  					<!-- Message Start -->
  					<div class="media">
  						<img src="<?= base_url('assets/') ?>dist/img/avatar5.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
  						<div class="media-body">
  							<h3 class="dropdown-item-title">
  								<?= strtoupper($this->fungsi->user_login()->username) ?>
  								<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
  							</h3>
  							<p class="text-sm"><?= $this->fungsi->user_login()->branch ?></p>
  							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>Join At <?= date('d M Y', strtotime($this->fungsi->user_login()->created)) ?></p>
  						</div>
  					</div>
  					<!-- Message End -->
  				</a>
  				<div class="dropdown-divider"></div>
  				<a href="<?= site_url('auth/logout') ?>" class="dropdown-item dropdown-footer btn btn-error text-red"><i class="fas fa-sign-out-alt"></i> Log Out</a>
  			</div>
  		</li>
  	</ul>
  </nav>
  <!-- /.navbar -->
