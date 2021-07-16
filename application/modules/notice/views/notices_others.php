<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('list'); ?> <?php  echo lang('notice'); ?></h5>
				</div>
				<div class="card-body">
				
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<?php if (in_array('notice', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
									
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('notice'); ?>
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
                                <th><?php echo lang('notice'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('from_date'); ?></th>
                                <th><?php echo lang('to_date'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($notices as $notice) { 
						
						$staff_ion_id = $this->ion_auth->get_user_id();
						$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
					
						$users_notice = $this->db->get_where('notice', array('id' => $notice->id))->row()->user;
						$users_notice1 = explode(',', $users_notice);
						
						if (in_array($staff_profile, $users_notice1)) { ?>
                            <tr class="">
                                <td> <a href="notice/viewNotice?id=<?php echo $notice->id; ?>" ><?php echo $notice->title; ?></a></td>
                                <td><?php  echo substr($notice->description, 0, 50) . '. . .'; ?></td>
                                <td><?php  echo $notice->from_date; ?></td>
                                <td><?php  echo $notice->to_date; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs btn_width viewbutton" data-toggle="modal" data-id="<?php echo $notice->id; ?>"><i class="fa fa-eye"></i> View</button>   
                                    <?php if (in_array('notice', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
									<a class="btn btn-info editbutton btn_width btn-xs" href="notice/editNotice?id=<?php echo $notice->id; ?>"> <i class="fa fa-edit"></i> Edit </a>
									<a class="btn btn-info btn-xs btn_width delete_button" href="notice/delete?id=<?php echo $notice->id; ?>" onclick="return confirm('Are you sure you want to delete this notice?');"><i class="fa fa-trash-o"></i></a>
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






<!-- Add Notice Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Notice</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="notice/addNew" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('from_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" autocomplete="off" name="from_date" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('to_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="to_date"  autocomplete="off" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('select'); ?> <?php echo lang('profile_that_can_see'); ?></label>
						<select class="form-control js-example-basic-multiple"  name="user[]" multiple="" required>  
								<option value="">Select Profile...</option>	
								<option value="Doctor">Doctor</option>
								<option value="Nurse">Nurse</option>
								<option value="Laboratorist">Laboratorist</option>
								<option value="Pharmacist">Pharmacist</option>
								<option value="Accountant">Accountant</option>
								<option value="Receptionist">Receptionist</option>
						</select>
					</div>
					</div>
					</div>
					
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="ckeditor form-control editor" name="description" value="" cols="52" id="" rows="6" placeholder=""></textarea>						                  
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
<!-- Add Notice Modal-->







<!-- Edit Notice Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i> View Notice</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editNoticeForm" action="" method="post" enctype="multipart/form-data">
                   <div class="row">
					<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" readonly id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('from_date'); ?></label>
                        <input type="text" class="form-control " readonly name="from_date" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
					<div class="col-md-3">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('to_date'); ?></label>
                        <input type="text" class="form-control " name="to_date" readonly id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('profile_that_can_see'); ?></label>
                        <input type="text" class="form-control" name="user" id="exampleInputEmail1" value='' readonly placeholder="" required>
                    </div>
					
					
					
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="ckeditor form-control editor1" name="description" disabled="disabled" value="" cols="20" id="editor1" rows="6" placeholder=""></textarea>						                  
				   </div>
				   </div>
				   </div>
                    
					 <input type="hidden" name="id" value=''>
                </form>
                   
                   
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Notice Modal-->


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
		$('#editNoticeForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'notice/editNoticeByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editNoticeForm').find('[name="id"]').val(response.notice.id).end()
			$('#editNoticeForm').find('[name="title"]').val(response.notice.title).end()
			CKEDITOR.instances['editor1'].setData(response.notice.description)
			$('#editNoticeForm').find('[name="to_date"]').val(response.notice.to_date).end()
			$('#editNoticeForm').find('[name="from_date"]').val(response.notice.from_date).end()
			$('#editNoticeForm').find('[name="user"]').val(response.notice.user).end()
		});
	});
});
</script>
