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
					<div class="text-center corporate-id">
						<h2>
							<?php echo $settings->title ?>
						</h2>
						<h4>
							<?php echo $settings->address ?>
						</h4>
						<h4>
							Tel: <?php echo $settings->phone ?>
						</h4>
					</div>
					<hr>
					<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<h4> <?php  echo lang('payment_to'); ?> :</h4>
						<p>
							<?php echo $settings->title; ?> <br>
							<?php echo $settings->address; ?><br>
							Tel:  <?php echo $settings->phone; ?>
						</p>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<h4> <?php  echo lang('bill_to'); ?> :</h4>
						<p>
							<?php
							$patient_info = $this->db->get_where('patient', array('id' => $patient_id))->row();
							echo $patient_info->name . ' <br>';
							echo $patient_info->address . '  <br/>';
							P: echo $patient_info->phone
							?>
						</p>
					</div>
					</div>



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

					   <div class="col-md-4">
						<div class="form-group">
							<h4> <?php  echo lang('invoice_info'); ?> </h4> 
							<ul class="unstyled">
								<li> <?php  echo lang('invoice_status'); ?>: <br> 
									<strong class="maroooooon">
										<?php
										if (array_sum($gross_total) != array_sum($amount_received)) {
											if (array_sum($amount_received) == 0) {
												echo '<strong>'.lang('unpaid').'</strong>';
											} else {
												echo '<strong>'.lang('paid_partially').'</strong>';
											}
										} else {
											echo '<strong>'.lang('paid').'</strong>';
										}
										?> 
									</strong> 
								</li>
							</ul>
						</div>
						</div>
						</div>

						<?php
						if (!empty($payments)) {
                        ?>

                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> <?php  echo lang('category'); ?> </th>
                                    <th> Qty </th>
                                    <th> <?php  echo lang('amount'); ?> </th>
                                    <th> <?php  echo lang('date'); ?> </th>
                                </tr>
                            </thead>

                            <tbody>
						<?php
						foreach ($payments as $payment) {
						if (!empty($payment->category_name)) {
							$category_name = $payment->category_name;
							$category_name1 = explode(',', $category_name);
							$i = 0;
							foreach ($category_name1 as $category_name2) {
								$category_name3 = explode('*', $category_name2);
								if ($category_name3[1] > 0) {
									?>                
								<tr>
									<td><?php echo $i = $i + 1; ?></td>
									<td><?php echo $this->finance_model->getPaymentCategoryById($category_name3[0])->category; ?> </td>
									<td><?php echo $category_name3[3]; ?> <?php echo $settings->qty; ?></td>
									<td class=""><?php echo $settings->currency; ?> <?php echo number_format($category_name3[1] * $category_name3[3], 0, '.', ','); ?> </td>
									<td><?php echo date('m-d-Y h:i:s A', $payment->date); ?> </td>
								</tr> 
                    <?php
                }
            }
        }
    }
    ?>

                            </tbody>

                        </table>


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




<?php } ?>

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
						<?php if(!empty(number_format(array_sum($gross_total) - array_sum($amount_received)))){ ?>
						<div class="panel-body col-md-12 add_deposit" >

									<form role="form" action="finance/amountReceivedFromCT" method="post" enctype="multipart/form-data">
										
										<div class="form-group">
											<label for="exampleInputEmail1"> Amount Received </label>
											<input type="number" class="form-control" pattern="[0-9]{5}" name="amount_received" id="exampleInputEmail1" value='<?php
													if (!empty($category->description)) {
														echo $category->description;
													}
										?>' placeholder="<?php echo $settings->currency; ?> ">
										</div>
										<input type="hidden" name="id" value="<?php echo $patient_id; ?>">

										<button type="submit" name="submit" class="btn btn-info"> Deposit </button>
									</form>
									
						</div>
						<?php } ?>	
					</div>
				</div>
				</div>
			         
		

<!--main content end-->
<!--footer start-->
