<?PHP

include "../../config/config.php";

$conn = connection();


//$security = false;

$data = [];
//$dataArray = [];
$sqlWhere = "";


$sqlWhere .= "a.ap_date = (CURDATE() + 2) AND a.ap_status != '2' ";//status ไม่เท่ากัน ยกเงิก

if ($sqlWhere != "") { $sqlWhere = " WHERE ".$sqlWhere; }

$sqlOrder = " ORDER BY a.ap_date DESC";

$sql = "SELECT a.*, dt.doctor_title_name, d.doctor_name, pt.patient_title_name, p.patient_name, p.patient_email,p.patient_birthdate, c.cham_id, c.cham_title FROM appointment a ".
		"INNER JOIN doctors d ON d.doctor_id = a.doctor_id ".
		"INNER JOIN doctor_title dt ON dt.doctor_title_id = d.doctor_title_id ".
		"INNER JOIN patients p ON p.patient_id = a.patient_id ".
		"INNER JOIN patient_title pt ON pt.patient_title_id = p.patient_title_id ".
		"INNER JOIN chamber c ON c.cham_id = a.cham_id".$sqlWhere.$sqlOrder;


$res = query($conn, $sql);
while ($rs = fetch_array($res)) {
	$data[$rs["ap_id"]]["ap_id"] = isset($rs["ap_id"]) ? $rs["ap_id"] : "";
	$data[$rs["ap_id"]]["patient_id"] = isset($rs["patient_id"]) ? $rs["patient_id"] : "";
	$data[$rs["ap_id"]]["cham_id"] = isset($rs["cham_id"]) ? $rs["cham_id"] : "";
	$data[$rs["ap_id"]]["cham_title"] = isset($rs["cham_title"]) ? $rs["cham_title"] : "";
	$data[$rs["ap_id"]]["ap_date"] = isset($rs["ap_date"]) ? dateToPage($rs["ap_date"]) : "";
	$data[$rs["ap_id"]]["ap_start_time"] = isset($rs["ap_start_time"]) ? $rs["ap_start_time"] : "";
	$data[$rs["ap_id"]]["ap_end_time"] = isset($rs["ap_end_time"]) ? $rs["ap_end_time"] : "";
	$data[$rs["ap_id"]]["doctor_id"] = isset($rs["doctor_id"]) ? $rs["doctor_id"] : "";
	$data[$rs["ap_id"]]["doctor_title_name"] = isset($rs["doctor_title_name"]) ? $rs["doctor_title_name"] : "";
	$data[$rs["ap_id"]]["doctor_name"] = isset($rs["doctor_name"]) ? $rs["doctor_name"] : "";
	$data[$rs["ap_id"]]["patient_id"] = isset($rs["patient_id"]) ? $rs["patient_id"] : "";
	$data[$rs["ap_id"]]["patient_title_name"] = isset($rs["patient_title_name"]) ? $rs["patient_title_name"] : "";
	$data[$rs["ap_id"]]["patient_name"] = isset($rs["patient_name"]) ? $rs["patient_name"] : "";
	$data[$rs["ap_id"]]["patient_email"] = isset($rs["patient_email"]) ? $rs["patient_email"] : "";
	$data[$rs["ap_id"]]["patient_birthdate"] = isset($rs["patient_birthdate"]) ? $rs["patient_birthdate"] : "";

	$data[$rs["ap_id"]]["ap_datetime_create"] = isset($rs["ap_datetime_create"]) ? dateTimeToPage($rs["ap_datetime_create"]) : "";
	$data[$rs["ap_id"]]["ap_status"] = isset($rs["ap_status"]) ? $rs["ap_status"] : "";
	$data[$rs["ap_id"]]["ap_come"] = isset($rs["ap_come"]) ? $rs["ap_come"] : "";
	
}


