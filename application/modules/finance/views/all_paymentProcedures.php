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
					<h5 class="card-title"><?php  echo lang('paymentProcedures'); ?></h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
						<a data-toggle="modal" href="#myModal">
							<div class="btn-group">
								<button id="" class="btn green">
									<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?> <?php  echo lang('paymentProcedures'); ?>
								</button>
							</div>
						</a>
                     </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>
                                <th> <?php echo lang('name'); ?> </th>
                                <th> <?php echo lang('description'); ?></th>
                                <th> <?php echo lang('price'); ?></th>
                                <th> <?php echo lang('doc_com'); ?></th>
                                <th> <?php echo lang('type'); ?></th>
                                <th> <?php  echo lang('options'); ?> </th>
                            </tr>
                        </thead>
                        <tbody>

                  
                        <?php foreach ($categories as $category) { 
						
						if(empty($category->deletii) && empty($category->e_date)){
							?>
                            <tr class="">
                                <td>
								  <?php echo $category->category; ?>
								</td>
                                <td> <?php  echo substr($category->description, 0, 20) . '. . .'; ?> </td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($category->c_price); ?></td>
								<td> <?php 
								if (empty($category->doc_com)){
								echo '0' . ' ' . '%'; 
							    } else {
								echo $category->doc_com . ' ' . '%'; 
								}
							    ?></td>
								<td> <?php echo $category->type; ?></td>
								<td>
								<?php if (in_array('finance', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
									
								    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"></i> Edit</button>   
									<a class="btn btn-info btn-xs delete_button" href="finance/deletePaymentProcedures?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
								<?php } ?>
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

<!-- Add Procedure Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php  echo lang('add'); ?> <?php  echo lang('paymentProcedures'); ?></h4>
            </div>
					<div class="modal-body">
						<form role="form" action="finance/addpaymentProcedures" method="post" enctype="multipart/form-data">
					<div class="form-group"> 
						<label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
						<input type="text" class="form-control" name="category" id="exampleInputEmail1" value='' placeholder="" required>    
					</div>
					<div class="form-group"> 
						<label for="exampleInputEmail1"> <?php echo lang('description'); ?></label>
						<input type="text" class="form-control "  name="description" id="exampleInputEmail1" value='' required>    
					</div> 
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('price'); ?> </label>
						<input type="number" class="form-control" pattern="[0-9]{5}" name="c_price" id="exampleInputEmail1" value='' placeholder="" required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('doc_com'); ?> (%)</label>
						<input type="number" class="form-control" pattern="[0-9]{5}" name="doc_com" id="exampleInputEmail1" value='' placeholder="" >
					</div>
					</div>
					</div>
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('type'); ?> </label>
						<select class="form-control"  name="type" required>  
								<option value="">Select Category...</option>	
								<option value="Diagnostic Test">Diagnostic Test</option>	
								<option value="Others">Others</option>	
						</select>
					</div>
					<section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
				</form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Procedure Modal-->







<!-- Edit Procedure Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?> <?php  echo lang('paymentProcedures'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPaymentProcedures" action="finance/addpaymentProcedures" method="post" enctype="multipart/form-data">
                    <div class="form-group"> 
						<label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
						<input type="text" class="form-control" name="category" id="exampleInputEmail1" value='' placeholder="" required>    
					</div>
					<div class="form-group"> 
						<label for="exampleInputEmail1"> <?php echo lang('description'); ?></label>
						<input type="text" class="form-control "  name="description" id="exampleInputEmail1" value='' required>    
					</div> 
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('price'); ?> </label>
						<input type="number" class="form-control" pattern="[0-9]{5}" name="c_price" id="exampleInputEmail1" value='' placeholder="" required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1"> <?php echo lang('doc_com'); ?> (%)</label>
						<input type="number" class="form-control" pattern="[0-9]{5}" name="doc_com" id="exampleInputEmail1" value='' placeholder="" >
					</div>
					</div>
					</div>
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('type'); ?> </label>
						<select class="form-control"  name="type" required>  
								<option value="">Select Category...</option>	
								<option value="Diagnostic Test">Diagnostic Test</option>	
								<option value="Others">Others</option>	
						</select>
					</div>
				   <input type="hidden" name="id">
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Procedure Modal-->


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
	$(".editbutton").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#editPaymentProcedures').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'finance/editPaymentProceduresByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editPaymentProcedures').find('[name="id"]').val(response.paymentProcedures.id).end()
			$('#editPaymentProcedures').find('[name="category"]').val(response.paymentProcedures.category).end()
			$('#editPaymentProcedures').find('[name="type"]').val(response.paymentProcedures.type).end()
			$('#editPaymentProcedures').find('[name="description"]').val(response.paymentProcedures.description).end()
			$('#editPaymentProcedures').find('[name="doc_com"]').val(response.paymentProcedures.doc_com).end()
			$('#editPaymentProcedures').find('[name="c_price"]').val(response.paymentProcedures.c_price).end()
		});
	});
});
</script>
