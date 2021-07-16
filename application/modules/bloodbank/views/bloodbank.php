<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"> <?php  echo lang('bloodbank'); ?></h5>
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
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>                      
                                <th><?php echo lang('b_group'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bloodbanks as $bloodbank) { ?>
                            <tr class="">
                                <td> <?php echo $bloodbank->b_group; ?></td>
                                <td><?php  echo $bloodbank->bags . ' ' . 'Bags'; ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $bloodbank->id; ?>"><i class="fa fa-edit"></i> Update</button>   
                                        
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






<!-- Edit Bloodbank Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Update Blood Group</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBloodbankForm" action="bloodbank/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('bloodbank'); ?></label>
                        <input type="text" class="form-control" name="b_group" id="exampleInputEmail1" value='' placeholder="" readonly>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('bloodbank'); ?></label>
                        <input type="number" class="form-control" name="bags" pattern="[0-9]{5}" minlength="5" value='' placeholder="" required>
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
<!-- Edit Bloodbank Modal-->


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
		$('#editBloodbankForm').trigger("reset");
		$('#myModal2').modal('show');
		$.ajax({
			url: 'bloodbank/editBloodbankByJason?id=' + iid,
			method: 'GET',
			data: '',
			dataType: 'json',
		}).success(function (response) {
			// Populate the form fields with the data returned from server
			$('#editBloodbankForm').find('[name="id"]').val(response.bloodbank.id).end()
			$('#editBloodbankForm').find('[name="b_group"]').val(response.bloodbank.b_group).end()
			$('#editBloodbankForm').find('[name="bags"]').val(response.bloodbank.bags).end()
		});
	});
});
</script>
