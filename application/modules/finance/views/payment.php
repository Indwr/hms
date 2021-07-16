
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"> <?php  echo lang('all'); ?> <?php  echo lang('payments'); ?> <br><br>Includes: Pharmacy Payments, Bed Payments and Procedure Payments</h5>
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
                                <th> <?php  echo lang('patient'); ?> </th>
                                <th> <?php  echo lang('date'); ?> </th>
                                <th> <?php  echo lang('sub_total'); ?> </th>
                                <th> <?php  echo lang('discount'); ?> </th>
                                <th> <?php  echo lang('grand_total'); ?> </th>
                                <th> <?php  echo lang('amount_received'); ?> </th>
                                <th> <?php  echo lang('due_amount'); ?> </th>
                                <th class="option_th"> <?php  echo lang('options'); ?> </th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($payments as $payment) { ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                            <tr class="">
                                <td><?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->name;
                                    }
                                    ?></td>
                                <td><?php echo date('h:i:s A d-m-y', $payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($payment->amount); ?></td>              
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->flat_discount)) {
                                        echo number_format($payment->flat_discount);
                                    } else {
                                        echo '0';
                                    }
                                    ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total); ?></td>
                                <td><?php echo $settings->currency; ?> <?php
                                    echo number_format($payment->amount_received);
                                    ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total - $payment->amount_received); ?></td>
                                <td> 
                                    <a class="btn btn-xs btn-info" href="finance/invoice?id=<?php echo $payment->id; ?>"><i class="fa fa-file-text"></i>  <?php  echo lang('invoice'); ?></a>
                                    <!--
                                        <a class="btn btn-info btn-xs delete_button" href="finance/delete?id=<?php echo $payment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                   -->
                                    </button>
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
