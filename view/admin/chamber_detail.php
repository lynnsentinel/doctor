<?php 
	include "layout/layout.php";
	$conn = connection();

	$cham_id = isset($_GET["p"]) ? $_GET["p"] : "";
	
?>
<!doctype html>
<html lang="en">

	<?php layout_Head(); ?>

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

	<style>
		table#table_main tr td {
			vertical-align: middle !important;
		}
	</style>

	<body>
		<div class="main-wrapper main-wrapper-1">
			<?php layout_TopMenu(); ?>

			<div class="main-content">
				<section class="section">
					
					<a href="chamber_title.php"><button type="button" class="btn btn-danger m-3">กลับไปหน้าห้อง</button></a>

					<div class="section-body px-3 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12 col-md-10 col-lg-6 p-0 m-auto">
								<div class="row m-0">
									<div class="col-12">
										<div class="card shadow">
											<div class="card-body">
												<?php
												if($cham_id == 0){
													echo '<h5 class="text-center">เพิ่มห้อง</h5>';
												}else{
													echo '<h5 class="text-center">แก้ไขห้อง</h5>';
												}

												?>
												

												<form method="POST" action="#" class="needs-validation"> <!--was-validated-->
												
													<div class="row mt-5">
														<div class="col-12">
															<div class="form-group m-0">
																<label for="cham_title">คำนำหน้าแพทย์</label>
																<input id="cham_title" type="text" class="form-control" name="cham_title" value="" required>
															</div>
														</div>
													</div>

												</form>

												<div class="row mt-5">
													<div class="col-12">
														<button type="button" id="btnSave" class="btn btn-primary btn-lg btn-block" onclick="saveData()">บันทึก</button>
													</div>
												</div>
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
	let cham_id = '<?php echo $cham_id; ?>';

	$(document).ready(function () {
		loadData()
	});


	function loadData() {
		
		if (cham_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiChamberGet.php",
				data: { 'type':'id', 'cham_id':cham_id },
				dataType: "json",
				beforeSend: function() {},
				success: function (res) {
					//alert(res.data);
					let row = res.data;
					console.log(row);
					if (row.length > 0) {
						row.map( e => {
							
							$('#cham_title').val(e.cham_title);
							
							
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
				}
			});
		}
	}

	function saveData() {
		let status = checkData();
		let result = false;
		if (status) {
			
			/*
			let ap_status = $('input[name="ap_status"]:checked').val();
			let ap_come = $('input[name="ap_come"]:checked').val();
			*/
			
			
			let cham_title = $('#cham_title').val();
			


			if (cham_id != "" || cham_id == 0) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>api/apiConfirmChamberSave.php",
					//data: {'type':'save', 'patient_id':patient_id, 'patient_title_id':patient_title, 'patient_name':name, 'patient_email':email,'patient_birthdate':patient_birthdate},

					data: {'type':'save', 'cham_id':cham_id,
					'cham_title':cham_title},
					dataType: "json",
					beforeSend: function() { 
					},
					success: function(data) {
						if(data.status){
							Swal.fire({
								title: 'บันทึกสำเร็จ',
								icon: 'success',
								confirmButtonText: 'ตกลง',
								confirmButtonColor: '#28a745',
								allowOutsideClick: false, // close by button only
							}).then((result) => {
								if (result.value) {
									window.location.href = '<?php echo base_url(); ?>view/admin/chamber.php';
								}
							});
						} else {
							Swal.fire({
								title: 'บันทึกไม่สำเร็จ',
								text: data.status_detail,
								icon: 'error',
								confirmButtonText: 'ตกลง',
								confirmButtonColor: '#dc3545',
								allowOutsideClick: false, // close by button only
							}).then((result) => {
								if (result.value) {
									
								}
							});
						}
					},
					error: function(request, status, error) { 
						Swal.fire({
							title: 'บันทึกไม่สำเร็จ',
							text: data.status_detail,
							icon: 'error',
							confirmButtonText: 'ตกลง',
							confirmButtonColor: '#dc3545',
							allowOutsideClick: false, // close by button only
						}).then((result) => {
							if (result.value) {

							}
						});
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
						window.location.href = '<?php echo base_url(); ?>view/admin/chamber_title.php';
					}
				});
			}
		}else{

		}
		return result;
	}

	function checkData() {
		let status = false;

		
		let cham_title = $('#cham_title').val();


		$('.needs-validation').addClass('was-validated');

		if (cham_title != "" && cham_title != "" ) {
			$('.needs-validation').removeClass('was-validated');
			status = true;
		}

		return status;
	}
</script>