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

			$u_email = isset($_POST["u_email"]) ? $_POST["u_email"] : "";
			$password_old = isset($_POST["password_old"]) ? checkSecurity($_POST["password_old"], true) : "";
			$password_new1 = isset($_POST["password_new1"]) ? checkSecurity($_POST["password_new1"], true) : "";
			$password_new2 = isset($_POST["password_new2"]) ? checkSecurity($_POST["password_new2"], true) : "";


			if (!empty($u_email) && !empty($password_old) && !empty($password_new1) && !empty($password_new2)) {
				$sql = "";
				
				if ($u_level == "admin") {
					$sql = "SELECT admin_id FROM admin WHERE u_status = '1' AND admin_email = '".$u_email."' AND admin_pass = '".$password_old."';";
					$sqlUpdate = "UPDATE admin SET admin_pass = '".$password_new2."' WHERE u_status = '1' AND admin_email = '".$u_email."';";
				} else if ($u_level == "user") {
					$sql = "SELECT patient_id FROM patients WHERE p_status = '1' AND patient_email = '".$u_email."' AND patient_pass = '".$password_old."';";
					$sqlUpdate = "UPDATE patients SET patient_pass = '".$password_new2."' WHERE p_status = '1' AND patient_email = '".$u_email."';";
				}

				$res = query($conn, $sql);
				if($rs = fetch_array($res)){
					if ($password_new1 == $password_new2) {
						$res2 = query($conn, $sqlUpdate);
						$status = true;
					}
				} else {
					$status_detail = "รหัสผ่านเดิมไม่ถูกต้อง";
				}
				
			}
		} else if ($type == 'new') {
			$key = isset($_POST["k"]) ? $_POST["k"] : "";
			$email = isset($_POST["email"]) ? $_POST["email"] : "";
			$password_new1 = isset($_POST["password_new1"]) ? checkSecurity($_POST["password_new1"], true) : "";
			$password_new2 = isset($_POST["password_new2"]) ? checkSecurity($_POST["password_new2"], true) : "";

			if (!empty($key)) {
				$ref = "";

				if ($level == '1') {
					$sql = "SELECT * FROM admin WHERE u_status = '1' AND admin_email = '".$email."';";
					$res = query($conn, $sql);
					if($rs = fetch_array($res)){
						$admin_birthdate = isset($rs["admin_birthdate"]) ? $rs["admin_birthdate"] : "";
						$admin_pass = isset($rs["admin_pass"]) ? $rs["admin_pass"] : "";

						if (!empty($email) && !empty($admin_pass) && !empty($admin_birthdate)) {
							$ref = checkSecurity($email.$admin_pass.$admin_birthdate, true);

						}
					}
				} else if ($level == '2') {
					$sql = "SELECT * FROM patients WHERE p_status = '1' AND patient_email = '".$email."';";
					$res = query($conn, $sql);
					if($rs = fetch_array($res)){
						$patient_birthdate = isset($rs["patient_birthdate"]) ? $rs["patient_birthdate"] : "";
						$patient_pass = isset($rs["patient_pass"]) ? $rs["patient_pass"] : "";

						if (!empty($email) && !empty($patient_pass) && !empty($patient_birthdate)) {
							$ref = checkSecurity($email.$patient_pass.$patient_birthdate, true);
						}
					}
				}
				if ($key == $ref) {

					if ($level == '1') {
						$sqlUpdate = "UPDATE admin SET admin_pass = '".$password_new2."' WHERE u_status = '1' AND admin_email = '".$email."';";
						$res = query($conn, $sqlUpdate);
						if ($res) {
							$status = true;
						}
					} else if ($level == '2') {
						$sqlUpdate = "UPDATE patients SET patient_pass = '".$password_new2."' WHERE p_status = '1' AND patient_email = '".$email."';";
						$res = query($conn, $sqlUpdate);
						if ($res) {
							$status = true;
						}
					}
				}
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