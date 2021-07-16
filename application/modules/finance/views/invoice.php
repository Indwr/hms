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
					<div class="">
						<h4> <?php  echo lang('payment_to'); ?> :</h4>
						<p>
							<?php echo $settings->title; ?> <br>
							<?php echo $settings->address; ?><br>
							Tel:  <?php echo $settings->phone; ?>
						</p>
					</div>
					</div>
					<div class="col-md-4">
					<div class="">
						<h4> <?php  echo lang('bill_to'); ?> :</h4>
						<p>
							<?php
							$patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();
							echo $patient_info->name . ' <br>';
							echo $patient_info->address . '  <br/>';
							P: echo $patient_info->phone
							?>
						</p>
					</div>
					</div>
					<div class="col-md-4">
					<div class="">
						<h4> <?php  echo lang('invoice_info'); ?> </h4>
						<ul class="unstyled">
							<li> <?php  echo lang('date'); ?> 		: <?php echo date('m/d/Y', $payment->date); ?></li>
							<li> <?php  echo lang('invoice_status'); ?> :<br>
								<?php
								if ($payment->gross_total != $payment->amount_received) {
									if ($payment->amount_received == 0) {
										echo '<strong>'.lang('unpaid').'</strong>';
									} else {
										echo '<strong>'.lang('paid_partially').'</strong>';
									}
								} else {
									echo '<strong>'.lang('paid').'</strong>';
								}
								?> 
							</li>
						</ul>
					</div>
					</div>
					</div>
					
						<table class="table table-striped table-hover">

							<thead>
								<tr>
									<th>#</th>
									<th> Item </th>
									<th>Unit Price</th>
									<th><?php echo lang('quantity'); ?></th>
									<th> <?php  echo lang('amount'); ?> </th>
								</tr>
							</thead>

							<tbody>
								<?php if (!empty($payment->x_ray)) { ?>
									<tr>
										<td><?php echo $i = 1 ?></td>
										<td>X Ray</td>
										<td class=""><?php echo $settings->currency; ?> <?php echo $payment->x_ray; ?> </td>
									</tr>
								<?php } ?>
								<?php
								if (!empty($payment->category_name) || !empty($payment->category)) {
									$category_name = $payment->category_name;
									$category_name1 = explode(',', $category_name);
									if (empty($payment->x_ray)) {
										$i = 0;
									}
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
												<td><?php echo $settings->currency; ?> <?php 
												$cat_unit_price = $category_name3[1];
												if (empty($cat_unit_price)){
												   echo number_format($payment->bed_unit);
												} else {
													echo number_format($cat_unit_price);
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
											
											</tr> 
											<?php
										//}
									}
								}
								?>

							</tbody>
						</table>
						<center><img src="uploads/QRcode.png" width="" height=""></center>
						<center class="invoice_no"><?php echo $payment->id; ?></center>
						
						
								<div class="row">
									<div class="col-lg-12 ">
										<ul class="unstyled amounts">
											<li><strong> <?php  echo lang('sub_total'); ?>   <?php  echo lang('amount'); ?>  : </strong><?php echo $settings->currency; ?> <?php echo number_format($payment->amount, 0, '.', ','); ?></li>
											<?php if (!empty($payment->discount)) { ?>
												<li><strong>Discount</strong> <?php
													if ($discount_type == 'percentage') {
														echo '(%) : ';
													} else {
														echo ': ' . $settings->currency;
													}
													?> <?php
													$discount = explode('*', $payment->discount);
													if (!empty($discount[1])) {
														echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
													} else {
														echo $discount[0];
													}
													?></li>
											<?php } ?>
											<?php if (!empty($payment->vat)) { ?>
												<li><strong> <?php  echo lang('vat'); ?>  :</strong>   <?php
													if (!empty($payment->vat)) {
														echo $payment->vat;
													} else {
														echo '0';
													}
													?> % = <?php echo $settings->currency . ' ' . number_format($payment->flat_vat, 0, '.', ','); ?></li>
											<?php } ?>
											<li><strong> <?php  echo lang('grand_total'); ?>  : </strong><?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total, 0, '.', ','); ?></li>
											<li><strong> <?php  echo lang('amount_received'); ?>  : </strong><?php echo $settings->currency; ?> <?php echo number_format($payment->amount_received, 0, '.', ','); ?></li>
											<li><strong> <?php  echo lang('amount_to_be_paid'); ?>  : </strong><?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total - $payment->amount_received, 0, '.', ','); ?></li>
										</ul>
									</div>
								</div>
								</div>
							</div>
						
						<div class="text-center invoice-btn">
							<?php if (in_array('sales', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								<a href="finance/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> <?php  echo lang('edit_invoice'); ?> </a>
							<?php } ?>

							<a class="btn green" href="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
						</div>
						
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						
						
						<!--footer start-->
						<script src="common/js/bateristaworks.min.js"></script>