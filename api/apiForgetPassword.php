<?php 
	session_start();
	include "../config/config.php";
	$conn = connection();

	$status = false;
	$status_detail = "";
    $security = false;
	$key = "";

	$http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

    if ($security) {

		$type = isset($_POST["type"]) ? $_POST["type"] : "";
		$email = isset($_POST["email"]) ? $_POST["email"] : "";
		$birth_date = isset($_POST["birth_date"]) ? $_POST["birth_date"] : "";

		if (!empty($email) && !empty($birth_date)) {
			if ($type == '1') {
				$sql = "SELECT * FROM admin WHERE u_status = '1' AND admin_email = '".$email."' AND admin_birthdate = '".$birth_date."';";
				$res = query($conn, $sql);
				if($rs = fetch_array($res)){
					$admin_pass = isset($rs["admin_pass"]) ? $rs["admin_pass"] : "";
					if (!empty($email) && !empty($admin_pass) && !empty($birth_date)) {
						$key = checkSecurity($email.$admin_pass.$birth_date, true);
					}
				} else {
					$status_detail = "ไม่มีอีเมลหรือวันเดือนปีเกิดนี้อยู่ในระบบ โปรดตรวจสอบอีเมลหรือวันเดือนปีเกิดอีกครั้ง";
				}
			} else if ($type == '2') {
				$sql = "SELECT * FROM patients WHERE p_status = '1' AND patient_email = '".$email."' AND patient_birthdate = '".$birth_date."';";
				$res = query($conn, $sql);
				if($rs = fetch_array($res)){
					$patient_pass = isset($rs["patient_pass"]) ? $rs["patient_pass"] : "";
					if (!empty($email) && !empty($patient_pass) && !empty($birth_date)) {
						$key = checkSecurity($email.$patient_pass.$birth_date, true);
					}
				} else {
					$status_detail = "ไม่มีอีเมลหรือวันเดือนปีเกิดนี้อยู่ในระบบ โปรดตรวจสอบอีเมลหรือวันเดือนปีเกิดอีกครั้ง";
				}
			}
			
		} else {
			$status_detail = "ข้อมูลไม่ครบถ้วน โปรดรีเฟรชหน้าจอ";
		}
	}

	if (!empty($key)) {
		$status = true;
		$status_detail = "new_password.php?mail=".$email."&k=".$key;
    } else if (empty($status_detail)) {
		$status_detail = "ไม่มีสามารถสร้างรหัสใหม่ได้ โปรดลองใหม่อีกครั้ง";
	}

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>