<?php 
	session_start();
	include "../config/config.php";
	$conn = connection();

	$u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
	$u_email = isset($_SESSION["u_email"]) ? $_SESSION["u_email"] : "";
	$u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";
	$u_id = isset($_POST["u_id"]) ? $_POST["u_id"] : "";

    $security = false;
	$data = [];
	$dataArray = [];
	$sqlWhere = "";

	$status = false;

	$http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

	if ($security && !empty($u_id) && $u_id == $_SESSION["u_id"]) {
		$sql = "SELECT ap_id FROM appointment WHERE ap_status in ('0','1') AND ap_come = '0' AND ap_date >= '".date("Y-m-d")."' AND patient_id = '".$u_id."';";
		$res = query($conn, $sql);
		if ($rs = fetch_array($res)) {
			$status = true;
		}
	}

	$res = array(
		'status' => $status,
	);

	echo json_encode($res);
?> 