<?php 
    session_start();
	include "../../config/config.php";
    $u_id = isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "";
    $u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
    $u_email = isset($_SESSION["u_email"]) ? $_SESSION["u_email"] : "";
    $u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";

	if (empty($u_id) || empty($u_email) || $u_level != "user") {
		header('Location: '.base_url());
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
						'.
							// <li><a href="frmdeduct.php" class="nav-link text-bold">Deduct Process</a></li>
							// <li><a href="frmdrc.php" class="nav-link text-bold">DRC Process</a></li>
							// <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link text-bold">Menu1</a>
							// 	<div class="dropdown-menu">
							// 		<a href="#" class="dropdown-item has-icon">
							// 			<i class="fas fa-user"></i> Menu1.1
							// 		</a>
							// 		<a href="#" class="dropdown-item has-icon">
							// 			<i class="fas fa-bolt"></i> Menu1.2
							// 		</a>
							// 		<a href="#" class="dropdown-item has-icon">
							// 			<i class="fas fa-cog"></i> Menu1.3
							// 		</a>
							// 		<a href="#" class="dropdown-item has-icon">
							// 			<i class="fas fa-sign-out-alt"></i> Menu1.4
							// 		</a>
							// 	</div>
							// </li>
						'
						</ul>
						<ul class="navbar-nav navbar-right">
							<li><a href="#" class="nav-link text-bold"></a></li>
							<li class="dropdown dropdown-list-toggle d-none"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
								<div class="dropdown-menu dropdown-list dropdown-menu-right">
									<div class="dropdown-header">Messages
										<div class="float-right">
										<a href="#">Mark All As Read</a>
										</div>
									</div>
									<div class="dropdown-list-content dropdown-list-message">
										<a href="#" class="dropdown-item dropdown-item-unread">
										<div class="dropdown-item-avatar">
											<img alt="image" src="'.base_url().'assets/img/avatar/avatar-1.png" class="rounded-circle">
											<div class="is-online"></div>
										</div>
										<div class="dropdown-item-desc">
											<b>Kusnaedi</b>
											<p>Hello, Bro!</p>
											<div class="time">10 Hours Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item dropdown-item-unread">
										<div class="dropdown-item-avatar">
											<img alt="image" src="'.base_url().'assets/img/avatar/avatar-2.png" class="rounded-circle">
										</div>
										<div class="dropdown-item-desc">
											<b>Dedik Sugiharto</b>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
											<div class="time">12 Hours Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item dropdown-item-unread">
										<div class="dropdown-item-avatar">
											<img alt="image" src="'.base_url().'assets/img/avatar/avatar-3.png" class="rounded-circle">
											<div class="is-online"></div>
										</div>
										<div class="dropdown-item-desc">
											<b>Agung Ardiansyah</b>
											<p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											<div class="time">12 Hours Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item">
										<div class="dropdown-item-avatar">
											<img alt="image" src="'.base_url().'assets/img/avatar/avatar-4.png" class="rounded-circle">
										</div>
										<div class="dropdown-item-desc">
											<b>Ardian Rahardiansyah</b>
											<p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
											<div class="time">16 Hours Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item">
										<div class="dropdown-item-avatar">
											<img alt="image" src="'.base_url().'assets/img/avatar/avatar-5.png" class="rounded-circle">
										</div>
										<div class="dropdown-item-desc">
											<b>Alfa Zulkarnain</b>
											<p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
											<div class="time">Yesterday</div>
										</div>
										</a>
									</div>
									<div class="dropdown-footer text-center">
										<a href="#">View All <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</li>
							<li class="dropdown dropdown-list-toggle d-none"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
								<div class="dropdown-menu dropdown-list dropdown-menu-right">
									<div class="dropdown-header">Notifications
										<div class="float-right">
										<a href="#">Mark All As Read</a>
										</div>
									</div>
									<div class="dropdown-list-content dropdown-list-icons">
										<a href="#" class="dropdown-item dropdown-item-unread">
										<div class="dropdown-item-icon bg-light text-white">
											<i class="fas fa-code"></i>
										</div>
										<div class="dropdown-item-desc">
											Template update is available now!
											<div class="time text-primary">2 Min Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-info text-white">
											<i class="far fa-user"></i>
										</div>
										<div class="dropdown-item-desc">
											<b>You</b> and <b>Dedik Sugiharto</b> are now friends
											<div class="time">10 Hours Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-success text-white">
											<i class="fas fa-check"></i>
										</div>
										<div class="dropdown-item-desc">
											<b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
											<div class="time">12 Hours Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-danger text-white">
											<i class="fas fa-exclamation-triangle"></i>
										</div>
										<div class="dropdown-item-desc">
											Low disk space. Let\'s clean it!
											<div class="time">17 Hours Ago</div>
										</div>
										</a>
										<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-info text-white">
											<i class="fas fa-bell"></i>
										</div>
										<div class="dropdown-item-desc">
											Welcome to Stisla template!
											<div class="time">Yesterday</div>
										</div>
										</a>
									</div>
									<div class="dropdown-footer text-center">
										<a href="#">View All <i class="fas fa-chevron-right"></i></a>
									</div>
								</div>
							</li>

							<li><a href="booking.php" class="nav-link nav-link-lg d-none d-lg-inline-block">ทำการนัดหมายแพทย์</a></li>

							<li class="dropdown">
								<a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
									<img alt="image" src="'.base_url().'assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="dropdown-title text-truncate">คุณ <span class="top-uname">'.$_SESSION["u_name"].'</span></div>
									<a href="profile.php" class="dropdown-item has-icon">
										<i class="fas fa-user"></i> แก้ไขข้อมูลผู้ใช้งาน
									</a>
									<a href="change_password.php" class="dropdown-item has-icon">
										<i class="fas fa-unlock"></i> แก้ไขรหัสผ่าน
									</a>
									<a href="booking.php" class="dropdown-item has-icon d-inline-block d-lg-none">
										<i class="fas fa-calendar"></i> ทำการนัดหมายแพทย์
									</a>
									<a href="features-settings.html" class="dropdown-item has-icon d-none">
										<i class="fas fa-cog"></i> Settings
									</a>
									<div class="dropdown-divider"></div>
									<a href="'.base_url().'" class="dropdown-item has-icon text-danger">
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