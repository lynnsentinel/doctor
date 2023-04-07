<?php 
	session_start();
	include "../config/config.php";
	$conn = connection();

	$u_id = isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "";
	$u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
	$u_email = isset($_SESSION["u_email"]) ? $_SESSION["u_email"] : "";
	$u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";

	$type = isset($_POST["type"]) ? $_POST["type"] : "";

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

	if ($security && !empty($u_id)) {

		if ($u_level == "admin" && $type == "search") {
			$type_search = isset($_POST["type_search"]) ? $_POST["type_search"] : "";
			$search = isset($_POST["search"]) ? $_POST["search"] : "";

			if (!empty($search)) {
				if ($sqlWhere != "") { $sqlWhere .= " AND "; }
				if ($type_search == '1') {
					$sqlWhere .= "p.patient_name like '%".$search."%'";
				} else if ($type_search == '2') {
					$sqlWhere .= "d.doctor_name like '%".$search."%'";
				}
			}
		} else if ($type == "id") {
			$ap_id = isset($_POST["ap_id"]) ? $_POST["ap_id"] : "";
			$u_id = isset($_POST["u_id"]) ? $_POST["u_id"] : "";

			if (!empty($ap_id)) {
				if ($sqlWhere != "") { $sqlWhere .= " AND "; }
				$sqlWhere .= "a.ap_id = '".$ap_id."'";
			}
			if (!empty($u_id)) {
				if ($sqlWhere != "") { $sqlWhere .= " AND "; }
				$sqlWhere .= "a.patient_id = '".$u_id."'";
			}
		}	else if ($type == "id2") {
			$ap_id = isset($_POST["ap_id"]) ? $_POST["ap_id"] : "";
			$u_id = isset($_POST["u_id"]) ? $_POST["u_id"] : "";

			if (!empty($ap_id)) {
				if ($sqlWhere != "") { $sqlWhere .= " AND "; }
				$sqlWhere .= "a.ap_id = '".$ap_id."'";
			}
			if (!empty($u_id)) {
				if ($sqlWhere != "") { $sqlWhere .= " AND "; }
				$sqlWhere .= "a.patient_id = '".$u_id."' AND  a.ap_date >= CURDATE() ";
			}
		}

		if ($sqlWhere != "") { $sqlWhere = " WHERE ".$sqlWhere; }
		

		$sqlOrder = " ORDER BY a.ap_date DESC";

		$sql = "SELECT a.*, dt.doctor_title_name, d.doctor_name, pt.patient_title_name, p.patient_name, p.patient_email, c.cham_id, c.cham_title FROM appointment a ".
				"INNER JOIN doctors d ON d.doctor_id = a.doctor_id ".
				"INNER JOIN doctor_title dt ON dt.doctor_title_id = d.doctor_title_id ".
				"INNER JOIN patients p ON p.patient_id = a.patient_id ".
				"INNER JOIN patient_title pt ON pt.patient_title_id = p.patient_title_id ".
				"INNER JOIN chamber c ON c.cham_id = a.cham_id".$sqlWhere.$sqlOrder;
		$res = query($conn, $sql);
		while ($rs = fetch_array($res)) {
			$data["ap_id"] = isset($rs["ap_id"]) ? $rs["ap_id"] : "";
			$data["patient_id"] = isset($rs["patient_id"]) ? $rs["patient_id"] : "";
			$data["cham_id"] = isset($rs["cham_id"]) ? $rs["cham_id"] : "";
			$data["cham_title"] = isset($rs["cham_title"]) ? $rs["cham_title"] : "";
			
			//$data["ap_date"] = isset($rs["ap_date"]) ? dateToPage($rs["ap_date"]) : "";
			if(isset($rs["ap_date"])){
				$date = str_replace('-', '/', $rs["ap_date"]);	 
				$rs["ap_date"] = (substr($date, 5, 2)."/".substr($date, 8, 10))."/".substr($date, 0, 4) ;
			}
			$data["ap_date"] = isset($rs["ap_date"]) ? $rs["ap_date"] : "";

			$data["ap_start_time"] = isset($rs["ap_start_time"]) ? $rs["ap_start_time"] : "";
			$data["ap_end_time"] = isset($rs["ap_end_time"]) ? $rs["ap_end_time"] : "";
			$data["doctor_id"] = isset($rs["doctor_id"]) ? $rs["doctor_id"] : "";
			$data["doctor_title_name"] = isset($rs["doctor_title_name"]) ? $rs["doctor_title_name"] : "";
			$data["doctor_name"] = isset($rs["doctor_name"]) ? $rs["doctor_name"] : "";
			$data["patient_id"] = isset($rs["patient_id"]) ? $rs["patient_id"] : "";
			$data["patient_title_name"] = isset($rs["patient_title_name"]) ? $rs["patient_title_name"] : "";
			$data["patient_name"] = isset($rs["patient_name"]) ? $rs["patient_name"] : "";
			$data["patient_email"] = isset($rs["patient_email"]) ? $rs["patient_email"] : "";
			$data["ap_datetime_create"] = isset($rs["ap_datetime_create"]) ? dateTimeToPage($rs["ap_datetime_create"]) : "";
			$data["ap_status"] = isset($rs["ap_status"]) ? $rs["ap_status"] : "";
			$data["ap_sendmail"] = isset($rs["ap_sendmail"]) ? $rs["ap_sendmail"] : "";
			$data["ap_come"] = isset($rs["ap_come"]) ? $rs["ap_come"] : "";

			$data["ap_detail"] = isset($rs["ap_detail"]) ? $rs["ap_detail"] : "";
			
			if( $ret != '' ) { $ret = $ret . ',' ; } 
			$ret = $ret . json_encode($data) ; 
		}
	}

	echo '{"data":[' . $ret . ']}';
?> 