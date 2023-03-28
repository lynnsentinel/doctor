<?php 
	session_start();
	include "../config/config.php";
	$conn = connection();

	$status = false;
	$status_detail = "";
    $security = false;
	$res2 = "";

	$http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

    if ($security) {
		$type = isset($_POST["type"]) ? $_POST["type"] : "";
		$level = isset($_POST["level"]) ? $_POST["level"] : "";
		if ($type == 'change') {

			$u_id = isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "";
			$u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
			$u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";

			//$u_email = isset($_POST["u_email"]) ? $_POST["u_email"] : "";
			//$password_old = isset($_POST["password_old"]) ? checkSecurity($_POST["password_old"], true) : "";
			$password_new1 = isset($_POST["password_new1"]) ? checkSecurity($_POST["password_new1"], true) : "";
			//$password_new2 = isset($_POST["password_new2"]) ? checkSecurity($_POST["password_new2"], true) : "";


			if (!empty($password_new1) ) {
				$sql = "";
				
				if ($u_level == "doctor") {
					//$sql = "SELECT admin_id FROM admin WHERE u_status = '1' AND admin_email = '".$u_email."' AND admin_pass = '".$password_old."';";

					$sqlUpdate = "UPDATE doctors SET doctor_pass = '".$password_new1."' WHERE doctor_id = '".$u_id."';";
				} 

				$res = query($conn, $sqlUpdate);
				$status = true;
				
			}
		} 
	}

	if ($status == false && empty($status_detail)) {
        $status_detail = "เปลี่ยนรหัสไม่สำเร็จ";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>