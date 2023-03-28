<?php 
    session_start();
	include "../../config/config.php";
    $u_id = isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "";
    $u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
    $u_email = isset($_SESSION["u_email"]) ? $_SESSION["u_email"] : "";
    $u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";

	if (empty($u_id) || empty($u_email) || $u_level != "doctor") {
		header('Location: '.base_url().'/doctor/');
	}

	function layout_Head($title="Doctor") {
		$html = '<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
					<meta name="description" content="">
					<meta name="author" content="">
					<!-- <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"> -->

					<title>'.$title.'</title>

					<!-- General CSS Files -->
					<link rel="stylesheet" href="'.base_url().'assets/modules/bootstrap/css/bootstrap.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/modules/fontawesome/css/all.min.css">

					<!-- CSS Libraries -->
					<link rel="stylesheet" href="'.base_url().'assets/modules/chocolat/dist/css/chocolat.css">
					<link rel="stylesheet" href="'.base_url().'assets/modules/select2/dist/css/select2.min.css">

					<!-- Template CSS -->
					<link rel="stylesheet" href="'.base_url().'assets/css/bootstrap.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/css/style.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/css/components.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/css/custom.css">
				</head>';
		echo $html;
	}

	function layout_TopMenu() {
			$html = '<nav class="navbar navbar-expand-lg main-navbar bg-primary">
						<ul class="navbar-nav mr-auto">
							<li><h3 class="text-light m-0">DOCTOR</h3></li>
						</ul>
						<ul class="navbar-nav navbar-right">
							

							<li class="dropdown">
								<a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
									<img alt="image" src="'.base_url().'assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="dropdown-title text-truncate">คุณ '.$_SESSION["u_name"].'</div>
									<a href="change_password.php" class="dropdown-item has-icon">
										<i class="fas fa-unlock"></i> แก้ไขรหัสผ่าน
									</a>
									<a href="#" class="dropdown-item has-icon d-inline-block d-lg-none">
										<i class="fas fa-calendar"></i> รายการนัดหมาย
									</a>
									<a href="#" class="dropdown-item has-icon d-inline-block d-lg-none">
										<i class="fas fa-user"></i> ผู้ป่วย
									</a>
									<a href="#" class="dropdown-item has-icon d-inline-block d-lg-none">
										<i class="fas fa-user-md"></i> แพทย์
									</a>
									<a href="#" class="dropdown-item has-icon d-inline-block d-lg-none">
										<i class="fas fa-user-cog"></i> ผู้ดูแล
									</a>
									<a href="#" class="dropdown-item has-icon d-inline-block d-lg-none">
										<i class="fas fa-tasks"></i> ข้อมูลอื่นๆ
									</a>
									
									<div class="dropdown-divider"></div>
									<a href="'.base_url().'doctor" class="dropdown-item has-icon text-danger">
										<i class="fas fa-sign-out-alt"></i> Logout
									</a>
								</div>
							</li>
						</ul>
					</nav>';
		echo $html;
	}

	function layout_Script() {
		$html = '<!-- General JS Scripts -->
				<script src="'.base_url().'assets/modules/jquery.min.js"></script>
				<script src="'.base_url().'assets/modules/popper.js"></script>
				<script src="'.base_url().'assets/modules/tooltip.js"></script>
				<script src="'.base_url().'assets/modules/bootstrap/js/bootstrap.min.js"></script>
				<script src="'.base_url().'assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
				<script src="'.base_url().'assets/modules/moment.min.js"></script>
				<script src="'.base_url().'assets/js/stisla.js"></script>

				<!-- JS Libraies -->
				<script src="'.base_url().'assets/modules/cleave-js/dist/cleave.min.js"></script>
				<script src="'.base_url().'assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
				<script src="'.base_url().'assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
				<script src="'.base_url().'assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
				<script src="'.base_url().'assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
				<script src="'.base_url().'assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
				<script src="'.base_url().'assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
				<script src="'.base_url().'assets/modules/select2/dist/js/select2.full.min.js"></script>
				<script src="'.base_url().'assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
				<script src="'.base_url().'assets/modules/inputmask/jquery.inputmask.bundle.js"></script>
				<script src="'.base_url().'assets/modules/sweetalert2/sweetalert2.all.min.js"></script>
				<script src="'.base_url().'assets/js/main.js"></script>';
		echo $html;
	}
?>