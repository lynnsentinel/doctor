<?php 
	include "layout/layout.php";
	$conn = connection();
?>
<!doctype html>
<html lang="en">

	<?php layout_Head(); ?>
	
	<body>
		<div class="main-wrapper main-wrapper-1">
			<?php layout_TopMenu(); ?>

			<div class="main-content">
				<section class="section m-0">
					<div class="section-body-full p-3">
						<div class="row mt-4">
							<div class="col-12 col-lg-4 m-auto">
								<div class="card shadow">
									<div class="card-body">
										<div class="row">
											<div class="col-12">
												<h5 class="text-center">แก้ไขรหัสผ่าน</h5>
											</div>
										</div>

										<form method="POST" action="#" class="needs-validation"> <!-- was-validated -->
											<div class="row mt-5">
												<div class="col-12">
													
													<div class="form-group m-0 mt-2">
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
				</section>
			</div>
		</div>

		
	</body>


</html>

<?php layout_Script(); ?>

<script>
	$(document).ready(function () {

	});

	function changePassword() {
		let status = checkData();
        if (status) {
			
			
				let dataArr = "";
				
				let password_new1 = $('#password_new1').val();
				

				dataArr = { 'type':'change', 'password_new1': password_new1 }

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>api/apiDoctorChangePassword.php",
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
									//location.reload();
									window.location.href = '<?php echo base_url(); ?>view/doctor/doctor_booking.php';
								}
							});
						} else {
							Swal.fire({
								title: data.status_detail,
								text: '',
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
				});
			}
		
	}

	function checkData() {
		let status = "";
		
		let password_new1 = $('#password_new1').val();
		

		if ( password_new1 != "" ) {
			$('.needs-validation').removeClass('was-validated');
			status = true;
		} else {
			$('.needs-validation').addClass('was-validated');
			status = false;
		}

		return status;
	}

	
</script>