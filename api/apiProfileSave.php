<?php 
	session_start();
	include "../config/config.php";
	$conn = connection();

	$u_id = isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "";
	$u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
	$u_email = isset($_SESSION["u_email"]) ? $_SESSION["u_email"] : "";
	$u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";

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
		if ($type == "save") {
			$patient_title_id = isset($_POST["title_name"]) ? $_POST["title_name"] : "";
			$patient_name = isset($_POST["name"]) ? $_POST["name"] : "";
			$email = isset($_POST["email"]) ? $_POST["email"] : "";
			$patient_birthdate = isset($_POST["birth_date"]) ? $_POST["birth_date"] : "";

			if (!empty($u_id)) {
				$sql = "UPDATE patients SET patient_title_id = '".$patient_title_id."', patient_name = '".$patient_name."', patient_birthdate = '".$patient_birthdate."' WHERE patient_id = '".$u_id."';";
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
					$_SESSION["u_name"] = $patient_name;
				}
			}
		} else if ($type == "delete") {
			$patient_id = isset($_POST["id"]) ? $_POST["id"] : "";
			if (!empty($patient_id)) {
				$sql = "UPDATE patients SET p_status = '0' WHERE patient_id = '".$patient_id."';";
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			}
		}
	}

	if ($status == false && $status_detail == "") {
		$status_detail = "เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>