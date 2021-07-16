<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-6">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title">
				<?php
                echo 'My Zoom JWT Credentials'
                ?></h5>
				</div>
				<div class="card-body">
										<span class="validation_in"><?php echo validation_errors(); ?></span>

														<form role="form" action="zoom/updateZoomCredential" method="post" enctype="multipart/form-data">
															<div class="form-group">
																 <label for="exampleInputEmail1"><?php echo 'API Key'; ?></label>
																 <input type="text" class="form-control" name="api_key" id="exampleInputEmail1" value='<?php echo $doctor->api_key; ?>' required>
															</div>
															<div class="form-group">
																 <label for="exampleInputEmail1"><?php echo 'API Secret'; ?></label>
																 <input type="text" class="form-control" name="api_secret" id="exampleInputEmail1" value='<?php echo $doctor->api_secret; ?>' required>
															</div>
														
															<input type="hidden" name="id" value='<?php echo $doctor->id; ?>'>
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
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
