<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-7">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php echo lang('staff'); ?> <?php echo lang('permission'); ?></h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
				  
                                    <form role="form" action="settings/update" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('staff'); ?></label>
											 <select class="form-control m-bot15 js-example-basic-single" name="permit" value='' id="permit">
                                            <option class="form-control m-bot15 js-example-basic-single"  value="1" >Select Staff...</option>
											<?php foreach ($staffs as $staff) { ?>
												<option  id="" value="<?php echo $staff->id; ?>"><?php echo $staff->name; ?></option>
											<?php } ?> 	
                                               
                                            </select>
                                        </div> 
										
										
										
										<div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('staff'); ?> <?php echo lang('department'); ?></label>
                                           <div id="permission_dept" class="blue_permit">
										   
                                           </div>
										
                                        </div>
										
										<div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('staff'); ?> <?php echo lang('profile'); ?></label>
                                           <div id="permission_profile" class="blue_permit">
										   
                                           </div>
										
                                        </div>
										
										<div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('staff'); ?> <?php echo lang('role'); ?>/<?php echo lang('permission'); ?></label>
                                           <div id="permission" class="orange_permit">
										   
                                           </div>
										
                                        </div>
										
										<script src="common/js/bateristaworks.min.js"></script>
			
										<script>
											
											$(document).ready(function () {
											  $("#permit").change(function() {
												var permit_id = $('#permit').val();
												
												$.ajax({
												  type: "GET",
												  data: '',
												  url: 'staff/getPermitByAjax?id=' + permit_id,
												  dataType: 'json',
												  success: function(response) {	
													var perm = response.staff.permission;
													var permProfile = response.staff.profile;
													var permProfileDept = response.staff.dept;
													if (perm == null){
													stripped = perm;
													}else {
													stripped = perm.replace(/,/g, '</br>')
													}
													
													
													document.getElementById('permission').innerHTML = stripped;
													document.getElementById('permission_profile').innerHTML = permProfile;
													document.getElementById('permission_dept').innerHTML = permProfileDept;
												  }
												
												 });
											   });
											}); 
											
										</script>
                                        
                                      
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

<script src="common/js/bateristaworks.min.js"></script>
