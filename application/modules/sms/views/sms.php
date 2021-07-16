<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('sent'); ?> <?php  echo lang('sms'); ?></h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
									<a href="sms/sendNewText">
										<div class="btn-group">
											<button id="" class="btn green">
												<i class="fa fa-location-arrow"></i> <?php  echo lang('send'); ?> <?php  echo lang('new'); ?> <?php  echo lang('sms'); ?>
											</button>
										</div>
									</a>
                     </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('message'); ?></th>
                                <th><?php echo lang('recipient'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($sents as $sent) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style='width: 25%;'><?php echo date('h:i:s a m/d/y', $sent->date); ?></td>
                                    <td><?php
                                        if (!empty($sent->message)) {
                                            echo $sent->message;
                                        }
                                        ?></td>
                                    <td><?php
                                        if (!empty($sent->recipient)) {
                                            echo $sent->recipient;
                                        }
                                        ?></td>
                                    <td>
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="sms/delete?id=<?php echo $sent->id; ?>" <?php echo lang('delete'); ?> onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
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
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

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
			$('#myModal2').modal('show');
			$.ajax({
				url: 'area/editAreaByJason?id=' + iid,
				method: 'GET',
				data: '',
				dataType: 'json',
			}).success(function (response) {
				// Populate the form fields with the data returned from server
				$('#areaEditForm').find('[name="id"]').val(response.area.id).end()
				$('#areaEditForm').find('[name="name"]').val(response.area.name).end()
				CKEDITOR.instances['editor'].setData(response.area.description)
			});
		});
	});
</script>
