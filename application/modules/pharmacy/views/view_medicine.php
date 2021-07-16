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
					<?php echo $medicine->category; ?>
					<?php 
						if ($medicine->e_date == 0):
							echo '';
						elseif (strtotime($medicine->e_date) <= time() &&  ($medicine->howmany) > 0): 
							echo '<p class="btn btn_width stock-expired" >Expired</p>';
						elseif (strtotime($medicine->e_date) <= strtotime("+2 month") && (strtotime($medicine->e_date) > time())  &&  ($medicine->howmany) > 0):
							echo '<p class="btn btn_width soon-expire">Soon Expire</p>';
						else:
							echo '';
						endif; 
					?>
                                       
					</h5>
				</div>
				<div class="card-body">
				   <span class="validation_in"><?php echo validation_errors(); ?></span>
                                    <form role="form">
                                        <div class="row"> 
                                        <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
                                            <input type="text" class="input-line full-width control form-control" disabled name="medicine" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->category)) {
                                                echo $medicine->category;
                                            }
                                            ?>' placeholder="">    
                                        </div>
                                        </div>
										<div class="col-md-6"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('MedicineCategory'); ?> </label>
										<input type="text" class="input-line full-width control form-control" disabled name="medicine" id="exampleInputEmail1" value='<?php echo $this->db->get_where('medicine_category', array('id' => $medicine->catg))->row()->name; ?>' placeholder=""> 
                                        </div>
                                        </div>
                                        </div>
										<div class="row"> 
										<div class="col-md-6"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                                            <input type="text" class="input-line full-width control form-control" disabled  name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->description)) {
                                                echo $medicine->description;
                                            }
                                            ?>'>    
                                        </div> 
                                        </div> 
										<div class="col-md-3"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('qty'); ?></label>
                                            <input type="number" class="input-line full-width control form-control" disabled pattern="[0-9]{5}" id="exampleInputEmail1" name="howmany" value='<?php
                                            if (!empty($medicine->howmany)) {
                                                echo $medicine->howmany;
                                            }
                                            ?>' placeholder="" >    
                                        </div> 
                                        </div> 
										<div class="col-md-3"> 
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('ex_date'); ?></label>
                                            <input type="text" class="input-line full-width control form-control" disabled  name="e_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->e_date)) {
                                                echo $medicine->e_date;
                                            }
                                            ?>' placeholder="" autocomplete="off">    
                                        </div> 
                                        </div> 
                                        </div>
                                       
										
										
										<div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('str_box');?> </label>
                                            <input type="text" class="input-line full-width control form-control" disabled  name="cost_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->str_box)) {
                                                echo $medicine->str_box;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        </div>                                        
										<div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('cost'); ?> (<?php echo $settings->currency; ?>)</label>
                                            <input type="number" class="input-line full-width control form-control" disabled pattern="[0-9]{5}" name="cost_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->cost_price)) {
                                                echo $medicine->cost_price;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('sale'); ?> (<?php echo $settings->currency; ?>)</label>
                                            <input type="number" class="input-line full-width control form-control" disabled pattern="[0-9]{5}" name="c_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->c_price)) {
                                                echo $medicine->c_price;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        </div>
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($medicine->id)) {
                                            echo $medicine->id;
                                        }
                                        ?>'>
										<p>
									</p>
									<center>
									
									<span><i small class="fa fa-info-circle show_icon"></i></span>
										<small >									
									<span>
									<?php 
									    echo $medicine->staff_update;
										
										if(strpos($medicine->staff_update, Loaded) !== false){
										 echo ' ' . $medicine->unit;	
										}
										
										if(strpos($medicine->staff_update, 'Updated Stock') !== false){
										 echo ' ' . $medicine->unit;	
										}
									?>
									</span>
									<br>
									<a href="<?php echo $medicine->qr_code; ?>"><img class="qr_code_item_1" src="<?php echo $medicine->qr_code; ?>"></a>
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

