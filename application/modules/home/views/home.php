	<?php 
		if ($this->ion_auth->in_group(array('Staff'))) {
		$staff_ion_id = $this->ion_auth->get_user_id();
		$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
		$permissions = $this->staff_model->getStaffById($staff)->permission;
		$permission1 = explode(',', $permissions);
		} 		
	?>
	<section id="main-content"> 
    <section class="wrapper site-min-height">
				
	<?php if (!$this->ion_auth->in_group('Patient')) { ?>
	
     <div class="contentbar">
	 <div class="col-lg-12">
			<div class=" m-b-30">
			
			<div class="row">
			<div class="col-md-3">
					<div class="col-lg-12 col-xl-12">
						<div class="card m-b-30">
							<div class="card-body">
								<div class="media">
									<span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-users"></i></span>
									<div class="media-body">
										<p class="mb-0"><?php  echo lang('patients'); ?></p>
										<h5 class="mb-0">
										<?php
										$this->db->from('patient');
										$count = $this->db->count_all_results();
										echo number_format($count, 0, '.', ',')
										?>
										</h5>                      
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
				
			<div class="col-md-3">
				<div class="col-lg-12 col-xl-12">
					<div class="card m-b-30">
						<div class="card-body">
							<div class="media">
								<span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-user-md"></i></span>
								<div class="media-body">
									<p class="mb-0"><?php  echo lang('doctors'); ?></p>
									<h5 class="mb-0">
									<?php
									$query_staff = $this->db->get('staff')->result();
									$i = 0;
									foreach ($query_staff as $q_staff) {
										if ($q_staff->profile == 'Doctor') {
											$i = $i + 1;
										}
									}
									echo $i;
									?>  
									</h5>                      
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="col-md-3">	
				<div class="col-lg-12 col-xl-12">
					<div class="card m-b-30">
						<div class="card-body">
							<div class="media">
								<span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-user"></i></span>
								<div class="media-body">
									<p class="mb-0"><?php  echo lang('nurses'); ?></p>
									<h5 class="mb-0">
									<?php
									$query_staff = $this->db->get('staff')->result();
									$i = 0;
									foreach ($query_staff as $q_staff) {
										if ($q_staff->profile == 'Nurse') {
											$i = $i + 1;
										}
									}
									echo $i;
									?>  
									</h5>                      
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="col-md-3">
				<div class="col-lg-12 col-xl-12">
					<div class="card m-b-30">
						<div class="card-body">
							<div class="media">
								<span class="align-self-center mr-3 action-icon badge badge-danger-inverse"><i class="fa fa-user"></i></span>
								<div class="media-body">
									<p class="mb-0"><?php  echo lang('laboratorists'); ?></p>
									<h5 class="mb-0">
									<?php
									$query_staff = $this->db->get('staff')->result();
									$i = 0;
									foreach ($query_staff as $q_staff) {
										if ($q_staff->profile == 'Laboratorist') {
											$i = $i + 1;
										}
									}
									echo $i;
									?>  
									</h5>                      
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			
			
			<div class="row">
			<div class="col-md-3">
					<div class="col-lg-12 col-xl-12">
						<div class="card m-b-30">
							<div class="card-body">
								<div class="media">
									<span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-user"></i></span>
									<div class="media-body">
										<p class="mb-0"><?php  echo lang('pharmacists'); ?></p>
										<h5 class="mb-0">
										<?php
										$query_staff = $this->db->get('staff')->result();
										$i = 0;
										foreach ($query_staff as $q_staff) {
											if ($q_staff->profile == 'Pharmacist') {
												$i = $i + 1;
											}
										}
										echo $i;
										?>  
										</h5>                      
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
				
			<div class="col-md-3">
				<div class="col-lg-12 col-xl-12">
					<div class="card m-b-30">
						<div class="card-body">
							<div class="media">
								<span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-user"></i></span>
								<div class="media-body">
									<p class="mb-0"><?php  echo lang('accountants'); ?></p>
									<h5 class="mb-0">
									<?php
									$query_staff = $this->db->get('staff')->result();
									$i = 0;
									foreach ($query_staff as $q_staff) {
										if ($q_staff->profile == 'Accountant') {
											$i = $i + 1;
										}
									}
									echo $i;
									?>  
									</h5>                      
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="col-md-3">	
				<div class="col-lg-12 col-xl-12">
					<div class="card m-b-30">
						<div class="card-body">
							<div class="media">
								<span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-user"></i></span>
								<div class="media-body">
									<p class="mb-0"><?php  echo lang('receptionists'); ?></p>
									<h5 class="mb-0">
									<?php
									$query_staff = $this->db->get('staff')->result();
									$i = 0;
									foreach ($query_staff as $q_staff) {
										if ($q_staff->profile == 'Receptionist') {
											$i = $i + 1;
										}
									}
									echo $i;
									?>  
									</h5>                      
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="col-md-3">
				<div class="col-lg-12 col-xl-12">
					<div class="card m-b-30">
						<div class="card-body">
							<div class="media">
								<span class="align-self-center mr-3 action-icon badge badge-danger-inverse"><i class="fa fa-money"></i></span>
								<div class="media-body">
									<p class="mb-0"><?php  echo lang('payments'); ?></p>
									<h5 class="mb-0">
									<?php
									$query_staff = $this->db->get('payment')->result();
									$i = 0;
									
									$i = $i + 1;
										
									echo $i;
									?>  
									</h5>                      
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
	<?php } ?>
	
		<div class="contentbar " >
		<!-- Start row -->
		<div class="row">
		
	<?php if (in_array('finance', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
			<!-- Start col -->
			<div class="col-lg-4">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title"> <?php echo date('M')?>, <?php echo lang('this_month_sale_expense_pie_chart'); ?> </h5>
					</div> 
					<div class="panel-body text-center">
					<canvas id="pie" height="250" width="290"></canvas>
					<br>
					<span class="sale_color" > Sales: <?php echo $settings->currency . ' ' . number_format($this_month[0], 0, '.', ',');?> </span>
					<span class="expense_color"> Expenses: <?php echo $settings->currency . ' ' . number_format($this_month[1], 0, '.', ','); ?></span>
					
				</div>
			</div>
		</div>
		
	<div class="col-lg-12 col-xl-8">
		<div class="card m-b-30 dash-widget">
				<div class="card-header">                                
					<div class="row align-items-center">
						<div class="col-5">
							<h5 class="card-title mb-0" id="chart_header"><?php echo lang('sales_graph'); ?></h5>
						</div>
						<div class="col-7">
							<ul class="nav nav-pills float-right" id="pills-index-tab-justified" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-sales-tab-justified" data-toggle="pill" href="#pills-sales-justified" onClick="change_sales()" role="tab" aria-selected="true">Sales</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-clients-tab-justified" data-toggle="pill" href="#pills-sales-justified" onClick="change_expenses()" role="tab" aria-selected="false">Expenses</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="card-body py-0 pl-0 pr-2" id="clear_sale">
						<div id="apex-bar"></div>
					</div>
					
					<div class="card-body py-0 pl-0 pr-2" style="display:none;" id="show_expense">
						<div id="apex-bar-expense"></div>
					</div>
				</div>
		</div>
	</div>
		
		<?php
			foreach ($payments as $payment) {
				$date = $payment->date;
				$month = date('m', $date);
				$year = date('y', $date);
				if (date('y', time()) == date('y', $date)) {
					if ($month == '01') {
						$jan[] = $payment->gross_total;
					}
					if ($month == '02') {
						$feb[] = $payment->gross_total;
					}
					if ($month == '03') {
						$mar[] = $payment->gross_total;
					}
					if ($month == '04') {
						$apr[] = $payment->gross_total;
					}
					if ($month == '05') {
						$may[] = $payment->gross_total;
					}
					if ($month == '06') {
						$jun[] = $payment->gross_total;
					}
					if ($month == '07') {
						$jul[] = $payment->gross_total;
					}
					if ($month == '08') {
						$aug[] = $payment->gross_total;
					}
					if ($month == '09') {
						$sep[] = $payment->gross_total;
					}
					if ($month == '10') {
						$oct[] = $payment->gross_total;
					}
					if ($month == '11') {
						$nov[] = $payment->gross_total;
					}
					if ($month == '12') {
						$dec[] = $payment->gross_total;
					}
				}
			}
			?>

			<?php
			if (!empty($jan)) {
				$jan_total = array_sum($jan);
			} else {
				$jan_total = 0;
			}
			if (!empty($feb)) {
				$feb_total = array_sum($feb);
			} else {
				$feb_total = 0;
			}
			if (!empty($mar)) {
				$mar_total = array_sum($mar);
			} else {
				$mar_total = 0;
			}
			if (!empty($apr)) {
				$apr_total = array_sum($apr);
			} else {
				$apr_total = 0;
			}
			if (!empty($may)) {
				$may_total = array_sum($may);
			} else {
				$may_total = 0;
			}
			if (!empty($jun)) {
				$jun_total = array_sum($jun);
			} else {
				$jun_total = 0;
			}
			if (!empty($jul)) {
				$jul_total = array_sum($jul);
			} else {
				$jul_total = 0;
			}
			if (!empty($aug)) {
				$aug_total = array_sum($aug);
			} else {
				$aug_total = 0;
			}
			if (!empty($sep)) {
				$sep_total = array_sum($sep);
			} else {
				$sep_total = 0;
			}
			if (!empty($oct)) {
				$oct_total = array_sum($oct);
			} else {
				$oct_total = 0;
			}
			if (!empty($nov)) {
				$nov_total = array_sum($nov);
			} else {
				$nov_total = 0;
			}
			if (!empty($dec)) {
				$dec_total = array_sum($dec);
			} else {
				$dec_total = 0;
			}
			$all_value = array($jan_total, $feb_total, $mar_total, $apr_total, $may_total, $jun_total, $jul_total, $aug_total, $sep_total, $oct_total, $nov_total, $dec_total);
			if (!empty($all_value)) {
				$max = max($all_value);
			} else {
				$max = 0;
			}
			$str_len = strlen(round($max));
			$indicator = pow(10, $str_len - 1);
			if (!function_exists('ceiling')) {

				function ceiling($number, $significance = 1) {
					return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number / $significance) * $significance) : false;
				}

			}
			$round = ceiling($max, $indicator);
			?>
			
			<?php
                        foreach ($expenses as $expense) {
                            $date1 = $expense->date;
                            $month1 = date('m', $date1);
                            $year1 = date('y', $date1);
                            if (date('y', time()) == date('y', $date1)) {
                                if ($month1 == '01') {
                                    $jan1[] = $expense->amount;
                                }
                                if ($month1 == '02') {
                                    $feb1[] = $expense->amount;
                                }
                                if ($month1 == '03') {
                                    $mar1[] = $expense->amount;
                                }
                                if ($month1 == '04') {
                                    $apr1[] = $expense->amount;
                                }
                                if ($month1 == '05') {
                                    $may1[] = $expense->amount;
                                }
                                if ($month1 == '06') {
                                    $jun1[] = $expense->amount;
                                }
                                if ($month1 == '07') {
                                    $jul1[] = $expense->amount;
                                }
                                if ($month1 == '08') {
                                    $aug1[] = $expense->amount;
                                }
                                if ($month1 == '09') {
                                    $sep1[] = $expense->amount;
                                }
                                if ($month1 == '10') {
                                    $oct1[] = $expense->amount;
                                }
                                if ($month1 == '11') {
                                    $nov1[] = $expense->amount;
                                }
                                if ($month1 == '12') {
                                    $dec1[] = $expense->amount;
                                }
                            }
                        }
                        ?>

                        <?php
                        if (!empty($jan1)) {
                            $jan_total1 = array_sum($jan1);
                        } else {
                            $jan_total1 = 0;
                        }
                        if (!empty($feb1)) {
                            $feb_total1 = array_sum($feb1);
                        } else {
                            $feb_total1 = 0;
                        }
                        if (!empty($mar1)) {
                            $mar_total1 = array_sum($mar1);
                        } else {
                            $mar_total1 = 0;
                        }
                        if (!empty($apr1)) {
                            $apr_total1 = array_sum($apr1);
                        } else {
                            $apr_total1 = 0;
                        }
                        if (!empty($may1)) {
                            $may_total1 = array_sum($may1);
                        } else {
                            $may_total1 = 0;
                        }
                        if (!empty($jun1)) {
                            $jun_total1 = array_sum($jun1);
                        } else {
                            $jun_total1 = 0;
                        }
                        if (!empty($jul1)) {
                            $jul_total1 = array_sum($jul1);
                        } else {
                            $jul_total1 = 0;
                        }
                        if (!empty($aug1)) {
                            $aug_total1 = array_sum($aug1);
                        } else {
                            $aug_total1 = 0;
                        }
                        if (!empty($sep1)) {
                            $sep_total1 = array_sum($sep1);
                        } else {
                            $sep_total1 = 0;
                        }
                        if (!empty($oct1)) {
                            $oct_total1 = array_sum($oct1);
                        } else {
                            $oct_total1 = 0;
                        }
                        if (!empty($nov1)) {
                            $nov_total1 = array_sum($nov1);
                        } else {
                            $nov_total1 = 0;
                        }
                        if (!empty($dec1)) {
                            $dec_total1 = array_sum($dec1);
                        } else {
                            $dec_total1 = 0;
                        }
                        $all_value1 = array($jan_total1, $feb_total1, $mar_total1, $apr_total1, $may_total1, $jun_total1, $jul_total1, $aug_total1, $sep_total1, $oct_total1, $nov_total1, $dec_total1);
                        if (!empty($all_value1)) {
                            $max1 = max($all_value1);
                        } else {
                            $max1 = 0;
                        }
                        $str_len1 = strlen(round($max1));
                        $indicator1 = pow(10, $str_len1 - 1);
                        if (!function_exists('ceiling')) {

                            function ceiling($number1, $significance1 = 1) {
                                return ( is_numeric($number1) && is_numeric($significance1) ) ? (ceil($number1 / $significance1) * $significance1) : false;
                            }

                        }
                        $round1 = ceiling($max1, $indicator1);
                        ?>	
	<?php } ?>	
					<div class="card m-b-30 dash-widget">
							<div class="card-header">                                
								<div class="row align-items-center">
									<div class="col-md-12">
										<h5 class="card-title mb-0"><?php echo lang('appointment_calander'); ?></h5>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<section class="panel">
										<div class="panel-body">
											<div id="calendar" class="has-toolbar calendar_view"></div>
										</div>
									</section>
								</div>
							</div>
					</div>
			
			
	</section>
	
	

		<script src="assets_ui/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="assets_ui/plugins/apexcharts/irregular-data-series.js"></script> 
		
		<script>
		
		var options = {
		  chart: {
			type: 'line'
		  },
		  series: [{
			name: 'Sales <?php echo $settings->currency; ?>',
			data: [<?php if (!empty($jan)) {echo array_sum($jan) * 100 ;}?>,<?php if (!empty($feb)) {echo array_sum($feb) * 100 ;}?>,<?php if (!empty($mar)) {echo array_sum($mar) * 100 ;}?>,<?php if (!empty($apr)) {echo array_sum($apr) * 100 ;}?>,<?php if (!empty($may)) {echo array_sum($may) * 100 ;}?>,<?php if (!empty($jun)) {echo array_sum($jun) * 100 ;}?>,<?php if (!empty($jul)) {echo array_sum($jul) * 100 ;}?>,<?php if (!empty($aug)) {echo array_sum($aug) * 100 ;}?>,<?php if (!empty($sep)) {echo array_sum($sep) * 100 ;}?>,<?php if (!empty($oct)) {echo array_sum($oct) * 100 ;}?>,<?php if (!empty($nov)) {echo array_sum($nov) * 100 ;}?>,<?php if (!empty($dec)) {echo array_sum($dec) * 100 ;}?>]
		  }],
		  xaxis: {
			categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
		  }
		}

		new ApexCharts(document.querySelector("#apex-bar"),options).render();
		
		
		var optionss = {
		  chart: {
			type: 'line'
		  },
		  series: [{
			name: 'Expenses <?php echo $settings->currency; ?>',
			data: [<?php if (!empty($jan1)) {echo array_sum($jan1) * 100 ;}?>,<?php if (!empty($feb1)) {echo array_sum($feb1) * 100 ;}?>,<?php if (!empty($mar1)) {echo array_sum($mar1) * 100 ;}?>,<?php if (!empty($apr1)) {echo array_sum($apr1) * 100 ;}?>,<?php if (!empty($may1)) {echo array_sum($may1) * 100 ;}?>,<?php if (!empty($jun1)) {echo array_sum($jun1) * 100 ;}?>,<?php if (!empty($jul1)) {echo array_sum($jul1) * 100 ;}?>,<?php if (!empty($aug1)) {echo array_sum($aug1) * 100 ;}?>,<?php if (!empty($sep1)) {echo array_sum($sep1) * 100 ;}?>,<?php if (!empty($oct1)) {echo array_sum($oct1) * 100 ;}?>,<?php if (!empty($nov1)) {echo array_sum($nov1) * 100 ;}?>,<?php if (!empty($dec1)) {echo array_sum($dec1) * 100 ;}?>]
		  }],
		  xaxis: {
			categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
		  }
		}
		
		new ApexCharts(document.querySelector("#apex-bar-expense"),optionss).render();		
		
		
		function change_sales(){
			 document.getElementById('chart_header').innerHTML = 'Sales Graph';
			 document.getElementById('clear_sale').style = '';
			 document.getElementById('show_expense').style = 'display:none';
		}		
		
		function change_expenses(){
			 document.getElementById('chart_header').innerHTML = 'Expenses Graph';
			 document.getElementById('clear_sale').style = 'display:none';
			 document.getElementById('show_expense').style = '';
		}
		</script>
		
		
