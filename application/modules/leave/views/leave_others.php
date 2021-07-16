<?php 
	if ($this->ion_auth->in_group(array('Staff'))) {
	$staff_ion_id = $this->ion_auth->get_user_id();
	$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
	$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
	$permissions = $this->staff_model->getStaffById($staff)->permission;
	$permission1 = explode(',', $permissions);
	} 		
?>


<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('list'); ?> <?php  echo lang('my'); ?> <?php  echo lang('leave_app'); ?></h5>
				</div>
				<div class="card-body">
				
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
						
						<a data-toggle="modal" href="#myModal">
							<div class="btn-group">
								<button id="" class="btn green">
									<i class="fa fa-plus-circle"></i>   <?php  echo lang('leave_apply'); ?>
								</button>
							</div>
						</a>
						
                     </div>
					 
					
                    <div class="space15"></div>
					<div class="table_overflow">
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>                       
                                <th><?php echo lang('staff'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('from_date'); ?> - <?php echo lang('to_date'); ?></th>
								<th><?php echo lang('description'); ?></th>
								<th><?php echo lang('status'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($leaves as $leave) { 
						$staff_ion_id = $this->ion_auth->get_user_id();
						$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
       
						if($staff === $leave->staff){
						?>
                            <tr class="">
                                <td> <?php echo $this->db->get_where('staff', array('id' => $leave->staff))->row()->name;?> 
								     <br>(<?php echo $this->db->get_where('staff', array('id' => $leave->staff))->row()->profile; ?>)
								</td>
                                <td> <?php echo $this->db->get_where('staff', array('id' => $leave->staff))->row()->dept;?></td>
                                <td> <?php echo $leave->type; ?></td>
                                <td><?php  echo $leave->from_day; ?> - <?php  echo $leave->to_day; ?></td>
                                <td><?php  echo substr($leave->description, 0, 20) . '. . .'; ?></td>
                                <td>
								<?php
									if (empty($leave->status)) {
										echo '<p class="btn btn-xs btn_width process_po">'.lang('pending').'</p>';
									} elseif ($leave->status == 'approved') {
										echo '<p class="btn btn-xs btn_width paid_po" >'.lang('approved').'</p>';
									}elseif ($leave->status == 'declined') {
										echo '<p class="btn btn-xs btn_width decline_po" >'.lang('declined').'</p>';
									}
								?>
								</td>
                              
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs btn_width viewbutton" data-toggle="modal"  data-id="<?php echo $leave->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                    
							    </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
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
<!-- page end-->
</section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add leave Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('leave_apply'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="leave/addNew" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('from_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" autocomplete="off" name="from_day" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('to_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="to_day"  autocomplete="off" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('category'); ?> </label>
						<select class="form-control js-example-basic-single"  name="type" required>  
								<option value="">Select Category...</option>	
								<option value="Study Leave">Study Leave</option>
								<option value="Paternity/Maternity Leave">Paternity/Maternity Leave</option>
								<option value="Medical Leave">Medical Leave</option>
								<option value="Bereavement Leave">Bereavement Leave</option>
								<option value="Unpaid Leave">Unpaid Leave</option>
								<option value="Sabbatical Leave">Sabbatical Leave</option>
								<option value="General">General</option>
								<option value="Holiday">Holiday</option>
								<option value="Vacation">Vacation</option>
								<option value="Others">Others - Specify in description</option>
						</select>
					</div>
					</div>
					</div>
					
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="" name="description" value="" cols="53" id="" rows="4" placeholder=""></textarea>							                  
				   </div>
				   </div>
				   </div>
                    
                    <section class="">
                        <button type="submit" name="submit" onclick="return confirm('Are you sure you want to submit application');" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add leave Modal-->







<!-- Edit leave Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i> View leave</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editleaveForm" action="" method="post" enctype="multipart/form-data">
                  <div class="row">
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('from_date'); ?></label>
                        <input type="text" class="form-control " readonly autocomplete="off" name="from_day" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('to_date'); ?></label>
                        <input type="text" class="form-control " name="to_day" readonly  autocomplete="off" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <input type="text" class="form-control " name="type" readonly  autocomplete="off" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					</div>
					</div>
					
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="" name="description" value="" cols="53" id="" readonly rows="4" placeholder=""></textarea>							                  
				   </div>
				   </div>
				   </div>
                    
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit leave Modal-->


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

<script type="text/javascript">
$(document).ready(function () {
	$(".viewbutton").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editleaveForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'leave/editleaveByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editleaveForm').find('[name="id"]').val(response.leave.id).end()
			$('#editleaveForm').find('[name="type"]').val(response.leave.type).end()
			$('#editleaveForm').find('[name="to_day"]').val(response.leave.to_day).end()
			$('#editleaveForm').find('[name="from_day"]').val(response.leave.from_day).end()
			$('#editleaveForm').find('[name="description"]').val(response.leave.description).end()
		});
	});
});
</script>
