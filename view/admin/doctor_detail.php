<?php 
	include "layout/layout.php";
	$conn = connection();

	$doctor_id = isset($_GET["p"]) ? $_GET["p"] : "";
	//$option_doctor = "";
	//$option_room = "";
	$option_doctor_title = "";
	$sqlR = "SELECT * FROM doctor_title WHERE doctor_title_enable = '1'";
	$resR = query($conn, $sqlR);
	while($rsR = fetch_array($resR)){
		$option_doctor_title .= '<option value="'.$rsR['doctor_title_id'].'">'.$rsR['doctor_title_name'].'</option>';
	}

	$option_room = "";
	$sqlR = "SELECT * FROM chamber WHERE cham_enable = '1'";
	$resR = query($conn, $sqlR);
	while($rsR = fetch_array($resR)){
		$option_room .= '<option value="'.$rsR['cham_id'].'">'.$rsR['cham_title'].'</option>';
	}

	/*
	$sqlD = "SELECT d.*, t.doctor_title_name FROM doctors d LEFT JOIN doctor_title t ON d.doctor_title_id = t.doctor_title_id WHERE d.doctor_enable = '1';";
	$resD = query($conn, $sqlD);
	while ($rsD = fetch_array($resD)) {
		$option_doctor .= '<option value="'.$rsD['doctor_id'].'">'.$rsD['doctor_title_name'].$rsD['doctor_name'].'</option>';
	}
	*/
	/*
	
	*/
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
					
					<a href="doctor.php"><button type="button" class="btn btn-danger m-3">กลับไปหน้ารายชื่อแพทย์</button></a>
				
					<div class="section-body px-3 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12 col-md-10 col-lg-6 p-0 m-auto">
								<div class="row m-0">
									<div class="col-12">
										<div class="card shadow">
											<div class="card-body">
												<h5 class="text-center">แก้ไขข้อมูลแพทย์</h5>

												<form method="POST" action="#" class="needs-validation"> <!--was-validated-->
												
													<div class="row mt-3">
														<div class="col-12">
															<div class="form-group m-0">
																<label for="doctor_title">คำนำหน้า</label>
																<select id="doctor_title" class="form-control" name="doctor_title" required >
																	<option value="">---โปรดเลือกคำนำหน้า---</option>
																	<?php echo $option_doctor_title; ?>
																</select>
															</div>
														</div>
													</div>

													<div class="row mt-3">
														<div class="col-12">
															<div class="form-group m-0">
																<label for="name">ชื่อ</label>
																<input id="name" type="text" class="form-control" name="name" value="" required>
															</div>
														</div>
													</div>

													<div class="row mt-3">
														<div class="col-12">
															<div class="form-group m-0">
																<label for="doctor_email">อีเมล์</label>
																<input id="doctor_email" type="text" class="form-control" name="doctor_email" value="" required>
															</div>
														</div>
													</div>
													
													<div class="row mt-3">
														<div class="col-12">
															<div class="form-group m-0">
																<label for="cham_id">ห้อง</label>
																<select id="cham_id" class="form-control" name="cham_id" required >
																	<option value="">---โปรดเลือกห้อง---</option>
																	<?php echo $option_room; ?>
																</select>
															</div>
														</div>
													</div>

												</form>

												<div class="row mt-3">

													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1 ">
															<input class="form-check-input doctor_mon" type="checkbox" id="doctor_mon" value="1" name="doctor_mon">
															<label class="form-check-label" for="doctor_mon">จันทร์</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input doctor_tue" type="checkbox" id="doctor_tue" value="1" name="doctor_tue">
															<label class="form-check-label" for="doctor_tue">อังคาร</label>
														</div>
													</div>
													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input doctor_wed" type="checkbox" id="doctor_wed" value="1" name="doctor_wed">
															<label class="form-check-label" for="doctor_wed">พุธ</label>
														</div>
													</div>

													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input doctor_thu" type="checkbox" id="doctor_thu" value="1" name="doctor_thu">
															<label class="form-check-label" for="doctor_thu">พฤหัส</label>
														</div>
													</div>

													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input doctor_fri" type="checkbox" id="doctor_fri" value="1" name="doctor_fri">
															<label class="form-check-label" for="doctor_fri">ศุกร์</label>
														</div>
													</div>

													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input doctor_sat" type="checkbox" id="doctor_sat" value="1" name="doctor_sat">
															<label class="form-check-label" for="doctor_sat">เสาร์</label>
														</div>
													</div>

													<div class="col-3">
														<div class="form-check m-0 pt-2 mt-1">
															<input class="form-check-input doctor_sun" type="checkbox" id="doctor_sun" value="1" name="doctor_sun">
															<label class="form-check-label" for="doctor_sun">อาทิตย์</label>
														</div>
													</div>
												</div>


												




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
	let doctor_id = '<?php echo $doctor_id; ?>';

	$(document).ready(function () {
		loadData()
	});


	function loadData() {
		if (doctor_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiDoctorGet.php",
				data: { 'type':'id', 'doctor_id':doctor_id },
				dataType: "json",
				beforeSend: function() {},
				success: function (res) {
					//alert(res.data);
					let row = res.data;
					console.log(row);
					if (row.length > 0) {
						row.map( e => {
							
							$('#doctor_title').val(e.doctor_title_id);
							$('#name').val(e.doctor_name);
							$('#doctor_email').val(e.doctor_email);
							$('#cham_id').val(e.cham_id);

							$('input[name="doctor_mon"][value="'+e.doctor_mon+'"]').attr('checked',true);
							$('input[name="doctor_tue"][value="'+e.doctor_tue+'"]').attr('checked',true);
							$('input[name="doctor_wed"][value="'+e.doctor_wed+'"]').attr('checked',true);
							$('input[name="doctor_thu"][value="'+e.doctor_thu+'"]').attr('checked',true);
							$('input[name="doctor_fri"][value="'+e.doctor_fri+'"]').attr('checked',true);
							$('input[name="doctor_sat"][value="'+e.doctor_sat+'"]').attr('checked',true);
							$('input[name="doctor_sun"][value="'+e.doctor_sun+'"]').attr('checked',true);


							
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
				}
			});
		}
	}

	function saveData() {
		let status = checkData();
		let result = false;
		if (status) {
			
			/*
			let ap_status = $('input[name="ap_status"]:checked').val();
			let ap_come = $('input[name="ap_come"]:checked').val();
			*/
			
			let doctor_title_id = $('#doctor_title').val();
			let doctor_name = $('#name').val();
			let cham_id = $('#cham_id').val();
			let doctor_email = $('#doctor_email').val();
			let doctor_mon = $('input[name="doctor_mon"]:checked').val();
			let doctor_tue = $('input[name="doctor_tue"]:checked').val();
			let doctor_wed = $('input[name="doctor_wed"]:checked').val();
			let doctor_thu = $('input[name="doctor_thu"]:checked').val();
			let doctor_fri = $('input[name="doctor_fri"]:checked').val();
			let doctor_sat = $('input[name="doctor_sat"]:checked').val();
			let doctor_sun = $('input[name="doctor_sun"]:checked').val();


			if (doctor_id != "" || doctor_id == 0) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>api/apiConfirmDoctorSave.php",
					//data: {'type':'save', 'patient_id':patient_id, 'patient_title_id':patient_title, 'patient_name':name, 'patient_email':email,'patient_birthdate':patient_birthdate},

					data: {'type':'save', 'doctor_id':doctor_id,
					'doctor_title_id':doctor_title_id,
					'doctor_name':doctor_name,
					'doctor_email':doctor_email,
					'cham_id':cham_id,
					'doctor_mon':doctor_mon,
					'doctor_tue':doctor_tue,
					'doctor_wed':doctor_wed,
					'doctor_thu':doctor_thu,
					'doctor_fri':doctor_fri,
					'doctor_sat':doctor_sat,
					'doctor_sun':doctor_sun},
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
									window.location.href = '<?php echo base_url(); ?>view/admin/doctor.php';
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
						window.location.href = '<?php echo base_url(); ?>view/admin/doctor.php';
					}
				});
			}
		}else{

		}
		return result;
	}

	function checkData() {
		let status = false;

		let doctor_title_id = $('#doctor_title').val();
		let doctor_name = $('#name').val();
		let doctor_email = $('#doctor_email').val();
		let cham_id = $('#cham_id').val();


		$('.needs-validation').addClass('was-validated');

		if (doctor_title_id != "" && doctor_name != "" && doctor_email != "" && cham_id != "" ) {
			$('.needs-validation').removeClass('was-validated');
			status = true;
		}

		return status;
	}
</script>