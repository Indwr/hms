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
					<h5 class="card-title"><?php  echo lang('list'); ?> <?php  echo lang('MedicineCategory'); ?></h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
									<?php if (in_array('MedicineCategory', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('MedicineCategory'); ?>
												</button>
											</div>
										</a>
									<?php } ?>
                     </div>
                    <div class="space15"></div>
					<div class="table_overflow">
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>                     
                                <th><?php echo lang('MedicineCategory'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($MedicineCategorys as $MedicineCategory) { ?>
                            <tr class="">
                                <td> <?php echo $MedicineCategory->name; ?></td>
                                <td><?php  echo substr($MedicineCategory->description, 0, 77) . '. . .'; ?></td>
                                <td>
								<?php if ($this->ion_auth->in_group(array('Staff', 'admin'))) { ?>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $MedicineCategory->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                <?php } ?>  
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="pharmacy/deleteMedicineCategory?id=<?php echo $MedicineCategory->id; ?>" onclick="return confirm('Are you sure you want to delete this Medicine Category?');"><i class="fa fa-trash-o"></i></a>
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






<!-- Add MedicineCategory Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Medicine Category</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="pharmacy/addNewMedicineCategory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('MedicineCategory'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="" name="description" value="" cols="52" id="" rows="2" placeholder=""></textarea>						                  
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
<!-- Add MedicineCategory Modal-->







<!-- Edit MedicineCategory Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Medicine Category</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicineCategoryForm" action="pharmacy/addNewMedicineCategory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('MedicineCategory'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea class="" name="description" value="" cols="52" id="" rows="2" placeholder=""></textarea>						                  
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
<!-- Edit MedicineCategory Modal-->


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
		$('#editMedicineCategoryForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'pharmacy/editMedicineCategoryByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editMedicineCategoryForm').find('[name="id"]').val(response.MedicineCategory.id).end()
			$('#editMedicineCategoryForm').find('[name="name"]').val(response.MedicineCategory.name).end()
			$('#editMedicineCategoryForm').find('[name="description"]').val(response.MedicineCategory.description).end()
		});
	});
});
</script>