/*
$data[4]['ap_id'] = 4;
$data[4]['patient_id'] = 8;
$data[4]['cham_id'] = 4;
$data[4]['cham_title'] = 'ทันตกรรม';
$data[4]['ap_date'] = '12/03/2023';
$data[4]['ap_start_time'] = '10:00:00';
$data[4]['ap_end_time'] = '10:30:00';
$data[4]['doctor_id'] = 5
$data[4]['doctor_title_name'] = 'ทพญ.';
$data[4]['doctor_name'] = 'อภิชญา สุธรรมวาท';
$data[4]['patient_title_name'] = 'นาย';
$data[4]['patient_name'] = 'pomchai';
$data[4]['patient_email'] = 'pomchai@hotmail.com';
$data[4]['patient_birthdate'] = '2000-03-01';
$data[4]['ap_datetime_create'] = '10/03/2023 09:39:29';
$data[4]['ap_status'] = 0;
$data[4]['ap_come'] = 0;
        

$data[3]['ap_id'] = 3;
$data[3]['patient_id'] = 10;
$data[3]['cham_id'] => 4;
$data[3]['cham_title'] = 'ทันตกรรม';
$data[3]['ap_date'] = '12/03/2023';
$data[3]['ap_start_time'] ='09:00:00';
$data[3]['ap_end_time'] = '10:00:00';
$data[3]['doctor_id'] = 5;
$data[3]['doctor_title_name'] = 'ทพญ.';
$data[3]['doctor_name'] = 'อภิชญา สุธรรมวาท';
$data[3]['patient_title_name'] = 'นาย';
$data[3]['patient_name'] = 'pomchai2';
$data[3]['patient_email'] = 'pomchai@hotmail.com';
$data[3]['patient_birthdate'] = '2000-03-01';
$data[3]['ap_datetime_create'] = '02/03/2023 10:03:45';
$data[3]['ap_status'] = 1;
$data[3]['ap_come'] = 0;
*/        

foreach($data as $key => $value){
	$to = $value["patient_email"];

	$subject = "Doctor Appointment";
	$message = "
	<html>
	<head>
	<title>Doctor Appointment</title>
	</head>
	<body>
	<p>ใบนัดผู้ป่วย</p>
	<table>
	<tr>
	<td>ชื่อ-นามสกุล</td>
	<td>".$value["patient_title_name"].' '.$value["patient_name"]."</td>
	</tr>

	<tr>
	<td>วันที่นัด</td>
	<td>".$value["ap_date"].' เวลา :'.$value["ap_start_time"]."</td>
	</tr>

	<tr>
	<td>พบแพทย์</td>
	<td>".$value["doctor_title_name"].' เวลา : '.$value["doctor_name"].'  ห้อง : '.$value["cham_title"]."</td>
	</tr>

	</table>
	</body>
	</html>
	";

	//echo $message;
	//echo "<br />";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <pomchai@hotmail.com>' . "\r\n";
	$headers .= 'Cc: pomchai@hotmail.com' . "\r\n";

	mail($to,$subject,$message,$headers);
}



exit;
require("phpMailer/class.phpmailer.php");
$mail = new PHPMailer();

$body = "ทดสอบการส่งอีเมล์ภาษาไทย UTF-8 ผ่าน SMTP Server ด้วย PHPMailer.";

$mail->CharSet = "utf-8";
$mail->isSMTP(); // Set mailer to use SMTP
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true; // Enable smtp authentication
$mail->SMTPSecure = 'false'; // Enable "tls" encryption, "ssl" also accepted
$mail->Host = "mail.yourdomain.com"; // SMTP server "smtp.yourdomain.com" หรือ TLS/SSL : hostname By Nakhonitech : "xxx.nakhonitech.com"
$mail->Port = 25; // พอร์ท SMTP 25 / SSL: 465 or 587 / TLS: 587
$mail->Username = "email@yourdomain.com"; // account SMTP
$mail->Password = "******"; // รหัสผ่าน SMTP

$mail->SetFrom("email@yourdomain.com", "yourname");
$mail->AddReplyTo("email@yourdomain.com", "yourname");
$mail->Subject = "ทดสอบ PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress("pomchai@hotmailcom", "recipient1"); // ผู้รับคนที่หนึ่ง
//$mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง

if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
echo "Message sent!";
}
?>