	<div class="contentbar">
		<!-- Start row -->
		<div class="row">
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-body">
				<ul class="nav nav-tabs custom-tab-line mb-3" id="defaultTabLine" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab-line" data-toggle="tab" href="report/birthReport#birth" role="tab" aria-controls="home-line" aria-selected="true"><i class="feather icon-user-plus mr-2"></i><?php  echo lang('birth'); ?> <?php  echo lang('report'); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab-line" data-toggle="tab" href="#profile-line" role="tab" aria-controls="profile-line" aria-selected="false"><i class="feather icon-user mr-2"></i>Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab-line" data-toggle="tab" href="#contact-line" role="tab" aria-controls="contact-line" aria-selected="false"><i class="feather icon-phone mr-2"></i>Contact</a>
					</li>
				</ul>
				<div class="tab-content" id="defaultTabContentLine">
					<div class="tab-pane fade show active" id="birth" role="tabpanel" aria-labelledby="home-tab-line">
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<a data-toggle="modal" href="#myModal">
											<div class="btn-group">
												<button id="" class="btn green">
													<i class="fa fa-plus-circle"></i>  <?php  echo lang('add'); ?>  <?php  echo lang('birth'); ?> <?php  echo lang('report'); ?>
												</button>
											</div>
										</a>
									 </div>
									<div class="space15"></div>
									<div class="table_overflow">
									<table class="table table-striped table-hover table-bordered" id="bateristaworks">
										<thead>
											<tr>                      
												<th><?php echo lang('patient'); ?></th>
												<th><?php echo lang('description'); ?></th>
												<th><?php echo lang('date'); ?></th>
												<th><?php echo lang('options'); ?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($reports as $report) { if($report == 'birth'){?>
											<tr class="">
												<td> <?php echo $report->patient; ?></td>
												<td><?php  echo substr($report->description, 0, 77) . '. . .'; ?></td>
												<td><?php  echo $report->date; ?></td>
												<td>
													<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $report->id; ?>"><i class="fa fa-eye"></i> View</button>   
														
													<a class="btn btn-info btn-xs btn_width delete_button" href="report/delete?id=<?php echo $report->id; ?>" onclick="return confirm('Are you sure you want to delete this report?');"><i class="fa fa-trash-o"></i></a>
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
					<div class="tab-pane fade" id="profile-line" role="tabpanel" aria-labelledby="profile-tab-line">
					  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
					</div>
					<div class="tab-pane fade" id="contact-line" role="tabpanel" aria-labelledby="contact-tab-line">
					  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
					</div>
				</div>
			</div>
			</div>
			</div>
		</div>
    </div>
							
							
							
							<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				
			</div>
		</div>
		</div>
</section>
<!-- page end-->
</section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Report Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="report/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('report'); ?></label>
                        <input type="text" class="form-control" name="dept" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea  class="" name="description" value="" cols="52" id="" rows="6" placeholder=""></textarea>						                  
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
<!-- Add Report Modal-->







<!-- Edit Report Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Report</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editReportForm" action="report/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('report'); ?></label>
                        <input type="text" class="form-control" name="dept" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
					<textarea class="" name="description" value="" cols="52" id="" rows="6" placeholder=""></textarea>						                  
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
<!-- Edit Report Modal-->


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
		$('#editReportForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'report/editReportByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editReportForm').find('[name="id"]').val(response.report.id).end()
			$('#editReportForm').find('[name="dept"]').val(response.report.dept).end()
			$('#editReportForm').find('[name="description"]').val(response.report.description).end()
		});
	});
});
</script>
