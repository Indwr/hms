<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-7">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title">
				<?php
                if (!empty($staff->id))
                    echo lang('edit_staff');
                else
                    echo lang('add_staff');
                ?></h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
				   
		        
                        <form role="form" action="staff/addNew" method="post" enctype="multipart/form-data">
						<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php echo $staff->name; ?>' required>

                    </div>
                    <hr>
					<small class="orange_staff"><span >Important!</span> The email and password is what the staff would use to login to the system, the password can be changed anytime both by the staff or the system Admininstrator.</small>
					<p>
					<div class="row">
				    <div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php echo $staff->email; ?>' placeholder="" required>
                    </div>
                    </div>
				    <div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('password'); ?></label>
                        <input type="password" class="form-control" minlength="5" name="password" id="exampleInputEmail1" placeholder="********" value="<?php echo $staff->password; ?>" 
						<?php if (empty($staff->id)){echo 'required';}else{}?> >
                    </div>                 
                    </div>
                    </div>
					<div class="row">
				    <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php echo $staff->address; ?>' placeholder="" required>
                    </div>
                    </div>
				    <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php echo $staff->phone; ?>' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('profile'); ?></label>
						<select class="form-control js-example-basic-single" name="profile" required="required" value=""> 
						        <option value="">Select Profile...</option>	
								<option <?php if(!empty($staff->profile)){ echo 'selected="selected"'; } ?> value="<?php echo $staff->profile; ?>"><?php echo $staff->profile; ?></option>
								<option value="Admin">Admin</option>
								<option value="Doctor">Doctor</option>
								<option value="Nurse">Nurse</option>
								<option value="Laboratorist">Laboratorist</option>
								<option value="Pharmacist">Pharmacist</option>
								<option value="Accountant">Accountant</option>
								<option value="Receptionist">Receptionist</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('department'); ?></label>
						<select type="text" class="form-control js-example-basic-single" name="dept"  value="">
						<option value="">Select Department...</option>
                        <option <?php if(!empty($staff->dept) ){ echo 'selected="selected"'; } ?> value="<?php echo $staff->dept; ?>"><?php echo $staff->dept; ?></option>							
						<?php foreach ($departments as $department) { ?>
							   <option  value="<?php echo $department->dept; ?>"><?php echo $department->dept; ?></option>	
						<?php } ?>
						</select>
					</div>
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
								<label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
							<div class="">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail " >
									<img class="" src="<?php echo $staff->img_url; ?>" />	
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" ></div>
									<div >
									<span class="btn btn-white btn-file">
										<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
										<input type="file" class="default" name="img_url" value="<?php echo $staff->img_url; ?>"/></span>
									<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
									<br>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					
					<div class="form-group pos_client"> 
					<label for="exampleInputEmail1"> <?php echo lang('module_permission'); ?></label>
					<br>
					<input type='checkbox' value="patient" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   $permissions = $this->staff_model->getStaffById($staff->id)->permission;
						   $permission1 = explode(',', $permissions);
						   
						   if (in_array('patient', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('patient'); ?>
					<br>
					<input type='checkbox' value="medical_history" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   $permissions = $this->staff_model->getStaffById($staff->id)->permission;
						   $permission1 = explode(',', $permissions);
						   
						   if (in_array('medical history', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('medical_history'); ?>
					<br>
					
					<input type='checkbox' value="bed" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('bed', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('bed'); ?>

					<br>
					<input type='checkbox' value="appointment" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('appointment', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('appointment'); ?>

					<br>
					<input type='checkbox' value="human resources" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('human resources', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('human_res'); ?>

					<br>
					<input type='checkbox' value="bloodbank" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('bloodbank', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('bloodbank'); ?>

					<br>
					<input type='checkbox' value="pharmacy" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('pharmacy', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('pharmacy'); ?>

					<br>
					<input type='checkbox' value="notice" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('notice', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('notice'); ?>

					<br>
					<input type='checkbox' value="report" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('report', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('report'); ?>

					<br>
					<input type='checkbox' value="ambulance" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('ambulance', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('ambulance'); ?>

					<br>
					<input type='checkbox' value="inventory" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('inventory', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('inventory'); ?>

					<br>
					<input type='checkbox' value="finance" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('finance', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('finance'); ?>

					<br>
					<input type='checkbox' value="financial report" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('financial report', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('financial_report'); ?>

					<br>
					<input type='checkbox' value="leave" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('leave', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('leave_app'); ?>

					<br>
					<input type='checkbox' value="sms" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('sms', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('sms'); ?>

					<br>
					<input type='checkbox' value="tpa" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('tpa', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('tpa_manage'); ?>

					<br>
					<input type='checkbox' value="blog" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('blog', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('blog'); ?>

					<br>
					<input type='checkbox' value="settings" name="permission[]"
					   <?php
					   if (!empty($staff->id)) {
						   if (in_array('settings', $permission1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('settings'); ?>

					<br>
					</div>
						<input type="hidden" name="id" value='<?php echo $staff->id; ?>'>
						<button type="submit" name="submit" class="btn btn-info" onclick="return confirm('Notice: each box you have checked for this staff means the staff is able to Add, Edit/Approve and Delete in each section of the checked box')"><?php echo lang('submit'); ?></button>
					</form>
							</div>
						</section>
					</div>
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
