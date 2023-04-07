<?php

//$_GET['ap_id'];

session_start();
include "../config/config.php";
$conn = connection();

$u_id = isset($_SESSION["u_id"]) ? $_SESSION["u_id"] : "";
$u_name = isset($_SESSION["u_name"]) ? $_SESSION["u_name"] : "";
$u_email = isset($_SESSION["u_email"]) ? $_SESSION["u_email"] : "";
$u_level = isset($_SESSION["u_level"]) ? $_SESSION["u_level"] : "";

//$security = false;
$ret = "";
$data = [];
//$dataArray = [];
$sqlWhere = "";
$status = false;
$security = true;


if ($security && !empty($u_id)) {

	$sqlWhere .= "a.ap_id = '".$_GET['ap_id']."' AND a.patient_id = '".$u_id."' ";

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
		$data["ap_id"] = isset($rs["ap_id"]) ? $rs["ap_id"] : "";
		$data["patient_id"] = isset($rs["patient_id"]) ? $rs["patient_id"] : "";
		$data["cham_id"] = isset($rs["cham_id"]) ? $rs["cham_id"] : "";
		$data["cham_title"] = isset($rs["cham_title"]) ? $rs["cham_title"] : "";
		$data["ap_date"] = isset($rs["ap_date"]) ? dateToPage($rs["ap_date"]) : "";
		$data["ap_start_time"] = isset($rs["ap_start_time"]) ? $rs["ap_start_time"] : "";
		$data["ap_end_time"] = isset($rs["ap_end_time"]) ? $rs["ap_end_time"] : "";
		$data["doctor_id"] = isset($rs["doctor_id"]) ? $rs["doctor_id"] : "";
		$data["doctor_title_name"] = isset($rs["doctor_title_name"]) ? $rs["doctor_title_name"] : "";
		$data["doctor_name"] = isset($rs["doctor_name"]) ? $rs["doctor_name"] : "";
		$data["patient_id"] = isset($rs["patient_id"]) ? $rs["patient_id"] : "";
		$data["patient_title_name"] = isset($rs["patient_title_name"]) ? $rs["patient_title_name"] : "";
		$data["patient_name"] = isset($rs["patient_name"]) ? $rs["patient_name"] : "";
		$data["patient_email"] = isset($rs["patient_email"]) ? $rs["patient_email"] : "";
		$data["patient_birthdate"] = isset($rs["patient_birthdate"]) ? $rs["patient_birthdate"] : "";

		$data["ap_datetime_create"] = isset($rs["ap_datetime_create"]) ? dateTimeToPage($rs["ap_datetime_create"]) : "";
		$data["ap_status"] = isset($rs["ap_status"]) ? $rs["ap_status"] : "";
		$data["ap_come"] = isset($rs["ap_come"]) ? $rs["ap_come"] : "";
		
	}
}
//$data["patient_birthdate"] = '1974-11-02';

$birthDate = explode("-", $data["patient_birthdate"]);

$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));
  
/*
echo '<pre>';
print_r($data);
echo '</pre>';
*/
error_reporting( error_reporting() & ~E_NOTICE );
define ('PDF_FONT_SIZE_DATA', 8);
define ('PDF_MARGIN_FOOTER', 8);

require_once("setPDF.php"); // ไฟล์สำหรับกำหนดรายละเอียด pdf

$pdf->SetHeaderData('', '', '', '');
$pdf->setPrintHeader(false);

$pdf->SetFooterMargin(7);
$pdf->SetFooterFont(array('freeserif', '', 8));

$pdf->SetFont('freeserif', '', 10);

$htmlcontent='';
$pdf->AddPage();
$htmlcontent.='<table style="border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">';
$htmlcontent.='<tr>';
$htmlcontent.='<td width="100%"><div align="center"><b>ใบนัดผู้ป่วย โรงพยาบาลหงส์ไทย</b></div></td>';
$htmlcontent.='</tr>';
$htmlcontent.='</table>';

$htmlcontent.='<br />';
$htmlcontent.='<table style="border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">';
$htmlcontent.='<tr>';
$htmlcontent.='<td width="15%"></td>';
$htmlcontent.='<td width="20%"><b>ชื่อ-นามสกุล</b></td>';
$htmlcontent.='<td width="25%"><b>'.$data["patient_title_name"].' '.$data["patient_name"].'</b></td>';
$htmlcontent.='<td width="5%"><b>อายุ</b></td>';
$htmlcontent.='<td width="3%"><b>'.$age.'</b></td>';
$htmlcontent.='<td width="3%"><b>ปี</b></td>';
$htmlcontent.='</tr>';
$htmlcontent.='</table>';

//$htmlcontent.='<br />';

$htmlcontent.='<table style="border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">';
$htmlcontent.='<tr>';
$htmlcontent.='<td width="15%"></td>';
$htmlcontent.='<td width="20%"><b>วันที่นัด</b></td>';
$htmlcontent.='<td width="25%"><b>'.$data["ap_date"].'</b></td>';
$htmlcontent.='<td width="5%"><b>เวลา</b></td>';
$htmlcontent.='<td width="20%"><b>'.$data["ap_start_time"].'</b></td>';
$htmlcontent.='</tr>';
$htmlcontent.='</table>';


$htmlcontent.='<table style="border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">';
$htmlcontent.='<tr>';
$htmlcontent.='<td width="15%"></td>';
$htmlcontent.='<td width="20%"><b>พบแพทย์</b></td>';
$htmlcontent.='<td width="25%"><b>'.$data["doctor_title_name"].' '.$data["doctor_name"].'</b></td>';
$htmlcontent.='<td width="5%"><b>ห้อง</b></td>';
$htmlcontent.='<td width="20%"><b>'.$data["cham_title"].'</b></td>';
$htmlcontent.='</tr>';
$htmlcontent.='</table>';


$htmlcontent=stripslashes($htmlcontent);
$htmlcontent=AdjustHTML($htmlcontent);

$pdf->writeHTML($htmlcontent, true, 0, true, 0);

ob_end_clean();
$pdf->Output('appointment_rep1.pdf', 'I');
$pdf->Close();
ob_end_flush();
?> 