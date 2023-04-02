<?php
$data[4]['ap_id'] = 4;
$data[4]['patient_id'] = 8;
$data[4]['cham_id'] = 4;
$data[4]['cham_title'] = 'ทันตกรรม';
$data[4]['ap_date'] = '12/03/2023';
$data[4]['ap_start_time'] = '10:00:00';
$data[4]['ap_end_time'] = '10:30:00';
$data[4]['doctor_id'] = 5;
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
$data[3]['cham_id'] = 4;
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
        

foreach($data as $key => $value){
	$to = $value["patient_email"];

	$subject = "Doctor Appointment";
	$message = "
	<html>
	<head>
	<title>Doctor Appointment</title>
	</head>
	<body>
	<p>แจ้งเตือนการนัด</p>
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
?>