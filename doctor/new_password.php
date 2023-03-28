<?php
	include "../config/config.php";
	$key = isset($_GET["k"]) ? $_GET["k"] : "";
	$email = isset($_GET["mail"]) ? $_GET["mail"] : "";

	if (empty($key) || empty($email)) {
		header('Location: '.base_url());
	}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"> -->

		<title>สร้างรหัสผ่านใหม่</title>

		<!-- General CSS Files -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

		<!-- CSS Libraries -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/chocolat/dist/css/chocolat.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/select2/dist/css/select2.min.css">

		<!-- Template CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
	</head>

	<body class="body-login bg-primary">
		<section class="section">
			<div class="row">
				<div class="col-12 col-md-6 col-lg-5 col-xl-4 m-auto">
					<div class="login-brand">
						<h2 class="text-light">Doctor</h2>
						<!-- <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
					</div>

					<div class="card card-primary">
						<div class="card-header text-center">
							<h3 class="mt-3">สร้างรหัสผ่าน</h3>
						</div>
						<div class="card-body">
							<form method="POST" action="#" class="needs-validation"> <!-- was-validated -->
								<div class="row">
									<div class="col-12">
										<div class="form-group m-0">
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
		</section>
	</body>
</html>

<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<script>
	function changePassword() {
		let status = checkData();
        if (status) {
			let dataArr = "";
			let password_new1 = $('#password_new1').val();
			let password_new2 = $('#password_new2').val();

			dataArr = { 'type':'new', 'level':'1', 'email':'<?php echo $email; ?>', 'k':'<?php echo $key; ?>', 'password_new1': password_new1, 'password_new2': password_new2 }

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
								window.location.href = '<?php echo base_url(); ?>admin';
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
		let password_new2 = $('#password_new2').val();
		$('.password_new_feed').addClass('d-none');

		if (password_new1 != "" && password_new2 != "") {
			$('.needs-validation').removeClass('was-validated');
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
		} else {
			$('.needs-validation').addClass('was-validated');
			status = false;
		}

		return status;
	}
</script>