<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-9">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php echo $category->category; ?></h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
                                    <form role="form">
                                        <div class="row"> 
                                        <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
                                            <input type="text" class="input-line full-width control form-control" disabled name="category" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->category)) {
                                                echo $category->category;
                                            }
                                            ?>' placeholder="">    
                                        </div>
                                        </div>
										<div class="col-md-6"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('category'); ?> </label>
											 <select name="catg" type="text" class="input-line full-width control form-control" disabled>
											  <option class="input-line full-width control form-control" disabled  value="">Select Category...</option>
											<?php foreach ($product_categorys as $product_category) { ?>
												<option  <?php if(!empty($category->catg)){ echo 'selected="selected"'; } ?> value="<?php echo $product_category->id; ?>"><?php echo $product_category->name; ?></option>
											<?php } ?> 	
										</select>	
                                        </div>
                                        </div>
                                        </div>
										<div class="row"> 
										<div class="col-md-6"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                                            <input type="text" class="input-line full-width control form-control" disabled  name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->description)) {
                                                echo $category->description;
                                            }
                                            ?>'>    
                                        </div> 
                                        </div> 
										<div class="col-md-6"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('warehouse'); ?> </label>
											<select name="str_box" type="text" class="input-line full-width control form-control" disabled>
											
											  <option class=""   value="" >Select Warehouse...</option>
											<?php foreach ($warehouses as $warehouse) { ?>
												<option  <?php if(!empty($category->str_box)){ echo 'selected="selected"'; } ?> value="<?php echo $warehouse->id; ?>"><?php echo $warehouse->name; ?></option>
											<?php } ?> 	
										</select>	
									
                                        </div>
                                        </div>
                                        </div>
                                        
										<div class="row"> 
										<div class="col-md-6"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('qty'); ?></label>
                                            <input type="number" class="input-line full-width control form-control" disabled pattern="[0-9]{5}" id="exampleInputEmail1" name="howmany" value='<?php
                                            if (!empty($category->howmany)) {
                                                echo $category->howmany;
                                            }
                                            ?>' placeholder="" >    
                                        </div> 
                                        </div> 
                                        <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('unit'); ?></label>
                                            <input  type="text" class="input-line full-width control form-control" disabled name="unit" required id="exampleInputEmail1" value='<?php
                                            if (!empty($category->unit)) {
                                                echo $category->unit;
                                            }
                                            ?>' placeholder="e.g Bags, Cartons, Drums, Kegs" >    
                                        </div> 
                                        </div> 
                                        </div> 
										<?php $expiry_check = $settings->expiry_check; if($expiry_check == 'on') { ?>
										<div class="row"> 
										<div class="col-md-6"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('ex_date'); ?></label>
                                            <input type="text" class="input-line full-width control form-control" disabled  name="e_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->e_date)) {
                                                echo $category->e_date;
                                            }
                                            ?>' placeholder="" autocomplete="off">    
                                        </div> 
                                        </div> 
										
										<div class="col-md-6"> 
										<div class="form-group"> 
											
											<br>
                                            <?php 
												if ($category->e_date == 0):
													echo '';
												elseif (strtotime($category->e_date) <= time() &&  ($category->howmany) > 0): 
													echo '<p class="btn btn_width stock-expired" >Expired</p>';
												elseif (strtotime($category->e_date) <= strtotime("+2 month") && (strtotime($category->e_date) > time())  &&  ($category->howmany) > 0):
													echo '<p class="btn btn_width soon-expire">Soon Expire</p>';
												else:
													echo '';
												endif; 
											?>
                                        </div> 
										
                                        </div> 
										
                                        </div> 
										<?php } ?>
										<?php $customer_check = $settings->customer_sales; if($customer_check == 'on') { ?>
                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('cost'); ?> (<?php echo $settings->currency; ?>)</label>
                                            <input type="number" class="input-line full-width control form-control" disabled pattern="[0-9]{5}" name="cost_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->cost_price)) {
                                                echo $category->cost_price;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('sale'); ?> (<?php echo $settings->currency; ?>)</label>
                                            <input type="number" class="input-line full-width control form-control" disabled pattern="[0-9]{5}" name="c_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->c_price)) {
                                                echo $category->c_price;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        </div>
                                        </div>
										<?php } ?>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($category->id)) {
                                            echo $category->id;
                                        }
                                        ?>'>
										<p>
									</p>
									<center>
									
									<span><i small class="fa fa-info-circle show_icon"></i></span>
										<small >									
									<span>
									<?php 
									    echo $category->staff_update;
										
										if(strpos($category->staff_update, Loaded) !== false){
										 echo ' ' . $category->unit;	
										}
										
										if(strpos($category->staff_update, 'Updated Stock') !== false){
										 echo ' ' . $category->unit;	
										}
									?>
									</span>
									<br>
									<a href="<?php echo $category->qr_code; ?>"><img class="qr_code_item_1" src="<?php echo $category->qr_code; ?>"></a>
									</center>
									
								   </form>
									
                                </div>
                                </div>
                                </div>
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

