
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('list'); ?> <?php  echo lang('patient'); ?></h5>
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
													<i class="fa fa-plus-circle"></i>   <?php  echo lang('register'); ?>  <?php  echo lang('patient'); ?>
												</button>
											</div>
										</a>
                     </div>
                    <div class="space15"></div>
					<div class="table_overflow">
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>                      
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Staff'))) { ?>
                                    <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?>
                                <th><?php echo lang('admit_count'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($patients as $patient) { ?>
                            <tr class="">
                                <td> 
								
								<?php $check_death = $this->db->get_where('report', array('patient' =>  $patient->id))->row()->type; 
								if($check_death == 'death'){?>
								<div class="tooltip1 red_class">
								   <?php echo $patient->name; ?>
								  <span class="tooltiptext1"><?php echo $patient->name; ?> is Dead since <?php echo $this->db->get_where('report', array('patient' =>  $patient->id))->row()->date;?></span>
								</div>
								
								<?php } else{ echo $patient->name; }?>
								      
								
								</td>
                                <td><?php echo $patient->phone; ?></td>


                                <?php if ($this->ion_auth->in_group(array('admin', 'Staff'))) { ?>
                                    <td> <?php echo $settings->currency; ?>
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
                                    </td>
                                <?php } ?>
								<td>
								<?php echo $patient->admit; ?>
								</td>
                                <td>
								
								        <?php if ($this->ion_auth->in_group(array('admin', 'Staff'))) { ?>
										<?php 
										$last_a_time = explode('-', $patient->admit_from);
										$last_d_time = explode('-', $patient->admit_to);
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
										if (empty($patient->admit_from) && empty($patient->admit_to) || time() > $last_d_time && $check_death != 'death') { ?>
                                        <button type="button" class="btn btn-info  btn-resize btn_width invoicebutton admit_patient" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fa fa-plus-circle"></i> Admit</button>   
                                        <?php } elseif($check_death == 'death') {?>
										
										<?php } else {?>
										 <button type="button" class="btn btn-warning  btn-resize btn_width invoicebutton admit_view" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><img src="assets_ui/images/svg-icon/tables.svg"  width="17px" class="img-fluid" alt="bed"> On Admission</button>   
                                        <?php } ?>
										
										<button type="button" class="btn btn-info  btn-resize btn_width editbutton" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                        
                                        <a class="btn btn-primary  btn-resize btn-resize btn_width " href="patient/patientHistory?id=<?php echo $patient->id; ?>&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('history'); ?></a>
                                        
                                        <a class="btn btn-info  btn-resize btn_width delete_button" href="patient/delete?id=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete this patient?');"><i class="fa fa-trash-o"></i></a>
                                      <?php } ?>
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
<!-- page end-->
</section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('register'); ?>  <?php  echo lang('patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addNew" method="post" enctype="multipart/form-data">
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
                    <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('full_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-2">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15 " name="sex" value='' required>
						<option value=""  > </option>
						<option value="Others"  > <?php echo lang('others'); ?> </option>
                        <option value="Male"  > <?php echo lang('male'); ?> </option>
                        <option value="Female"  > <?php echo lang('female'); ?> </option>
                            
                        </select>
                    </div>
                    </div>
					<div class="col-md-2">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('dob'); ?></label>
                        <input style="padding-right:6px;" type="text" class="form-control default-date-picker js-example-basic-single" name="dob" autocomplete="off" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					</div>
                    </div>

                    <div class="row">
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('b_group'); ?></label>
						<select class="form-control m-bot15 " name="b_group" value=''>
							<option value=""></option>
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
						</select>
                    </div>
                    </div>
                    <div class="col-md-9">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<hr>
					<div class="row">
					<div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="number" class="form-control" name="phone" pattern="[0-9]{5}" minlength="5" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-5">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" autocomplete="off" value='' placeholder="" >
                    </div>
                    </div>
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?> (Default: 12345)</label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" autocomplete="off" value='12345' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						<label for="exampleInputEmail1">Image</label>
						<div class="btn btn-warning"  onClick="$('.reply').toggle()">Upload from Computer</div>
					  </div>
				    </div>
					&nbsp;
					<div class="col-md-3">
								<div class="form-group">
								<label for="exampleInputEmail1" style="color:white;"> .</label>
								<div  onClick="setTimeout(function(){($('.captture').toggle(), Webcam.attach( '#my_camera' )); }, 0000);" class="btn btn-info">Capture with Camera</div> 
							  </div>
						</div>
					</div>
                    
					<div class="row">
					   <div class="col-md-5">
							<div class="form-group captture" style="display:none;">
								 <div style="text-align:center;">
									 
									<div class="row">
									<div class="col-md-4">
									<div class="form-group" >
									<div id="my_camera"></div>
									</div>
									</div>
									<div class="col-md-4" >
									<div class="form-group">
									
									<div class="pad_result" id="results" ></div>
									</div>
									</div>
									</div>
									<br>
									<div class=" btn btn-primary" onClick="take_snapshot()" id="snap">Capture Photo</div>
									<div class=" btn btn-success" onClick="saveSnap()" id="">Save Photo</div>
								 </div>
							</div>
					   </div> 
					</div>
					   
					<div class="row">
				       
					  <div class="col-md-6">
					<div class="form-group reply captturre" style="display:none;" >
					<label class="control-label">Image Upload</label>
						<div class="fileupload fileupload-new" data-provides="fileupload" >
							<div class="fileupload-new thumbnail upload_classs" >
								<img src="assets_ui/images/omnimedy.jpg" alt="" />
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
							<div>
								<span class="btn btn-white btn-file">
									<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
									<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
									<input type="file" id="putpic" class="default" name="img_url">
								</span>
								<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"> Remove</a>
							</div>
								</div>
							</div>
						</div>				
					  </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
					<input type="hidden"  name="photo" id="photo_input" value="">
					<hr>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->







<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?>  <?php  echo lang('patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatientForm" action="patient/addNew" method="post" enctype="multipart/form-data">
                      <div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
					<select class="form-control " name="doctor" value='' > 
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
                        <label for="exampleInputEmail1"><?php echo lang('full_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-2">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control " name="sex" value='' required>
						<option value=""  > </option>
						<option value="Others"  > <?php echo lang('others'); ?> </option>
                        <option value="Male"  > <?php echo lang('male'); ?> </option>
                        <option value="Female"  > <?php echo lang('female'); ?> </option>
                            
                        </select>
                    </div>
                    </div>
					<div class="col-md-2">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('dob'); ?></label>
                        <input style="padding-right:6px;" type="text" class="form-control default-date-picker" name="dob" autocomplete="off" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input style="padding-right:6px;" type="text" class="form-control" readonly autocomplete="off" id="Age_px" value='' placeholder="">
                    </div>
					</div>
                    </div>

                    <div class="row">
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('b_group'); ?></label>
						<select class="form-control " name="b_group" value=''>
							<option value=""></option>
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
						</select>
                    </div>
                    </div>
                    <div class="col-md-9">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<hr>
					<div class="row">
					<div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="number" class="form-control" name="phone" pattern="[0-9]{5}" minlength="5" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-5">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" autocomplete="off" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" autocomplete="off" value='12345' placeholder="" >
                    </div>
                    </div>
                    </div>
					
					<div class="row">
				       
					  <div class="col-md-6">
					<div class="form-group reply captturre"  >
					<label class="control-label">Image</label>
						<div class="fileupload fileupload-new" data-provides="fileupload" >
							<div class="fileupload-new thumbnail upload_classs" >
								<img id="img1" alt="" />
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
							<input type="hidden" name="photo" id="img2" value=''>
								</div>
							</div>
						</div>				
					  </div>
					
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Patient Modal-->


<!-- Admit Patient Modal-->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('admit'); ?>  <?php  echo lang('patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="admitPatientForm" action="patient/admit" method="post" enctype="multipart/form-data">
			
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('bed'); ?></label>
						<select class="form-control js-example-basic-single" name="bed" value='' required> 
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
					</div>
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
				
					<input type="hidden" name="id" >  
					
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Admit Patient Modal-->


<!-- OnAdmission Patient Modal-->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('admission_details'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="OnadmitPatientForm"  method="post" enctype="multipart/form-data">
			
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('bed'); ?></label>
						<select class="form-control" name="bed" value='' disabled> 
						<option value="">Select From Available Beds...</option>
					
							<?php foreach ($beds as $bed) { ?>
								<option value="<?php echo $bed->id; ?>">
								<?php echo $bed->name; ?>  
								</option>
							<?php } ?>
						</select>
					</div>
					</div>
					</div>
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('addmission'); ?> <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control  " name="admit_from" value=""   autocomplete="off" minlength="5" placeholder="" readonly>							                  
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('discharge'); ?> <?php echo lang('date'); ?>  </label>
					<input  type="text" class="form-control " name="admit_to" value=""   autocomplete="off" minlength="5" placeholder="" readonly>							                  
					</div>
					</div>
					</div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Webcam.min.js -->
<script type="text/javascript" src="common/js/webcamjs/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
 Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90
 });
 //Webcam.attach( '#my_camera' );

 // preload shutter audio clip
 var shutter = new Audio();
 shutter.autoplay = false;
 shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

 function take_snapshot() {
  // play sound effect
  shutter.play();

  // take snapshot and get image data
  Webcam.snap( function(data_uri) {
  // display results in page
  document.getElementById('results').innerHTML = 
   '<img id="imageprev" src="'+data_uri+'"/>';
  } );

 // Webcam.reset();
 }

function saveSnap(){
 // Get base64 value from <img id='imageprev'> source
 var base64image = document.getElementById("imageprev").src;

 Webcam.upload( base64image, 'upload.php', function(code, text) {
 // console.log('Save successfully');
  //console.log(text);
  //alert(text);
			const Toast = Swal.mixin({
			  customClass: 'format-prestine',                 
			  toast: true,
			  position: 'center',
			  showConfirmButton: false,
			});
			Toast.fire({
			  type: 'success',
			  title:  '<span style="color:#a5dc86;">Photo Saved Successfully</span>'
			});	
			var d = new Date();
			var unn = Math.floor(d.getTime()/1000)
			document.getElementById("photo_input").value = text;
    });
}
</script>

<script src="common/js/bateristaworks.min.js"></script>

<script>
var $slider = document.getElementById('slider');
var $toggle = document.getElementById('toggle');

$toggle.addEventListener('click', function() {
	var isOpen = $slider.classList.contains('slide-in');

	$slider.setAttribute('class', isOpen ? 'slide-out' : 'slide-in');
});
</script>

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
	$(".admit_view").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#OnadmitPatientForm').trigger("reset");
		$('#myModal4').modal('show');
		$.ajax({
			url: 'patient/editPatientByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server

			$('#OnadmitPatientForm').find('[name="id"]').val(response.patient.id).end()
			$('#OnadmitPatientForm').find('[name="bed"]').val(response.patient.bed).end()
			$('#OnadmitPatientForm').find('[name="admit_from"]').val(response.patient.admit_from).end()
			$('#OnadmitPatientForm').find('[name="admit_to"]').val(response.patient.admit_to).end()
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".admit_patient").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#admitPatientForm').trigger("reset");
		$('#myModal3').modal('show');
		$.ajax({
			url: 'patient/editPatientByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server

			$('#admitPatientForm').find('[name="id"]').val(response.patient.id).end()
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".editbutton").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editPatientForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'patient/editPatientByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
             var image = $("#img1").attr("src", "uploads/img_url");
			 
			$('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
			$('#editPatientForm').find('[name="name"]').val(response.patient.name).end()
			$('#editPatientForm').find('[name="password"]').val(response.patient.password).end()
			$('#editPatientForm').find('[name="email"]').val(response.patient.email).end()
			$('#editPatientForm').find('[name="address"]').val(response.patient.address).end()
			$('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end()
			$('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end()
			$('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end()
			$('#editPatientForm').find('[name="dob"]').val(response.patient.dob).end()
			$('#editPatientForm').find('[name="b_group"]').val(response.patient.b_group).end()
			$('#editPatientForm').find('[name="doctor"]').val(response.patient.doctor).end()
			
			if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
			   $("#img1").attr("src", response.patient.img_url);
			   $("#img2").attr("value", response.patient.img_url);
			} else{
			document.getElementById("img1").src = 'assets_ui/images/omnimedy.jpg';	
			document.getElementById("img2").value = 'assets_ui/images/omnimedy.jpg';	
			}
			var dobb = response.patient.dob;
			
			function getAge(dateString) {

				var dates = dateString.split("-");
				var d = new Date();

				var userday = dates[0];
				var usermonth = dates[1];
				var useryear = dates[2];

				var curday = d.getDate();
				var curmonth = d.getMonth()+1;
				var curyear = d.getFullYear();

				var age = curyear - useryear;

				if((curmonth < usermonth) || ( (curmonth == usermonth) && curday < userday   )){

					age--;
					
				}

				return age;
			}
			
			agedd = getAge(dobb);
			
			document.getElementById("Age_px").value = agedd;	
		});
	});
});
</script>
