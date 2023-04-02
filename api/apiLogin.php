<?php 
    session_start();
	include "../config/config.php";
	$conn = connection();

	$status = false;	
	$status_detail = "";	
    $security = false;

    $user_level = "";
    $_SESSION['u_id'] = "";
    $_SESSION['u_name'] = "";
    $_SESSION['u_email'] = "";
    $_SESSION['u_level'] = "";

    $http = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) ? strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) : "";
    $method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
    
    if($http == "xmlhttprequest" && $method == "POST"){    
        $security = true;
    }

    if ($security) {

        $type = isset($_POST["type"]) ? $_POST["type"]: "";
        $email = isset($_POST["email"]) ? checkSecurity($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? checkSecurity($_POST["password"]) : "";
        $password_encrypt = isset($password) ? checkSecurity($password, true) : "";

        if (!empty($email) && !empty($password)) {
            if ($type == '1') {
                $sql = "SELECT * FROM admin WHERE u_status = '1' AND admin_email = '".$email."' AND admin_pass = '".$password_encrypt."'";
                $res = query($conn, $sql);
                if($rs = fetch_array($res)){
                    $_SESSION['u_id'] = isset($rs["admin_id"]) ? $rs["admin_id"] : "";
                    $_SESSION['u_name'] = isset($rs["admin_name"]) ? $rs["admin_name"] : "";
                    $_SESSION['u_email'] = isset($rs["admin_email"]) ? $rs["admin_email"] : "";
                    $_SESSION['u_level'] = "admin";
                } else {
                    $status_detail = "Not Admin";
                }
            } else if ($type == '2') {
                $sql = "SELECT * FROM patients WHERE p_status = '1' AND patient_email = '".$email."' AND patient_pass = '".$password_encrypt."'";
                $res = query($conn, $sql);
                if($rs = fetch_array($res)){
                    $_SESSION['u_id'] = isset($rs["patient_id"]) ? $rs["patient_id"] : "";
                    $_SESSION['u_name'] = isset($rs["patient_name"]) ? $rs["patient_name"] : "";
                    $_SESSION['u_email'] = isset($rs["patient_email"]) ? $rs["patient_email"] : "";
                    $_SESSION['u_level'] = "user";
                } else {
                    $status_detail = "Not User";
                }
            }
        } else {
            $status_detail = "Not have email or pass";
        }
    }

    if (!empty($_SESSION['u_id']) && $_SESSION['u_level'] == "admin") {
        $status = true;
        $status_detail = base_url().'view/admin/booking.php';
    } else if (!empty($_SESSION['u_id']) && $_SESSION['u_level'] == "user") {
        $status = true;
        $status_detail = base_url().'view/user/booking.php';
    } else {
        $status_detail = "Not user";
    }
    
    $res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>