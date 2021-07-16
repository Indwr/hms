<?php 
	if ($this->ion_auth->in_group(array('Staff'))) {
		$staff_ion_id = $this->ion_auth->get_user_id();
		$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
		$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
		$permissions = $this->staff_model->getStaffById($staff)->permission;
		$permission1 = explode(',', $permissions);
	} 		
	$patient_ion_id = $this->ion_auth->get_user_id();
	$patientt = $this->db->get_where('patient', array('ion_user_id' => $patient_ion_id))->row()->id;
										
?>

<div class="contentbar">
		<!-- Start row -->
		<div class="row">							
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-body">
				
				<div class="tabset">
						  <!-- Tab 1 -->
						  <input type="radio" name="tabset" id="tab7" aria-controls="Kolawole" checked>
						  <label for="tab7" ><i class="feather icon-calendar mr-2"></i><?php  echo lang('todays'); ?> <?php  echo lang('appointment'); ?></label>
						  <!-- Tab 2 -->
						  <input type="radio" name="tabset" id="tab8" aria-controls="Olawuyi">
						  <label for="tab8"> <i class="feather icon-calendar mr-2"></i><?php  echo lang('upcoming'); ?> <?php  echo lang('appointment'); ?></label>
						   <!-- Tab 3 -->
						  <input type="radio" name="tabset" id="tab9" aria-controls="Baterista">
						  <label for="tab9"> <i class="feather icon-calendar mr-2"></i><?php  echo lang('all'); ?> <?php  echo lang('appointment'); ?></label>
						  <!-- Tab 4 -->
						  <input type="radio" name="tabset" id="tab19" aria-controls="Baterista1">
						  <label for="tab19"> <i class="feather icon-calendar mr-2"></i><?php  echo lang('my'); ?> <?php  echo lang('requests'); ?>
						  </label>
						  
						  <div class="tab-panels">
							<section id="Kolawole" class="tab-panel">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('request'); ?>  <?php  echo lang('appointment'); ?>
												</button>
											</div>
										</a>
									 </div>
									<div class="space15"></div>
									<div class="table_overflow">
									<table class="table table-striped table-hover table-bordered" id="bateristaworks">
										<thead>
											<tr>                     
												<th><?php echo lang('patient'); ?></th>
												<th><?php echo lang('doctor'); ?></th>
												<th><?php echo lang('department'); ?></th>
												<th><?php echo lang('date'); ?> - <?php echo lang('time'); ?></th>
												<th><?php echo lang('status'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php 
										foreach ($appointments as $appointment) { 
										if($appointment->date === date('d-m-Y') && $patientt == $appointment->patient) {
										?>
											<tr class="">
												<td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name;?></td>
												<td> <?php echo $this->db->get_where('staff', array('id' => $appointment->doctor))->row()->name; ?></td>
												<td> <?php echo $appointment->department; ?></td>
												<td> <?php echo $appointment->date; ?> - <?php echo $appointment->time; ?></td>
												<td> <?php
													if (empty($appointment->status)) {
														echo '<p class="btn btn-xs btn_width process_po">'.lang('pending').'</p>';
													} elseif ($appointment->status == 'confirm') {
														echo '<p class="btn btn-xs btn_width paid_po" >'.lang('approved').'</p>';
													}
												?></td>
												<td>
													<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $appointment->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                                <?php if ($appointment->status != 'confirm') {?>
													<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=<?php echo $appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this appointment?');"><i class="fa fa-trash-o"></i></a>
												<?php } ?>
												</td>
											</tr>
										<?php } ?>
										<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							</section>
							<section id="Olawuyi" class="tab-panel">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('request'); ?>  <?php  echo lang('appointment'); ?>
												</button>
											</div>
										</a>
									 </div>
									<div class="space15"></div>
									<div class="table_overflow">
									<table class="table table-striped table-hover table-bordered" id="bateristaworks2">
										<thead>
											<tr>                     
												<th><?php echo lang('patient'); ?></th>
												<th><?php echo lang('doctor'); ?></th>
												<th><?php echo lang('department'); ?></th>
												<th><?php echo lang('date'); ?> - <?php echo lang('time'); ?></th>
												<th><?php echo lang('status'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php 
										foreach ($appointments as $appointment) { 
										if($appointment->date > date('d-m-Y') && $patientt == $appointment->patient) { ?>
											<tr class="">
												<td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name;?></td>
												<td> <?php echo $this->db->get_where('staff', array('id' => $appointment->doctor))->row()->name; ?></td>
												<td> <?php echo $appointment->department; ?></td>
												<td> <?php echo $appointment->date; ?> - <?php echo $appointment->time; ?></td>
												<td>
												<?php
													if (empty($appointment->status)) {
														echo '<p class="btn btn-xs btn_width process_po">'.lang('pending').'</p>';
													} elseif ($appointment->status == 'confirm') {
														echo '<p class="btn btn-xs btn_width paid_po" >'.lang('approved').'</p>';
													}
												?>
												</td>
												<td>
												
													<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $appointment->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                               <?php if ($appointment->status != 'confirm') {?>
													<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=<?php echo $appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this appointment?');"><i class="fa fa-trash-o"></i></a>
												<?php } ?>
												</td>
											</tr>
										<?php } ?>
										<?php } ?>
											</tbody>
										</table>
								    </div>
						        </div>
						    </div>
							</section>
							<section id="Baterista" class="tab-panel">
							 <div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('request'); ?>  <?php  echo lang('appointment'); ?>
												</button>
											</div>
										</a>
									 </div>
									<div class="space15"></div>
									<div class="table_overflow">
									<table class="table table-striped table-hover table-bordered" id="bateristaworks22">
										<thead>
											<tr>                     
												<th><?php echo lang('patient'); ?></th>
												<th><?php echo lang('doctor'); ?></th>
												<th><?php echo lang('department'); ?></th>
												<th><?php echo lang('date'); ?> - <?php echo lang('time'); ?></th>
												<th><?php echo lang('status'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										foreach ($appointments as $appointment) { 
										if($patientt == $appointment->patient) { ?>
											<tr class="">
												<td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name;?></td>
												<td> <?php echo $this->db->get_where('staff', array('id' => $appointment->doctor))->row()->name; ?></td>
												<td> <?php echo $appointment->department; ?></td>
												<td> <?php echo $appointment->date; ?> - <?php echo $appointment->time; ?></td>
												<td> <?php
													if (empty($appointment->status)) {
														echo '<p class="btn btn-xs btn_width process_po">'.lang('pending').'</p>';
													} elseif ($appointment->status == 'confirm') {
														echo '<p class="btn btn-xs btn_width paid_po" >'.lang('approved').'</p>';
													}
												?></td>
												<td>
												<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $appointment->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                                <?php if ($appointment->status != 'confirm') {?>
													<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=<?php echo $appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this appointment?');"><i class="fa fa-trash-o"></i></a>
												<?php } ?>
												</td>
											</tr>
										<?php } ?>
										<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							</section>
							<section id="Baterista1" class="tab-panel">
							 <div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
									<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('request'); ?>  <?php  echo lang('appointment'); ?>
												</button>
											</div>
										</a>
									 </div>
									<div class="space15"></div>
									<div class="table_overflow">
									<table class="table table-striped table-hover table-bordered" id="bateristaworks222">
										<thead>
											<tr>                     
												<th><?php echo lang('patient'); ?></th>
												<th><?php echo lang('doctor'); ?></th>
												<th><?php echo lang('department'); ?></th>
												<th><?php echo lang('date'); ?> - <?php echo lang('time'); ?></th>
												<th><?php echo lang('status'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($appointments as $appointment) { 
										if(!empty($appointment->request) && $patientt == $appointment->patient) {?>
											<tr class="">
												<td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name;?></td>
												<td> <?php echo $this->db->get_where('staff', array('id' => $appointment->doctor))->row()->name; ?></td>
												<td> <?php echo $appointment->department; ?></td>
												<td> <?php echo $appointment->date; ?> - <?php echo $appointment->time; ?></td>
												<td> <?php
													if (empty($appointment->status)) {
														echo '<p class="btn btn-xs btn_width process_po">'.lang('pending').'</p>';
													} elseif ($appointment->status == 'confirm') {
														echo '<p class="btn btn-xs btn_width paid_po" >'.lang('approved').'</p>';
													}
												?></td>
												<td>
												<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $appointment->id; ?>"><i class="fa fa-eye"></i> View</button>   
													
												<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=<?php echo $appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this appointment?');"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
										<?php } ?>
										<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							</section>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<!--main content end-->
<!--footer start-->






<!-- Add Appointment Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Request Appointment</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="appointment/addNewByPatient" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control js-example-basic-single" name="doctor" value='' required> 
						<option value="">Select Doctor</option>
							<?php foreach ($staffs as $staff) { if ($staff->profile == 'Doctor'){ ?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="row">
					<div class="col-md-8">
					<div class="form-group">
					<label for="exampleInputEmail1">  <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control  default-date-picker" name="date" value=""   autocomplete="off"  placeholder="" required>							                  
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
					<label for="exampleInputEmail1">  <?php echo lang('time'); ?>  </label>
					<input type="text" class="form-control timepicker-default" name="time" id="exampleInputEmail1" value="" readonly>
                             							                  
					</div>
					</div>
					</div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="" name="description" value="" cols="52" id="" rows="3" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                   <input type="hidden" name="patient" value="<?php echo $patientt; ?>">
					<section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->







<!-- Edit Appointment Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Appointment</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAppointmentForm" action="appointment/addNewByPatient" method="post" enctype="multipart/form-data">
                    <div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control " name="doctor" value='' required readonly> 
						<option value="">Select Doctor</option>
							<?php foreach ($staffs as $staff) { if ($staff->profile == 'Doctor'){ ?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="row">
					<div class="col-md-8">
					<div class="form-group">
					<label for="exampleInputEmail1">  <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control  default-date-picker" name="date" value=""  readonly  autocomplete="off"  placeholder="" required>							                  
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
					<label for="exampleInputEmail1">  <?php echo lang('time'); ?>  </label>
					<input type="text" class="form-control timepicker-default" name="time" id="exampleInputEmail1" value="" readonly>
                             							                  
					</div>
					</div>
					</div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="" name="description" value="" cols="52" id="" rows="3" readonly placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                   <input type="hidden" name="patient" value="<?php echo $patientt; ?>">
				   <input type="hidden" name="id">
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Appointment Modal-->


<script src="common/js/bateristaworks.min.js"></script>

<script>
    $(document).ready(function () {
        $('#bateristaworks').DataTable({
            responsive: true,
            
           dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1,2,3,4,5],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#bateristaworks22').DataTable({
            responsive: true,
            
           dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1,2,3,4,5],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script><script>
    $(document).ready(function () {
        $('#bateristaworks2').DataTable({
            responsive: true,
            
           dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1,2,3,4,5],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#bateristaworks221').DataTable({
            responsive: true,
            
           dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1,2,3,4,5],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script><script>
    $(document).ready(function () {
        $('#bateristaworks222').DataTable({
            responsive: true,
            
           dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1,2,3,4,5],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".editbutton").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editAppointmentForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'appointment/editAppointmentByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editAppointmentForm').find('[name="id"]').val(response.appointment.id).end()
			//$('#editAppointmentForm').find('[name="department"]').val(response.appointment.dept).end()
			$('#editAppointmentForm').find('[name="description"]').val(response.appointment.description).end()
			$('#editAppointmentForm').find('[name="patient"]').val(response.appointment.patient).end()
			$('#editAppointmentForm').find('[name="date"]').val(response.appointment.date).end()
			$('#editAppointmentForm').find('[name="doctor"]').val(response.appointment.doctor).end()
			$('#editAppointmentForm').find('[name="time"]').val(response.appointment.time).end()
		});
	});
});
</script>
