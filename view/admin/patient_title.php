<?php 
	include "layout/layout.php";
	$conn = connection();
?>
<!doctype html>
<html lang="en">

	<?php layout_Head(); ?>

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

	<style>
		table#table_main tr th, table#table_main tr td {
			vertical-align: middle !important;
		}
	</style>

	<body>
		<div class="main-wrapper main-wrapper-1">
			<?php layout_TopMenu(); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<div class="col-8">
							<h5>คำนำหน้า</h5>
						</div>
						<div class="col-4 text-right">
							<a href="patient_title_detail.php?p=0"><button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มคำนำหน้า</button></a>
						</div>
					</div>

					<div class="section-body px-2 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12">
								<div class="card shadow">
									<div class="card-body px-1">
										

										<div class="row m-0 mt-3">
											<div class="col-12 table-responsive">
												<table id="table_main" class="table table-striped table-bordered dataTable w-100 mb-0">
													<thead class="bg-light">
														<tr>
															<th width="15%" class="text-center">คำนำหน้า</th>
															<th width="15%" class="text-center"></th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</body>


</html>

<?php layout_Script(); ?>
<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script>
	$(document).ready(function () {
		loadTable();
	});

	function loadTable() {
		//let search = $('#search').val();
		//let type_search = $('input[name="type_search"]:checked').val();

		$('#table_main').DataTable({
			order: [[0, 'desc']],
			destroy: true,
			searching: false,
			paging: true,
			lengthChange: false,
			pageLength: 10,
			ajax: {
				url: "<?php echo base_url(); ?>api/apiPatientTitleGet.php",
				type: "POST",
				//data: { "type":"search", "type_search":type_search, "search":search }
				data: { "type":"search" }
			},
			columns: [
 			
				{ data:"patient_title_name", class:"", 
					render: function ( data, type, full, meta ){
						return data;
					}
				},

				{ data:"patient_title_id", class:"text-center",
					render: function ( data, type, full, meta ){
						let html = "";
						html += '<button type="button" class="btn btn-sm btn-outline-warning mx-1" onclick="editData(\''+data+'\')"><i class="fas fa-edit"></i></button>';
						html += '<button type="button" class="btn btn-sm btn-outline-danger mx-1" onclick="delData(\''+data+'\')"><i class="fas fa-trash-alt"></i></button>';
						return html;
					} 
				}

				

				
			]
		});
	}

	

	function editData(id){
		window.location.href = '<?php echo base_url(); ?>view/admin/patient_title_detail.php?p='+id;
	}

	function delData(id){
		
		if (id != "") {
			Swal.fire({
				title: 'ต้องการลบรายการ?',
				icon: 'error',
				confirmButtonText: '<i class="fas fa-trash-alt"></i> ต้องการ',
				confirmButtonColor: '#dc3545',
				showCancelButton: true,
				cancelButtonText: 'ไม่',
				// cancelButtonColor: '#dc3545',
				allowOutsideClick: false, // close by button only
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>api/apiConfirmPatientTitleSave.php",
						data: { 'type':'delete', 'patient_title_id':id },
						dataType: "json",
						beforeSend: function() {},
						success: function (res) {
							if (res.status) {
								Swal.fire({
									title: 'Delete Success',
									icon: 'success',
									confirmButtonText: 'OK',
									allowOutsideClick: false, // close by button only
								}).then((result) => {
									if (result.value) {
										loadTable();
									}
								});
							} else {
								Swal.fire({
									title: 'เกิดข้อผิดพลาด โปรดทำรายการใหม่',
									icon: 'error',
									confirmButtonText: 'ตกลง',
									confirmButtonColor: '#dc3545',
									allowOutsideClick: false,
								}).then((result) => {
									if (result.value) {
										
									}
								});
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) { 
							Swal.fire({
								title: 'เกิดข้อผิดพลาด โปรดทำรายการใหม่',
								icon: 'error',
								confirmButtonText: 'ตกลง',
								confirmButtonColor: '#dc3545',
								allowOutsideClick: false,
							}).then((result) => {
								if (result.value) {

								}
							});
						}
					});
				}
			});
		}
	}
</script>