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
		$patient_id = isset($_POST["patient_id"]) ? $_POST["patient_id"] : "";
		$patient_title_id = isset($_POST["patient_title_id"]) ? $_POST["patient_title_id"] : "";
		
		$patient_email = isset($_POST["patient_email"]) ? $_POST["patient_email"] : "";
		$patient_birthdate = isset($_POST["patient_birthdate"]) ? dateToDB($_POST["patient_birthdate"]) : "";
		
		$patient_name = isset($_POST["patient_name"]) ? $_POST["patient_name"] : "";

		//$ap_status = isset($_POST["ap_status"]) ? $_POST["ap_status"] : "";
		//$ap_come = isset($_POST["ap_come"]) ? $_POST["ap_come"] : "";
		if (!empty($patient_id)) {
			if ($type == "save") {
				$sql = "UPDATE patients  SET patient_title_id = '".$patient_title_id."', patient_name = '".$patient_name."', patient_email = '".$patient_email."', patient_birthdate = '".$patient_birthdate."' WHERE patient_id = '".$patient_id."';";

				//$sql = "UPDATE patients  SET patient_name = '".$patient_name."' WHERE patient_id = '".$patient_id."';";
				$res = query($conn, $sql);

				if ($res) {
					$status = true;
				}
			} else if ($type == "delete") {
				$sql = "DELETE FROM patients WHERE patient_id = '".$patient_id."';";
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			}
		}
		
	}
	//echo $sql;

	if ($status == false && empty($status_detail)) {
		$status_detail = "เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>