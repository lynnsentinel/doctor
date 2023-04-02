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
					$sqlWhere .= "admin_name like '%".$search."%'";
				} else if ($type_search == '2') {
					$sqlWhere .= "admin_name like '%".$search."%'";
				}
			}
		} else if ($type == "id") {
			$admin_id = isset($_POST["admin_id"]) ? $_POST["admin_id"] : "";

			//$u_id = isset($_POST["u_id"]) ? $_POST["u_id"] : "";

			if (!empty($admin_id) || $admin_id==0) {
				if ($sqlWhere != "") { $sqlWhere .= " AND "; }
				$sqlWhere .= "admin_id = '".$admin_id."'";
			}
			
		}

		if ($sqlWhere != "") { $sqlWhere = " WHERE ".$sqlWhere; }

		$sql = "SELECT * FROM admin ".$sqlWhere;
					
		//echo $sql;
		//exit;
		$res = query($conn, $sql);
		while ($rs = fetch_array($res)) {
			$data["admin_id"] = isset($rs["admin_id"]) ? $rs["admin_id"] : "";

			$data["admin_name"] = isset($rs["admin_name"]) ? $rs["admin_name"] : "";
			$data["admin_email"] = isset($rs["admin_email"]) ? $rs["admin_email"] : "";
			$data["admin_birthdate"] = isset($rs["admin_birthdate"]) ? $rs["admin_birthdate"] : "";
			
			
						
			if( $ret != '' ) { $ret = $ret . ',' ; } 
			$ret = $ret . json_encode($data) ; 
		}
		
		 

	}

	echo '{"data":[' . $ret . ']}';
?> 