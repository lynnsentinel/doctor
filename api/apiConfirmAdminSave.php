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
	$error_message = "";

	$http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

    if ($security) {
		$type = isset($_POST["type"]) ? $_POST["type"] : "";
		

		$admin_id 	= isset($_POST["admin_id"]) ? $_POST["admin_id"] : "";
		
		$admin_name = isset($_POST["admin_name"]) ? $_POST["admin_name"] : "";
		$admin_email = isset($_POST["admin_email"]) ? $_POST["admin_email"] : "";
		$admin_birthdate = isset($_POST["admin_birthdate"]) ? $_POST["admin_birthdate"] : "";

		
		if (!empty($admin_id)) {

			if ($type == "save") {
				$sql = "SELECT * FROM admin WHERE admin_email = '".$admin_email."' AND  admin_id != '".$admin_id."';";
				$res = query($conn, $sql);
				
				$found = 0;
				while ($rs = fetch_array($res)) {
					$found = 1;
					$error_message = "อีเมล์ซ้ำ";
				}
				
				if($found == 0){
					$sql = "UPDATE admin  SET admin_name = '".$admin_name."',admin_birthdate = '".$admin_birthdate."', admin_email = '".$admin_email."' WHERE admin_id = '".$admin_id."';";

					$res = query($conn, $sql);
					if ($res) {
						$status = true;
					}
				}
				
			} else if ($type == "delete") {
				$sql = "DELETE FROM admin WHERE admin_id = '".$admin_id."';";
				//echo $sql;
				//exit;
				$res = query($conn, $sql);
				if ($res) {
					$status = true;
				}
			}
		}

		if ($admin_id == 0) {
			if ($type == "save") {

				$sql = "SELECT * FROM admin WHERE admin_email = '".$admin_email."' ";
				$res = query($conn, $sql);
				
				$found = 0;
				while ($rs = fetch_array($res)) {
					$found = 1;
					$error_message = "อีเมล์ซ้ำ";
				}
				
				if($found == 0){
					
					$sql = "INSERT INTO admin ( admin_name,admin_email ) ".
						"VALUES ( '".$admin_name."', '".$admin_email."' );";
					
					$res = query($conn, $sql);
					if ($res) {
						$status = true;
					}
					
				}
			}
			
		}
		
	}
	
	//echo $sql;

	if ($status == false && empty($status_detail)) {
		$status_detail = "เกิดข้อผิดพลาด ".$error_message." โปรดลองใหม่อีกครั้ง";
    }

	$res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>