<?php
	include "../config/config.php"; 
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"> -->

		<title>ลืมรหัสผ่าน</title>

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
							<h3 class="mt-3">ลืมรหัสผ่าน</h3>
						</div>
						<div class="card-body">
							<form method="POST" action="#" class="needs-validation"> <!--was-validated-->
								<div class="form-group">
									<label for="email">อีเมล</label>
									<input id="email" type="email" class="form-control" name="email" tabindex="1" required>
									<div class="invalid-feedback">
										โปรดกรอกอีเมลให้ถูกต้อง
									</div>
								</div>

								<div class="form-group">
									<div class="d-block">
										<label for="birth_date" class="control-label">วันเดือนปีเกิด (01/01/1900)</label>
									</div>
									<input id="birth_date" type="date" class="form-control" name="birth_date" tabindex="2" placeholder="วว/ดด/ปปปป" required>
									<div class="invalid-feedback">
										โปรดกรอกวันเดือนปีเกิดให้ถูกต้อง
									</div>
								</div>

								<!-- <div class="form-group">
									<div class="custom-control custom-checkbox p-0">
										<input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
										<label class="custom-control-label" for="remember-me">Remember Me</label>
									</div>
								</div> -->

								<div class="form-group mt-5">
									<div class="pass-incorrect text-danger text-center mb-2 d-none">
										ไม่มีอีเมลนี้ในระบบ โปรดตรวจสอบและลองใหม่
									</div>
									<button type="button" class="btn btn-primary btn-lg btn-block" onclick="forgetPassword()">ลืมรหัสผ่าน</button>
									<a href="<?php echo base_url(); ?>admin" class="link"><button type="button" class="btn btn-outline-success btn-lg btn-block mt-3">กลับไปหน้าเข้าสู่ระบบ</button></a>
								</div>
							</form>
							<!-- <div class="text-center mt-4 mb-3">
								<div class="text-job text-muted">Login With Social</div>
							</div> -->
						</div>
					</div>

					<!-- <div class="mt-5 text-muted text-center">
						Don't have an account? <a href="auth-register.html">Create One</a>
					</div>
					<div class="simple-footer">
						Copyright &copy; Stisla 2018
					</div> -->
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
	function forgetPassword() {
        let status = checkData();
        if (status) {
            let dataArr = "";
            let email = $('#email').val();
			let birth_date = $('#birth_date').val();

            dataArr = { 'type':'1', 'email': email, 'birth_date': birth_date }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>api/apiForgetPassword.php",
                data: dataArr,
                dataType: "json",
                beforeSend: function() { 
					$('.pass-incorrect').addClass('d-none');
				},
                success: function(data) {
                    if(data.status){
                        window.location.href = data.status_detail;
                    } else {
						$('.pass-incorrect').removeClass('d-none');
					}
                },
                error: function(request, status, error) { 
					$('.pass-incorrect').removeClass('d-none');
				}
            });
        } else {

		}
	}

	function checkData() {
		let status = "";
		let email = $('#email').val();
		let birth_date = $('#birth_date').val();

		$('.pass-incorrect').addClass('d-none');

		if (email != "" && birth_date != "") {
			$('.needs-validation').removeClass('was-validated');
			status = true;
		} else {
			$('.needs-validation').addClass('was-validated');
			status = false;
		}

		return status;
	}
	
</script>