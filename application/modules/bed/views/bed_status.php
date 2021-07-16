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
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-body">
				
				<div class="tabset">
				  <!-- Tab 1 -->
				  <input type="radio" name="tabset" id="tab7" aria-controls="Kolawole" checked>
				  <label for="tab7" ><i class="feather icon-grid mr-2"></i><?php  echo lang('available'); ?> <?php  echo lang('beds'); ?></label>
				  <!-- Tab 2 -->
				  <input type="radio" name="tabset" id="tab8" aria-controls="Olawuyi">
				  <label for="tab8"> <i class="feather icon-folder mr-2"></i><?php  echo lang('alloted'); ?> <?php  echo lang('beds'); ?></label>
				  
				  <div class="tab-panels">
					<section id="Kolawole" class="tab-panel">
					<div class="panel-body">
					<div class="row icon-box-list icon-svg-list bed_font">
					<?php foreach ($beds as $bed) { ?>
						
					 <?php
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
					
					if (empty($bed->last_a_time) && empty($bed->last_d_time) || time() > $last_d_time) {

					?>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 bed_font allotbutton" data-toggle="modal" data-id="<?php echo $bed->id; ?>">
						<p><span><img src="assets_ui/images/svg-icon/tables.svg" class="img-fluid icon-svg bed_with tooltip22" alt="advanced"></span><?php echo $bed->name ?>
						<br>
						<span class="bed_sub" >Bed Type:
						<?php echo  $this->db->get_where('bed_type', array('id' => $bed->type))->row()->name; ?>
					    </span>
						<br>
						<span class="bed_sub" >Last Occupied:
						<?php 
						if(empty($bed->last_d_time)){
							echo 'Never';
						}else {
							echo $bed->last_d_time;
                        } ?>
					    </span>
						</p>
					    
					</div>
					
					<?php } ?>
					<?php } ?>
				
					
					</div>
					
					</section>
					
					<section id="Olawuyi" class="tab-panel">
					<div class="panel-body">
					<div class="row icon-box-list icon-svg-list bed_font">
					<?php foreach ($beds as $bed) { ?>
						
					 <?php
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
					
					if (!empty($bed->last_a_time) && !empty($bed->last_d_time) && time() < $last_d_time) {
                   
					?>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 bed_font red_bed" data-toggle="modal" data-id="<?php echo $bed->id; ?>">
						<p><span><img src="assets_ui/images/svg-icon/un_bed.png" class="img-fluid  bed_with tooltip22" alt=""></span><?php echo $bed->name ?>
						<br>
						<span class="bed_sub" >Bed Type:
						<?php echo  $this->db->get_where('bed_type', array('id' => $bed->type))->row()->name; ?>
					    </span>
						<br>
						<span class="bed_sub" >Available by:
						<?php echo $bed->last_d_time; ?>
					    </span>
						</p>
					    
					</div>
					
					<?php } ?>
					<?php } ?>
				
					
					</div>
					
					</section>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="common/js/bateristaworks.min.js"></script>

<!-- Allot Bed Modal-->
<div class="modal fade" id="myModal22"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('admit'); ?>  <?php  echo lang('patient'); ?></h4>
            </div>
            <div class="modal-body">
					 <form role="form" id="editBedFormAllot" action="bed/admit" method="post" enctype="multipart/form-data">
					 
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
                        <button type="submit" name="submit" class="btn btn-info" ><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Allot Bed Modal-->
<script type="text/javascript">
		$(document).ready(function () {
			$(".allotbutton").click(function (e) {
				e.preventDefault(e);
				// Get the record's ID via attribute  
				var iid = $(this).attr('data-id');
				$('#editBedFormAllot').trigger("reset");
				$('#myModal22').modal('show');
				$.ajax({
					url: 'bed/editBedByJason?id=' + iid,
					method: 'GET',
					data: '',
					dataType: 'json',
				}).success(function (response) {
					// Populate the form fields with the data returned from server

					$('#editBedFormAllot').find('[name="bed"]').val(response.bed.id).end()
					$('#editBedFormAllot').find('[name="name"]').val(response.bed.name).end()
					$('#editBedFormAllot').find('[name="bed_type"]').val(response.bed.type).end()
					$('#editBedFormAllot').find('[name="fee"]').val(response.bed.fee).end()
				   
				});
			});
		});
</script>