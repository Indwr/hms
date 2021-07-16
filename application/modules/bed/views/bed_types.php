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
					<h5 class="card-title"><?php  echo lang('list'); ?>   <?php echo lang('bed'); ?> <?php echo lang('types'); ?></h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
					<?php if (in_array('bed', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                       <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add'); ?> <?php echo lang('bed'); ?> <?php echo lang('type'); ?>
                                </button>
                            </div>
                        </a>
					<?php } ?>
                     </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks" >
                        <thead>
                            <tr>
                                <th><?php echo lang('title'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bed_types as $bed_types) { ?>
                            <tr class="">
							    <td> <?php echo $bed_types->name; ?></td>
								
                                <td>
								<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $bed_types->id; ?>"><i class="fa fa-edit"></i> Edit</button>   
                                        
                                <a class="btn btn-info btn-xs btn_width delete_button" href="bed/deleteBedType?id=<?php echo $bed_types->id; ?>" onclick="return confirm('Are you sure you want to delete this bed type?');"><i class="fa fa-trash-o"></i></a>
                               
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
    </section>
</section>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add'); ?> <?php echo lang('bed'); ?> <?php echo lang('type'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="bed/addNewBedType" method="post" enctype="multipart/form-data">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
					<input  type="text" class="form-control" name="name" value=""  placeholder="">						                  
					</div>
					
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Bed Modal-->







<!-- Bed Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php echo lang('bed'); ?> <?php echo lang('type'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBedTypeForm" action="bed/addNewBedType" method="post" enctype="multipart/form-data">
					<div class="form-group">
					<div class="form-group">
					<label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
					<input  type="text" class="form-control" name="name" value=""  placeholder="">						                  
					</div>
					
                    <input type="hidden" name="id" value=''>
                    
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info" ><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
            </div>
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
			$(".editbutton").click(function (e) {
				e.preventDefault(e);
				// Get the record's ID via attribute  
				var iid = $(this).attr('data-id');
				$('#editBedTypeForm').trigger("reset");
				$('#myModal2').modal('show');
				$.ajax({
					url: 'bed/editBedTypeByJason?id=' + iid,
					method: 'GET',
					data: '',
					dataType: 'json',
				}).success(function (response) {
					// Populate the form fields with the data returned from server

					$('#editBedTypeForm').find('[name="id"]').val(response.bed_type.id).end()
					$('#editBedTypeForm').find('[name="name"]').val(response.bed_type.name).end()
				   
				});
			});
		});
</script>