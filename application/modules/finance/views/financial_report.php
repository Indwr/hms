
	<section id="main-content"> 
    <section class="wrapper site-min-height">
        
	
	<div class="contentbar">
		<!-- Start row -->
		<div class="row">
			<!-- Start col -->
			<div class="col-lg-9">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title">
						<?php  echo 'Financial Report'; ?> 
						</h5>
					</div>
					<div class="col-md-12">
            <div class="col-md-7">  
                <section>

                    <form role="form" class="f_report" action="finance/Report" method="post" enctype="multipart/form-data">
                        <div class="row">
						<div class="col-md-7">
                        <div class="form-group">
                                <div class="input-group input-large" data-date="13-07-2013" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                    if (!empty($from)) {
                                        echo $from;
                                    }
                                    ?>" placeholder=" <?php  echo lang('from'); ?> " autocomplete="off">
                                    <span class="input-group-addon"> <?php  echo lang(''); ?> </span>
                                    <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                    if (!empty($to)) {
                                        echo $to;
                                    }
                                    ?>" placeholder=" <?php  echo lang('to'); ?> " autocomplete="off">
                                </div>
                            </div>
                            </div>
							<div class="col-md-3">
							<div class="form-group">
                                <button type="submit" name="submit" class="btn btn-info range_submit"> <?php  echo lang('submit'); ?> </button>
                            </div>
                            </div>
                        </div>
                    </form>
                </section>
				
            </div>
			<hr>
			<?php
			if (!empty($payments)) {
				$paid_number = 0;
				foreach ($payments as $payment) {
					$paid_number = $paid_number + 1;
				}
			}
			?>
			
					<h5 class="card-title"> Income Report </h5>
					
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty </th>
								<th>Unit Cost</th>
                                <th>Unit Sale</th>
								<th>Sum Cost</th>
                                <th>Sum Sale</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $category_id_for_report = array();
                            foreach ($payment_categories as $cat_name) {
                                foreach ($payments as $payment) {
                                    $categories_in_payment = explode(',', $payment->category_name);
                                    foreach ($categories_in_payment as $key => $category_in_payment) {
                                        $category_id = explode('*', $category_in_payment);
                                        if ($category_id[0] == $cat_name->id) {
                                            $category_id_for_report[] = $category_id[0];
                                        }
                                    }
                                }
                            }
                            $category_id_for_reports = array_unique($category_id_for_report);
                            ?>

                            <?php
                            foreach ($payment_categories as $category) {
                                  $category_quantity = 0;
                                if (in_array($category->id, $category_id_for_reports)) {
                                    ?>
                                    <tr class="">
                                        <td><?php echo $category->category ?></td>
                                        <td>
                                            <?php
                                            foreach ($payments as $paymentt) {
                                                $category_names_and_amountss = $paymentt->category_name;
                                                $category_names_and_amountss = explode(',', $category_names_and_amountss);
                                                foreach ($category_names_and_amountss as $category_name_and_amountt) {
                                                    $category_namee = explode('*', $category_name_and_amountt);
                                                    if (($category->id == $category_namee[0])) {
                                                        $category_quantity = $category_quantity + $category_namee[3];
														  $cost_category = $category_namee[4];
														  //$cost_per_category[] = $category_namee[4] * $category_quantity;
														// $cost_my_category[] = array_sum($cost_category) * $category_namee[3];
														  $amount_per_category = $category_namee[1];
														 
                                                    }
                                                }
                                            }
                                            echo $category_quantity;
                                            ?> 
                                        </td>
										<td> 
											<?php echo $settings->currency; ?> <?php
                                            if (!empty($cost_category)) {
                                                echo number_format($cost_category, 0, '.', ',');
                                               $cost_per_category[] = $cost_category * $category_quantity;
                                            } else {
                                                echo '0';
                                            }
                                            echo $cost_category = NULL;
                                            ?>
										</td>
                                        <td><?php echo $settings->currency; ?> <?php
                                            if (!empty($amount_per_category)) {
												echo number_format($amount_per_category, 0, '.', ',');
                                                $total_by_category[] = array_sum($amount_per_category);
                                            } else {
                                                echo '0';
                                            }

                                            $amount_per_category = NULL;
                                            ?></td>	
											
											
										<td><?php echo $settings->currency; ?> 
										
                                            <?php
                                            if (!empty($cost_per_category)) {
												echo number_format(array_sum($cost_per_category), 0, '.', ',');
                                                $total_cost_by_category[] = array_sum($cost_per_category);
                                            } else {
                                                echo '0';
                                            }

                                            $cost_per_category = NULL;
                                            ?></td>
                                        <td><?php echo $settings->currency; ?> <?php
                                            foreach ($payments as $payment) {
                                                $category_names_and_amounts = $payment->category_name;
                                                $category_names_and_amounttts = $payment->category;
                                                $category_names_and_amounts = explode(',', $category_names_and_amounts);
                                                foreach ($category_names_and_amounts as $category_name_and_amount) {
                                                    $category_name = explode('*', $category_name_and_amount);
                                                    if (($category->id == $category_name[0])) {
                                                        $amount_for_category = $category_quantity * $category_name[1]; 
                                                    }
													if(!empty($category_names_and_amounttts)){
														$thename = $amount_for_category + $payment->hospital_amount;
													}
                                                }
                                            }
                                            if (!empty($amount_for_category)) {
												echo number_format($amount_for_category, 0, '.', ',');
                                                $total_payment_by_category[] = $amount_for_category;
                                            } else {
                                                echo '0';
                                            }

                                            $amount_for_category = NULL;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
						
						<table class="table table-striped table-advance table-hover">
						 <thead>
                            <tr>
                                <th>Income From Bed</th>
                                <th class="hidden-phone">Days</th>
                                <th class="hidden-phone">Unit Sale</th>
                                <th class="hidden-phone">Sum Sale</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
							$i = 0;
							foreach ($payments as $payment) { 
							if(!empty($payment->category)){?>
                                <tr class="">
                                    <td><?php echo $payment->category; ?></td>
                                    <td>
                                        <?php echo $payment->bed_qty; ?>
                                    </td>
									<td>
                                        <?php echo $settings->currency; ?>
                                        <?php echo $payment->bed_unit; ?>
                                    </td>
									<td>
                                        <?php echo $settings->currency; ?>
                                        <?php echo $payment->hospital_amount; ?>
                                    </td>
                                </tr>
								<?php 
								
								if(!empty($payment->category)) {
									$i = $i + $payment->hospital_amount;
								}
								
								?>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
						
                            
                    
					<tr>
						<td> <h5 class="card-title"><?php echo lang('total'); ?> <?php echo lang('discount'); ?></h5></td>
						 <td></td>
						<td><h5 class="card-title">
							<?php echo $settings->currency; ?>
							<?php
							if (!empty($payments)) {
								foreach ($payments as $payment) {
									$discount[] = $payment->flat_discount;
								}
								if ($paid_number > 0) {
									echo number_format(array_sum($discount), 0, '.', ',');
								} else {
									echo '0';
								}
							} else {
								echo '0';
							}
							?></h5>
						</td>
					</tr>
                            <!--
                            <tr>
                                <td><h5><?php echo lang('total'); ?> <?php echo lang('vat'); ?></h5></td>
                                <td>
                            <?php echo $settings->currency; ?>
                            <?php
                            if (!empty($payments)) {
                                foreach ($payments as $payment) {
                                    $vat[] = $payment->flat_vat;
                                }
                                if ($paid_number > 0) {
                                    echo array_sum($vat);
                                } else {
                                    echo '0';
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                                </td>
                            </tr>
                            -->
                            <!--
                            <tr>
                                <td><h4><?php echo lang('gross_income'); ?></h4></td>
                                 <td></td>
                                <td><h4>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        if ($paid_number > 0) {
                                            $gross = array_sum($total_payment_by_category) - array_sum($discount) + array_sum($vat) + $i + $j;
											echo number_format($gross, 0, '.', ',');
                                           
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?></h4>
                                </td>
                            </tr>
                            <tr>
                            -->
                              
                                </td>
                            </tr>
                            <tr>
                               
                                </td>
                            </tr>

                        </tbody>
                    </table>
					
                   <h5 class="card-title"> Expense Report </h5>
				
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th class="hidden-phone">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expenses as $expense) { ?>
                                <tr class="">
                                    <td><?php echo $expense->category ?></td>
                                    <td>
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        //foreach ($expenses as $expense) {
                                            //$category_name = $expense->category;

                                           // if (($category->category == $category_name)) {
                                            //    $amount_per_category[] = $expense->amount;
                                           // }
										   $total_expense_by_categoryy = $expense->amount;
										   echo number_format($total_expense_by_categoryy);
										   $total_expense_by_category[] = $total_expense_by_categoryy;
                                       // }
                                       // if (!empty($amount_per_category)) {
                                            //$total_expense_by_category[] = array_sum($expense->amount);
											//echo number_format(array_sum($amount_per_category), 0, '.', ',');
                                       // } else {
                                        //    echo '0';
                                        //}

                                        //$amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
        </div>
	
		</div>
	</div>
			
			<!-- Start col -->
                    <div class="col-lg-12 col-xl-3">
                        <div class="card m-b-30 dash-widget">
                            <div class="card-header">                                
                                <div class="row align-items-center">
                                    
                                    <div class="col-7">
                                        
                                    </div>
                                </div>
                            </div>
						<table class="table  table-hover " id="">
					   
						<tbody> 					
							<tr>
								<td>-</td>
								<td>
									Total Sales
								</td>
								<td>
									<span class="badge badge-primary">
									<?php echo $settings->currency; ?>
                                        <?php
                                        if (empty($gross)) {
											
                                            $gross = 0;
											
                                        }
                                        echo $gross_bill;
										echo number_format($gross);
                                        ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>-</td>
								<td>
									Total Hospital Amount
								</td>
								<td>
									<span class="badge badge-success">
									<?php echo $settings->currency; ?>
									<?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $hospital_amount[] = $payment->hospital_amount;
                                        }
                                        if ($paid_number > 0) {
                                            $hospital_amount = array_sum($hospital_amount);
                                            echo $hospital_amount;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>-</td>
								<td>
									Total Doctors Commission
								</td>
								<td>
									<span class="badge badge-primary">
									<?php echo $settings->currency; ?>
									 <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $doctor_amount[] = $payment->doc_com;
                                        }
                                        if ($paid_number > 0) {
                                            $gross_doctor_amount = array_sum($doctor_amount);
                                            echo $gross_doctor_amount;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    } ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>

							<tr>
								<td>-</td>
								<td>
									Total Cost
								</td>
								<td>
									<span class="badge bg-warning" >
										<?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($payments)) {
                                            if (($paid_number > 0)) {
                                                if (!empty($total_cost_by_category)) {
                                                    $total_cost = array_sum($total_cost_by_category);
                                                    echo number_format($total_cost, 0, '.', ',');
                                                } else {
                                                    $total_cost = 0;
                                                    echo number_format($total_cost, 0, '.', ',');
                                                }
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>	
										
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>-</td>
								<td>
									Total Due
								</td>
								<td>
									<span class="badge badge-danger" >
								    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $amount_received[] = $payment->amount_received;
                                        }
                                        if ($paid_number > 0) {
                                            $amount_received = array_sum($amount_received);
                                            echo number_format($gross - $amount_received, 0, '.', ',');
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
										
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
						<tr>
								<td>-</td>
								<td>
									Total Expense
								</td>
								<td>
									<span class="badge badge-secondary" >
								     <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($total_expense_by_category)) {
                                           
											echo number_format(array_sum($total_expense_by_category), 0, '.', ',');
											
                                        } else {
                                            echo '0';
                                        }
                                        ?>
										
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>

							<?php 
						    $profit = 0 - array_sum($total_expense_by_category) - array_sum($total_cost_by_category);
						    $profit = $gross - array_sum($total_cost_by_category);
						    $profit = $gross - array_sum($total_expense_by_category) - array_sum($total_cost_by_category);
						    ?>
							
							<tr>
								<td>-</td>
								<td>
									<?php  if ($profit < 0) {
										echo '<strong><p class="os" style="color:red;">Loss</p></strong>';
									}
									else {
										echo Profit;
									}?>
								</td>
								<td>
									<span class="badge bg-success">
									    <?php echo $settings->currency; ?>
										<?php
										if (empty($total_payment_by_category)) {
											if (empty($total_expense_by_category)) {
												echo '';
											} else {
												$profit = 0 - array_sum($total_expense_by_category) - array_sum($total_cost_by_category);
												echo number_format($profit, 0, '.', ',');
											}
										}
										if (empty($total_expense_by_category)) {
											if (empty($total_payment_by_category)) {
												echo '0';
											} else {
												$profit = $gross - array_sum($total_cost_by_category);
												echo number_format($profit, 0, '.', ',');
											}
										} else {
											if (!empty($gross)) {
												$profit = $gross - array_sum($total_expense_by_category) - array_sum($total_cost_by_category);
												echo number_format($profit, 0, '.', ',');
											}
										}
										?>
									</span>
								</td>
								<td>
									<div id="work-progress2"><canvas width="47" height="22" class="cannvas"></canvas></div>
								</td>
							</tr>

						  
						</tbody>
					</table>
				</div>
				</div>
			</div>
			<!-- End col -->		
		</div>            
	</div>            
	
</section>
					
<!--main content end-->
<!--footer start-->