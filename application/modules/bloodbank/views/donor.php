<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('list'); ?> <?php  echo lang('donor'); ?></h5>
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
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('donor'); ?>
												</button>
											</div>
										</a>
                     </div>
                    <div class="space15"></div>
					<div class="table_overflow">
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>                      
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('gender'); ?></th>
                                <th><?php echo lang('age'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('b_group'); ?></th>
                                <th><?php echo lang('donate_date'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($donors as $donor) { ?>
                            <tr class="">
                                <td> <?php echo $donor->name; ?></td>
                                <td> <?php echo $donor->gender; ?></td>
                                <td> 
								<?php 
								$birthDate = $donor->dob;
							    echo $age = date_diff(date_create($birthDate), date_create('now'))->y;
								?>
								</td>
                                <td> <?php echo $donor->phone; ?></td>
                                <td> <?php echo $donor->b_group; ?></td>
                                <td> <?php echo $donor->d_date; ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $donor->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                        
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="bloodbank/delete?id=<?php echo $donor->id; ?>" onclick="return confirm('Are you sure you want to delete this donor?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
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






<!-- Add Donor Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Donor</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="bloodbank/addDonor" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="gender" value='' required>
						<option value=""></option>
						<option value="Others"  > <?php echo lang('others'); ?> </option>
                        <option value="Male"  > <?php echo lang('male'); ?> </option>
                        <option value="Female"  > <?php echo lang('female'); ?> </option> 
                        </select>
                    </div>
                    </div>
					
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('dob'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="dob" id="exampleInputEmail1" autocomplete="off" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('b_group'); ?></label>
						<select class="form-control js-example-basic-single"  required name="b_group">
							<option value=""></option>
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
						</select>
                    </div>
                    </div>
					
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('last_donate_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="d_date" id="exampleInputEmail1" autocomplete="off" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="number" class="form-control " name="phone" pattern="[0-9]{5}" minlength="5" autocomplete="off" value='' placeholder="" >
                    </div>
                    </div>
                    </div>
                    
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Donor Modal-->







<!-- Edit Donor Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Donor</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editDonorForm" action="bloodbank/addDonor" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15 " name="gender" value='' required>
						<option value="Others"  > <?php echo lang('others'); ?> </option>
                        <option value="Male"  > <?php echo lang('male'); ?> </option>
                        <option value="Female"  > <?php echo lang('female'); ?> </option> 
                        </select>
                    </div>
                    </div>
					
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('dob'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="dob" id="exampleInputEmail1" autocomplete="off" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('b_group'); ?></label>
						<select class="form-control "  required name="b_group">
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
						</select>
                    </div>
                    </div>
					
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('last_donate_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="d_date" id="exampleInputEmail1" autocomplete="off" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="number" class="form-control " name="phone" pattern="[0-9]{5}" minlength="5" autocomplete="off" value='' placeholder="" >
                    </div>
                    </div>
                    </div>
					
                    <input type="hidden" name="id" >
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Donor Modal-->


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
		$('#editDonorForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'bloodbank/editDonorByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editDonorForm').find('[name="id"]').val(response.donor.id).end()
			$('#editDonorForm').find('[name="name"]').val(response.donor.name).end()
			$('#editDonorForm').find('[name="gender"]').val(response.donor.gender).end()
			$('#editDonorForm').find('[name="b_group"]').val(response.donor.b_group).end()
			$('#editDonorForm').find('[name="dob"]').val(response.donor.dob).end()
			$('#editDonorForm').find('[name="d_date"]').val(response.donor.d_date).end()
			$('#editDonorForm').find('[name="phone"]').val(response.donor.phone).end()
		});
	});
});
</script>
             