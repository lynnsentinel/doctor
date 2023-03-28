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
	$data = [];
	$dataArray = [];

	$http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

    if ($security && !empty($u_id)) {

		$sql = "SELECT * FROM patients WHERE p_status = '1' AND patient_id = '".$u_id."';";
		$res = query($conn, $sql);
		while ($rs = fetch_array($res)) {
			$data["title_name"] = isset($rs["patient_title_id"]) ? $rs["patient_title_id"] : "";
			$data["name"] = isset($rs["patient_name"]) ? $rs["patient_name"] : "";
			$data["email"] = isset($rs["patient_email"]) ? $rs["patient_email"] : "";
			$data["birthdate"] = isset($rs["patient_birthdate"]) ? $rs["patient_birthdate"] : "";

			array_push($dataArray,$data);
			$status = true;
		}

		if (count($dataArray) <= 0) {
			$status_detail = "ไม่พบข้อมูลผู้ใช้งาน";
		}
	}

	if ($status == false && $status_detail == "") {
        $status_detail = "เกิดข้อผิดพลาด";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail,
		'data' => $dataArray
	);

	echo json_encode($res);
?>