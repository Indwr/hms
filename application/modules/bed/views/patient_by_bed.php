	<?php 
		if ($this->ion_auth->in_group(array('Staff'))) {
		$staff_ion_id = $this->ion_auth->get_user_id();
		$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
		$permissions = $this->staff_model->getStaffById($staff)->permission;
		$permission1 = explode(',', $permissions);
		} 		
		$expiry_check = $settings->expiry_check;	
	?>
	<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('list'); ?>   <?php echo lang('bed'); ?> <?php echo lang('submitted'); ?></h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
                     </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks" >
                        <thead>
                            <tr>
                                                      
                                <th><?php echo lang('supplier'); ?></th>
                                <th><?php echo lang('product'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('date'); ?> <?php echo lang('submitted'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($quotes as $quote) { 
								if ($bed_id == $quote->bed) {
						?>
                            <tr class="">
                                
                                <td> 
								<?php if (in_array('supplier', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								<a href="supplier/viewSupplier?id=<?php echo $quote->supplier; ?>"  class="click_link"> 
								<?php } ?>
								<?php echo $this->db->get_where('supplier', array('id' => $quote->supplier))->row()->name; ?>
								<?php if (in_array('supplier', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								</a>
								<?php } ?>
								
								</td>
								
                                <td> <?php echo $item = $this->db->get_where('payment_category', array('id' => $quote->q_item))->row()->category; ?></td>
                                <td> 
								<?php 
								if(strlen($quote->q_description) > 20){ echo substr($quote->q_description, 0, 18) . '. . .'; }
								else{echo $quote->q_description;}
								?></td>
                                <td> <?php echo $quote->s_date; ?></td>
                                <td>
								
								<button type="button" class="btn btn-info btn-xs btn_width viewbutton" data-toggle="modal" data-id="<?php echo $quote->id; ?>"><i class="fa fa-eye"></i> <?php echo lang('view'); ?></button>   
							
								</td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
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



<!-- View Bed Modal-->
<div class="modal fade" id="myModal22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> <?php echo lang('quote'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editQuoteSentForm" action="" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('bed'); ?></label>
						<textarea disabled class="textarea_quote" name="q_description" value="" cols="30" id="" rows="4" placeholder="enter your bed here..."></textarea>						                  
					   
					</div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="q_item" value=''>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Bed Modal-->


<script src="common/js/bateristaworks.min.js"></script>
<script>
    $(document).ready(function () {
        $('#bateristaworks').DataTable({
            responsive: true,
            
           dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1,2,3,4,5],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }
        });
    });
</script>
<script type="text/javascript">
		$(document).ready(function () {
			$(".viewbutton").click(function (e) {
				e.preventDefault(e);
				// Get the record's ID via attribute  
				var iid = $(this).attr('data-id');
				$('#editQuoteSentForm').trigger("reset");
				$('#myModal22').modal('show');
				$.ajax({
					url: 'bed/editBedSentByJason?id=' + iid,
					method: 'GET',
					data: '',
					dataType: 'json',
				}).success(function (response) {
					// Populate the form fields with the data returned from server

					$('#editQuoteSentForm').find('[name="id"]').val(response.quote.id).end()
					$('#editQuoteSentForm').find('[name="q_description"]').val(response.quote.q_description).end()
					
				});
			});
		});
</script>

<script type="text/javascript">
		$(document).ready(function () {
			$(".editbutton").click(function (e) {
				e.preventDefault(e);
				// Get the record's ID via attribute  
				var iid = $(this).attr('data-id');
				$('#editQuoteForm').trigger("reset");
				$('#myModal2').modal('show');
				$.ajax({
					url: 'bed/editBedByJason?id=' + iid,
					method: 'GET',
					data: '',
					dataType: 'json',
				}).success(function (response) {
					// Populate the form fields with the data returned from server

					$('#editQuoteForm').find('[name="id"]').val(response.bed.id).end()
					$('#editQuoteForm').find('[name="description"]').val(response.bed.description).end()
					$('#editQuoteForm').find('[name="item"]').val(response.bed.item).end()
					$('#editQuoteForm').find('[name="q_item"]').val(response.bed.item).end()
				   
				});
			});
		});
</script>