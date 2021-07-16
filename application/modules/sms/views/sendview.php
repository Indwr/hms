<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-6">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php echo lang('send_sms'); ?>
					</h5>
						</div>
						<div class="card-body">
						   <?php echo validation_errors(); ?>
										<p>
                                <a href="sms/sent" class=''>
                                    <button class="btn green">
                                       Sent SMS
                                    </button>
                                </a>
                                <form role="form" class="clearfix" action="sms/sendNew" method="post">
								<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1"> <?php  echo lang('patient'); ?></label>
										<select class="form-control m-bot15 js-example-basic-single"  name="mobiles" value='' required>
										<option class="form-control m-bot15 js-example-basic-single"  value="" name="">Select Patient...</option>
											<?php foreach ($patients as $patient) { ?>
												<option  id="" value="<?php echo $patient->phone; ?>"><?php echo $patient->name; ?> <?php echo $patient->phone; ?></option>
											<?php } ?> 	
										</select>						
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1"><?php echo lang('message'); ?></label>
									<textarea maxlength="160" class="" name="message" value="" cols="54" id="" rows="6" placeholder="Enter Text Here..."></textarea>						                  
                                   </div>
								</div>
								</div>
									
									<input type="hidden" name="id" value=''>
	                                  <button type="submit" name="submit" class="btn btn-info"><?php echo lang('send'); ?></button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/bateristaworks.min.js"></script>
