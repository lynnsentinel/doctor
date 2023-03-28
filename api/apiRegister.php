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
		if ($type == 'user') {
			$title_name = isset($_POST["title_name"]) ? $_POST["title_name"] : "";
			$name = isset($_POST["name"]) ? $_POST["name"] : "";
			$email = isset($_POST["email"]) ? $_POST["email"] : "";
			$password = isset($_POST["password"]) ? checkSecurity($_POST["password"], true) : "";
			$birth_date = isset($_POST["birth_date"]) ? $_POST["birth_date"] : "";
			
			if (!empty($name) && !empty($email) && !empty($password) && !empty($birth_date)) {
				$sql = "SELECT patient_id FROM patients WHERE patient_email = '".$email."';";
				$res = query($conn, $sql);
				if ($rs = fetch_array($res)) {
				} else {
					$sqlInsert = "INSERT INTO patients (patient_title_id, patient_name, patient_email, patient_pass, patient_birthdate, patient_register_date, p_status) ".
								"VALUES ('".$title_name."', '".$name."', '".$email."', '".$password."', '".$birth_date."', NOW(), 1);";
					$resInsert = query($conn, $sqlInsert);
					if ($resInsert) {
						$status = true;
					} else {
						$status_detail = "เกิดข้อผิดพลาดกับการลงทะเบียน โปรดลองใหม่อีกครั้ง";
					}
				}
			}
		}
	}

	if ($status == false && $status_detail == "") {
        $status_detail = "อีเมลนี้มีผู้ใช้งานในระบบแล้ว";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>