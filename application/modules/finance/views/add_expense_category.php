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
                if (!empty($category->id))
                    echo lang('edit_expense_category');
                else
                    echo lang('add_expense_category');
                ?></h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
                                    <form role="form" action="finance/addExpenseCategory" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php  echo lang('category'); ?> </label>
                                            <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->category)) {
                                                echo $category->category;
                                            }
                                            ?>' placeholder="">    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('description'); ?> </label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->description)) {
                                                echo $category->description;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($category->id)) {
                                            echo $category->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?> </button>
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
