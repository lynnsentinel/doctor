<?php
    session_start();
	session_destroy();
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

		<title>เข้าสู่ระบบ Admin</title>

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
							<h3>เข้าสู่ระบบ Admin</h3>
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
										<label for="password" class="control-label">รหัสผ่าน</label>
										<div class="float-right">
											<a href="forget_password.php" class="text-small">ลืมรหัสผ่าน?</a>
										</div>
									</div>
									<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
									<div class="invalid-feedback">
										โปรดกรอกรหัสผ่าน
									</div>
								</div>

								<div class="form-group mt-5">
									<div class="pass-incorrect text-danger text-center mb-2 d-none">
										อีเมลหรือรหัสผ่านไม่ถูกต้อง โปรดตรวจสอบและกรอกใหม่อีกครั้ง
									</div>
									<button type="button" class="btn btn-primary btn-lg btn-block" onclick="login()">เข้าสู่ระบบ</button>
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
	async function waitUpdateSendmail(){
		const response = await sendmail();
		

	}


	function login() {
        
        let status = checkData();
        if (status) {

        	//sendmail();
        	waitUpdateSendmail();

            let dataArr = "";
            let email = $('#email').val();
			let password = $('#password').val();

            dataArr = { 'type':'1', 'email': email, 'password': password }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>api/apiLogin.php",
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
		let password = $('#password').val();

		$('.pass-incorrect').addClass('d-none');

		if (email != "" && password != "") {
			$('.needs-validation').removeClass('was-validated');
			status = true;
		} else {
			$('.needs-validation').addClass('was-validated');
			status = false;
		}

		return status;
	}
	
	function sendmail(){
		$.ajax({
            url: "<?php echo base_url(); ?>api/apiAdminSendMail.php",
            data: {},
            type: "get",
            beforeSend: function (xhr) { xhr.setRequestHeader('Content-Type', 'application/json'); },
            success: function (data, status) {
            	//alert(data.data[]);
                //if (data.status == 0) {
                    
                //}
            }
        });
    }

    
</script>