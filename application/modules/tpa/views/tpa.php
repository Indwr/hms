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
					<h5 class="card-title"> <?php  echo 'Third-Party Administration Management'; ?> </h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
									<?php if (in_array('tpa', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('tpa'); ?>
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
                                <th><?php echo lang('tpa'); ?></th>
                                <th><?php echo lang('code'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('address'); ?></th>
                                <th><?php echo lang('contact_name'); ?></th>
                                <th><?php echo lang('contact_phone'); ?></th>
								<?php if ($this->ion_auth->in_group(array('Staff', 'admin'))) { ?>
                                <th><?php echo lang('options'); ?></th>
								<?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tpas as $tpa) { ?>
                            <tr class="">
                                <td> <?php echo $tpa->name; ?></td>
                                <td> <?php echo $tpa->code; ?></td>
                                <td> <?php echo $tpa->email; ?></td>
                                <td><?php  echo substr($tpa->address, 0, 77) . '. . .'; ?></td>
								<td> <?php echo $tpa->contact_name; ?></td>
								<td> <?php echo $tpa->contact_phone; ?></td>
								
								<?php if ($this->ion_auth->in_group(array('Staff', 'admin'))) { ?>
                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $tpa->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="tpa/delete?id=<?php echo $tpa->id; ?>" onclick="return confirm('Are you sure you want to delete this tpa?');"><i class="fa fa-trash-o"></i></a>
                                <?php } ?>  
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






<!-- Add Tpa Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Tpa</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="tpa/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('tpa'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('code'); ?></label>
                        <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='' placeholder="" >
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="" >
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
					<textarea  class="" name="address" value="" cols="53" id="" rows="2" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
				   <div class="row">
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('contact_name'); ?></label>
                        <input type="text" class="form-control" name="contact_name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('contact_phone'); ?></label>
                        <input type="text" class="form-control" name="contact_phone" id="exampleInputEmail1" value='' placeholder="" required>
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
<!-- Add Tpa Modal-->







<!-- Edit Tpa Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Tpa</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editTpaForm" action="tpa/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('tpa'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('code'); ?></label>
                        <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='' placeholder="" >
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="" >
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
					<textarea  class="" name="address" value="" cols="53" id="" rows="2" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
				   <div class="row">
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('contact_name'); ?></label>
                        <input type="text" class="form-control" name="contact_name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('contact_phone'); ?></label>
                        <input type="text" class="form-control" name="contact_phone" id="exampleInputEmail1" value='' placeholder="" required>
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
<!-- Edit Tpa Modal-->


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
		$('#editTpaForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'tpa/editTpaByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editTpaForm').find('[name="id"]').val(response.tpa.id).end()
			$('#editTpaForm').find('[name="name"]').val(response.tpa.name).end()
			$('#editTpaForm').find('[name="address"]').val(response.tpa.address).end()
			$('#editTpaForm').find('[name="code"]').val(response.tpa.code).end()
			$('#editTpaForm').find('[name="contact_phone"]').val(response.tpa.contact_phone).end()
			$('#editTpaForm').find('[name="contact_name"]').val(response.tpa.contact_name).end()
			$('#editTpaForm').find('[name="email"]').val(response.tpa.email).end()
		});
	});
});
</script>
