
	<div class="contentbar">
		<!-- Start row -->
		<div class="row">							
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-body">
				
				<div class="tabset">
						  <!-- Tab 1 -->
						  <input type="radio" name="tabset" id="tab7" aria-controls="Kolawole" checked>
						  <label for="tab7" ><i class="feather icon-user-plus mr-2"></i><?php  echo lang('birth'); ?> <?php  echo lang('report'); ?></label>
						  <!-- Tab 2 -->
						  <input type="radio" name="tabset" id="tab8" aria-controls="Olawuyi">
						  <label for="tab8"> <i class="feather icon-user-x mr-2"></i><?php  echo lang('death'); ?> <?php  echo lang('report'); ?></label>
						  <!-- Tab 3 -->
						  <input type="radio" name="tabset" id="tab9" aria-controls="Baterista">
						  <label for="tab9"><i class="feather icon-user-check mr-2"></i><?php  echo lang('operation'); ?> <?php  echo lang('report'); ?></label>
						  
						  <div class="tab-panels">
							<section id="Kolawole" class="tab-panel">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('birth'); ?> <?php  echo lang('report'); ?>
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
												<th><?php echo lang('description'); ?></th>
												<th><?php echo lang('date'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($reports as $report) { if($report->type == 'birth'){?>
											<tr class="">
												<td><?php echo $this->db->get_where('patient', array('id' =>  $report->patient))->row()->name; ?></td>
												<td><?php  echo substr($report->description, 0, 77) . '. . .'; ?></td>
												<td><?php  echo $report->date; ?></td>
												<td>
													<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $report->id; ?>"><i class="fa fa-eye"></i> View</button>   
														
													<a class="btn btn-info btn-xs btn_width delete_button" href="report/delete?id=<?php echo $report->id; ?>" onclick="return confirm('Are you sure you want to delete this report?');"><i class="fa fa-trash-o"></i></a>
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
										<a data-toggle="modal" href="#myModalDeath">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('death'); ?> <?php  echo lang('report'); ?>
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
												<th><?php echo lang('description'); ?></th>
												<th><?php echo lang('cause_of_death'); ?></th>
												<th><?php echo lang('date'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($reports as $report) { if($report->type == 'death'){?>
											<tr class="">
												<td><?php echo $this->db->get_where('patient', array('id' =>  $report->patient))->row()->name; ?></td>
												<td><?php  echo substr($report->description, 0, 77) . '. . .'; ?></td>
												<td><?php  echo $report->death_cause; ?></td>
												<td><?php  echo $report->date; ?></td>
												<td>
													<button type="button" class="btn btn-info btn-xs btn_width editbutton2" data-toggle="modal" data-id="<?php echo $report->id; ?>"><i class="fa fa-eye"></i> View</button>   
														
													<a class="btn btn-info btn-xs btn_width delete_button" href="report/delete?id=<?php echo $report->id; ?>" onclick="return confirm('Are you sure you want to delete this report?');"><i class="fa fa-trash-o"></i></a>
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
										<a data-toggle="modal" href="#myModalSurgery">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('operation'); ?> <?php  echo lang('report'); ?>
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
												<th><?php echo lang('description'); ?></th>
												<th><?php echo lang('date'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($reports as $report) { if($report->type == 'operation'){?>
											<tr class="">
												<td><?php echo $this->db->get_where('patient', array('id' =>  $report->patient))->row()->name; ?></td>
												<td><?php  echo substr($report->description, 0, 77) . '. . .'; ?></td>
												<td><?php  echo $report->date; ?></td>
												<td>
													<button type="button" class="btn btn-info btn-xs btn_width editbutton22" data-toggle="modal" data-id="<?php echo $report->id; ?>"><i class="fa fa-eye"></i> View</button>   
														
													<a class="btn btn-info btn-xs btn_width delete_button" href="report/delete?id=<?php echo $report->id; ?>" onclick="return confirm('Are you sure you want to delete this report?');"><i class="fa fa-trash-o"></i></a>
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






<!-- Add Birth Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Birth Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="report/addNew" method="post" enctype="multipart/form-data">
				<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control js-example-basic-single" name="patient" value='' required> 
						<option value="">Select Patient...</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					
         
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control js-example-basic-single" name="doctor" value='' required> 
						<option value="">Select Doctor...</option>
							<?php foreach ($staffs as $staff) { if($staff->profile == 'Doctor'){?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('date'); ?>  </label>
						<input  type="text" class="form-control  default-date-picker" name="date" value=""   autocomplete="off"  placeholder="" required>							                  
						</div>
					</div>
					</div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                       <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
				   
					<input  type="hidden" class="form-control" name="type" value="birth" >							                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Report Modal-->




<!-- Add Death Modal-->
<div class="modal fade" id="myModalDeath" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Death Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="report/addNew" method="post" enctype="multipart/form-data">
				<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control js-example-basic-single" name="patient" value='' required> 
						<option value="">Select Patient...</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					
         
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control js-example-basic-single" name="doctor" value='' required> 
						<option value="">Select Doctor...</option>
							<?php foreach ($staffs as $staff) { if($staff->profile == 'Doctor'){?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('date'); ?>  </label>
						<input  type="text" class="form-control  default-date-picker" name="date" value=""   autocomplete="off"  placeholder="" required>							                  
						</div>
					</div>
					</div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('cause_of_death'); ?></label>
                       <input type="text" class="form-control" name="death_cause" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                       <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
				   
					<input  type="hidden" class="form-control" name="type" value="death" >							                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Report Modal-->

<!-- Add Surgery Modal-->
<div class="modal fade" id="myModalSurgery" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Operation Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="report/addNew" method="post" enctype="multipart/form-data">
				<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control js-example-basic-single" name="patient" value='' required> 
						<option value="">Select Patient...</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					
         
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control js-example-basic-single" name="doctor" value='' required> 
						<option value="">Select Doctor...</option>
							<?php foreach ($staffs as $staff) { if($staff->profile == 'Doctor'){?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('date'); ?>  </label>
						<input  type="text" class="form-control  default-date-picker" name="date" value=""   autocomplete="off"  placeholder="" required>							                  
						</div>
					</div>
					</div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                       <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
				   
					<input  type="hidden" class="form-control" name="type" value="operation" >							                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Report Modal-->







<!-- Edit Report Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Birth Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editReportForm" action="report/addNew" method="post" enctype="multipart/form-data">
				<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control " name="patient" value='' required> 
						<option value="">Select Patient...</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					
         
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control " name="doctor" value='' required> 
						<option value="">Select Doctor...</option>
							<?php foreach ($staffs as $staff) { if($staff->profile == 'Doctor'){?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('date'); ?>  </label>
						<input  type="text" class="form-control  " name="date" value=""   autocomplete="off"  placeholder="" required>							                  
						</div>
					</div>
					</div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                       <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
				   
					<input  type="hidden" class="form-control" name="type" value="birth" >							                  
					<input  type="hidden" class="form-control" name="id" value="" >							                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Report Modal-->


<!-- Edit Report Modal-->
<div class="modal fade" id="myModal22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Death Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editReportForm" action="report/addNew" method="post" enctype="multipart/form-data">
				<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control " name="patient" value='' required> 
						<option value="">Select Patient...</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					
         
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control " name="doctor" value='' required> 
						<option value="">Select Doctor...</option>
							<?php foreach ($staffs as $staff) { if($staff->profile == 'Doctor'){?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('date'); ?>  </label>
						<input  type="text" class="form-control  " name="date" value=""   autocomplete="off"  placeholder="" required>							                  
						</div>
					</div>
					</div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('cause_of_death'); ?></label>
                       <input type="text" class="form-control" name="death_cause" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                       <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
				   
					<input  type="hidden" class="form-control" name="type" value="death" >							                  
					<input  type="hidden" class="form-control" name="id" value="" >							                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Report Modal-->


<!-- Edit Operation Report Modal-->
<div class="modal fade" id="myModal222" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Operation Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editReportForm" action="report/addNew" method="post" enctype="multipart/form-data">
				<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control " name="patient" value='' required> 
						<option value="">Select Patient...</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					
         
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
						<select class="form-control " name="doctor" value='' required> 
						<option value="">Select Doctor...</option>
							<?php foreach ($staffs as $staff) { if($staff->profile == 'Doctor'){?>
								<option value="<?php echo $staff->id; ?>">
								<?php echo $staff->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
					
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('date'); ?>  </label>
						<input  type="text" class="form-control  " name="date" value=""   autocomplete="off"  placeholder="" required>							                  
						</div>
					</div>
					</div>
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                       <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="" >					
				    </div>
				   
					<input  type="hidden" class="form-control" name="type" value="operation" >							                  
					<input  type="hidden" class="form-control" name="id" value="" >							                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Report Modal-->


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
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".editbutton").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editReportForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'report/editReportByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editReportForm').find('[name="id"]').val(response.report.id).end()
			$('#editReportForm').find('[name="patient"]').val(response.report.patient).end()
			$('#editReportForm').find('[name="doctor"]').val(response.report.doctor).end()
			$('#editReportForm').find('[name="date"]').val(response.report.date).end()
			$('#editReportForm').find('[name="description"]').val(response.report.description).end()
			$('#editReportForm').find('[name="type"]').val(response.report.type).end()
			$('#editReportForm').find('[name="death_cause"]').val(response.report.death_cause).end()
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".editbutton2").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editReportForm').trigger("reset");
		$('#myModal22').modal('show');
		$.ajax({
			url: 'report/editReportByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editReportForm').find('[name="id"]').val(response.report.id).end()
			$('#editReportForm').find('[name="patient"]').val(response.report.patient).end()
			$('#editReportForm').find('[name="doctor"]').val(response.report.doctor).end()
			$('#editReportForm').find('[name="date"]').val(response.report.date).end()
			$('#editReportForm').find('[name="description"]').val(response.report.description).end()
			$('#editReportForm').find('[name="type"]').val(response.report.type).end()
			$('#editReportForm').find('[name="death_cause"]').val(response.report.death_cause).end()
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".editbutton22").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editReportForm').trigger("reset");
		$('#myModal222').modal('show');
		$.ajax({
			url: 'report/editReportByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editReportForm').find('[name="id"]').val(response.report.id).end()
			$('#editReportForm').find('[name="patient"]').val(response.report.patient).end()
			$('#editReportForm').find('[name="doctor"]').val(response.report.doctor).end()
			$('#editReportForm').find('[name="date"]').val(response.report.date).end()
			$('#editReportForm').find('[name="description"]').val(response.report.description).end()
			$('#editReportForm').find('[name="type"]').val(response.report.type).end()
			$('#editReportForm').find('[name="death_cause"]').val(response.report.death_cause).end()
		});
	});
});
</script>
