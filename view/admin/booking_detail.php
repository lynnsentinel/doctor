<?php 
	include "layout/layout.php";
	$conn = connection();

	$ap_id = isset($_GET["p"]) ? $_GET["p"] : "";
	$option_doctor = "";
	$option_room = "";
	
	// $sqlUser = "SELECT p.*, pt.patient_title_name FROM patients p INNER JOIN patient_title pt ON pt.patient_title_id = p.patient_title_id WHERE patient_id = '".$u_id."'";
	// $resU = query($conn, $sqlUser);
	// while($rsU = fetch_array($resU)){
	// 	$user_name = $rsU['patient_title_name'].$rsU['patient_name'];
	// 	$user_email = $rsU['patient_email'];
	// }

	$sqlD = "SELECT d.*, t.doctor_title_name FROM doctors d LEFT JOIN doctor_title t ON d.doctor_title_id = t.doctor_title_id WHERE d.doctor_enable = '1';";
	$resD = query($conn, $sqlD);
	while ($rsD = fetch_array($resD)) {
		$option_doctor .= '<option value="'.$rsD['doctor_id'].'">'.$rsD['doctor_title_name'].$rsD['doctor_name'].'</option>';
	}

	$sqlR = "SELECT * FROM chamber WHERE cham_enable = '1'";
	$resR = query($conn, $sqlR);
	while($rsR = fetch_array($resR)){
		$option_room .= '<option value="'.$rsR['cham_id'].'">'.$rsR['cham_title'].'</option>';
	}
?>
<!doctype html>
<html lang="en">

	<?php layout_Head(); ?>

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

	<style>
		table#table_main tr td {
			vertical-align: middle !important;
		}
	</style>

	<body>
		<div class="main-wrapper main-wrapper-1">
			<?php layout_TopMenu(); ?>

			<div class="main-content">
				<section class="section">
					
					<a href="booking.php"><button type="button" class="btn btn-danger m-3">กลับไปหน้ารายการ</button></a>
				
					<div class="section-body px-3 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12 col-md-10 col-lg-6 p-0 m-auto">
								<div class="row m-0">
									<div class="col-12">
										<div class="card shadow">
											<div class="card-body">
												<h5 class="text-center">แก้ไขการนัดหมาย</h5>

												<div class="row mt-5">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="name">ชื่อ</label>
															<input id="name" type="text" class="form-control" name="name" value="" disabled>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="email">อีเมล</label>
															<input id="email" type="email" class="form-control" name="email" value="" disabled>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="room">ห้อง</label>
															<select id="room" class="form-control" name="room" disabled>
																<option value="">---โปรดเลือกห้อง---</option>
																<?php echo $option_room; ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="doctor">แพทย์</label>
															<select id="doctor" class="form-control" name="doctor" disabled>
																<option value="">---โปรดเลือกแพทย์---</option>
																<?php echo $option_doctor; ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="date">วันที่นัดหมาย</label>
															<input type="date" id="date" class="form-control" name="date" disabled>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-6">
														<div class="form-group m-0">
															<label for="time1">เวลา</label>
															<input type="text" id="time1" class="form-control" name="time1" disabled>
														</div>
													</div>
													<!--
													<div class="col-6">
														<div class="form-group m-0">
															<label for="time2">ถึง</label>
															<input type="time" id="time2" class="form-control" name="time2" disabled>
														</div>
													</div>
												-->
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="ap_detail">จุดประสงค์เพือ</label>
															
															<input type="text" id="ap_detail" class="form-control" name="ap_detail" disabled>
														</div>
													</div>
												</div>

												<div class="row mt-3">
													<div class="col-3">
														<div class="form-group m-0">
															<label class="mt-3">สถานะ</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_status" type="radio" id="ap_status1" value="0" name="ap_status" checked>
															<label class="form-check-label" for="ap_status1">ไม่ยืนยัน</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_status" type="radio" id="ap_status2" value="1" name="ap_status">
															<label class="form-check-label" for="ap_status2">ยืนยัน</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_status" type="radio" id="ap_status3" value="2" name="ap_status">
															<label class="form-check-label" for="ap_status3">ยกเลิก</label>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-3">
														<div class="form-group m-0">
															<label class="mt-3">การมาตามนัด</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_come" type="radio" id="ap_come1" value="0" name="ap_come" checked>
															<label class="form-check-label" for="ap_come1">ไม่ระบุ</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_come" type="radio" id="ap_come2" value="1" name="ap_come">
															<label class="form-check-label" for="ap_come2">มา</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_come" type="radio" id="ap_come3" value="2" name="ap_come">
															<label class="form-check-label" for="ap_come3">ไม่มา</label>
														</div>
													</div>
												</div>
												<!--
												<div class="row mt-3">
													<div class="col-3">
														<div class="form-group m-0">
															<label class="mt-3">ส่งเมล์แจ้งเตือน</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_sendmail" type="radio" id="ap_sendmail1" value="0" name="ap_sendmail" checked>
															<label class="form-check-label" for="ap_come1">ยังไม่ส่่ง</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input ap_sendmail" type="radio" id="ap_sendmail2" value="1" name="ap_sendmail">
															<label class="form-check-label" for="ap_come2">ส่งแล้ว</label>
														</div>
													</div>
													
												</div>
												-->

												<div class="row mt-5">
													<div class="col-12">
														<button type="button" id="btnSave" class="btn btn-primary btn-lg btn-block" onclick="saveData()">บันทึก</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</body>