<?php
$total_this = $this_month[1] + $this_month[0];
?>								
<script>

    //owl carousel

    $(document).ready(function () {
        $("#owl-demo").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: true

        });
    });

    //custom select box

    $(function () {
        $('select.styled').customSelect();
    });



    Morris.Bar({
        element: 'hero-bar2',
        data: [
            {device: 'Jan', geekbench: <?php echo $jan_total2; ?>},
            {device: 'Feb', geekbench: <?php echo $feb_total2; ?>},
            {device: 'March', geekbench: <?php echo $mar_total2; ?>},
            {device: 'April', geekbench: <?php echo $apr_total2; ?>},
            {device: 'May', geekbench: <?php echo $may_total2; ?>},
            {device: 'Jun', geekbench: <?php echo $jun_total2; ?>},
            {device: 'Jul', geekbench: <?php echo $jul_total2; ?>},
            {device: 'Ayg', geekbench: <?php echo $aug_total2; ?>},
            {device: 'Sep', geekbench: <?php echo $sep_total2; ?>},
            {device: 'Oct', geekbench: <?php echo $oct_total2; ?>},
            {device: 'Nov', geekbench: <?php echo $nov_total2; ?>},
            {device: 'Dec', geekbench: <?php echo $dec_total2; ?>}
        ],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Geekbench'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        barColors: ['#19b6c2']
    });
    Morris.Bar({
        element: 'hero-bar1',
        data: [
            {device: 'Jan', geekbench: <?php echo $jan_total1; ?>},
            {device: 'Feb', geekbench: <?php echo $feb_total1; ?>},
            {device: 'March', geekbench: <?php echo $mar_total1; ?>},
            {device: 'April', geekbench: <?php echo $apr_total1; ?>},
            {device: 'May', geekbench: <?php echo $may_total1; ?>},
            {device: 'Jun', geekbench: <?php echo $jun_total1; ?>},
            {device: 'Jul', geekbench: <?php echo $jul_total1; ?>},
            {device: 'Ayg', geekbench: <?php echo $aug_total1; ?>},
            {device: 'Sep', geekbench: <?php echo $sep_total1; ?>},
            {device: 'Oct', geekbench: <?php echo $oct_total1; ?>},
            {device: 'Nov', geekbench: <?php echo $nov_total1; ?>},
            {device: 'Dec', geekbench: <?php echo $dec_total1; ?>}
        ],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Geekbench'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        barColors: ['#19b6c2']
    });

    Morris.Bar({
        element: 'hero-bar',
        data: [
            {device: 'Jan', geekbench: <?php echo $jan_total; ?>},
            {device: 'Feb', geekbench: <?php echo $feb_total; ?>},
            {device: 'March', geekbench: <?php echo $mar_total; ?>},
            {device: 'April', geekbench: <?php echo $apr_total; ?>},
            {device: 'May', geekbench: <?php echo $may_total; ?>},
            {device: 'Jun', geekbench: <?php echo $jun_total; ?>},
            {device: 'Jul', geekbench: <?php echo $jul_total; ?>},
            {device: 'Ayg', geekbench: <?php echo $aug_total; ?>},
            {device: 'Sep', geekbench: <?php echo $sep_total; ?>},
            {device: 'Oct', geekbench: <?php echo $oct_total; ?>},
            {device: 'Nov', geekbench: <?php echo $nov_total; ?>},
            {device: 'Dec', geekbench: <?php echo $dec_total; ?>}
        ],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Geekbench'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        barColors: ['#19b6c2']
    });

</script>
		<script src="common/js/jquery-1.8.3.min.js"></script>
		<script src="common/js/all-chartjs.js"></script>
		<script src="common/assets/morris.js-0.4.3/morris.min.js" type="text/javascript"></script>
		<script src="common/assets/morris.js-0.4.3/raphael-min.js" type="text/javascript"></script>
		<script src="common/assets/chart-master/Chart.js"></script>


		<script>
			<?php
			$total_this = $this_month[1] + $this_month[0];
			?>

			var pieData = [
				{
					value: <?php echo $this_month[1] / $total_this * 180; ?>,
					color: "#b8becc"
				},
				{
					value: <?php echo $this_month[0] / $total_this * 180; ?>,
					color: "#0080ff"
				}

			];
			
			new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
		</script>