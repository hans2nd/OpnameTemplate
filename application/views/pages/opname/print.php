<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<title>Document</title>
	<style>
		@page {
			margin: 0.1cm;
		}

		body {
			margin: 0.1cm;
			font-family: Verdana, Geneva, Tahoma, sans-serif;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		table,
		td,
		th {
			border: 2px solid;
			text-align: center;
		}
	</style>
</head>

<body>
	<?php foreach ($getOpname as $row) : ?>
		<table>
			<tr>
				<td rowspan="2">
					<p>
						<br>
						<br>
						<br>
						<!-- <b>Receipt Date</b> -->
						 <b><?php if ($row['typeid'] == 'OP01') {
							echo "Opname Date";
						 } elseif ($row['typeid'] == 'RT01') {
							echo "Retur Opname Date";
						 } else {
							echo "Receipt Date";
						 } ?></b>
						<br>
						<?= ($row['created'] == '0000-00-00') ? null : date('d-M-Y', strtotime($row['created'])); ?>
					</p>
				</td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
				<td rowspan="2">
					<p>
						<b><u>Site</u></b>
						<br>
						<?= $row['warehouse']; ?>
						<br><br>
						<b>Location</b>
						<br>
						<?= $row['locationid']; ?>
					</p>
				</td>
			</tr>
			<tr></tr>
			<tr>
				<td colspan="4">
					<h4><?= $row['description']; ?></h4>
				</td>
			</tr>
			<tr>
				<td rowspan=" 2">
					<p>
						Inventory ID
						<br>
						<?php
						echo '<img src="assets/uploads/qrCode/' . $row['inventoryid'] . '.png" style="width: 100px">'; ?>
						<br>
						<?= $row['inventoryid']; ?>
					</p>
				</td>
				<td rowspan="2">
					<p>
						<br>
						<b>Quantity</b>
						<br>
						<?= $row['wholeqty'] . " " . $row['wholeuom'] . "<br>" . $row['looseqty'] . " " . $row['looseuom']; ?>
					</p>
				</td>
				<td rowspan="2">
					<p>
						<br>
						<b>Expired</b>
						<br>
						<?= ($row['expired'] == '0000-00-00') ? null : date('d-M-Y', strtotime($row['expired'])); ?>
					</p>
				</td>
				<td rowspan="2">
					<p>
						Lot Number
						<br>
						<?php
						echo '<img src="assets/uploads/qrCode/' . $row['lotnumber'] . '.png" style="width: 100px">'; ?>
						<br>
						<?= $row['lotnumber']; ?>
					</p>
				</td>
			</tr>
			<tr></tr>
		</table>
	<?php endforeach; ?>
</body>

</html>
