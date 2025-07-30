	<footer class="main-footer">
		<strong>Copyright © 2024 <a href="#">Hans-PLJKT</a>.</strong>
		All rights reserved.
		<div class="float-right d-none d-sm-inline-block">
			<code>Jakarta, <?php echo date('d F Y || H:i:s') ?> WIB</code>
			<b>Version</b> 1.1.0
		</div>
	</footer>
	</div>
	<!-- jQuery -->
	<script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/jszip/jszip.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- SweetAlert2 -->
	<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- Select2 -->
	<script src="<?= base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>

	<!-- SWEETALERT -->
	<?php if ($this->session->flashdata('sukses')) { ?>
		<script>
			swal("Berhasil", "<?php echo $this->session->flashdata('sukses'); ?>", "success")
		</script>
	<?php } ?>

	<?php if (isset($error)) { ?>
		<script>
			swal("Oops...", "<?php echo strip_tags($error); ?>", "warning")
		</script>
	<?php } ?>

	<?php if ($this->session->flashdata('warning')) { ?>
		<script>
			swal("Oops...", "<?php echo $this->session->flashdata('warning'); ?>", "warning")
		</script>
	<?php } ?>

	<script>
		$(function() {
			//DataTable
			$("#example1").DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
				"buttons": ["excel","colvis"]
				// "buttons": ["copy", " csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
		// Sweet Alert
		const flashData = $('.flash-data').data('flashsuccess');

		if (flashData) {
			Swal.fire({
				title: 'Sukses',
				// text: 'Data Berhasil ' + flashData,
				text: flashData,
				type: 'success',
				icon: 'success'
			});
		}

		// Sweet Alert
		const flashGagal = $('.flash-data-gagal').data('flashgagal');

		if (flashGagal) {
			Swal.fire({
				title: 'Gagal',
				// text: 'Data Gagal ' + flashGagal,
				text: flashGagal,
				type: 'error',
				icon: 'error'
			});
		}
		// Sweet alert
		function confirmation(ev) {
			ev.preventDefault();
			var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
			console.log(urlToRedirect); // verify if this is the right URL
			Swal.fire({
					title: "Yakin ingin menghapus data ini?",
					text: "Data yang sudah dihapus tidak dapat dikembalikan",
					icon: "warning",
					buttons: true,
					dangerMode: true,
					showCancelButton: true,
					confirmButtonColor: "#d33",
					cancelButtonColor: "#3085d6",
					confirmButtonText: "Yes, Hapus!",
				})
				.then((result) => {
					if (result.isConfirmed) {
						// If the user clicks "Yes, delete it!" button, proceed with the deletion
						// succesModal('Data Berhasil Dihapus !');
						Swal.fire({
							title: "Berhasil !",
							text: 'Data Berhasil Di Hapus !',
							icon: "success",
							showLoaderOnConfirm: true,
						}).then((result) => {
							// Reload the page after the Swal modal is closed
							if (result.isConfirmed || result.dismiss === Swal.DismissReason.close) {
								window.location.href = urlToRedirect;
							}
						});
					}
				});
			return false;
		}

		$('#inputNotes').on('input', function() {
			this.style.height = 'auto';

			this.style.height =
				(this.scrollHeight) + 'px';
		});


		//Initialize Select2 Elements
		$('.select2').select2();

		//Initialize Select2 Elements
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		});
	</script>

	<!-- input stok form -->
	<script>
		/* $(document).ready(function() {
			$(document).on('click',
				'#select_item',
				function() {
					var id = $(this).data('id');
					var inventoryid = $(this).data('inventoryid');
					var description = $(this).data('description');
					var wholeuom = $(this).data('wholeuom');
					var looseuom = $(this).data('looseuom');
					$('#txtInventoryid').val(inventoryid);
					$('#inputDescription').val(description);
					$('#txtWholeUOM').val(wholeuom);
					$('#txtLooseUOM').val(looseuom);
					$('#modal-item').modal('hide');
				});
		}); */
		$(document).on('change', '#txtInventoryid', function() {
			var inventoryID = $(this).val();
			$.ajax({
				type: 'get',
				url: '<?php echo base_url("Opname/getItemDescription/") ?>' + inventoryID,
				dataType: 'json',
				success: function(data) {
					// console.log(data); 
					// alert('Item ID: ' + data.id + ', Name: ' + data.inventoryid); 
					$('#inputDescription').val(data.description);
					$('#txtWholeUOM').val(data.wholeuom);
					$('#txtLooseUOM').val(data.looseuom);
				},
				error: function(xhr, status, error) {
					console.error('Error:', status, error);
				}
			});
		});
	</script>

	</body>

	</html>

	<?php /* End of file footer.php and path \application\views\layout\footer.php */ ?>