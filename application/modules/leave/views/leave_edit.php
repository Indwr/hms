<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-9">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title">
				<?php echo lang('edit');?> <?php echo lang('leave');?></h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
				   
                <form role="form" action="Leave/addNew" method="post" enctype="multipart/form-data">
					<div class="row">
				    <div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='<?php echo $Leave->title; ?>' placeholder="" required>
                    </div>
                    </div>
				    <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('from_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="from_date" id="exampleInputEmail1" value='<?php echo $Leave->from_date; ?>' placeholder="" required>
                    </div>
                    </div>
				    <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('to_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="to_date" id="exampleInputEmail1" value='<?php echo $Leave->to_date; ?>' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="ckeditor form-control editor" name="description" cols="52" id="" rows="6" placeholder=""><?php echo $Leave->description; ?></textarea>						                  
				   </div>
				   
				   
					<div class="form-group pos_client"> 
					<label for="exampleInputEmail1"> <?php echo lang('select'); ?> <?php echo lang('profile_that_can_see'); ?></label>
					<br>
					<input type='checkbox' value="Doctor" name="user[]"
					   <?php
					   if (!empty($Leave->id)) {
						   $user_seen = $this->Leave_model->getLeaveById($Leave->id)->user;
						   $user_seen1 = explode(',', $user_seen);
						   
						   if (in_array('Doctor', $user_seen1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('doctor'); ?>
					<br>
					
					
					<input type='checkbox' value="Nurse" name="user[]"
					   <?php
					   if (!empty($Leave->id)) {
						   if (in_array('Nurse', $user_seen1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('nurse'); ?>
					<br>
					
					<input type='checkbox' value="Laboratorist" name="user[]"
					   <?php
					   if (!empty($Leave->id)) {
						   if (in_array('Laboratorist', $user_seen1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('laboratorist'); ?>
					<br>
					
					<input type='checkbox' value="Pharmacist" name="user[]"
					   <?php
					   if (!empty($Leave->id)) {
						   if (in_array('Pharmacist', $user_seen1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('pharmacist'); ?>
					<br>
					
					<input type='checkbox' value="Accountant" name="user[]"
					   <?php
					   if (!empty($Leave->id)) {
						   if (in_array('Accountant', $user_seen1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('accountant'); ?>
					<br>
					
					<input type='checkbox' value="Receptionist" name="user[]"
					   <?php
					   if (!empty($Leave->id)) {
						   if (in_array('Receptionist', $user_seen1)) {
							   echo 'checked';
						   }
					   } else {
						   echo 'checked';
					   }
					   ?>> <?php echo lang('receptionist'); ?>
					<br>
					
					
					</div>
						<input type="hidden" name="id" value='<?php echo $Leave->id; ?>'>
						<button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
			</form>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
