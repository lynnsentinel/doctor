<?php 
	session_start();
	include "../config/config.php";
	$conn = connection();

	$u_id = isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "";
	$u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
	$u_email = isset($_SESSION["u_email"]) ? $_SESSION["u_email"] : "";
	$u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";


    $security = false;
	$ret = "";
	$data = [];
	$dataArray = [];
	$sqlWhere = "";

	$status = false;

	$http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

	if ($security) {
		$room = isset($_POST["room"]) ? $_POST["room"] : "";
		
		$sql = "SELECT d.*, t.doctor_title_name FROM doctors d LEFT JOIN doctor_title t ON d.doctor_title_id = t.doctor_title_id WHERE d.doctor_enable = '1' AND d.cham_id = '".$room."';";
		$res = query($conn, $sql);
		while ($rs = fetch_array($res)) {
			$data["doctor_id"] = isset($rs["doctor_id"]) ? $rs["doctor_id"] : "";
			$data["doctor_title_name"] = isset($rs["doctor_title_name"]) ? $rs["doctor_title_name"] : "";
			$data["doctor_name"] = isset($rs["doctor_name"]) ? $rs["doctor_name"] : "";
			$data["doctor_mon"] = isset($rs["doctor_mon"]) ? $rs["doctor_mon"] : "";
			$data["doctor_tue"] = isset($rs["doctor_tue"]) ? $rs["doctor_tue"] : "";
			$data["doctor_wed"] = isset($rs["doctor_wed"]) ? $rs["doctor_wed"] : "";
			$data["doctor_thu"] = isset($rs["doctor_thu"]) ? $rs["doctor_thu"] : "";
			$data["doctor_fri"] = isset($rs["doctor_fri"]) ? $rs["doctor_fri"] : "";
			$data["doctor_sat"] = isset($rs["doctor_sat"]) ? $rs["doctor_sat"] : "";
			$data["doctor_sun"] = isset($rs["doctor_sun"]) ? $rs["doctor_sun"] : "";
			
			if( $ret != '' ) { $ret = $ret . ',' ; } 
			$ret = $ret . json_encode($data) ; 
		}
	}

	echo '{"data":[' . $ret . ']}';
?> 