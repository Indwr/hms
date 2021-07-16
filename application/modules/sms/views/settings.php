			<!--sidebar end-->
			<!-- Start Contentbar -->    
			<div class="contentbar">
				<!-- Start row -->
				<div class="row">
					<!-- Start col -->
					<div class="col-lg-6">
						<div class="card m-b-30">
							<div class="card-header">
								<h5 class="card-title"><?php echo lang('clickatell'); ?> <?php echo lang('sms'); ?> <?php echo lang('settings'); ?></h5>
							</div>
							<div class="card-body">
							   <?php echo validation_errors(); ?>
                                        <form role="form" action="sms/addNewSettings" method="post" enctype="multipart/form-data">
										<div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('sender'); ?></label>
                                                <input type="text" class="form-control" name="sender" id="exampleInputEmail1" value='<?php
                                                if (!empty($settings_sms->sender)) {
                                                    echo $settings_sms->sender;
                                                }
                                                ?>' placeholder="" >
                                            </div>
                               
											<div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('clickatell'); ?> <?php echo lang('api_id'); ?></label>
                                                <input type="text" class="form-control" name="username" id="exampleInputEmail1" value='<?php
                                                if (!empty($settings_sms->api_id)) {
                                                    echo $settings_sms->api_id;
                                                }
                                                ?>' placeholder="" >
                                            </div>
											
											<div class="row">
											<div class="col-md-6">
											<div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('clickatell'); ?> <?php echo lang('username'); ?></label>
                                                <input type="text" class="form-control" name="username" id="exampleInputEmail1" value='<?php
                                                if (!empty($settings_sms->username)) {
                                                    echo $settings_sms->username;
                                                }
                                                ?>' placeholder="" >
                                            </div>
                                            </div>
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('clickatell'); ?> <?php echo lang('password'); ?></label>
                                                <input type="password" class="form-control" name="password" id="exampleInputEmail1" value=' <?php
                                                if (!empty($settings_sms->password)) {
                                                    echo $settings_sms->password;
                                                }
                                                ?>' placeholder="********">
                                            </div>
                                            </div>
                                            </div>
                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($settings_sms->id)) {
                                                echo $settings_sms->id;
                                            }
                                            ?>'>
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
											</form>
                                    </div>
                                </section>
                            </div>
                        </div>
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