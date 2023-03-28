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
		$ap_id = isset($_POST["ap_id"]) ? $_POST["ap_id"] : "";
		$ap_status = isset($_POST["ap_status"]) ? $_POST["ap_status"] : "";
		//$ap_sendmail = isset($_POST["ap_sendmail"]) ? $_POST["ap_sendmail"] : "";
		$ap_come = isset($_POST["ap_come"]) ? $_POST["ap_come"] : "";
		if (!empty($ap_id)) {
			if ($type == "save") {
				//$sql = "UPDATE appointment SET ap_status = '".$ap_status."',ap_sendmail = '".$ap_sendmail."', ap_come = '".$ap_come."' WHERE ap_id = '".$ap_id."';";
				$sql = "UPDATE appointment SET ap_status = '".$ap_status."', ap_come = '".$ap_come."' WHERE ap_id = '".$ap_id."';";
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			} else if ($type == "delete") {
				$sql = "DELETE FROM appointment WHERE ap_id = '".$ap_id."';";
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			}
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