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

    if ($security && !empty($u_id)) {
		$room = isset($_POST["room"]) ? $_POST["room"] : "";
		$doctor = isset($_POST["doctor"]) ? $_POST["doctor"] : "";
		$date = isset($_POST["date"]) ? $_POST["date"] : "null";
		$time1 = isset($_POST["time1"]) ? $_POST["time1"] : "";
		$time2 = isset($_POST["time2"]) ? $_POST["time2"] : "";
		$ap_detail = isset($_POST["ap_detail"]) ? $_POST["ap_detail"] : "";

		$dateday = DateTime::createFromFormat('Y-m-d', $date);
    	$dateday = $dateday->format('l');
		$cmd_date = strtolower(substr($dateday,0,3));
		
		$sql = "SELECT * FROM doctors WHERE doctor_enable = '1' AND doctor_id = '".$doctor."' AND doctor_".$cmd_date." = '1';";
		$res = query($conn, $sql);
		if ($rs = fetch_array($res)) {
			$sql = "INSERT INTO appointment ( patient_id, doctor_id, ap_date, ap_start_time, ap_end_time, cham_id, ap_datetime_create, ap_status, ap_come, ap_detail ) ".
								"VALUES ( '".$u_id."', '".$doctor."', '".$date."', '".$time1."', '".$time2."', '".$room."', NOW(), '0', '0', '".$ap_detail."' );";
			$res = query($conn, $sql);
			if ($res) {
				$status = true;
			}
		} else {
			$status_detail = "แพทย์ท่านนี้ไม่ได้เข้าวันที่ท่านเลือก<br>โปรดเลือกนัดวันใหม่";
		}
		
	}

	if ($status == false && empty($status_detail)) {
		$status_detail = "เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>