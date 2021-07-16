<div class="contentbar">
		<!-- Start row -->
		<div class="row">
			<!-- Start col -->
			<div class="col-lg-8">
				<div class="card m-b-30">
				
					<center>
					<div class="col">
							<a href="">
								<img src="<?php echo $this->db->get('settings')->row()->logo;?>" data-holder-rendered="true" />
							</a>
						</div>
					</center>
						<center>
						 <h4>
						 <strong> <?php  echo lang('staff'); ?>:</strong>    <?php echo $this->db->get_where('staff', array('id' => $staff_id))->row()->name; ?>
					   
						</h4>
						</center>

						<hr>
							<?php
							$gross_total = array();
							foreach ($payments as $payment) {
								$gross_total[] = $payment->gross_total;
								$amount[] = $payment->amount;
								$flat_vat[] = $payment->flat_vat;
								$discount[] = $payment->flat_discount;
								$amount_received[] = $payment->amount_received;
							}
							?>			   
						<?php
						if (!empty($payments)) {
                        ?>

                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> <?php  echo 'Item'; ?> </th>
                                    <th> Qty </th>
                                    <th> <?php  echo lang('amount'); ?> </th>
                                    <th> <?php  echo lang('date'); ?> </th>
                                </tr>
                            </thead>

                            <tbody>
						<?php
						foreach ($payments as $payment) {
						if (!empty($payment->category_name) || !empty($payment->category)) {
							$category_name = $payment->category_name;
							$category_name1 = explode(',', $category_name);
							$i = 0;
							foreach ($category_name1 as $category_name2) {
								$category_name3 = explode('*', $category_name2);
								//if ($category_name3[1] > 0) {
									?>                
								<tr>
												<td><?php echo $i = $i + 1; ?></td>
												<td><?php
												$cat_namee = $this->finance_model->getPaymentCategoryById($category_name3[0])->category;
												if (empty($cat_namee)){
												   echo $payment->category;
												} else {
													echo $cat_namee;
												}
												?></td>
												<td><?php 
												$cat_qtty = $category_name3[3];
												if (empty($cat_qtty)){
												   echo $payment->bed_qty;
												} else {
													echo $cat_qtty;
												}
												?> </td>
												<td class=""><?php echo $settings->currency; ?> 
												<?php 
												$cat_amount = $category_name3[1] * $category_name3[3]; 
												if (empty($cat_amount)){
												   echo $payment->hospital_amount;
												} else {
													echo $cat_amount;
												}?> </td>
											
										<td><?php echo date('m-d-Y h:i:s A', $payment->date); ?> </td>
								</tr> 
								<?php
							//}
						}
					}
				}
				?>

                            </tbody>

                        </table>
				<?php } ?>     
			</div>
	</div>
	
	<!-- Start col -->
                <div class="col-lg-12 col-xl-4">
                    <div class="card m-b-30 dash-widget">
								<div class="card-header">                                
									<div class="row align-items-center">
										<div class="col-12">
											<h5 class="card-title mb-0"><?php  echo lang('amount_to_be_paid'); ?> : <?php echo $settings->currency; ?>  <?php echo number_format(array_sum($gross_total) - array_sum($amount_received), 0, '.', ','); ?> </h5>
										</div>
									</div>
								</div>
						 <div class="row">
                            <div class="col-lg-12  pull-right">
                                <ul class="unstyled amounts">
                                    <li><strong> <?php  echo lang('sub_total'); ?>   <?php  echo lang('amount'); ?>  : </strong><?php echo $settings->currency; ?> <?php
                            if (!empty($amount)) {
                                $amounttt =  array_sum($amount);
								echo number_format($amounttt);
                            }?></li>
                                        <?php if (!empty($discount)) { ?>
                                        <li><strong><?php  echo lang('discount'); ?></strong> <?php ?> <?php echo array_sum($discount); ?> </li>
                                        <?php } ?>
                                   
                                    <li ><strong><?php  echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php
                                if (!empty($gross_total)) {
                                    echo number_format(array_sum($gross_total), 0, '.', ',');
                                }
                                    ?></li>
                                    <li ><strong><?php  echo lang('amount_received'); ?>: </strong><?php echo $settings->currency; ?> <?php
                                        if (!empty($amount_received)) {
                                            echo number_format(array_sum($amount_received), 0, '.', ',');
                                        }
                                        ?></li>
                                </ul>
                            </div>
                        </div>
						 <div class="row">
                        <div class="col-lg-12 pull-right">
                            <ul class="unstyled amounts">         
                                <li ><strong> <?php  echo lang('total'); ?>   <?php  echo lang('amount_to_be_paid'); ?>  : </strong><?php echo $settings->currency; ?> <?php
                                    if (!empty($gross_total) || !empty($amount_received)) {
                                        echo number_format(array_sum($gross_total) - array_sum($amount_received));
                                    }
                                        ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>


					</div>
				</div>
				</div>
			         
		

<!--main content end-->
<!--footer start-->
