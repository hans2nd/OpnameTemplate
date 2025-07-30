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

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row col-md-3">
				<?php foreach ($selectedUser as $key) : ?>
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<!-- <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
							</div>
							<?php
							$qrCode = new Endroid\QrCode\QrCode($key['id']); //get username
							$qrCode->writeFile('assets/uploads/qrCode/' . $key['id'] . '.png'); //simpan di folder assets
							echo '<img src="assets/uploads/qrCode/' . $key['id'] . '.png" style="width: 100px">';
							?>
							<h3><?= $key['username'] ?></h3>
							<p class="text-muted text-center">
								<?php
								$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
								echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($key['username'], $generator::TYPE_CODE_128)) . '">';
								?></p>

							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>Followers</b> <a class="float-right">1,322</a>
								</li>
								<li class="list-group-item">
									<b>Following</b> <a class="float-right">543</a>
								</li>
								<li class="list-group-item">
									<b>Friends</b> <a class="float-right">13,287</a>
								</li>
							</ul>
							<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</div>