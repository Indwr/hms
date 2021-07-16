<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-7">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php echo lang('blog'); ?> <?php echo lang('settings'); ?></h5>
				</div>
				<div class="card-body">
					
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
				   
					<form role="form" action="blog/setting_update" method="post" enctype="multipart/form-data">
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('number_per_page'); ?></label>
							<input type="text" class="form-control" name="page" id="exampleInputEmail1" value='<?php
							if (!empty($settings->page)) {
								echo $settings->page;
							}
							?>' placeholder="">
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1"><?php echo lang('number_per_other_post'); ?> </label>
							<input type="text" class="form-control" name="related" id="exampleInputEmail1" value='<?php
							if (!empty($settings->related)) {
								echo $settings->related;
							}
							?>' placeholder="">
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
