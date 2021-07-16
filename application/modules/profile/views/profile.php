<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-5">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title">
							<?php if (!$this->ion_auth->in_group('Supplier')) { ?>
							<?php echo lang('manage_profile'); ?>
							<?php } ?>
							<?php if ($this->ion_auth->in_group('Supplier')) { ?>
								   <?php echo lang('change_pass'); ?>
							<?php } ?><span id="headerr"></h5>
							</div>
							<div class="card-body">
							
							   <span class="validation_in"><?php echo validation_errors(); ?></span>
							   
                                        <form role="form" action="profile/addNew" method="post" enctype="multipart/form-data">
                                            <div class="form-group 
											<?php if ($this->ion_auth->in_group('Supplier')) { ?>
											hidden
											<?php } ?>">
                                                <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                                if (!empty($profile->username)) {
                                                    echo $profile->username;
                                                }
                                                ?>' placeholder="" <?php
                                                       if (!$this->ion_auth->in_group('admin')) {
                                                           echo 'readonly';
                                                       }
                                                       ?>>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                                if (!empty($profile->email)) {
                                                    echo $profile->email;
                                                }
                                                ?>' <?php
                                                       if (!empty($profile->username)) {
                                                           echo $profile->username;
                                                       }
                                                       ?>' placeholder="" <?php
                                                       if (!$this->ion_auth->in_group('admin')) {
                                                           echo 'readonly';
                                                       }
                                                       ?>>
                                            </div>
                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($profile->id)) {
                                                echo $profile->id;
                                            }
                                            ?>'>
											
											 <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('change_password'); ?></label>
                                                <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                                            </div>
											
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
