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
			<div class="col-lg-9">
				<div class="card m-b-30">
					
					<div class="card-body">
					<div class="panel-body">
					<a data-toggle="modal" href="#myModalDocument">
						<div class="btn-group">
							<button id="" class="btn green">
								<i class="fa fa-file"></i>   <?php  echo lang('add_document'); ?>
							</button>
						</div>
					</a>
					<hr>
					<div class="row icon-box-list  bed_font">
					<?php foreach ($documents as $document) { 
					if($document->patient === $patient->id) {?>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-2 bed_font allotbutton" data-toggle="modal" data-id="<?php echo $bed->id; ?>">
					<a href="<?php echo $document->img_url; ?>" >
						<p>
						<span>
						<?php $file = $document->img_url;
						if(strpos($file, 'pdf') !== FALSE){ ?>
						<img class="img-fluid icon-svg bed_with tooltip22" alt="advanced" src="common/img/pdf-file.png" width="80%">	
						<?php } elseif(strpos($file, 'doc') !== FALSE){ ?>
							<img class="img-fluid icon-svg bed_with tooltip22" alt="advanced" src="common/img/doc-file.png" width="80%">
						<?php } elseif(strpos($file, 'png') !== FALSE){ ?>
							<img class="img-fluid icon-svg bed_with tooltip22" alt="advanced" src="common/img/png-file.png" width="80%">
						<?php } elseif(strpos($file, 'jpg') !== FALSE){ ?>
							<img class="img-fluid icon-svg bed_with tooltip22" alt="advanced" src="common/img/jpg-file.png" width="80%">
						<?php } elseif(strpos($file, 'jpeg') !== FALSE){ ?>
							<img class="img-fluid icon-svg bed_with tooltip22" alt="advanced" src="common/img/jpg-file.png" width="80%">
						<?php } else{ ?>
							<img class="img-fluid icon-svg bed_with tooltip22" alt="advanced" src="common/img/none-file.png" width="80%">
						<?php } ?>	
						</span>
						<br>
						<span class="bed_sub" ><?php echo $document->name; ?>
					    </span>
						</p>
					  </a>
					</div>
					<?php } ?>
					<?php } ?>
				
					
					</div>
					</div>
					
					</section>
					
				<div class="tabset">
			  <!-- Tab 1 -->
			  <input type="radio" name="tabset" id="tab7" aria-controls="Kolawole" checked>
			  <label for="tab7" ><i class="feather icon-clipboard mr-2"></i><?php  echo lang('medical_hx'); ?></label>
			  <!-- Tab 2 -->
			  <input type="radio" name="tabset" id="tab8" aria-controls="Olawuyi">
			  <label for="tab8"> <i class="feather icon-copy  mr-2"></i><?php  echo lang('admit_hx'); ?> </label>
			  <!-- Tab 3 -->
			  <input type="radio" name="tabset" id="tab9" aria-controls="Baterista">
			  <label for="tab9"><i class="feather icon-calendar mr-2"></i><?php  echo lang('appoint_hx'); ?></label>
			  <!-- Tab 4 -->
			  <input type="radio" name="tabset" id="tab10" aria-controls="omnimedy">
			  <label for="tab10"><i class="feather icon-credit-card mr-2"></i><?php  echo lang('pay_hx'); ?></label>
			  
			  <div class="tab-panels">
				<section id="Kolawole" class="tab-panel">
				<div class="panel-body">
					<div class="adv-table editable-table ">
						<div class="clearfix">
							<a data-toggle="modal" href="#myModalHistory">
								<div class="btn-group">
									<button id="" class="btn green">
										<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?> <?php  echo 'Medical Findings'; ?>
									</button>
								</div>
							</a>
						 </div>
						<div class="space15"></div>
					<div class="table_overflow" >
					
                   <table class="table table-striped table-hover table-bordered" id="bateristaworks">
						<thead>
							<tr>                     
								<th><?php echo lang('date'); ?></th>
								<th><?php echo lang('case_hx'); ?> </th>
								<?php if (in_array('medical_history', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								<th><?php echo lang('options'); ?> </th>
								<?php } ?>
							</tr>
						</thead>
                        <tbody>
                        <?php foreach ($medical_historys as $medical_history) { 
						if($patient->id === $medical_history->patient) {
						?>
							<tr class="">
								<td> <?php echo $medical_history->date;?></td>
								<td> <?php  echo substr($medical_history->case_history, 0, 77) . '. . .'; ?></td>
								<?php if (in_array('medical history', $permission1) || $this->ion_auth->in_group(array('admin')) || $staff_profile === 'Doctor') { ?>
								<td>
								 <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $medical_history->id; ?>"><i class="fa fa-eye"></i> View</button>   
								 <button type="button" class="btn btn-primary btn-xs btn_width rxx" data-toggle="modal" data-id="<?php echo $medical_history->id; ?>"><i class="fa fa-plus-circle"></i> Rx</button>  
								 <a class="btn btn-info btn-xs btn_width delete_button" href="patient/deleteMedicalHistory?id=<?php echo $medical_history->id; ?>&patient=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete Medical History?');"><i class="fa fa-trash-o"></i></a>
                                 
								</td>
								<?php } ?>
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
				 </div>
				<div class="space15"></div>
				<div class="table_overflow" >
					
                   <table class="table table-striped table-hover table-bordered" id="bateristaworks1">
						<thead>
							<tr>                     
								<th><?php echo lang('bed'); ?></th>
								<th><?php echo lang('doctor'); ?></th>
								<th><?php echo lang('days'); ?></th>
								<th><?php echo lang('addmission'); ?> / <?php echo lang('discharge'); ?></th>
							</tr>
						</thead>
                        <tbody>
                        <?php foreach ($admissions as $admission) { 
						if($patient->id === $admission->patient) {
						?>
							<tr class="">
								<td> <?php echo $this->db->get_where('bed', array('id' => $patient->bed))->row()->name;?></td>
								<td> <?php echo $this->db->get_where('staff', array('id' => $admission->doctor))->row()->name; ?></td>
								<td> <?php echo $admission->days; ?></td>
								<td> <?php echo $admission->a_date; ?> / <?php echo $admission->dd_date; ?></td>
								
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
								<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('appointment'); ?>
							</button>
						</div>
					</a>
				 </div>
				<div class="space15"></div>
				<div class="table_overflow" >
					
                   <table class="table table-striped table-hover table-bordered" id="bateristaworks2">
						<thead>
							<tr>                     
								<th><?php echo lang('patient'); ?></th>
								<th><?php echo lang('doctor'); ?></th>
								<th><?php echo lang('department'); ?></th>
								<th><?php echo lang('date'); ?> - <?php echo lang('time'); ?></th>
								<th><?php echo lang('status'); ?></th>
							</tr>
						</thead>
                        <tbody>
                        <?php foreach ($appointments as $appointment) { 
						if($patient->id === $appointment->patient) {
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
								
							</tr>
						<?php } ?>
						<?php } ?>
                       </tbody>
					</table>
				</div>
			</div>
		</div>
		</section>
		<section id="Omnimedy" class="tab-panel">
		<div class="panel-body">
			<div class="adv-table editable-table ">
				<div class="clearfix">
					<a href="finance/addSalePosByPatientToken?id=<?php echo $patient->id; ?>&payment_token=5e05efe9acd1a52238db3e51471b5f923a3481975f65d">
						<div class="btn-group">
							<button id="" class="btn green">
								<i class="fa fa-money"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('payment'); ?>
							</button>
						</div>
					</a>
					<?php
					$query = $this->db->get_where('payment', array('patient' => $patient->id))->result();

					$balance = array();

					foreach ($query as $gross) {

						$balance[] = $gross->gross_total - $gross->amount_received;
					}
					$balance = array_sum($balance);

					$due_balance = $balance;
					if ($due_balance > 0 ){
					?>
					<a data-toggle="modal" href="#myModalDeposit">
						<div class="btn-group">
							<button id="" class="btn btn-success">
								<i class="fa fa-plus-circle"></i>  <?php  echo lang('clear_due_amount'); ?> 
							</button>
						</div>
					</a>
					<?php } ?>
				 </div>
				<div class="space15"></div>
				<div class="table_overflow" >
					
                   <table class="table table-striped table-hover table-bordered" id="bateristaworks3">
						<thead>
							<tr>                     
								<th><?php echo lang('sub_total'); ?></th>
								<th><?php echo lang('discount'); ?></th>
								<th><?php echo lang('grand_total'); ?></th>
								<th><?php echo lang('due_amount'); ?></th>
								<th><?php echo lang('date'); ?></th>
								<th><?php echo lang('options'); ?></th>
							</tr>
						</thead>
                        <tbody>
                        <?php foreach ($payments as $payment) {
						if($patient->id === $payment->patient) {
						?>
							<tr class="">
								<td><?php echo $settings->currency; ?> <?php echo number_format($payment->amount); ?></td>
								<td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->flat_discount)) {
                                        echo number_format($payment->flat_discount);
                                    } else {
                                        echo '0';
                                    }
                                    ?>
								</td>
								<td> <?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total); ?>
								
								</td>
								<td> <?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total - $payment->amount_received); ?></td>
								<td> <?php echo date('d-m-Y', $payment->date); ?></td>
								<td> 
								 <a class="btn btn-xs btn-info" href="finance/invoice?id=<?php echo $payment->id; ?>"><i class="fa fa-file-text"></i>  <?php  echo lang('invoice'); ?></a>
                                   
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
				
			
			<!-- Start col -->
			
                    <div class="col-lg-12 col-xl-3">
                        <div class="card m-b-30 dash-widget">
                            <div class="card-header">                                
                                <div class="row align-items-center">
                                    <div class="col-12">
                                    <a href="<?php echo $patient->img_url; ?>" >
                                        <img src="<?php echo $patient->img_url; ?>" width="180px">
									</a>
									<h5 class="card-title mb-0"><?php echo $patient->name; ?></h5>
                                    </div>
                                    <div class="col-7">
                                        
                                    </div>
                                </div>
                            </div>
							<table class="table  table-hover " id="">
					   
						<tbody>  
							<tr>
								<td>
									<i  class=" fa fa-money"></i>
								</td>
								<td>
									<span class="badge bg-warning">
									<?php echo lang('due_payment'); ?>: <?php echo $settings->currency; ?>
									<?php
									$query = $this->db->get_where('payment', array('patient' => $patient->id))->result();

									$balance = array();

									foreach ($query as $gross) {

										$balance[] = $gross->gross_total - $gross->amount_received;
									}
									$balance = array_sum($balance);

									$due_balance = $balance;

									echo number_format($due_balance);

									$due_balance = NULL;
									?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>
									<i  class="fa fa-circle-o"></i>
								</td>
								<td>
									<span class="badge bg-success">
									<?php echo $patient->sex; ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>
									<i  class=" fa fa-envelope"></i>
								</td>
								<td>
									<span class="badge bg-success">
									<?php echo $patient->email; ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>
									<i  class=" fa fa-phone"></i>
								</td>
								<td>
									<span class="badge bg-success">
									<?php echo $patient->phone; ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>

							<tr>
								<td>
									<i class="	fa fa-location-arrow"></i>
								</td>
								<td>
									<span class="badge bg-success" >
										<?php echo $patient->address; ?>
										
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>
									<i class="	fa fa-circle"></i>
								</td>
								<td>
									<span class="badge bg-success" >
										<?php echo lang('admit_count'); ?>: <?php echo $patient->admit; ?>
										
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
						  
						</tbody>
					</table>
				</div>
				</div>
			</div>
			<!-- End col -->		
		</div>           

<script src="common/js/bateristaworks.min.js"></script>
<script>
   $(document).ready(function () {
        $('#bateristaworks').DataTable({
            responsive: true,
			
            dom: "<'row'<'col-sm-4'l><'col-sm-2 text-center'B><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-12'p>>",
            buttons: [
				
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>

<script>
   $(document).ready(function () {
        $('#bateristaworks1').DataTable({
            responsive: true,
			
            dom: "<'row'<'col-sm-4'l><'col-sm-2 text-center'B><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-12'p>>",
            buttons: [
				
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
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
			
            dom: "<'row'<'col-sm-4'l><'col-sm-2 text-center'B><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-12'p>>",
            buttons: [
				
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>

<script>
   $(document).ready(function () {
        $('#bateristaworks3').DataTable({
            responsive: true,
			
            dom: "<'row'<'col-sm-4'l><'col-sm-2 text-center'B><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-12'p>>",
            buttons: [
				
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>



<!-- Add myModalHistory-->
<div class="modal fade" id="myModalHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Medical Findings</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addMedicalHx" method="post" enctype="multipart/form-data">
				
					<div class="row">
					<div class="col-md-8">
					<div class="form-group">
					<label for="exampleInputEmail1">  <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control  default-date-picker" name="date" value=""   autocomplete="off"  placeholder="" required>							                  
					</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('case_hx'); ?></label>
					<textarea  class="" name="case_history" value="" cols="52" id="" rows="" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
				   <hr>
				   
				   <div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('exam_findings'); ?></label>
					<textarea  class="" name="exam_find" value="" cols="52" id="" rows="" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
				   <hr>
				   <div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('diagnosis'); ?></label>
					<textarea  class="" name="dx" value="" cols="52" id="" rows="" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                    <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- edit myModalHistory-->
<div class="modal fade" id="editModalHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> View Medical Findings</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicalHxForm" action="patient/addMedicalHx" method="post" enctype="multipart/form-data">
				
					<div class="row">
					<div class="col-md-8">
					<div class="form-group">
					<label for="exampleInputEmail1">  <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control  default-date-picker" name="date" value=""   autocomplete="off"  placeholder="" required>							                  
					</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('case_hx'); ?></label>
					<textarea  class="" name="case_history" value="" cols="52" id="" rows="" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
				   <hr>
				   
				   <div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('exam_findings'); ?></label>
					<textarea  class="" name="exam_find" value="" cols="52" id="" rows="" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
				   <hr>
				   <div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('diagnosis'); ?></label>
					<textarea  class="" name="dx" value="" cols="52" id="" rows="" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                    <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                    <input type="hidden" name="id" value="">
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- rxModalHistory-->
<div class="modal fade" id="rxModalHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Add Prescription</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="rxModalHistory" action="patient/rxModalHistory" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo 'Prescription'; ?></label>
					<textarea  class="" name="rx" value="" cols="52" id="" rows="" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                    <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                    <input type="hidden" name="id" value="">
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add Appointment Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Appointment</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="appointment/addNewPatient" method="post" enctype="multipart/form-data">
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
                    <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->

<!-- Clear Debt Modal-->
<div class="modal fade" id="myModalDeposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-money"></i> <?php  echo lang('amount_to_be_paid'); ?> : <?php echo $settings->currency; ?>  <?php
				$query = $this->db->get_where('payment', array('patient' => $patient->id))->result();

				$balance = array();

				foreach ($query as $gross) {

					$balance[] = $gross->gross_total - $gross->amount_received;
				}
				$balance = array_sum($balance);

				$due_balance = $balance;

				echo number_format($due_balance);

				$due_balance = NULL;
				?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/amountReceivedFromCT" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
					<label for="exampleInputEmail1"> Amount Received</label>
					<input type="number" class="form-control" pattern="[0-9]{5}" name="amount_received" id="exampleInputEmail1" value='<?php
							if (!empty($category->description)) {
								echo $category->description;
							}
						?>' placeholder="<?php echo $settings->currency; ?> ">
						</div>
					<input type="hidden" name="id" value="<?php echo $patient->id; ?>">

				
                    <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add Document Modal-->
<div class="modal fade" id="myModalDocument" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-file"></i> <?php  echo lang('add_document'); ?> </h4>
            </div>
            <div class="modal-body"><form role="form" action="patient/addPatientDocument" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?></label>
                        <input type="file" name="img_url"><br>
						<small>Accepted File Type Includes: Pdf, Doc, Png, Jpg, Jpeg</small>
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>


                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">
$(document).ready(function () {
	$(".editbutton").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editMedicalHxForm').trigger("reset");
		$('#editModalHistory').modal('show');
		$.ajax({
			url: 'patient/editMedicalHxByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editMedicalHxForm').find('[name="id"]').val(response.MedicalHx.id).end()
			$('#editMedicalHxForm').find('[name="exam_find"]').val(response.MedicalHx.exam_find).end()
			$('#editMedicalHxForm').find('[name="case_history"]').val(response.MedicalHx.case_history).end()
			$('#editMedicalHxForm').find('[name="dx"]').val(response.MedicalHx.dx).end()
			$('#editMedicalHxForm').find('[name="date"]').val(response.MedicalHx.date).end()
		});
	});
});
</script>


<script type="text/javascript">
$(document).ready(function () {
	$(".rxx").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#rxModalHistory').trigger("reset");
		$('#rxModalHistory').modal('show');
		$.ajax({
			url: 'patient/editMedicalHxByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#rxModalHistory').find('[name="id"]').val(response.MedicalHx.id).end()
			$('#rxModalHistory').find('[name="rx"]').val(response.MedicalHx.rx).end()
			$('#rxModalHistory').find('[name="date"]').val(response.MedicalHx.date).end()
		});
	});
});
</script>

