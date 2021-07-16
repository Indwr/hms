<div class="contentbar">
		<!-- Start row -->
		<div class="row">
			<!-- Start col -->
			<div class="col-lg-8">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title"><?php  echo lang('list'); ?>   <?php echo $staff->name; ?>'s <?php  echo lang('appointment'); ?></h5>
					</div>
					
						<div class="adv-table editable-table pad_tablee">
					<div class="space15"></div>
					<div class="table_overflow" >
					
                   <table class="table table-striped table-hover table-bordered" id="bateristaworks">
						<thead>
							<tr>                     
								<th><?php echo lang('patient'); ?></th>
								<th><?php echo lang('doctor'); ?></th>
								<th><?php echo lang('department'); ?></th>
								<th><?php echo lang('date'); ?> - <?php echo lang('time'); ?></th>
								<th><?php echo lang('status'); ?></th>
							</tr>
						</thead>
                        <tbody>
                        <?php foreach ($appointments as $appointment) { 
						if($appointment->doctor === $staff->id) {
						?>
							<tr class="">
								<td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name;?></td>
								<td> <?php echo $this->db->get_where('staff', array('id' => $appointment->doctor))->row()->name; ?></td>
								<td> <?php echo $appointment->department; ?></td>
								<td> <?php echo $appointment->date; ?> - <?php echo $appointment->time; ?></td>
								<td> <?php
									if (empty($appointment->status)) {
										echo '<p class="btn btn-xs btn_width process_po">'.lang('pending').'</p>';
									} elseif ($appointment->status == 'confirm') {
										echo '<p class="btn btn-xs btn_width paid_po" >'.lang('approved').'</p>';
									}
								?></td>
								
							</tr>
						<?php } ?>
						<?php } ?>
                        </tbody>
                    </table>
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
                                        <img src="<?php echo $staff->img_url; ?>" width="80px"><br>
                                        <h5 class="card-title mb-0"><?php echo $staff->name; ?></h5>
                                    </div>
                                    <div class="col-7">
                                        
                                    </div>
                                </div>
                            </div>
							<table class="table  table-hover " id="">
					   
						<tbody>  
							<tr>
								<td>
									<i  class=" fa fa-money"></i>
								</td>
								<td>
									<span class="badge bg-success">
									<?php echo lang('doc_com'); ?>: <?php echo $settings->currency; ?>
									<?php
									$query_payment = $this->db->get('payment')->result();
									$i = 0;
									foreach ($query_payment as $q_payment) {
										if ($q_payment->doctor == $staff->id) {
											$i = $i + $q_payment->doc_com;
										}
									}

									echo $i;
									?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							<tr>
								<td>
									<i  class=" fa fa-sitemap"></i>
								</td>
								<td>
									<span class="badge bg-warning">
									<?php echo $staff->dept; ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>
									<i  class=" fa fa-envelope"></i>
								</td>
								<td>
									<span class="badge bg-warning">
									<?php echo $staff->email; ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
							
							<tr>
								<td>
									<i  class=" fa fa-phone"></i>
								</td>
								<td>
									<span class="badge bg-warning">
									<?php echo $staff->phone; ?>
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>

							<tr>
								<td>
									<i class="	fa fa-location-arrow"></i>
								</td>
								<td>
									<span class="badge bg-warning" >
										<?php echo $staff->address; ?>
										
									</span>
								</td>
								<td>
									<div id="work-progress1"><canvas width="47" height="20" class="cannvas"></canvas></div>
								</td>
							</tr>
						  
						</tbody>
					</table>
				</div>
				</div>
			</div>
			<!-- End col -->		
		</div>           

<script src="common/js/bateristaworks.min.js"></script>
<script>
   $(document).ready(function () {
        $('#bateristaworks').DataTable({
            responsive: true,
			
            dom: "<'row'<'col-sm-4'l><'col-sm-2 text-center'B><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-12'p>>",
            buttons: [
				
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>
