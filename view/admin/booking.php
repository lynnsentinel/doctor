<?php 
	include "layout/layout.php";
	$conn = connection();
?>
<!doctype html>
<html lang="en">

	<?php layout_Head(); ?>

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

	<style>
		table#table_main tr th, table#table_main tr td {
			vertical-align: middle !important;
		}
	</style>

	<body>
		<div class="main-wrapper main-wrapper-1">
			<?php layout_TopMenu(); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<div class="col-8">
							<h5>รายการนัดหมาย</h5>
						</div>
						<div class="col-4 text-right">
							<!-- <a href=""><button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button></a> -->
						</div>
					</div>

					<div class="section-body px-2 pt-0 pb-3 shadow-0">
						<div class="row m-0">
							<div class="col-12">
								<div class="card shadow">
									<div class="card-body px-1">
										<div class="row m-0">
											<div class="col-auto">
												<div class="form-group m-0 pt-2 mt-1">
													<label>ค้นหา</label>
												</div>
											</div>
											<div class="col-4 col-lg-auto">
												<div class="form-check m-0 pt-2 mt-1">
													<input class="form-check-input" type="radio" id="patient" value="1" name="type_search" checked>
													<label class="form-check-label" for="patient">ผู้ป่วย</label>
												</div>
											</div>
											<div class="col-4 col-lg-auto">
												<div class="form-check m-0 pt-2 mt-1">
													<input class="form-check-input" type="radio" id="doctor" value="2" name="type_search">
													<label class="form-check-label" for="doctor">แพทย์</label>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group m-0">
													<div class="input-group">
														<input type="search" id="search" class="form-control" placeholder="ค้นหา">
														<div class="input-group-append">
															<button class="btn btn-primary" type="button" onclick="loadTable()">ค้นหา</button>
														</div>
													</div>
												</div>
												
											</div>
										</div>

										<div class="row m-0 mt-3">
											<div class="col-12 table-responsive">
												<table id="table_main" class="table table-striped table-bordered dataTable w-100 mb-0">
													<thead class="bg-light">
														<tr>
															<!-- <th width="5%" class="text-center">ลำดับ</th> -->
															<th width="10%" class="text-center">วันที่นัดหมาย</th>
															<th width="8%" class="text-center">เวลา</th>
															<th width="15%" class="text-center">ผู้ป่วย</th>
															<th width="10%" class="text-center">ห้อง</th>
															<th width="15%" class="text-center">แพทย์</th>
															<th width="15%" class="text-center">จุดประสงค์</th>
															<th width="12%" class="text-center">วัน-เวลาทำการนัด</th>
															<th width="5%" class="text-center">สถานะ</th>
															<th width="5%" class="text-center">มา</th>
															<th width="7%" class="text-center">เมล์เตือน</th>
															<th width="8%" class="text-center"></th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
												</table>
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
	$(document).ready(function () {
		//sendmail();
		loadTable();
	});
	/*
	function sendmail(){
		$.ajax({
            url: "<?php echo base_url(); ?>api/apiAdminSendMail.php",
            data: {},
            type: "get",
            beforeSend: function (xhr) { xhr.setRequestHeader('Content-Type', 'application/json'); },
            success: function (data, status) {
            	//alert(data.data[]);
                //if (data.status == 0) {
                    
                //}
            }
        });
    }
	*/

   
	function loadTable() {
		let search = $('#search').val();
		let type_search = $('input[name="type_search"]:checked').val();

		$('#table_main').DataTable({
			destroy: true,
			searching: false,
			paging: true,
			lengthChange: false,
			pageLength: 10,
			ajax: {
				url: "<?php echo base_url(); ?>api/apiBookingGet.php",
				type: "POST",
				data: { "type":"search", "type_search":type_search, "search":search }
			},
			columns: [
 				{ data:"ap_date", class:"text-center", 
					render: function ( data, type, full, meta ){
						return data;
					}
				},
				{ data:"ap_id", class:"text-center",
					render: function ( data, type, full, meta ){
						//let html = formatTimetoPage(full.ap_start_time)+"-"+formatTimetoPage(full.ap_end_time);
						let html = full.ap_start_time;
						return html;
					} 
				},
				{ data:"patient_id", class:"", 
					render: function ( data, type, full, meta ){
						return full.patient_title_name+full.patient_name;
					}
				},
 				{ data:"cham_title", class:"",
					render: function ( data, type, full, meta ){
						return data;
					}
				},
				{ data:"doctor_id", class:"",
					render: function ( data, type, full, meta ){
						return full.doctor_title_name+full.doctor_name;
					} 
				},
				{ data:"ap_detail", class:"",
					render: function ( data, type, full, meta ){
						return data;
					} 
				},
				{ data:"ap_datetime_create", class:"",
					render: function ( data, type, full, meta ){
						return data;
					} 
				},
				{ data:"ap_status", class:"text-center",
					render: function ( data, type, full, meta ){
						let html = "";
						if (data == 0) {
							html = '<i class="fas fa-minus-circle text-warning" style="font-size:20px;"></i><span class="d-none">ไม่ระบุ</span>';
						} else if (data == 1) {
							html = '<i class="fas fa-check-circle text-success" style="font-size:20px;"></i><span class="d-none">ยืนยัน</span>';
						} else if (data == 2) {
							html = '<i class="fas fa-times-circle text-danger" style="font-size:20px;"></i><span class="d-none">ยกเลิก</span>';
						}
						return html;
					} 
				},
				{ data:"ap_come", class:"text-center",
					render: function ( data, type, full, meta ){
						let html = "";
						if (data == 0) {
							html = '<i class="fas fa-minus-circle text-warning" style="font-size:20px;"></i><span class="d-none">ไม่ระบุ</span>';
						} else if (data == 1) {
							html = '<i class="fas fa-check-circle text-success" style="font-size:20px;"></i><span class="d-none">มา</span>';
						} else if (data == 2) {
							html = '<i class="fas fa-times-circle text-danger" style="font-size:20px;"></i><span class="d-none">ไม่มา</span>';
						}
						return html;
					} 
				},
				{ data:"ap_sendmail", class:"text-center",
					render: function ( data, type, full, meta ){
						let html = "";
						if (data == 0) {
							html = '<i class="fas fa-minus-circle text-warning" style="font-size:20px;"></i><span class="d-none">ไม่ส่ง</span>';
						} else if (data == 1) {
							html = '<i class="fas fa-check-circle text-success" style="font-size:20px;"></i><span class="d-none">ส่ง</span>';
						} 
						return html;
					} 
				},
				{ data:"ap_id", class:"text-center",
					render: function ( data, type, full, meta ){
						let html = "";
						html += '<button type="button" class="btn btn-sm btn-outline-warning mx-1" onclick="editData(\''+data+'\')"><i class="fas fa-edit"></i></button>';
						html += '<button type="button" class="btn btn-sm btn-outline-danger mx-1" onclick="delData(\''+data+'\')"><i class="fas fa-trash-alt"></i></button>';
						return html;
					} 
				}
			],
			// columnDefs: [
			// 	{ orderable: false, targets: 0 }
			// ],
			order: [[0, 'desc']]
		});
	}


	function editData(id){
		window.location.href = '<?php echo base_url(); ?>view/admin/booking_detail.php?p='+id;
	}

	function delData(id){
		if (id != "") {
			Swal.fire({
				title: 'ต้องการลบรายการ?',
				icon: 'error',
				confirmButtonText: '<i class="fas fa-trash-alt"></i> ต้องการ',
				confirmButtonColor: '#dc3545',
				showCancelButton: true,
				cancelButtonText: 'ไม่',
				// cancelButtonColor: '#dc3545',
				allowOutsideClick: false, // close by button only
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>api/apiConfirmBookingSave.php",
						data: { 'type':'delete', 'ap_id':id },
						dataType: "json",
						beforeSend: function() {},
						success: function (res) {
							if (res.status) {
								Swal.fire({
									title: 'Delete Success',
									icon: 'success',
									confirmButtonText: 'OK',
									allowOutsideClick: false, // close by button only
								}).then((result) => {
									if (result.value) {
										loadTable();
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
										
									}
								});
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) { 
							Swal.fire({
								title: 'เกิดข้อผิดพลาด โปรดทำรายการใหม่',
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
				}
			});
		}
	}
</script>