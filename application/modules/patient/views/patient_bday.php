<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"><?php echo lang('patient'); ?>  <?php echo lang('birthday'); ?></h5>
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
                                <th><?php echo lang('id'); ?></th>                        
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('dob'); ?></th>
                                <th><?php echo lang('age'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                       
						
                        <?php foreach ($patients as $patient) { 
						if (substr($patient->dob, 0, 5) === date("d-m")) {
						?>
                            <tr class="">
                                <td> <?php echo $patient->id; ?></td>
                                <td> <?php echo $patient->name; ?></td>
                                <td> <?php echo $patient->dob; ?></td>
                                <td> <?php echo date("Y") - substr($patient->dob, 6); ?></td>
                                <td><?php echo $patient->phone; ?></td>
                                <td>
								
								 <?php $wishesOfCurrentYear = $this->patient_model->getWishesByPatientThisYear($patient->id); ?>
                                   
								 <?php if (empty($wishesOfCurrentYear)){ ?>
								 <a class="btn  btn-xs btn-info editbutton" data-toggle="modal" data-id="<?php echo $patient->id; ?>">  <?php echo lang('send_wishes') ?></a>   
                                 <?php } else {?>
								 <a class="btn  btn-xs btn-primary ">  <?php echo lang('wishes_sent') ?></a>   
                                 <?php }?>
								
                                </td>
                            </tr>
                        <?php } } ?>
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





<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-envelope"></i> <?php echo lang('send'); ?> <?php echo lang('birthday'); ?> <?php echo lang('wishes'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatientForm" action="patient/sendWishes" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required readonly>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="" required readonly>
                    </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('dob'); ?></label>
                        <input type="text" class="form-control" name="dob" id="exampleInputEmail1" value='' readonly>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                         <input type="text" class="form-control" name="sex" id="exampleInputEmail1" value='' readonly>
                    </div>
                    </div>
                    </div>
					<div class="form-group">
                        <label><?php echo lang('message'); ?></label>
                        <textarea id="sms" maxlength="160" class="textarea_quote" name="message" value="" cols="70" rows="5" required></textarea>
                                    
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Patient Modal-->


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
			$('#editPatientForm').trigger("reset");
			$('#myModal2').modal('show');
			$.ajax({
				url: 'patient/editPatientByJason?id=' + iid,
				method: 'GET',
				data: '',
				dataType: 'json',
			}).success(function (response) {
				// Populate the form fields with the data returned from server

				$('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
				$('#editPatientForm').find('[name="name"]').val(response.patient.name).end()
				$('#editPatientForm').find('[name="password"]').val(response.patient.password).end()
				$('#editPatientForm').find('[name="email"]').val(response.patient.email).end()
				$('#editPatientForm').find('[name="address"]').val(response.patient.address).end()
				$('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end()
				$('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end()
				$('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end()
				$('#editPatientForm').find('[name="dob"]').val(response.patient.dob).end()
				var cx_name = response.patient.name;
				document.getElementById("sms").value = 'Happy Birthday, ' + cx_name + ' It is our wish that you will have years upon years of extraordinary achievements both in your business and personal lives.';	

			});
		});
	});
</script>


