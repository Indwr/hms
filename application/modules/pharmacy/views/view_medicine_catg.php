<?php 
	if ($this->ion_auth->in_group(array('Staff'))) {
	$staff_ion_id = $this->ion_auth->get_user_id();
	$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
	$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
	$permissions = $this->staff_model->getStaffById($staff)->permission;
	$permission1 = explode(',', $permissions);
	} 		
?>

<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('list'); ?> <?php  echo lang('medicine'); ?> <?php  echo 'In'; ?> <?php echo $this->db->get_where('medicine_category', array('id' => $medicineCategoryId))->row()->name; ?> <?php  echo lang('category'); ?></h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
									
                            </div>
									<div class="table_overflow">
									<table class="table table-striped table-hover table-bordered" id="bateristaworks">
							   <thead>
                            <tr>
                                <th> <?php echo lang('qr_code'); ?> </th>
                                <th> <?php echo lang('name'); ?> </th>
                                <th> <?php echo lang('category'); ?> </th>
                                <th> <?php echo lang('str_box'); ?> </th>
                                <th> <?php echo lang('qtyy'); ?></th>
                                <th> <?php echo lang('cost'); ?></th>
                                <th> <?php echo lang('sale'); ?></th>
                                <th> <?php echo lang('ex_date'); ?></th>
							
                                <th> <?php  echo lang('options'); ?> </th>
                            </tr>
                        </thead>
                        <tbody>

                  
                        <?php foreach ($medicines as $medicine) { 
						if(!empty($medicine->e_date) && empty($medicine->deletii) && $medicine->catg == $medicineCategoryId){?>
                            <tr class="">
							    
                                <td><a href="<?php echo $medicine->qr_code; ?>"><img class="qr_code_item" src="<?php echo $medicine->qr_code; ?>"></a></td>
                                <td>
								<?php if (in_array('pharmacy', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								<a href="pharmacy/viewMedicine?id=<?php echo $medicine->id; ?>"  class="click-link">
								<?php } ?>
										<?php echo $medicine->category; ?>
								<?php if (in_array('pharmacy', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								</a>
								<?php } ?>
								
								</td>
                                <td>
								<?php if (in_array('pharmacy', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								<a href="pharmacy/viewMedicineCategory?id=<?php echo $medicine->catg; ?>"  class="click-link">
								<?php } ?>
									<?php echo $this->db->get_where('medicine_category', array('id' => $medicine->catg))->row()->name; ?>
								<?php if (in_array('pharmacy', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								</a>
								<?php } ?>
								</td>
								
								<td>
								<?php echo $medicine->str_box; ?>
								</td>
								
                                <td>  <?php
                                    if ($medicine->howmany <= 0) {
                                        echo '<p class="btn btn-xs btn_width stock-out">Stock Out</p>';
                                    }
									else {
                                        echo $medicine->howmany;
                                    }
                                    ?> 
                                    <button type="button" class="btn btn green btn-xs btn_width load" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"> Load</button> 
                                </td>
			                    <td> <?php echo $settings->currency; ?> <?php echo number_format($medicine->cost_price); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($medicine->c_price); ?></td>
								<td>
								<?php echo $medicine->e_date; ?>
								
									
									<?php 
										if ($medicine->e_date == 0):
											echo '';
										elseif (strtotime($medicine->e_date) <= time() &&  ($medicine->howmany) > 0 && empty($medicine->deletii)): 
											echo '<p class="btn btn_width stock-expired" >Expired</p>';
										elseif (strtotime($medicine->e_date) <= strtotime("+2 month") && (strtotime($medicine->e_date) > time())  &&  ($medicine->howmany) > 0 && empty($medicine->deletii)):
											echo '<p class="btn btn_width soon-expire">Soon Expire</p>';
										else:
											echo '';
										endif; 
									?>

								</td>
							
                                    <td>
                                       <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"><i class="fa fa-edit"></i> Edit</button>   
                                        <a class="btn btn-info btn-xs delete_button" href="finance/deletePaymentCategory?id=<?php echo $medicine->id; ?>" onclick="return confirm('Are you sure you want to delete this medicine?');"><i class="fa fa-trash-o"></i></a>
                                    </td>
											
										</tr>
									<?php } ?>
									<?php } ?>
									</tbody>
								</table>
									</div>
								</div>
							</div>
							</section>
							
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
							
<!--main content end-->
<!--footer start-->






<!-- Add Birth Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Medicine</h4>
            </div>
            <div class="modal-body">
			  <form role="form" action="pharmacy/addMedicine" method="post" enctype="multipart/form-data">
				<div class="row"> 
				<div class="col-md-6"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
				<input type="text" class="form-control" name="category"exampleInputEmail1" value='' placeholder="" required>    
				</div>
				</div>
				<div class="col-md-6"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('MedicineCategory'); ?> </label>
				 <select name="catg" type="text" class="form-control m-bot15 js-example-basic-single" required="required">
				  <option class="form-control m-bot15 js-example-basic-single"  value="">Select Medicine Category...</option>
				<?php foreach ($MedicineCategorys as $MedicineCategory) { ?>
					<option   value="<?php echo $MedicineCategory->id; ?>"><?php echo $MedicineCategory->name; ?></option>
				<?php } ?> 	
				</select>	
				</div>
				</div>
				</div>
				<div class="row"> 
				<div class="col-md-6"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
				<input type="text" class="form-control "  name="description" id="exampleInputEmail1" value='' required>    
				</div> 
				</div> 
				<div class="col-md-3"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('qty'); ?></label>
				<input type="number" class="form-control" pattern="[0-9]{5}" id="exampleInputEmail1" name="howmany" value='' required placeholder="" >    
				</div> 
				</div>
				<div class="col-md-3">
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('ex_date'); ?></label>
				<input type="text" class="form-control default-date-picker"  name="e_date" id="exampleInputEmail1" value='' required placeholder="" autocomplete="off">    
				</div> 
				</div> 				
				
				</div>
				<div class="row">
                <div class="col-md-6">
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('str_box'); ?></label>
				<input type="text" class="form-control"  name="str_box" id="exampleInputEmail1" value='' required placeholder="" autocomplete="off">    
				</div> 
				</div> 
				
				<div class="col-md-3">
				<div class="form-group">
				<label for="exampleInputEmail1"> <?php echo lang('cost'); ?> (<?php echo $settings->currency; ?>)</label>
				<input type="number" class="form-control" pattern="[0-9]{5}" name="cost_price" id="exampleInputEmail1" value='' placeholder="" required>
				</div>
				</div>
				<div class="col-md-3">
				<div class="form-group">
				<label for="exampleInputEmail1"> <?php echo lang('sale'); ?> (<?php echo $settings->currency; ?>)</label>
				<input type="number" class="form-control" pattern="[0-9]{5}" name="c_price" id="exampleInputEmail1" value='' placeholder="" required>
				</div>
				</div>
				</div>
				

				<input type="hidden" name="id" value=''>					                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Report Modal-->



<!-- Edit Report Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Medicine</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicineForm" action="pharmacy/addMedicine" method="post" enctype="multipart/form-data">
				<div class="row"> 
				<div class="col-md-6"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
				<input type="text" class="form-control" name="category"exampleInputEmail1" value='' placeholder="" required>    
				</div>
				</div>
				<div class="col-md-6"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('MedicineCategory'); ?> </label>
				 <select name="catg" type="text" class="form-control m-bot15 " required>
				  <option class="form-control m-bot15"  value="">Select Medicine Category...</option>
				<?php foreach ($MedicineCategorys as $MedicineCategory) { ?>
					<option   value="<?php echo $MedicineCategory->id; ?>"><?php echo $MedicineCategory->name; ?></option>
				<?php } ?> 	
				</select>	
				</div>
				</div>
				</div>
				<div class="row"> 
				<div class="col-md-6"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
				<input type="text" class="form-control "  name="description" id="exampleInputEmail1" value='' required>    
				</div> 
				</div> 
				<div class="col-md-3"> 
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('qty'); ?></label>
				<input type="number" class="form-control" pattern="[0-9]{5}" id="exampleInputEmail1" name="howmany" value='' placeholder="" required>    
				</div> 
				</div>
				<div class="col-md-3">
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('ex_date'); ?></label>
				<input type="text" class="form-control default-date-picker"  name="e_date" id="exampleInputEmail1" value='' required placeholder="" autocomplete="off">    
				</div> 
				</div> 				
				</div>

				<div class="row">
                <div class="col-md-6">
				<div class="form-group"> 
				<label for="exampleInputEmail1"> <?php echo lang('str_box'); ?></label>
				<input type="text" class="form-control"  name="str_box" id="exampleInputEmail1" value='' required placeholder="" autocomplete="off">    
				</div> 
				</div> 
				
				<div class="col-md-3">
				<div class="form-group">
				<label for="exampleInputEmail1"> <?php echo lang('cost'); ?> (<?php echo $settings->currency; ?>)</label>
				<input type="number" class="form-control" pattern="[0-9]{5}" name="cost_price" id="exampleInputEmail1" value='' placeholder="" required>
				</div>
				</div>
				<div class="col-md-3">
				<div class="form-group">
				<label for="exampleInputEmail1"> <?php echo lang('sale'); ?> (<?php echo $settings->currency; ?>)</label>
				<input type="number" class="form-control" pattern="[0-9]{5}" name="c_price" id="exampleInputEmail1" value='' placeholder="" required>
				</div>
				</div>
				</div>
				
					<?php
					$current_user = $this->ion_auth->get_user_id();
					if ($this->ion_auth->in_group('Staff')) {
					$staff_name = $this->db->get_where('staff', array('ion_user_id' => $current_user))->row()->name;
					?>
					<input type="hidden" name="staff_update" value='<?php echo $staff_name; ?> Edited Medicine'>
					<?php } else{?>
					<input type="hidden" name="staff_update" value='Administrator Edited Medicine'>
					<?php } ?>
				
					<input  type="hidden" class="form-control" name="id" value="" >							                  
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Report Modal-->


<!-- Load Stock -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-medkit"></i> Load Medicine</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="loadMedicineForm" action="pharmacy/load" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('qty'); ?></label>
                        <input type="number" class="form-control" pattern="[0-9]{5}" name="qty" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					
					<?php
					$current_user = $this->ion_auth->get_user_id();
					if ($this->ion_auth->in_group('Staff')) {
						$staff_name = $this->db->get_where('staff', array('ion_user_id' => $current_user))->row()->name;
					?>
					<input type="hidden" name="staff_update" value='<?php echo $staff_name; ?> Loaded Medicine'>
					<?php } else{?>
					<input type="hidden" name="staff_update" value='Administrator Loaded Medicine'>
					<?php } ?>

                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


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

<script>
    $(document).ready(function () {
        $('#bateristaworks2').DataTable({
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

<script>
    $(document).ready(function () {
        $('#bateristaworks22').DataTable({
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
		$('#editMedicineForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'pharmacy/editMedicineByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editMedicineForm').find('[name="id"]').val(response.medicine.id).end()
			$('#editMedicineForm').find('[name="category"]').val(response.medicine.category).end()
			$('#editMedicineForm').find('[name="catg"]').val(response.medicine.catg).end()
			$('#editMedicineForm').find('[name="howmany"]').val(response.medicine.howmany).end()
			$('#editMedicineForm').find('[name="c_price"]').val(response.medicine.c_price).end()
			$('#editMedicineForm').find('[name="cost_price"]').val(response.medicine.cost_price).end()
			$('#editMedicineForm').find('[name="e_date"]').val(response.medicine.e_date).end()
			$('#editMedicineForm').find('[name="description"]').val(response.medicine.description).end()
			$('#editMedicineForm').find('[name="str_box"]').val(response.medicine.str_box).end()
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function () {
	$(".load").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute  
		var iid = $(this).attr('data-id');
		$('#loadMedicineForm').trigger("reset");
		$('#myModal3').modal('show');
		$.ajax({
			url: 'pharmacy/editMedicineByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#loadMedicineForm').find('[name="id"]').val(response.medicine.id).end()
		});
	});
});
</script>
