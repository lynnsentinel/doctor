<?php

require_once('config/lang/eng.php');
require_once('tcpdf.php');
require_once('htmltoolkit.php');
// ส่วนจัดการ footer


// ค่าเริ่มต้นต่างๆ สามารถเข้าไปกำหนดได้ที่ไฟล์ tcpdf_config.php ในโฟลเดอร์ config
// สร้าง PDF document ใหม่
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// กำหนดรายละเอียดของเอกสาร pdf แสดงเมื่อคลิกขวาที่ไฟล์ PDF แล้วเลือก Document Property
$pdf->SetCreator(PDF_CREATOR); // เครื่องมือสร้าง PDF  ค่าเริ่ม PDF_CREATOR = TCPDF
$pdf->SetAuthor('PANYA'); // ชื่อผู้สร้างไฟล์ PDF
$pdf->SetTitle('Doctor Appointment');//  กำหนด Title
$pdf->SetSubject('Doctor Appointment'); // กำหนด Subject
$pdf->SetKeywords('Doctor Appointment'); // กำหนด Keyword

//   กำหนดค่าเริ่มต้นสำหรับ Header
//	PDF_HEADER_LOGO  โลโก้รูปภาพส่วน Header
//	PDF_HEADER_LOGO_WIDTH ความกว้างของโลโก้ เป็น มิลเมตร (mm)
//	PDF_HEADER_TITLE หัวเรื่องของ Header
//	PDF_HEADER_STRING ข้อความที่ต้องการแสดงในส่วน header ขึ้นบรรทัดใหม่ใช้ \n
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
//$pdf->SetHeaderData('', '', 'Mathieu Kham Fabien Campion / Assistant Food & Beverage Manager', '');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// กำหนดค่าเริ่มต้น Font สำหรับช่องว่าง
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//ตั้งค่าหน้ากระดาษ
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(7, 7, 7);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);//20

//กำหนดการแบ่งหน้าอัตโนมัติ
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 15);


// กำหนดอัดราส่วนของรูปภาพ
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

// กำหนดกลุ่มภาษา
$pdf->setLanguageArray($l); 

// กำหนด Font กรณีใช้ภาษาไทยใช้ freeserif
$pdf->SetFont('freeserif', '', 20);
?>