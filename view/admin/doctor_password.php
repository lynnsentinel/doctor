<?php 
	include "layout/layout.php";
	$conn = connection();

	$doctor_id = isset($_GET["p"]) ? $_GET["p"] : "";
	
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
					
					<a href="doctor.php"><button type="button" class="btn btn-danger m-3">กลับไปหน้ารายชื่อแพทย์</button></a>
				
					<div class="section-body px-3 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12 col-md-10 col-lg-6 p-0 m-auto">
								<div class="row m-0">
									<div class="col-12">
										<div class="card shadow">
											<div class="card-body">
												<h5 class="text-center">รหัสผ่านใหม่</h5>

												<form method="POST" action="#" class="needs-validation"> <!-- was-validated -->
													<div class="row">
														<div class="col-12">
															<div class="form-group m-0">
																<label for="password_new1">ชื่อแพทย์</label>
																<input id="doctor_name" type="text" class="form-control" name="doctor_name" value="">
																
															</div>

															<div class="form-group m-0">
																<label for="password_new1">รหัสผ่านใหม่</label>
																<input id="password_new1" type="password" class="form-control" name="password_new1" required>
																<div class="password_new1_feed invalid-feedback">
																	โปรดกรอกรหัสผ่านใหม่
																</div>
															</div>
															
															<div class="row mt-5">
																<div class="col-12">
																	<button type="button" id="btnChangePassWord" class="btn btn-primary btn-lg btn-block" onclick="changePassword()">บันทึกรหัสผ่านใหม่</button>
																</div>
															</div>
														</div>
													</div>
												</form>
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
	let doctor_id = '<?php echo $doctor_id; ?>';

	$(document).ready(function () {
		loadData()
	});


	function loadData() {
		if (doctor_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiDoctorGet.php",
				data: { 'type':'id', 'doctor_id':doctor_id },
				dataType: "json",
				beforeSend: function() {},
				success: function (res) {
					//alert(res.data);
					let row = res.data;
					console.log(row);
					if (row.length > 0) {
						row.map( e => {
							
							$('#doctor_name').val(e.doctor_title_name+' '+e.doctor_name);
							
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
				}
			});
		}
	}

	function changePassword() {
		let status = checkData();
        if (status) {
			let dataArr = "";
			let password_new1 = $('#password_new1').val();
			

			dataArr = { 'type':'change', 'doctor_id': doctor_id, 'password_new1': password_new1}

			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiDoctorPassword.php",
				data: dataArr,
				dataType: "json",
				beforeSend: function() { },
				success: function(data) {
					if(data.status){
						Swal.fire({
							title: 'บันทึกรหัสผ่านใหม่สำเร็จ',
							icon: 'success',
							confirmButtonText: 'ตกลง',
							confirmButtonColor: '#28a745',
							allowOutsideClick: false, // close by button only
						}).then((result) => {
							if (result.value) {
								window.location.href = '<?php echo base_url(); ?>view/admin/doctor.php';
							}
						});
					} else {
						Swal.fire({
							title: 'บันทึกรหัสผ่านใหม่ไม่สำเร็จ',
							icon: 'error',
							confirmButtonText: 'ลองใหม่',
							confirmButtonColor: '#dc3545',
							allowOutsideClick: false, // close by button only
						}).then((result) => {
							if (result.value) {

							}
						});
					}
				},
				error: function(request, status, error) { 

				}
			});
		}
	}

	function checkData() {
		let status = "";
		let password_new1 = $('#password_new1').val();
		
		$('.password_new_feed').addClass('d-none');

		if (password_new1 != "" ) {
			$('.needs-validation').removeClass('was-validated');
			$('.password_new_feed').addClass('d-none');
			status = true;
			/*
			if (password_new1 == password_new2) {
				$('#password_new1').removeClass('border-danger');
				$('#password_new2').removeClass('border-danger');
				$('.password_new_feed').addClass('d-none');
				status = true;
			} else {
				$('#password_new1').addClass('border-danger');
				$('#password_new2').addClass('border-danger');
				$('.password_new_feed').removeClass('d-none');
				status = false;
			}
			*/
		} else {
			$('.needs-validation').addClass('was-validated');
			status = false;
		}

		return status;
	}
</script>