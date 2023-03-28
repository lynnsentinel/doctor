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
		

		$doctor_title_id 	= isset($_POST["doctor_title_id"]) ? $_POST["doctor_title_id"] : "";
		$doctor_title_name = isset($_POST["doctor_title_name"]) ? $_POST["doctor_title_name"] : "";

		
		if (!empty($doctor_title_id)) {

			if ($type == "save") {
				$sql = "UPDATE doctor_title  SET doctor_title_name = '".$doctor_title_name."' WHERE doctor_title_id = '".$doctor_title_id."';";

				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			} else if ($type == "delete") {
				$sql = "DELETE FROM doctor_title WHERE doctor_title_id = '".$doctor_title_id."';";
				//echo $sql;
				//exit;
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			}
		}

		if ($doctor_title_id == 0) {
			if ($type == "save") {
				$sql = "INSERT INTO doctor_title ( doctor_title_name ) ".
					"VALUES ( '".$doctor_title_name."' );";
				
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