</html>

<?php layout_Script(); ?>
<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script>
	let ap_id = '<?php echo $ap_id; ?>';

	$(document).ready(function () {
		loadData()
	});


	function loadData() {
		if (ap_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiBookingGet.php",
				data: { 'type':'id', 'ap_id':ap_id },
				dataType: "json",
				beforeSend: function() {},
				success: function (res) {
					let row = res.data;
					console.log(row);
					if (row.length > 0) {
						row.map( e => {
							//alert(e.ap_start_time);
							$('#name').val(e.patient_title_name+e.patient_name).attr('disabled',true);
							$('#email').val(e.patient_email).attr('disabled',true);
							$('#room').val(e.cham_id).change().attr('disabled',true);
							$('#doctor').val(e.doctor_id).change().attr('disabled',true);
							$('#date').val(formatDatetoDB(e.ap_date)).attr('disabled',true);
							//$('#time1').val(formatTimetoPage(e.ap_start_time)).attr('disabled',true);
							$('#time1').val(e.ap_start_time).attr('disabled',true);
							//$('#time2').val(formatTimetoPage(e.ap_end_time)).attr('disabled',true);
							$('input[name="ap_status"][value="'+e.ap_status+'"]').attr('checked',true);
							//$('input[name="ap_sendmail"][value="'+e.ap_sendmail+'"]').attr('checked',true);
							$('input[name="ap_come"][value="'+e.ap_come+'"]').attr('checked',true);
							$('#ap_detail').val(e.ap_detail).attr('disabled',true);
							
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
				}
			});
		}
	}

	function saveData() {
		let result = false;
		let ap_status = $('input[name="ap_status"]:checked').val();
		//let ap_sendmail = $('input[name="ap_sendmail"]:checked').val();
		let ap_come = $('input[name="ap_come"]:checked').val();

		if (ap_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiConfirmBookingSave.php",
				//data: {'type':'save', 'ap_id':ap_id, 'ap_status':ap_status, 'ap_sendmail':ap_sendmail, 'ap_come':ap_come},
				data: {'type':'save', 'ap_id':ap_id, 'ap_status':ap_status,  'ap_come':ap_come},
				dataType: "json",
				beforeSend: function() { 
				},
				success: function(data) {
					if(data.status){
						Swal.fire({
							title: 'บันทึกสำเร็จ',
							icon: 'success',
							confirmButtonText: 'ตกลง',
							confirmButtonColor: '#28a745',
							allowOutsideClick: false, // close by button only
						}).then((result) => {
							if (result.value) {
								window.location.href = '<?php echo base_url(); ?>view/admin/booking.php';
							}
						});
					} else {
						Swal.fire({
							title: 'บันทึกไม่สำเร็จ',
							text: data.status_detail,
							icon: 'error',
							confirmButtonText: 'ตกลง',
							confirmButtonColor: '#dc3545',
							allowOutsideClick: false, // close by button only
						}).then((result) => {
							if (result.value) {
								
							}
						});
					}
				},
				error: function(request, status, error) { 
					Swal.fire({
						title: 'บันทึกไม่สำเร็จ',
						text: data.status_detail,
						icon: 'error',
						confirmButtonText: 'ตกลง',
						confirmButtonColor: '#dc3545',
						allowOutsideClick: false, // close by button only
					}).then((result) => {
						if (result.value) {

						}
					});
				}
			});
		} else {
			Swal.fire({
				title: 'เกิดข้อผิดพลาด โปรดทำรายการใหม่',
				icon: 'error',
				confirmButtonText: 'ตกลง',
				confirmButtonColor: '#dc3545',
				allowOutsideClick: false,
			}).then((result) => {
				if (result.value) {
					window.location.href = '<?php echo base_url(); ?>admin';
				}
			});
		}
		
		return result;
	}

</script>