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
				<?php echo lang('leave');?></h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
				   <h5 class="card-title">
						<?php echo $leave->title; ?>
						
				    </h5>
					
                    <hr>
					<p>
					<span>
					<?php echo $leave->description; ?>
					</span>
					
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
