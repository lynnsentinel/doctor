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
					$sqlWhere .= "patient_title_name like '%".$search."%'";
				} else if ($type_search == '2') {
					$sqlWhere .= "patient_title_name like '%".$search."%'";
				}
			}
		} else if ($type == "id") {
			$patient_title_id = isset($_POST["patient_title_id"]) ? $_POST["patient_title_id"] : "";

			
			//$u_id = isset($_POST["u_id"]) ? $_POST["u_id"] : "";

			if (!empty($patient_title_id) || $patient_title_id==0) {
				if ($sqlWhere != "") { $sqlWhere .= " AND "; }
				$sqlWhere .= "patient_title_id = '".$patient_title_id."'";
			}
			
		}

		if ($sqlWhere != "") { $sqlWhere = " WHERE ".$sqlWhere; }

		$sql = "SELECT * FROM patient_title ".$sqlWhere;
					
		//echo $sql;
		//exit;
		$res = query($conn, $sql);
		while ($rs = fetch_array($res)) {
			$data["patient_title_id"] = isset($rs["patient_title_id"]) ? $rs["patient_title_id"] : "";

			$data["patient_title_name"] = isset($rs["patient_title_name"]) ? $rs["patient_title_name"] : "";
			

						
			if( $ret != '' ) { $ret = $ret . ',' ; } 
			$ret = $ret . json_encode($data) ; 
		}
		
		 

	}

	echo '{"data":[' . $ret . ']}';
?> 