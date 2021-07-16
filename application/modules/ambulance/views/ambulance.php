<div class="contentbar">
		<!-- Start row -->
		<div class="row">							
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-body">
				
				<div class="tabset">
						  <!-- Tab 1 -->
						  <input type="radio" name="tabset" id="tab7" aria-controls="Kolawole" checked>
						  <label for="tab7" ><i class="feather icon-truck mr-2"></i><?php  echo lang('ambulance'); ?> </label>
						  <!-- Tab 2 -->
						  <input type="radio" name="tabset" id="tab8" aria-controls="Olawuyi">
						  <label for="tab8"> <i class="feather icon-phone-incoming mr-2"></i><?php  echo lang('ambulance'); ?> <?php  echo lang('calls'); ?></label>
						  
						  <div class="tab-panels">
							<section id="Kolawole" class="tab-panel">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('ambulance'); ?>
												</button>
											</div>
										</a>
									 </div>
									<div class="space15"></div>
									<div class="table_overflow">
									<table class="table table-striped table-hover table-bordered" id="bateristaworks">
										<thead>
											<tr>                     
												<th><?php echo lang('v_number'); ?></th>
												<th><?php echo lang('v_model'); ?></th>
												<th><?php echo lang('year_made'); ?></th>
												<th><?php echo lang('driver_n'); ?></th>
												<th><?php echo lang('driver_c'); ?></th>
												<th><?php echo lang('driver_l'); ?></th>
												<th><?php echo lang('v_type'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($ambulances as $ambulance) { ?>
											<tr class="">
												<td> <?php echo $ambulance->v_number; ?></td>
												<td> <?php echo $ambulance->v_model; ?></td>
												<td> <?php echo $ambulance->year_made; ?></td>
												<td> <?php echo $ambulance->driver_n; ?></td>
												<td> <?php echo $ambulance->driver_c; ?></td>
												<td> <?php echo $ambulance->driver_l; ?></td>
												<td> <?php echo $ambulance->v_type; ?></td>
												<td>
													<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $ambulance->id; ?>"><i class="fa fa-eye"></i> View</button>   
														
													<a class="btn btn-info btn-xs btn_width delete_button" href="ambulance/delete?id=<?php echo $ambulance->id; ?>" onclick="return confirm('Are you sure you want to delete this ambulance?');"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
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
										<a data-toggle="modal" href="#myModal2">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('ambulance'); ?> <?php  echo lang('call'); ?>
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
												<th><?php echo lang('phone'); ?></th>
												<th><?php echo lang('address'); ?></th>
												<th><?php echo lang('v_number'); ?></th>
												<th><?php echo lang('v_model'); ?></th>
												<th><?php echo lang('driver_n'); ?></th>
												<th><?php echo lang('date'); ?></th>
												<th><?php echo lang('amount'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($ambulance_calls as $ambulance_call) { ?>
											<tr class="">
												<td> <?php echo $this->db->get_where('patient', array('id' => $ambulance_call->patient))->row()->name; ?></td>
												<td> <?php echo $this->db->get_where('patient', array('id' => $ambulance_call->patient))->row()->phone; ?></td>
												<td> <?php echo $this->db->get_where('patient', array('id' => $ambulance_call->patient))->row()->address; ?></td>
												<td> <?php echo $this->db->get_where('ambulance', array('id' => $ambulance_call->ambulance))->row()->v_number; ?></td>
												<td> <?php echo $this->db->get_where('ambulance', array('id' => $ambulance_call->ambulance))->row()->v_model; ?></td>
												<td> <?php echo $ambulance_call->d_name; ?></td>
												<td> <?php echo $ambulance_call->date; ?></td>
												<td> <?php echo $settings->currency; ?> <?php echo $ambulance_call->amount; ?></td>
												
												<td>
													<button type="button" class="btn btn-info btn-xs btn_width editbuttoncall" data-toggle="modal" data-id="<?php echo $ambulance_call->id; ?>"><i class="fa fa-eye"></i> View</button>   
														
													<a class="btn btn-info btn-xs btn_width delete_button" href="ambulance/deleteAmbulanceCall?id=<?php echo $ambulance_call->id; ?>" onclick="return confirm('Are you sure you want to delete this ambulance?');"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
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




<!-- Add Ambulance Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Ambulance</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="ambulance/addNew" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('v_number'); ?></label>
                        <input type="text" class="form-control" name="v_number" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('v_model'); ?></label>
                        <input type="text" class="form-control" name="v_model" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('year_made'); ?></label>
                        <input type="text" class="form-control" name="year_made" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_n'); ?></label>
                        <input type="text" class="form-control" name="driver_n" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_c'); ?></label>
                        <input type="text" class="form-control" name="driver_c" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_l'); ?></label>
                        <input type="text" class="form-control" name="driver_l" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('v_type'); ?></label>
                       <select class="form-control " name="v_type" required="required" value=""> 
						        <option value=""><?php echo lang('v_type'); ?>...</option>	
								<option  value="<?php echo 'Owned'; ?>"><?php echo 'Owned'; ?></option>
								<option  value="<?php echo 'Contractual'; ?>"><?php echo 'Contractual'; ?></option>
								
						</select> </div>
                    </div>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
					<textarea  class="" name="note" value="" cols="90" id="" rows="2" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                    
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Ambulance Modal-->


<!-- Add Ambulance Call Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('add'); ?>  <?php  echo lang('ambulance'); ?> <?php  echo lang('call'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="ambulance/addNewAmbulanceCall" method="post" enctype="multipart/form-data">
				 
				 <div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
					<select class="form-control js-example-basic-single" name="patient" value='' > 
					<option value="">Select Patient</option>
						<?php foreach ($patients as $patient) { ?>
							<option value="<?php echo $patient->id; ?>">
							<?php echo $patient->name; ?>  
							</option>
						<?php } ?>
					</select>
				  </div>
				  
				  <div class="form-group">
					<label for="exampleInputEmail1"><?php echo 'Vehicle Model'; ?></label>
					<select class="form-control js-example-basic-single" name="ambulance" value='' required> 
					<option value="">Select Vehicle Model</option>
						<?php foreach ($ambulances as $ambulance) { ?>
							<option value="<?php echo $ambulance->id; ?>">
							<?php echo $ambulance->v_model; ?>  
							</option>
						<?php } ?>
					</select>
				  </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_n'); ?></label>
                        <input type="text" class="form-control" name="d_name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('amount'); ?> (<?php echo $settings->currency; ?>)</label>
                        <input type="number" class="form-control" name="amount" pattern="[0-9]{5}" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
                    
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Ambulance Modal-->

<!-- Edit Ambulance Call Modal-->
<div class="modal fade" id="myModal22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('edit'); ?>  <?php  echo lang('ambulance'); ?> <?php  echo lang('call'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAmbulanceCallForm" action="ambulance/addNewAmbulanceCall" method="post" enctype="multipart/form-data">
				 
				 <div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
					<select class="form-control " name="patient" value='' > 
					<option value="">Select Patient</option>
						<?php foreach ($patients as $patient) { ?>
							<option value="<?php echo $patient->id; ?>">
							<?php echo $patient->name; ?>  
							</option>
						<?php } ?>
					</select>
				  </div>
				  
				  <div class="form-group">
					<label for="exampleInputEmail1"><?php echo 'Vehicle Model'; ?></label>
					<select class="form-control " name="ambulance" value='' required> 
					<option value="">Select Vehicle Model</option>
						<?php foreach ($ambulances as $ambulance) { ?>
							<option value="<?php echo $ambulance->id; ?>">
							<?php echo $ambulance->v_model; ?>  
							</option>
						<?php } ?>
					</select>
				  </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_n'); ?></label>
                        <input type="text" class="form-control" name="d_name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('amount'); ?> (<?php echo $settings->currency; ?>)</label>
                        <input type="number" class="form-control" name="amount" pattern="[0-9]{5}" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Ambulance Modal-->







<!-- Edit Ambulance Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Ambulance</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAmbulanceForm" action="ambulance/addNew" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('v_number'); ?></label>
                        <input type="text" class="form-control" name="v_number" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('v_model'); ?></label>
                        <input type="text" class="form-control" name="v_model" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('year_made'); ?></label>
                        <input type="text" class="form-control" name="year_made" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_n'); ?></label>
                        <input type="text" class="form-control" name="driver_n" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_c'); ?></label>
                        <input type="text" class="form-control" name="driver_c" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('driver_l'); ?></label>
                        <input type="text" class="form-control" name="driver_l" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('v_type'); ?></label>
                        <select class="form-control " name="v_type" required="required" value=""> 
						        <option value=""><?php echo lang('v_type'); ?>...</option>	
								<option  value="<?php echo 'Owned'; ?>"><?php echo 'Owned'; ?></option>
								<option  value="<?php echo 'Contractual'; ?>"><?php echo 'Contractual'; ?></option>
								
						</select></div>
                    </div>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
					<textarea  class="" name="note" value="" cols="90" id="" rows="2" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Ambulance Modal-->


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

<script type="text/javascript">
$(document).ready(function () {
	$(".editbutton").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editAmbulanceForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'ambulance/editAmbulanceByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editAmbulanceForm').find('[name="id"]').val(response.ambulance.id).end()
			$('#editAmbulanceForm').find('[name="v_number"]').val(response.ambulance.v_number).end()
			$('#editAmbulanceForm').find('[name="v_model"]').val(response.ambulance.v_model).end()
			$('#editAmbulanceForm').find('[name="year_made"]').val(response.ambulance.year_made).end()
			$('#editAmbulanceForm').find('[name="driver_n"]').val(response.ambulance.driver_n).end()
			$('#editAmbulanceForm').find('[name="driver_c"]').val(response.ambulance.driver_c).end()
			$('#editAmbulanceForm').find('[name="driver_l"]').val(response.ambulance.driver_l).end()
			$('#editAmbulanceForm').find('[name="v_type"]').val(response.ambulance.v_type).end()
			$('#editAmbulanceForm').find('[name="note"]').val(response.ambulance.note).end()
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".editbuttoncall").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editAmbulanceCallForm').trigger("reset");
		$('#myModal22').modal('show');
		$.ajax({
			url: 'ambulance/editAmbulanceCallByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editAmbulanceCallForm').find('[name="id"]').val(response.ambulance_call.id).end()
			$('#editAmbulanceCallForm').find('[name="ambulance"]').val(response.ambulance_call.ambulance).end()
			$('#editAmbulanceCallForm').find('[name="date"]').val(response.ambulance_call.date).end()
			$('#editAmbulanceCallForm').find('[name="d_name"]').val(response.ambulance_call.d_name).end()
			$('#editAmbulanceCallForm').find('[name="patient"]').val(response.ambulance_call.patient).end()
			$('#editAmbulanceCallForm').find('[name="amount"]').val(response.ambulance_call.amount).end()
		});
	});
});
</script>
