<?php
	include "config/config.php";
	$conn = connection();

	$option_name = "";

	$sql = "SELECT * FROM patient_title WHERE patient_title_enable = '1'";
	$res = query($conn, $sql);
	while($rs = fetch_array($res)){
		$option_name .= '<option value="'.$rs['patient_title_id'].'">'.$rs['patient_title_name'].'</option>';
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

		<title>ลงทะเบียน</title>

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
							<h3>ลงทะเบียน</h3>
						</div>
						<div class="card-body">
							<form method="POST" action="#" class="needs-validation"> <!--was-validated-->
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>คำนำหน้า</label>
											<select id="title_name" class="form-control" tabindex="1" required>
												<option value="" selected>---โปรดเลือก---</option>
												<?php echo $option_name; ?>
											</select>
											<div class="invalid-feedback">
												โปรดเลือกคำนำหน้า
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="name">ชื่อ</label>
											<input id="name" type="text" class="form-control" name="name" tabindex="2" required>
											<div class="invalid-feedback">
												โปรดกรอกชื่อ
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="email">อีเมล</label>
											<input id="email" type="email" class="form-control" name="email" tabindex="3" required>
											<div class="invalid-feedback">
												โปรดกรอกอีเมลให้ถูกต้อง
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="password">รหัสผ่าน</label>
											<input id="password" type="password" class="form-control" name="password" tabindex="4" required>
											<div class="invalid-feedback">
												โปรดกรอกรหัสผ่าน
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="email">วันเดือนปีเกิด</label>
											<input id="birth_date" type="date" class="form-control" name="birth_date" tabindex="5" required>
											<div class="invalid-feedback">
												โปรดกรอกวันเดือนปีเกิด
											</div>
										</div>
									</div>
								</div>
								<div class="row">
	<div class="col-12">
		<div class="form-group">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="agreement" name="agreement" required>
				<label class="form-check-label" for="agreement">
					ฉันยอมรับ <a href="termAndConditionOfUse.php" target="_blank">ข้อตกลงและเงื่อนไข</a> ทั้งหมด
				</label>
				<div class="invalid-feedback">
					โปรดยอมรับข้อตกลงและเงื่อนไข
				</div>
			</div>
		</div>
	</div>
</div>


								<div class="form-group mt-5">
									<button type="button" class="btn btn-primary btn-lg btn-block" onclick="login()">ลงทะเบียน</button>
									<a href="<?php echo base_url(); ?>" class="link"><button type="button" class="btn btn-outline-success btn-lg btn-block mt-3">กลับไปหน้าเข้าสู่ระบบ</button></a>
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
	function login() {
        let status = checkData();
        if (status) {
            let dataArr = "";
            let title_name = $('#title_name').val();
            let name = $('#name').val();
            let email = $('#email').val();
			let password = $('#password').val();
			let birth_date = $('#birth_date').val();

            dataArr = { 'type':'user', 'title_name':title_name, 'name':name, 'email': email, 'password': password, 'birth_date':birth_date }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>api/apiRegister.php",
                data: dataArr,
                dataType: "json",
                beforeSend: function() { 
				},
                success: function(data) {
                    if(data.status){
						Swal.fire({
							title: 'ลงทะเบียนสำเร็จ',
							icon: 'success',
							confirmButtonText: 'ตกลง',
							confirmButtonColor: '#28a745',
							allowOutsideClick: false, // close by button only
						}).then((result) => {
							if (result.value) {
                        		window.location.href = '<?php echo base_url();?>';
							}
						});
                    } else {
						Swal.fire({
							title: 'ลงทะเบียนไม่สำเร็จ',
							text: data.status_detail,
							icon: 'error',
							confirmButtonText: 'ตกลง',
							confirmButtonColor: '#dc3545',
							allowOutsideClick: false, // close by button only
						}).then((result) => {
							if (result.value) {
								if (data.status_detail == "อีเมลนี้มีผู้ใช้งานในระบบแล้ว") {
									$('#email').focus();
								}
							}
						});
					}
                },
                error: function(request, status, error) { 
					Swal.fire({
						title: 'ลงทะเบียนไม่สำเร็จ',
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

		}
	}

	function checkData() {
		let status = false;
		let title_name = $('#title_name').val();
		let name = $('#name').val();
		let email = $('#email').val();
		let password = $('#password').val();
		let birth_date = $('#birth_date').val();

		$('.needs-validation').addClass('was-validated');

		if (title_name != "" && name != "" && email != "" && password != "" && birth_date != "") {
			let check_mail = validateEmail(email);
			if (check_mail) {
				$('.needs-validation').removeClass('was-validated');
				status = true;
			}
		}

		return status;
	}
	function validateForm() {
		var checkBox = document.getElementById("agree");
		if (!checkBox.checked) {
			alert("Please agree to the terms and conditions before submitting the form.");
			return false;
		}
		}
		$('#agreement').on('change', function(){
		if(this.checked){
			$('#register-btn').prop('disabled', false);
		}
		else{
			$('#register-btn').prop('disabled', true);
		}
	});
</script>