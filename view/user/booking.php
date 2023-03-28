<?php 
	include "layout/layout.php";
	$conn = connection();

	$user_name = "";
	$user_email = "";
	$option_room = "";
	$option_doctor = "";
	$option_time = '<option data-id="0" value="">---โปรดเลือกเวลานัดหมาย---</option>
					<option data-id="1" value="09:00-09.15">09:00-09.15 น.</option>
					<option data-id="2" value="09.15-09.30">09.15-09.30 น.</option>
					<option data-id="3" value="09.30-09.45">09.30-09.45 น.</option>
					<option data-id="4" value="09.45-10.00">09.45-10.00 น.</option>
					
					<option data-id="5" value="10.00-10.15">10.00-10.15 น.</option>
					<option data-id="6" value="10.15-10.30">10.15-10.30 น.</option>
					<option data-id="7" value="10.30-10.45">10.30-10.45 น.</option>
					<option data-id="8" value="10.45-11.00">10.45-11.00 น.</option>

					<option data-id="9" value="11.00-11.15">11.00-11.15 น.</option>
					<option data-id="10" value="11.15-11.30">11.15-11.30 น.</option>
					<option data-id="11" value="11.30-11.45">11.30-11.45 น.</option>
					<option data-id="12" value="11.45-12.00">11.45-12.00 น.</option>

					<option data-id="13" value="12.00-12.15">12.00-12.15 น.</option>
					<option data-id="14" value="12.15-12.30">12.15-12.30 น.</option>
					<option data-id="15" value="12.30-12.45">12.30-12.45 น.</option>
					<option data-id="16" value="12.45-13.00">12.45-13.00 น.</option>

					<option data-id="17" value="13.00-13.15">13.00-13.15 น.</option>
					<option data-id="18" value="13.15-13.30">13.15-13.30 น.</option>
					<option data-id="19" value="13.30-13.45">13.30-13.45 น.</option>
					<option data-id="20" value="13.45-14.00">13.45-14.00 น.</option>

					<option data-id="21" value="14.00-14.15">14.00-14.15 น.</option>
					<option data-id="22" value="14.15-14.30">14.15-14.30 น.</option>
					<option data-id="23" value="14.30-13.45">14.30-14.45 น.</option>
					<option data-id="24" value="14.45-14.00">14.45-15.00 น.</option>

					<option data-id="25" value="15.00-15.15">15.00-15.15 น.</option>
					<option data-id="26" value="15.15-15.30">15.15-15.30 น.</option>
					<option data-id="27" value="15.30-15.45">15.30-15.45 น.</option>
					<option data-id="28" value="15.45-16.00">15.45-16.00 น.</option>';


	$sqlUser = "SELECT p.*, pt.patient_title_name FROM patients p INNER JOIN patient_title pt ON pt.patient_title_id = p.patient_title_id WHERE patient_id = '".$u_id."'";
	$resU = query($conn, $sqlUser);
	while($rsU = fetch_array($resU)){
		$user_name = $rsU['patient_title_name'].$rsU['patient_name'];
		$user_email = $rsU['patient_email'];
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
					<div class="section-header">
						<div class="col-12">
							<h5>ทำการนัดหมายแพทย์</h5>
						</div>
					</div>

					<div class="section-body px-3 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12 col-md-11 col-lg-10 p-0 m-auto">
								<div class="row m-0">
									<div class="col-12 col-md-7 col-lg-6">
										<div class="card shadow">
											<div class="card-body">
												<div class="row">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="name">ชื่อ</label>
															<input id="name" type="text" class="form-control" name="name" value="<?php echo $user_name; ?>" disabled>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="email">อีเมล</label>
															<input id="email" type="email" class="form-control" name="email" value="<?php echo $user_email; ?>" disabled>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="room">ห้อง</label>
															<select id="room" class="form-control" name="room" onchange="loadOptionDoctor()">
																<option value="">---โปรดเลือกห้อง---</option>
																<?php echo $option_room; ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="doctor">แพทย์ <span class="status-doctor"></span></label>
															<select id="doctor" class="form-control" name="doctor" onchange="checkDateDoctor()">
																<option value="">---โปรดเลือกแพทย์---</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="date">วันที่นัดหมาย</label>
															<input type="date" id="date" min="<?php echo date('Y-m-d',strtotime(date('Y-m-d') . "+2 days")); ?>" class="form-control" name="date">
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-6">
														<div class="form-group m-0">
															<label for="time1">ตั้งแต่</label>
															<select id="time1" class="form-control" name="time1">
																<?php echo $option_time; ?>
															</select>
														</div>
													</div>

													
													<div class="col-6">
														<div class="form-group m-0">
															<input type="hidden" name="time2" value="00.00" >
															<!--
															<label for="time2">ถึง</label>
															<select id="time2" class="form-control" name="time2">
																<?php echo $option_time; ?>
															</select>
															-->
														</div>
													</div>
												</div>
											
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="ap_detail">ต้องการนัดหมายเพื่อ</label>
															<textarea name="ap_detail" id="ap_detail" cols="50" class="form-control" rows="3"></textarea>
														</div>
													</div>
												</div>

												<div class="row mt-5">
													<div class="col-12">
														<button type="button" id="btnSave" class="btn btn-primary btn-lg btn-block" onclick="bookingDate()">บันทึกนัดหมาย</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-5 col-lg-6">
										<div class="card shadow-lg">
											<div class="card-body py-5">
												<div class="status-booking-no">
													<h4 class="text-center text-danger">ไม่มีการนัดหมายแพทย์</h4>
												</div>
												<div class="status-booking-yes d-none">
													<h4 class="text-center text-success">มีการนัดหมายแพทย์</h4>
													<h6 class="text-center mt-4">ห้อง : <span class="s-chamber font-weight-normal"></span></h6>
													<h6 class="text-center">แพทย์ : <span class="s-doctor font-weight-normal"></span></h6>
													<h6 class="text-center">วันที่ : <span class="s-datetime font-weight-normal"></span></h6>
													<h6 class="text-center">จุดประสงค์นัดหมายเพื่อ : <span class="s-ap_detail font-weight-normal"></span></h6>
													<span id="s-ap_id" class="d-none"></span>
													<h6 class="text-center"><span class="s-btn-print font-weight-normal">
													<button tyoe="button" name="printAp" class="btn btn-primary btn-lg btn-block" onclick="printAppointment()" >พิมพ์ใบนัด</button></span></h6>

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
	let u_id = '<?php echo $u_id; ?>';
	let array_doctor = [];

	$(document).ready(function () {
		checkBooking();
	});

	function checkBooking() {
		if (u_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiBookingCheck.php",
				data: { 'u_id':u_id },
				dataType: "json",
				beforeSend: function() {},
				success: function (res) {
					if (res.status) {
						loadData();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
				}
			});
		} else {
			window.location.href = '<?php echo base_url(); ?>';
		}
	}

	function loadData() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>api/apiBookingGet.php",
			data: { 'type':'id2', 'u_id':u_id },
			dataType: "json",
			beforeSend: function() {},
			success: function (res) {
				let row = res.data;
				if (row.length > 0) {
					row.map( e => {
						
						// $('#room').val(e.cham_id).change().attr('disabled',true);
						// $('#doctor').val(e.doctor_id).change().attr('disabled',true);
						// $('#date').val(formatDatetoDB(e.ap_date)).attr('disabled',true);
						// $('#time1').val(formatTimetoPage(e.ap_start_time)).attr('disabled',true);
						// $('#time2').val(formatTimetoPage(e.ap_end_time)).attr('disabled',true);
						$('#room').attr('disabled',true);
						$('#doctor').attr('disabled',true);
						$('#date').attr('disabled',true);
						$('#time1').attr('disabled',true);
						$('#time2').attr('disabled',true);

						$('.s-chamber').html(e.cham_title);
						$('.s-doctor').html(e.doctor_title_name+e.doctor_name);
						$('.s-ap_detail').html(e.ap_detail);
						
						//$('.s-datetime').html(e.ap_date+" "+formatTimetoPage(e.ap_start_time)+"-"+formatTimetoPage(e.ap_end_time));
						$('.s-datetime').html(e.ap_date+" เวลา "+e.ap_start_time);

						$('#s-ap_id').text(e.ap_id);
						//$('#ap_detail').text(e.ap_detail);

						//alert(e.ap_id);


					});

					$('.status-booking-no').addClass('d-none');
					$('.status-booking-yes').removeClass('d-none');
					$('.status-booking-yes').removeClass('d-none');
					$('#btnSave').addClass('btn-secondary').removeClass('btn-primary').attr('disabled',true);
					
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
			}
		});
	}

	function printAppointment(){
		var ap_id = $('#s-ap_id').text();
		//window.location.href = '../../report/reportAppointment.php?ap_id='+ap_id;
		window.open('../../report/reportAppointment.php?ap_id='+ap_id, '_blank');
	}

	function checkInput() {
		let result = false;
		let room = $('#room').val();
		let doctor = $('#doctor').val();
		let date = $('#date').val();
		let time1 = $('#time1').val();
		//let time2 = $('#time2').val();

		if (room != "" && doctor != "" && date != "" && time1 != "" ) {
			let t1 = parseInt($('#time1').find('option:selected').attr('data-id'));
			//let t2 = parseInt($('#time2').find('option:selected').attr('data-id'));
			if (t1) {
				result = true;
			} else {
				Swal.fire({
					title: 'ช่วงเวลาของท่านไม่ถูกต้อง<br>โปรดเลือกเวลานัดหมายใหม่',
					icon: 'error',
					confirmButtonText: 'ตกลง',
					confirmButtonColor: '#dc3545',
					allowOutsideClick: false,
				}).then((result) => {
					if (result.value) {
						$('#time1').focus();
					}
				});
			}
		} else {
			Swal.fire({
				title: 'โปรดกรอกข้อมูลให้ครบถ้วน',
				icon: 'error',
				confirmButtonText: 'ตกลง',
				confirmButtonColor: '#dc3545',
				allowOutsideClick: false,
			}).then((result) => {
				if (result.value) {
				}
			});
		}
		return result;
	}

	function checkInput_bak() {
		let result = false;
		let room = $('#room').val();
		let doctor = $('#doctor').val();
		let date = $('#date').val();
		let time1 = $('#time1').val();
		let time2 = $('#time2').val();

		if (room != "" && doctor != "" && date != "" && time1 != "" && time2 != "") {
			let t1 = parseInt($('#time1').find('option:selected').attr('data-id'));
			let t2 = parseInt($('#time2').find('option:selected').attr('data-id'));
			if (t1 <= t2) {
				result = true;
			} else {
				Swal.fire({
					title: 'ช่วงเวลาของท่านไม่ถูกต้อง<br>โปรดเลือกเวลานัดหมายใหม่',
					icon: 'error',
					confirmButtonText: 'ตกลง',
					confirmButtonColor: '#dc3545',
					allowOutsideClick: false,
				}).then((result) => {
					if (result.value) {
						$('#time1').focus();
					}
				});
			}
		} else {
			Swal.fire({
				title: 'โปรดกรอกข้อมูลให้ครบถ้วน',
				icon: 'error',
				confirmButtonText: 'ตกลง',
				confirmButtonColor: '#dc3545',
				allowOutsideClick: false,
			}).then((result) => {
				if (result.value) {
				}
			});
		}
		return result;
	}

	function loadOptionDoctor() {
		let room = $('#room').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>api/apiOptionDoctor.php",
			data: { 'room':room },
			dataType: "json",
			beforeSend: function() {},
			success: function (res) {
				let row = res.data;
				let option = '<option value="">---โปรดเลือกแพทย์---</option>';
				if (row.length > 0) {
					row.map( e => {
						option += '<option value="'+e.doctor_id+'">'+e.doctor_title_name+' '+e.doctor_name+'</option>';
					});
					array_doctor.push(...row);
				}
				$('#doctor').html(option);
				$('#doctor').val('').change();
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
			}
		});
	}

	function checkDateDoctor() {
		let doctor = $('#doctor').val();
		if (array_doctor.length > 0 && doctor != "") {
			let html = "";
			let html_date = "";
			array_doctor.map( e => {
				if (e.doctor_id == doctor) {
					let mon = e.doctor_mon;
					let tue = e.doctor_tue;
					let wed = e.doctor_wed;
					let thu = e.doctor_thu;
					let fri = e.doctor_fri;
					let sat = e.doctor_sat;
					let sun = e.doctor_sun;
					if (mon == '1') { html_date += "<span class=\"text-primary\">จันทร์</span>"; }
					if (html_date != "") { html_date += " ";  }
					if (tue == '1') { html_date += "<span class=\"text-primary\">อังคาร</span>"; }
					if (html_date != "") { html_date += " ";  }
					if (wed == '1') { html_date += "<span class=\"text-primary\">พุธ</span>"; }
					if (html_date != "") { html_date += " ";  }
					if (thu == '1') { html_date += "<span class=\"text-primary\">พฤหัสบดี</span>"; }
					if (html_date != "") { html_date += " ";  }
					if (fri == '1') { html_date += "<span class=\"text-primary\">ศุกร์</span>"; }
					if (html_date != "") { html_date += " ";  }
					if (sat == '1') { html_date += "<span class=\"text-primary\">เสาร์</span>"; }
					if (html_date != "") { html_date += " ";  }
					if (sun == '1') { html_date += "<span class=\"text-primary\">อาทิตย์</span>"; }
				}
			});
			html = "(แพทย์ท่านนี้เข้าทุกวัน "+html_date+")";
			$('.status-doctor').html(html);
		} else {
			$('.status-doctor').html('');
		}
	}

	function bookingDate() {
		if(u_id != "") {
            let dataArr = "";
			let room = $('#room').val();
			let doctor = $('#doctor').val();
			let date = $('#date').val();
			let time1 = $('#time1').val();
			let time2 = $('#time2').val();
			
			let ap_detail = $('#ap_detail').val();

			let check = checkInput();


            dataArr = { 'room':room, 'doctor':doctor, 'date':date, 'time1':time1, 'time2':time2 , 'ap_detail':ap_detail}

			if (check) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>api/apiBookingUserSave.php",
					data: dataArr,
					dataType: "json",
					beforeSend: function() {},
					success: function (data) {
						if (data.status) {
							Swal.fire({
								title: 'นัดหมายสำเร็จ',
								icon: 'success',
								confirmButtonText: 'ตกลง',
								confirmButtonColor: '#28a745',
								allowOutsideClick: false, // close by button only
							}).then((result) => {
								if (result.value) {
									location.reload();
								}
							});
						} else {
							Swal.fire({
								title: data.status_detail,
								icon: 'error',
								confirmButtonText: 'ตกลง',
								confirmButtonColor: '#dc3545',
								allowOutsideClick: false,
							}).then((result) => {
								if (result.value) {
									$('#date').focus();
								}
							});
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) { 
						Swal.fire({
							title: 'เกิดข้อผิดพลาด ลองทำรายการใหม่อีกครั้ง',
							icon: 'error',
							confirmButtonText: 'ตกลง',
							confirmButtonColor: '#dc3545',
							allowOutsideClick: false,
						}).then((result) => {
							if (result.value) {

							}
						});
					}
				});
			} else {

			}
			
			
		} else {
			window.location.href = '<?php echo base_url(); ?>';
		}
	}
	
</script>