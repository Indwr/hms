
<div class="contentbar">
<!-- Start row -->
<div class="row">							
<div class="col-lg-12">
<div class="card m-b-30">
<div class="card-body">

		<div class="tabset">
		  <!-- Tab 1 -->
		  <input type="radio" name="tabset" id="tab7" aria-controls="Kolawole" checked>
		  <label for="tab7" ><i class="feather icon-user-plus mr-2"></i><?php  echo lang('admin'); ?></label>
		  <!-- Tab 2 -->
		  <input type="radio" name="tabset" id="tab8" aria-controls="Olawuyi">
		  <label for="tab8"> <i class="feather icon-user-plus mr-2"></i><?php  echo lang('doctor'); ?></label>
		  <!-- Tab 3 -->
		  <input type="radio" name="tabset" id="tab9" aria-controls="Baterista">
		  <label for="tab9"><i class="feather icon-user-plus mr-2"></i><?php  echo lang('nurse'); ?></label>
		  <!-- Tab 4 -->
		  <input type="radio" name="tabset" id="tab10" aria-controls="lab">
		  <label for="tab10"><i class="feather icon-user-plus mr-2"></i><?php  echo lang('laboratorist'); ?></label>
		   <!-- Tab 5 -->
		  <input type="radio" name="tabset" id="tab11" aria-controls="pharma">
		  <label for="tab11"><i class="feather icon-user-plus mr-2"></i><?php  echo lang('pharmacist'); ?></label>
		   <!-- Tab 6 -->
		  <input type="radio" name="tabset" id="tab12" aria-controls="acc">
		  <label for="tab12"><i class="feather icon-user-plus mr-2"></i><?php  echo lang('accountant'); ?></label>
		   <!-- Tab 7 -->
		  <input type="radio" name="tabset" id="tab13" aria-controls="recepta">
		  <label for="tab13"><i class="feather icon-user-plus mr-2"></i><?php  echo lang('receptionist'); ?></label>
					  
	    <div class="tab-panels">
				<section id="Kolawole" class="tab-panel">
				<div class="panel-body">
					<div class="adv-table editable-table">
						<div class="clearfix">
							<a  href="staff/addStaff">
								<div class="btn-group">
									<button id="" class="btn green">
										<i class="fa fa-plus-circle"></i> <?php echo lang('add_staff'); ?>
									</button>
								</div>
							</a>
						</div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks" >
                        <thead>
                            <tr>
                                <th><?php echo lang('img'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($staffs as $staff) { 
						if($staff->ion_user_id != $this->ion_auth->get_user_id()) {
						if($staff->profile == 'Admin') {?>
                            <tr class="">
                                <td> <a href="<?php echo $staff->img_url; ?>"><img src="<?php echo $staff->img_url; ?>" width="20px"></a></td>
                                <td> 
								
								<?php echo $staff->name; ?> 
								
								</td>
                                <td><?php echo $staff->profile; ?></td>
                                <td><?php echo $staff->dept; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td>
								<a class="btn btn-primary btn-xs btn_width" href="finance/staffFinanceTransactionHistory?id=<?php echo $staff->id; ?>&staffFinanceTransactionHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('financial_activity'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width" href="staff/editStaff?id=<?php echo $staff->id; ?>" ><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this Staff?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        </tbody>
                    </table>
                  </div> 
            </div> 
        </div> 
</section>
 
 
<section id="Olawuyi" class="tab-panel">
				<div class="panel-body">
						<div class="adv-table editable-table ">
							<div class="clearfix">
								<a  href="staff/addStaff">
										<div class="btn-group">
										<button id="" class="btn green">
											<i class="fa fa-plus-circle"></i> <?php echo lang('add_staff'); ?>
										</button>
									</div>
								</a>
                            </div>
							
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks1" >
                        <thead>
                            <tr>
                                <th><?php echo lang('img'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
						
                        <?php foreach ($staffs as $staff) { if($staff->ion_user_id != $this->ion_auth->get_user_id()) {
							if($staff->profile == 'Doctor') { ?>
                            <tr class="">
                                <td> <a href="<?php echo $staff->img_url; ?>"><img src="<?php echo $staff->img_url; ?>" width="20px"></a></td>
                                <td> 
								
								<a class="click_link" href="staff/doctorDetails?id=<?php echo $staff->id; ?>&doctorHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><?php echo $staff->name; ?> </a>
								
								</td>
                                <td><?php echo $staff->profile; ?></td>
                                <td><?php echo $staff->dept; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td>
								<a class="btn btn-primary btn-xs btn_width" href="finance/staffFinanceTransactionHistory?id=<?php echo $staff->id; ?>&staffFinanceTransactionHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('financial_activity'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width" href="staff/editStaff?id=<?php echo $staff->id; ?>" ><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this Staff?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        </tbody>
                    </table>
                </div> 
           </div> 
      </div> 
</section>
				
<section id="Baterista" class="tab-panel">
				 <div class="panel-body">
					<div class="adv-table editable-table ">
						<div class="clearfix">
					<a  href="staff/addStaff">
							<div class="btn-group">
							<button id="" class="btn green">
								<i class="fa fa-plus-circle"></i> <?php echo lang('add_staff'); ?>
							</button>
						</div>
					</a>
                   </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks2" >
                        <thead>
                            <tr>
                                <th><?php echo lang('img'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($staffs as $staff) { if($staff->ion_user_id != $this->ion_auth->get_user_id()) {
							if($staff->profile == 'Nurse') { ?>
                            <tr class="">
                                <td> <a href="<?php echo $staff->img_url; ?>"><img src="<?php echo $staff->img_url; ?>" width="20px"></a></td>
                                <td> 
								
								<?php echo $staff->name; ?> 
								
								</td>
                                <td><?php echo $staff->profile; ?></td>
                                <td><?php echo $staff->dept; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td>
								<a class="btn btn-primary btn-xs btn_width" href="finance/staffFinanceTransactionHistory?id=<?php echo $staff->id; ?>&staffFinanceTransactionHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('financial_activity'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width" href="staff/editStaff?id=<?php echo $staff->id; ?>" ><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this Staff?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        </tbody>
                   </table>
             </div> 
        </div> 
    </div> 
</section>
				

<section id="lab" class="tab-panel">
				 <div class="panel-body">
					<div class="adv-table editable-table ">
						<div class="clearfix">
					<a  href="staff/addStaff">
							<div class="btn-group">
							<button id="" class="btn green">
								<i class="fa fa-plus-circle"></i> <?php echo lang('add_staff'); ?>
							</button>
						</div>
					</a>
                 </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks3" >
                        <thead>
                            <tr>
                                <th><?php echo lang('img'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($staffs as $staff) { if($staff->ion_user_id != $this->ion_auth->get_user_id()) {
							if($staff->profile == 'Laboratorist') { ?>
                            <tr class="">
                                <td> <a href="<?php echo $staff->img_url; ?>"><img src="<?php echo $staff->img_url; ?>" width="20px"></a></td>
                                <td> 
								
						        <?php echo $staff->name; ?> 
								
								</td>
                                <td><?php echo $staff->profile; ?></td>
                                <td><?php echo $staff->dept; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td>
								<a class="btn btn-primary btn-xs btn_width" href="finance/staffFinanceTransactionHistory?id=<?php echo $staff->id; ?>&staffFinanceTransactionHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('financial_activity'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width" href="staff/editStaff?id=<?php echo $staff->id; ?>" ><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this Staff?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        </tbody>
                    </table>
                  </div> 
            </div> 
      </div> 
</section>
				
				
<section id="pharma" class="tab-panel">
				 <div class="panel-body">
					<div class="adv-table editable-table ">
						<div class="clearfix">
					<a  href="staff/addStaff">
							<div class="btn-group">
							<button id="" class="btn green">
								<i class="fa fa-plus-circle"></i> <?php echo lang('add_staff'); ?>
							</button>
						</div>
					</a>
                    </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks4" >
                        <thead>
                            <tr>
                                <th><?php echo lang('img'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                  

                        <?php foreach ($staffs as $staff) { if($staff->ion_user_id != $this->ion_auth->get_user_id()) {
							if($staff->profile == 'Pharmacist') { ?>
                            <tr class="">
                                <td> <a href="<?php echo $staff->img_url; ?>"><img src="<?php echo $staff->img_url; ?>" width="20px"></a></td>
                                <td> 
								
								<?php echo $staff->name; ?>
								
								</td>
                                <td><?php echo $staff->profile; ?></td>
                                <td><?php echo $staff->dept; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td>
								<a class="btn btn-primary btn-xs btn_width" href="finance/staffFinanceTransactionHistory?id=<?php echo $staff->id; ?>&staffFinanceTransactionHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('financial_activity'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width" href="staff/editStaff?id=<?php echo $staff->id; ?>" ><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this Staff?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        </tbody>
                    </table>
                  </div> 
            </div> 
       </div> 
</section>
				

<section id="acc" class="tab-panel">
				 <div class="panel-body">
					<div class="adv-table editable-table ">
						<div class="clearfix">
					<a  href="staff/addStaff">
							<div class="btn-group">
							<button id="" class="btn green">
								<i class="fa fa-plus-circle"></i> <?php echo lang('add_staff'); ?>
							</button>
						</div>
					</a>
                    </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks5" >
                        <thead>
                            <tr>
                                <th><?php echo lang('img'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($staffs as $staff) { if($staff->ion_user_id != $this->ion_auth->get_user_id()) {
							if($staff->profile == 'Accountant') { ?>
                            <tr class="">
                                <td> <a href="<?php echo $staff->img_url; ?>"><img src="<?php echo $staff->img_url; ?>" width="20px"></a></td>
                                <td> 
								
							 <?php echo $staff->name; ?> 
								
								</td>
                                <td><?php echo $staff->profile; ?></td>
                                <td><?php echo $staff->dept; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td>
								<a class="btn btn-primary btn-xs btn_width" href="finance/staffFinanceTransactionHistory?id=<?php echo $staff->id; ?>&staffFinanceTransactionHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('financial_activity'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width" href="staff/editStaff?id=<?php echo $staff->id; ?>" ><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this Staff?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        </tbody>
                    </table>
                  </div> 
            </div> 
        </div> 
</section>
				

<section id="recepta" class="tab-panel">
				 <div class="panel-body">
					<div class="adv-table editable-table ">
						<div class="clearfix">
					<a  href="staff/addStaff">
							<div class="btn-group">
							<button id="" class="btn green">
								<i class="fa fa-plus-circle"></i> <?php echo lang('add_staff'); ?>
							</button>
						</div>
					</a>
                     </div>
					
                    <div class="space15"></div>
                    <div class="table_overflow">
					
                    <table class="table table-striped table-hover table-bordered" id="bateristaworks6" >
                        <thead>
                            <tr>
                                <th><?php echo lang('img'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('profile'); ?></th>
                                <th><?php echo lang('department'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($staffs as $staff) { if($staff->ion_user_id != $this->ion_auth->get_user_id()) {
							if($staff->profile == 'Receptionist') { ?>
                            <tr class="">
                                <td> <a href="<?php echo $staff->img_url; ?>"><img src="<?php echo $staff->img_url; ?>" width="20px"></a></td>
                                <td> 
								
								<?php echo $staff->name; ?> 
								
								</td>
                                <td><?php echo $staff->profile; ?></td>
                                <td><?php echo $staff->dept; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td>
								<a class="btn btn-primary btn-xs btn_width" href="finance/staffFinanceTransactionHistory?id=<?php echo $staff->id; ?>&staffFinanceTransactionHistory=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1"><i class="fa fa-file-text"></i> <?php echo lang('financial_activity'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width" href="staff/editStaff?id=<?php echo $staff->id; ?>" ><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this Staff?');"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        </tbody>
                    </table>
                 </div> 
            </div> 
        </div>					  
</section>

</div>
</div>
</div>     
</div>     
</div> 
</div>
</div>





<!-- Edit Staff Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Staff</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editStaffForm" action="staff/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">


                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">

                    </div>
                    <hr>
					<p>
					<div class="row">
				    <div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
				    <div class="col-md-6">
					<div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('password'); ?></label>
                        <input type="password" class="form-control" minlength="5" name="password" id="exampleInputEmail1" placeholder="********">
                    </div>                 
                    </div>
                    </div>
					<div class="row">
				    <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
				    <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    </div>
                    </div>
                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info">Submit</button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->
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

<script>
    $(document).ready(function () {
        $('#bateristaworks1').DataTable({
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
<script>
    $(document).ready(function () {
        $('#bateristaworks2').DataTable({
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
<script>
    $(document).ready(function () {
        $('#bateristaworks3').DataTable({
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
<script>
    $(document).ready(function () {
        $('#bateristaworks4').DataTable({
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

<script>
    $(document).ready(function () {
        $('#bateristaworks5').DataTable({
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

<script>
    $(document).ready(function () {
        $('#bateristaworks6').DataTable({
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
			$('#editStaffForm').trigger("reset");
			$('#myModal2').modal('show');
			$.ajax({
				url: 'staff/editStaffByJason?id=' + iid,
				method: 'GET',
				data: '',
				dataType: 'json',
			}).success(function (response) {
				// Populate the form fields with the data returned from server
				$('#editStaffForm').find('[name="id"]').val(response.staff.id).end()
				$('#editStaffForm').find('[name="name"]').val(response.staff.name).end()
				$('#editStaffForm').find('[name="password"]').val(response.staff.password).end()
				$('#editStaffForm').find('[name="email"]').val(response.staff.email).end()
				$('#editStaffForm').find('[name="address"]').val(response.staff.address).end()
				$('#editStaffForm').find('[name="phone"]').val(response.staff.phone).end()
			});
		});
	});
</script>