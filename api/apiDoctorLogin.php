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
                $sql = "SELECT * FROM doctors WHERE doctor_enable = '1' AND doctor_email = '".$email."' AND doctor_pass = '".$password_encrypt."'";
                $res = query($conn, $sql);
                if($rs = fetch_array($res)){
                    $_SESSION['u_id'] = isset($rs["doctor_id"]) ? $rs["doctor_id"] : "";
                    $_SESSION['u_name'] = isset($rs["doctor_name"]) ? $rs["doctor_name"] : "";
                    $_SESSION['u_email'] = isset($rs["doctor_email"]) ? $rs["doctor_email"] : "";
                    $_SESSION['u_level'] = "doctor";
                } else {
                    $status_detail = "Not Admin";
                }
            } 
        } else {
            $status_detail = "Not have email or pass";
        }
    }

    if (!empty($_SESSION['u_id']) && $_SESSION['u_level'] == "doctor") {
        $status = true;
        $status_detail = base_url().'view/doctor/doctor_booking.php';
    } else {
        $status_detail = "Not user";
    }

    $res = array(
		'status' => $status,
		'status_detail' => $status_detail
	);

	echo json_encode($res);
?>