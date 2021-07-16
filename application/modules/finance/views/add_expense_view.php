
<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-6">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php
					if (!empty($expense->id))
						echo lang('edit_expense');
					else
						echo lang('add_expense');
					?></h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
                                    <form role="form" action="finance/addExpense" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('category'); ?> </label>
                                            <select class="form-control m-bot15" name="category" value=''>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>" <?php
                                                    if (!empty($expense->category)) {
                                                        if ($category->category == $expense->category) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $category->category; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('description'); ?> </label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($expense->description)) {
                                                echo $expense->description;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('amount'); ?> </label>
                                            <input type="number" class="form-control" name="amount" id="exampleInputEmail1" value='<?php
                                            if (!empty($expense->amount)) {
                                                echo $expense->amount;
                                            }
                                            ?>' placeholder="<?php echo $settings->currency; ?>">
                                        </div>
										
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($expense->id)) {
                                            echo $expense->id;
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
