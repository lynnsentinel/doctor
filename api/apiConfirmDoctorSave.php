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
		/*
		$patient_id = isset($_POST["patient_id"]) ? $_POST["patient_id"] : "";
		$patient_title_id = isset($_POST["patient_title_id"]) ? $_POST["patient_title_id"] : "";
		$patient_email = isset($_POST["patient_email"]) ? $_POST["patient_email"] : "";
		$patient_birthdate = isset($_POST["patient_birthdate"]) ? dateToDB($_POST["patient_birthdate"]) : "";
		$patient_name = isset($_POST["patient_name"]) ? $_POST["patient_name"] : "";
		*/

		$doctor_id 	= isset($_POST["doctor_id"]) ? $_POST["doctor_id"] : "";
		$doctor_title_id = isset($_POST["doctor_title_id"]) ? $_POST["doctor_title_id"] : "";
		$doctor_name = isset($_POST["doctor_name"]) ? $_POST["doctor_name"] : "";
		$doctor_email = isset($_POST["doctor_email"]) ? $_POST["doctor_email"] : "";
		$cham_id 	= isset($_POST["cham_id"]) ? $_POST["cham_id"] : "";
		$doctor_mon = isset($_POST["doctor_mon"]) ? $_POST["doctor_mon"] : "";
		$doctor_tue = isset($_POST["doctor_tue"]) ? $_POST["doctor_tue"] : "";
		$doctor_wed = isset($_POST["doctor_wed"]) ? $_POST["doctor_wed"] : "";
		$doctor_thu = isset($_POST["doctor_thu"]) ? $_POST["doctor_thu"] : "";
		$doctor_fri = isset($_POST["doctor_fri"]) ? $_POST["doctor_fri"] : "";
		$doctor_sat = isset($_POST["doctor_sat"]) ? $_POST["doctor_sat"] : "";
		$doctor_sun = isset($_POST["doctor_sun"]) ? $_POST["doctor_sun"] : "";

		
		if (!empty($doctor_id)) {

			if ($type == "save") {
				$sql = "UPDATE doctors  SET doctor_name = '".$doctor_name."',doctor_email = '".$doctor_email."', cham_id = '".$cham_id."', doctor_mon = '".$doctor_mon."', doctor_tue = '".$doctor_tue."', doctor_wed = '".$doctor_wed."' , doctor_thu = '".$doctor_thu."' , doctor_fri = '".$doctor_fri."' , doctor_sat = '".$doctor_sat."', doctor_sun = '".$doctor_sun."' WHERE doctor_id = '".$doctor_id."';";

				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			} else if ($type == "delete") {
				$sql = "DELETE FROM doctors WHERE doctor_id = '".$doctor_id."';";
				//echo $sql;
				//exit;
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			}
		}

		if ($doctor_id == 0) {
			if ($type == "save") {
				$sql = "INSERT INTO doctors ( doctor_title_id,doctor_name,doctor_email, cham_id, doctor_mon, doctor_tue, doctor_wed, doctor_thu, doctor_fri, doctor_sat, doctor_sun ) ".
					"VALUES ( '".$doctor_title_id."', '".$doctor_name."', '".$doctor_email."', '".$cham_id."', '".$doctor_mon."', '".$doctor_tue."', '".$doctor_wed."', '".$doctor_thu."', '".$doctor_fri."', '".$doctor_sat."', '".$doctor_sun."' );";
				
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