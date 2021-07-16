<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-9">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php echo lang('settings'); ?></h5>
				</div>
				<div class="card-body">
					
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
				   
					<form role="form" action="settings/update" method="post" enctype="multipart/form-data">
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('hospital'); ?></label>
							<input type="text" class="form-control" name="title" id="exampleInputEmail1" value='<?php
							if (!empty($settings->title)) {
								echo $settings->title;
							}
							?>' placeholder="title">
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('hospital'); ?> <?php echo lang('address'); ?></label>
							<input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
							if (!empty($settings->address)) {
								echo $settings->address;
							}
							?>' placeholder="address">
						</div>
						</div>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
							<input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
							if (!empty($settings->system_vendor)) {
								echo $settings->system_vendor;
							}
							?>' placeholder="description">
						</div>
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('hospital'); ?> <?php echo lang('phone'); ?></label>
							<input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
							if (!empty($settings->phone)) {
								echo $settings->phone;
							}
							?>' placeholder="phone">
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('hospital'); ?> <?php echo lang('email'); ?></label>
							<input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
							if (!empty($settings->email)) {
								echo $settings->email;
							}
							?>' placeholder="email">
						</div>
						</div>
						
						<div class="col-md-6">
						<div class="form-group">
						 <label for="exampleInputEmail1"><?php echo lang('currency'); ?></label>
							<input type="text" class="form-control" name="currency" id="exampleInputEmail1" value='<?php
							if (!empty($settings->currency)) {
								echo $settings->currency;
							}
							?>' placeholder="currency">
						</div>
						</div>
									
						
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('language'); ?></label>
							<select class="form-control m-bot15" name="language" value=''>
								<option value="english" <?php
								if (!empty($settings->language)) {
									if ($settings->language == 'english') {
										echo 'selected';
									}
								}
								?>><?php echo lang('english'); ?> </option>
							</select>
							</div>
						</div>
						</div>
						<hr>
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('about_us'); ?></label>
							<textarea class="" name="about_us"  cols="40" id="" rows="3" placeholder=""> <?php
							if (!empty($settings->about_us)) {
								echo $settings->about_us;
							}
							?></textarea>						                  
						   </div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('welcome_long'); ?></label>
							<textarea class="" name="welcome_long"  cols="40" id="" rows="3" placeholder=""> <?php
							if (!empty($settings->welcome_long)) {
								echo $settings->welcome_long;
							}
							?></textarea>						                  
						   </div>
						</div>
						</div>
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
						 <label for="exampleInputEmail1"><?php echo lang('welcome_short'); ?></label>
							<input type="text" class="form-control" name="welcome_short" id="exampleInputEmail1" value='<?php
							if (!empty($settings->welcome_short)) {
								echo $settings->welcome_short;
							}
							?>' placeholder="welcome short">
						</div>
						</div>
						</div>
						<hr>
						<div class="">
							<h5 class="card-title"><?php echo 'Socials'; ?></h5>
						</div>
						<div class="form-group">
						 <label for="exampleInputEmail1"><?php echo lang('facebook'); ?></label>
							<input type="url" class="form-control" name="facebook" id="exampleInputEmail1" value='<?php
							if (!empty($settings->facebook)) {
								echo $settings->facebook;
							}
							?>' placeholder="facebook, begin with http://">
						</div>
						<div class="form-group">
						 <label for="exampleInputEmail1"><?php echo 'twitter'; ?></label>
							<input type="url" class="form-control" name="twitter" id="exampleInputEmail1" value='<?php
							if (!empty($settings->twitter)) {
								echo $settings->twitter;
							}
							?>' placeholder="twitter, begin with http://">
						</div>
						<div class="form-group">
						 <label for="exampleInputEmail1"><?php echo 'instagram'; ?></label>
							<input type="url" class="form-control" name="instagram" id="exampleInputEmail1" value='<?php
							if (!empty($settings->instagram)) {
								echo $settings->instagram;
							}
							?>' placeholder="instagram, begin with http://">
						</div>
						<hr>
						<div class="row">
						<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo 'Google Map Code'; ?> <a data-toggle="modal" href="#myModal"><span style="color:red;"> <i class="fa fa-info-circle"></i> Hint</span></a></label> 
							<textarea class="" name="map_iframe"  cols="88" id="" rows="" placeholder=""> <?php
							if (!empty($settings->map_iframe)) {
								echo $settings->map_iframe;
							}
							?></textarea>							
						</div>
						</div>
						</div>
						
						
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
								<label for="exampleInputEmail1"><?php echo lang('logo'); ?></label>
							<div class="">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="upload_settings fileupload-new thumbnail" >
									<img  class="fav_icon_width img_setprop" src="<?php echo $settings->logo; ?>" />	
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail"></div>
									<div>
									
										<span class="btn btn-white btn-file">
											<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
											<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
											<input type="file" class="default" name="img_url" value="<?php echo $settings->logo; ?>"/></span>
											
										
									<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"> Remove</a>
									<br>
									<span class="help-block">Recommended Size: 206x66</span>
									</div>
								</div>
							</div>
						</div>
						</div>
						
						
						<div class="col-md-6">
						<div class="form-group">
								<label for="exampleInputEmail1"><?php echo lang('favicon'); ?></label>
							<div class="">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail upload_settings_fav" >
									<img class="fav_icon_wid" src="<?php echo $settings->favicon; ?>" />	
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" ></div>
									<div >
									
										<span class="btn btn-white btn-file">
											<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
											<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
											<input type="file" class="default" name="img_url_favicon" value="<?php echo $settings->favicon; ?>"/></span>
											
										
									<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"> Remove</a>
									<br>
									<span class="help-block">Recommended Size: 90x90</span>
									</div>
								</div>
							</div>
						</div>
						</div>
						</div>									
						
						<input type="hidden" name="id" value='<?php
						if (!empty($settings->id)) {
							echo $settings->id;
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

<!-- page end-->
</section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/bateristaworks.min.js"></script>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> Google Map Hint</h4>
            </div>
            <div class="modal-body">
				<a href="uploads/google_tut.jpg">
				   <img src="common/img/google_hint.jpg" width="760px"/>
				</a>
            </div>
			<br>
			<div class="col-md-12">
			   <div class="form-group">
			   <strong>
			   Copy the entire link inside the SRC Starting from the https:// 
			   </strong>
				</div>
			</div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>