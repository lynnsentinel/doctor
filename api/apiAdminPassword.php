<?php 
	session_start();
	include "../config/config.php";
	$conn = connection();

	$status = false;
	$status_detail = "";
    $security = false;
	$res2 = "";

	$http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

    if ($security) {
		$type = isset($_POST["type"]) ? $_POST["type"] : "";
		
		if ($type == 'change') {
			$admin_id = isset($_POST["admin_id"]) ? $_POST["admin_id"] : "";

			$password_new1 = isset($_POST["password_new1"]) ? checkSecurity($_POST["password_new1"], true) : "";
			


			if (!empty($password_new1)) {
				$sqlUpdate = "";
				
				
				$sqlUpdate = "UPDATE admin SET admin_pass = '".$password_new1."' WHERE admin_id = '".$admin_id."' ;";
				
				$res = query($conn, $sqlUpdate);
				$status = true;
				/*
				if($rs = fetch_array($res)){
					if ($password_new1 == $password_new2) {
						$res2 = query($conn, $sqlUpdate);
						$status = true;
					}
				} else {
					$status_detail = "รหัสผ่านเดิมไม่ถูกต้อง";
				}
				*/
				
			}
		} 
	}

	if ($status == false && empty($status_detail)) {
        $status_detail = "เปลี่ยนรหัสไม่สำเร็จ";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>