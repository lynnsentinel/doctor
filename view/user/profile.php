<?php 
	include "layout/layout.php";
	$conn = connection();

	$option_name = "";

	$sql = "SELECT * FROM patient_title WHERE patient_title_enable = '1'";
	$res = query($conn, $sql);
	while($rs = fetch_array($res)){
		$option_name .= '<option value="'.$rs['patient_title_id'].'">'.$rs['patient_title_name'].'</option>';
	}
?>
<!doctype html>
<html lang="en">

	<?php layout_Head(); ?>

	<body>
		<div class="main-wrapper main-wrapper-1">
			<?php layout_TopMenu(); ?>

			<div class="main-content">
				<section class="section m-0">
					<div class="section-body-full p-3">
						<div class="row mt-4">
							<div class="col-12 col-lg-4 m-auto">
								<div class="card shadow">
									<div class="card-body h-100">
										<div class="row">
											<div class="col-12">
												<h5 class="text-center">ข้อมูลผู้ใช้งาน</h5>
											</div>
										</div>
										
											<form method="POST" action="#" class="needs-validation"> <!--was-validated-->
												<div class="row mt-5">
													<div class="col-12 col-md-8 col-lg-4">
														<div class="form-group m-0">
															<label>คำนำหน้า</label>
															<select id="title_name" class="form-control" tabindex="1" required>
																<option value="" selected>---โปรดเลือก---</option>
																<?php echo $option_name; ?>
															</select>
															<div class="invalid-feedback">
																โปรดเลือกคำนำหน้า
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12">
														<div class="form-group m-0 mt-2">
															<label for="name">ชื่อ</label>
															<input id="name" type="text" class="form-control" name="name" tabindex="2" required>
															<div class="invalid-feedback">
																โปรดกรอกชื่อ
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12">
														<div class="form-group m-0 mt-2">
															<label for="email">อีเมล</label>
															<input id="email" type="email" class="form-control" name="email" disabled>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12">
														<div class="form-group m-0 mt-2">
															<label for="email">วันเดือนปีเกิด</label>
															<input id="birth_date" type="date" class="form-control" name="birth_date" tabindex="5" required>
															<div class="invalid-feedback">
																โปรดกรอกวันเดือนปีเกิด
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12">
														<div class="form-group mt-5">
															<button type="button" class="btn btn-primary btn-lg btn-block" onclick="saveData()">บันทึก</button>
														</div>
													</div>
												</div>
											</form>
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

<script>
	$(document).ready(function () {
		loadData()
	});

	function loadData() {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>api/apiProfileGet.php",
			data: {},
			dataType: "json",
			beforeSend: function() { },
			success: function(data) {
				if(data.status){
					const arr = data.data
					arr.map(e=>{
						$('#title_name').val(e.title_name).change();
						$('#name').val(e.name);
						$('#email').val(e.email);
						$('#birth_date').val(e.birthdate);
					});
				} else {
					Swal.fire({
						title: 'เกิดข้อผิดพลาด ลองทำรายการใหม่อีกครั้ง',
						icon: 'error',
						confirmButtonText: 'ตกลง',
						confirmButtonColor: '#dc3545',
						allowOutsideClick: false,
					}).then((result) => {
						if (result.value) {
							window.location.href = '<?php echo base_url(); ?>';
						}
					});
				}
			},
			error: function(request, status, error) { 
				Swal.fire({
					title: 'เกิดข้อผิดพลาด ลองทำรายการใหม่อีกครั้ง',
					icon: 'error',
					confirmButtonText: 'ตกลง',
					confirmButtonColor: '#dc3545',
					allowOutsideClick: false,
				}).then((result) => {
					if (result.value) {
						window.location.href = '<?php echo base_url(); ?>';
					}
				});
			}
		});
	}

	function saveData() {
		let status = checkData();
		if (status) {
			let dataArr = "";
			let title_name = $('#title_name').val();
			let name = $('#name').val();
			let email = $('#email').val();
			let birth_date = $('#birth_date').val();

			dataArr = { 'type':'save', 'title_name':title_name, 'name':name, 'email': email, 'birth_date':birth_date }

			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>api/apiProfileSave.php",
				data: dataArr,
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
								$('.top-uname').html(name);
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
		}
	}

	function checkData() {
		let status = false;
		let title_name = $('#title_name').val();
		let name = $('#name').val();
		let email = $('#email').val();
		let birth_date = $('#birth_date').val();

		$('.needs-validation').addClass('was-validated');

		if (title_name != "" && name != "" && email != "" && birth_date != "") {
			// let check_mail = validateEmail(email);
			// if (check_mail) {
				$('.needs-validation').removeClass('was-validated');
				status = true;
			// }
		}

		return status;
	}
</script>