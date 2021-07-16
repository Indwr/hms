<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php  echo lang('expense_category'); ?> </h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										 <a href="finance/addExpenseCategoryView">
							<div class="btn-group">
								<button id="" class="btn green">
									<i class="fa fa-plus-circle"></i>  <?php  echo lang('add_expense_category'); ?> 
								</button>
							</div>
                        </a>
                     </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('category'); ?> </th>
                                <th> <?php  echo lang('description'); ?> </th>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <th> <?php  echo lang('options'); ?> </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categories as $category) { ?>
                            <tr class="">
                                <td><?php echo $category->category; ?></td>
                                <td> <?php echo $category->description; ?></td>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <td>
                                        <a class="btn btn-info btn-xs editbutton" href="finance/editExpenseCategory?id=<?php echo $category->id; ?>"><i class="fa fa-edit"></i>  <?php  echo lang('edit'); ?></a>
                                        <a class="btn btn-info btn-xs delete_button" href="finance/deleteExpenseCategory?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                <?php } ?>
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
<!--footer start-->
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
