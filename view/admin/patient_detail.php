<?php 
	include "layout/layout.php";
	$conn = connection();

	$patient_id = isset($_GET["p"]) ? $_GET["p"] : "";
	//$option_doctor = "";
	//$option_room = "";
	$option_patient_title = "";
	// $sqlUser = "SELECT p.*, pt.patient_title_name FROM patients p INNER JOIN patient_title pt ON pt.patient_title_id = p.patient_title_id WHERE patient_id = '".$u_id."'";
	// $resU = query($conn, $sqlUser);
	// while($rsU = fetch_array($resU)){
	// 	$user_name = $rsU['patient_title_name'].$rsU['patient_name'];
	// 	$user_email = $rsU['patient_email'];
	// }

	$sqlR = "SELECT * FROM patient_title WHERE patient_title_enable = '1'";
	$resR = query($conn, $sqlR);
	while($rsR = fetch_array($resR)){
		$option_patient_title .= '<option value="'.$rsR['patient_title_id'].'">'.$rsR['patient_title_name'].'</option>';
	}

	/*
	$sqlD = "SELECT d.*, t.doctor_title_name FROM doctors d LEFT JOIN doctor_title t ON d.doctor_title_id = t.doctor_title_id WHERE d.doctor_enable = '1';";
	$resD = query($conn, $sqlD);
	while ($rsD = fetch_array($resD)) {
		$option_doctor .= '<option value="'.$rsD['doctor_id'].'">'.$rsD['doctor_title_name'].$rsD['doctor_name'].'</option>';
	}
	*/
	/*
	$sqlR = "SELECT * FROM chamber WHERE cham_enable = '1'";
	$resR = query($conn, $sqlR);
	while($rsR = fetch_array($resR)){
		$option_room .= '<option value="'.$rsR['cham_id'].'">'.$rsR['cham_title'].'</option>';
	}
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
					
					<a href="patient.php"><button type="button" class="btn btn-danger m-3">กลับไปหน้าผู้ป่วย</button></a>
				
					<div class="section-body px-3 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12 col-md-10 col-lg-6 p-0 m-auto">
								<div class="row m-0">
									<div class="col-12">
										<div class="card shadow">
											<div class="card-body">
												<h5 class="text-center">แก้ไขข้อมูลผู้ป่วย</h5>

												<div class="row mt-5">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="patient_title">คำนำหน้า</label>
															<select id="patient_title" class="form-control" name="patient_title" >
																<option value="">---โปรดเลือกคำนำหน้า---</option>
																<?php echo $option_patient_title; ?>
															</select>
														
														</div>
													</div>
												</div>

												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="name">ชื่อ</label>
															<input id="name" type="text" class="form-control" name="name" value="" >
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="email">อีเมล</label>
															<input id="email" type="email" class="form-control" name="email" value="" >
														</div>
													</div>
												</div>
												
												<div class="row mt-3">
													<div class="col-12">
														<div class="form-group m-0">
															<label for="patient_birthdate">วัน/เดือน/ปีเกิด</label>
															<input id="patient_birthdate" type="patient_birthdate" class="form-control" name="patient_birthdate" value="" >
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
	let patient_id = '<?php echo $patient_id; ?>';

	$(document).ready(function () {
		loadData()
	});


	function loadData() {
		if (patient_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiPatientGet.php",
				data: { 'type':'id', 'patient_id':patient_id },
				dataType: "json",
				beforeSend: function() {},
				success: function (res) {
					let row = res.data;
					console.log(row);
					if (row.length > 0) {
						row.map( e => {
							
							$('#patient_title').val(e.patient_title_id);
							$('#name').val(e.patient_name);
							$('#email').val(e.patient_email);
							$('#patient_birthdate').val(e.patient_birthdate);
							
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
		/*
		let ap_status = $('input[name="ap_status"]:checked').val();
		let ap_come = $('input[name="ap_come"]:checked').val();
		*/

		let patient_title_id = $('#patient_title').val();
		let patient_name = $('#name').val();
		let patient_email = $('#email').val();
		let patient_birthdate = $('#patient_birthdate').val();
		

		if (patient_id != "") {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiConfirmPatientSave.php",
				//data: {'type':'save', 'patient_id':patient_id, 'patient_title_id':patient_title, 'patient_name':name, 'patient_email':email,'patient_birthdate':patient_birthdate},

				data: {'type':'save', 'patient_id':patient_id, 'patient_title_id':patient_title_id, 'patient_name':patient_name, 'patient_email':patient_email,'patient_birthdate':patient_birthdate},
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
								window.location.href = '<?php echo base_url(); ?>view/admin/patient.php';
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