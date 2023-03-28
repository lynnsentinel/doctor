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
													<div class="form-group m-0">
														<label for="password_old">รหัสผ่านเดิม</label>
														<input id="password_old" type="password" class="form-control" name="password_old" required>
														<div class="password_old_feed invalid-feedback">
															โปรดกรอกรหัสผ่านเดิม
														</div>
													</div>
													<div class="form-group m-0 mt-2">
														<label for="password_new1">รหัสผ่านใหม่</label>
														<input id="password_new1" type="password" class="form-control" name="password_new1" required>
														<div class="password_new1_feed invalid-feedback">
															โปรดกรอกรหัสผ่านใหม่
														</div>
													</div>
													<div class="form-group m-0 mt-2">
														<label for="password_new2">ยืนยันรหัสผ่านใหม่</label>
														<input id="password_new2" type="password" class="form-control" name="password_new2" required>
														<div class="password_new2_feed invalid-feedback">
															โปรดกรอกยืนยันรหัสผ่านใหม่
														</div>
														<div class="password_new_feed d-none">
															รหัสผ่านใหม่และยืนยันรหัสไม่ตรงกัน
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
			let status2 = checkData2();
			if (status2) {
				let dataArr = "";
				let password_old = $('#password_old').val();
				let password_new1 = $('#password_new1').val();
				let password_new2 = $('#password_new2').val();

				dataArr = { 'type':'change', 'u_email':'<?php echo $u_email; ?>', 'password_old': password_old, 'password_new1': password_new1, 'password_new2': password_new2 }

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>api/apiChangePassword.php",
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
									location.reload();
								}
							});
						} else {
							Swal.fire({
								title: data.status_detail,
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
	}

	function checkData() {
		let status = "";
		let password_old = $('#password_old').val();
		let password_new1 = $('#password_new1').val();
		let password_new2 = $('#password_new2').val();

		if (password_old != "" && password_new1 != "" && password_new2 != "") {
			$('.needs-validation').removeClass('was-validated');
			status = true;
		} else {
			$('.needs-validation').addClass('was-validated');
			status = false;
		}

		return status;
	}

	function checkData2() {
		let status = "";
		let password_new1 = $('#password_new1').val();
		let password_new2 = $('#password_new2').val();

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
		return status;
	}
</script>