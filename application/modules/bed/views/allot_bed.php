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
					<h5 class="card-title"><?php  echo lang('list'); ?>   <?php echo lang('alloted'); ?> <?php echo lang('bed'); ?></h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
					<?php if (in_array('bed', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                       <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('allot'); ?> <?php echo lang('bed'); ?>
                                </button>
                            </div>
                        </a>
					<?php } ?>
                     </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks" >
                        <thead>
                            <tr>
                                <th><?php echo lang('bed'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('alloted'); ?> <?php echo lang('date'); ?></th>
                                <th><?php echo lang('discharge'); ?> <?php echo lang('date'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($alloted_beds as $alloted_bed) { ?>
                            <tr class="">
                                <td> <?php echo $this->db->get_where('bed', array('id' => $alloted_bed->bed))->row()->name; ?></td>
                                <td> <?php echo $this->db->get_where('patient', array('id' => $alloted_bed->patient))->row()->name; ?></td>
                                <td>  <?php echo $alloted_bed->a_date; ?></td>
                                <td>  <?php echo $alloted_bed->dd_date; ?></td>
								<td>
								<!--
								<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $alloted_bed->id; ?>"><i class="fa fa-edit"></i> Edit</button>   
                                 -->  
                                <a class="btn btn-info btn-xs btn_width delete_button" href="bed/deleteBedAllotment?id=<?php echo $alloted_bed->id; ?>" onclick="return confirm('Are you sure you want to delete this bed allotment?');"><i class="fa fa-trash-o"></i></a>
                               
								</td>
                            </tr>
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
    </section>
</section>



<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('allot'); ?> <?php echo lang('bed'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBedFormAllot" action="bed/admitAllotBed" method="post" enctype="multipart/form-data">
					 
					 <div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control " name="id" value='' required> 
						<option value="">Select Patient</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('bed'); ?></label>
						<select class="form-control " name="bed" value='' required> 
						<option value="">Select From Available Beds...</option>
					
							<?php foreach ($beds as $bed) { 
							$last_a_time = explode('-', $bed->last_a_time);
                            $last_d_time = explode('-', $bed->last_d_time);
                            if (!empty($last_d_time[1])) {
                                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                                if ($last_d_h_am_pm[2] == 'AM') {
                                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                } else {
                                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                }
                                $last_d_time = strtotime($last_d_time[0]) + $last_d_m;
                            }
							if (empty($bed->last_a_time) && empty($bed->last_b_time) || time() > $last_d_time) {
							
							?>
								<option value="<?php echo $bed->id; ?>">
								<?php echo $bed->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div> 
			
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('addmission'); ?> <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control  form_datetime-meridian" name="a_date" value=""   autocomplete="off" minlength="5" placeholder="" required>							                  
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('discharge'); ?> <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control form_datetime-meridian" name="dd_date" value=""   autocomplete="off" minlength="5" placeholder="" required>							                  
					</div>
					</div>
					</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
					<select class="form-control js-example-basic-single" name="doctor" value='' required> 
					<option value="">Select Doctor</option>
						<?php foreach ($staffs as $staff) { 
						if ($staff->profile == 'Doctor'){?>
							<option value="<?php echo $staff->id; ?>">
							<?php echo $staff->name; ?>  - <strong> <?php echo $staff->dept; ?></strong>
							</option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('tpa'); ?>/<?php echo lang('insurance'); ?> </label>
					<select class="form-control js-example-basic-single" name="tpa" value='' > 
					<option value="">Select Tpa/Insurance</option>
						<?php foreach ($tpas as $tpas) { ?>
							<option value="<?php echo $tpas->id; ?>">
							<?php echo $tpas->name; ?> 
							</option>
						<?php } ?>
					</select>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('policy_no'); ?>  </label>
					<input  type="text" class="form-control " name="policy_no" value=""   autocomplete="off" placeholder="" >							                  
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
<!-- Add Bed Modal-->







<!-- Bed Modal-->
<div class="modal fade" id="myModal2"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php echo lang('bed'); ?> <?php echo lang('allotment'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBedAllotForm" action="bed/addNewBedAllotment" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('bed'); ?></label>
						<select class="form-control " name="bed" value='' required> 
						<option value="">Select From Available Beds...</option>
					
							<?php foreach ($beds as $bed) { 
							$last_a_time = explode('-', $bed->last_a_time);
                            $last_d_time = explode('-', $bed->last_d_time);
                            if (!empty($last_d_time[1])) {
                                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                                if ($last_d_h_am_pm[2] == 'AM') {
                                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                } else {
                                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                }
                                $last_d_time = strtotime($last_d_time[0]) + $last_d_m;
                            }
							if (empty($bed->last_a_time) && empty($bed->last_b_time) || time() > $last_d_time) {
							
							?>
								<option value="<?php echo $bed->id; ?>">
								<?php echo $bed->name; ?>  
								</option>
							<?php } ?>
							<?php } ?>
						</select>
					</div> <form role="form" id="editBedFormAllot" action="bed/admit" method="post" enctype="multipart/form-data">
					 
					 <div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('patient'); ?> </label>
						<select class="form-control js-example-basic-single" name="id" value='' required> 
						<option value="">Select Patient</option>
							<?php foreach ($patients as $patient) { ?>
								<option value="<?php echo $patient->id; ?>">
								<?php echo $patient->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
			
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('addmission'); ?> <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control  form_datetime-meridian" name="a_date" value=""   autocomplete="off" minlength="5" placeholder="" required>							                  
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('discharge'); ?> <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control form_datetime-meridian" name="dd_date" value=""   autocomplete="off" minlength="5" placeholder="" required>							                  
					</div>
					</div>
					</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
					<select class="form-control js-example-basic-single" name="doctor" value='' required> 
					<option value="">Select Doctor</option>
						<?php foreach ($staffs as $staff) { 
						if ($staff->profile == 'Doctor'){?>
							<option value="<?php echo $staff->id; ?>">
							<?php echo $staff->name; ?>  - <strong> <?php echo $staff->dept; ?></strong>
							</option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('tpa'); ?>/<?php echo lang('insurance'); ?> </label>
					<select class="form-control js-example-basic-single" name="tpa" value='' > 
					<option value="">Select Tpa/Insurance</option>
						<?php foreach ($tpas as $tpas) { ?>
							<option value="<?php echo $tpas->id; ?>">
							<?php echo $tpas->name; ?> 
							</option>
						<?php } ?>
					</select>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('policy_no'); ?>  </label>
					<input  type="text" class="form-control " name="policy_no" value=""   autocomplete="off" placeholder="" >							                  
				</div>
				</div>
				</div>
				
					
                    <input type="hidden" name="bed" value=''>
                    
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Bed Modal-->


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
			$(".editbutton").click(function (e) {
				e.preventDefault(e);
				// Get the record's ID via attribute  
				var iid = $(this).attr('data-id');
				$('#editBedAllotForm').trigger("reset");
				$('#myModal2').modal('show');
				$.ajax({
					url: 'bed/editBedAllotmentByJason?id=' + iid,
					method: 'GET',
					data: '',
					dataType: 'json',
				}).success(function (response) {
					// Populate the form fields with the data returned from server

					$('#editBedAllotForm').find('[name="id"]').val(response.bedAllotment.id).end()
					$('#editBedAllotForm').find('[name="patient"]').val(response.bedAllotment.patient).end()
					$('#editBedAllotForm').find('[name="a_date"]').val(response.bedAllotment.a_date).end()
					$('#editBedAllotForm').find('[name="bed"]').val(response.bedAllotment.bed).end()
					$('#editBedAllotForm').find('[name="dd_date"]').val(response.bedAllotment.dd_date).end()
				   
				});
			});
		});
</script>