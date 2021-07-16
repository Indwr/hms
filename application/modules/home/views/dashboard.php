<?php 
	if ($this->ion_auth->in_group(array('Staff'))) {
	$staff_ion_id = $this->ion_auth->get_user_id();
	$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
	$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
	$permissions = $this->staff_model->getStaffById($staff)->permission;
	$permission1 = explode(',', $permissions);
	} 		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="OmniMedy Hospital Management System">
    <meta name="author" content="Codejigon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title><?php echo ucfirst($this->router->fetch_class()); ?> - <?php echo $this->db->get('settings')->row()->system_vendor;?> </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $this->db->get('settings')->row()->favicon;?>">    
    <!-- Start css -->
    <!-- Switchery css -->
    <link href="assets_ui/plugins/switchery/switchery.min.css" rel="stylesheet">
    <!-- Apex css -->
    <link href="assets_ui/plugins/apexcharts/apexcharts.css" rel="stylesheet">
	<!-- Slick css -->
    <link href="assets_ui/plugins/slick/slick.css" rel="stylesheet">
    <link href="assets_ui/plugins/slick/slick-theme.css" rel="stylesheet">
    <link href="assets_ui/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets_ui/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets_ui/css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="assets_ui/css/style.css" rel="stylesheet" type="text/css">
	<link href="common/css/invoice-print.css" rel="stylesheet" media="print">
    <link href="common/assets/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="common/assets/select2/css/select2.min.css"/>
    <link rel="stylesheet" type="text/css" href="common/css/select2_reset.css"/>
	<link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
	
	<link href="common/css/bootstrap.css" rel="stylesheet">
    <link href="common/css/invoice-print.css" rel="stylesheet" media="print">
    <link href="common/css/style_reset.css" rel="stylesheet">
	  
    <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
	<link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
    <!-- End css -->
	
    <!--Google Font-->
	<link href="//fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <!--Google Font-->
</head>
<body class="vertical-layout" onload="Slider();">    
    
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
        <div class="leftbar">
            <!-- Start Sidebar -->
            <div class="sidebar">
                <!-- Start Logobar -->
                <div class="logobar">
                    <a href="" class="logo logo-large"><img src="<?php echo $this->db->get('settings')->row()->logo;?>" class="img-fluid" alt="logo"></a>
                    <a href="" class="logo logo-small"><img src="<?php echo $this->db->get('settings')->row()->favicon;?>" class="img-fluid" alt="logo"></a>
                </div>
                <!-- End Logobar -->
                <!-- Start Navigationbar -->
                <div class="navigationbar">
                    <ul class="vertical-menu">
                        <li>
                            <a href="home">
                              <img src="assets_ui/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('home'); ?></span>
                            </a>
                        </li>
					      
						<li>
                            <a href="department">
                              <img src="assets_ui/images/svg-icon/basic.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('department'); ?></span>
                            </a>
                        </li>
                        
						<?php 
						$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
						if ($check_doctor == 'Doctor') { ?>
						 <li>
                            <a href="patient/myPatient">
                              <img src="assets_ui/images/svg-icon/user.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('my'); ?> <?php  echo lang('patient'); ?></span>
                            </a>
                        </li>
						<?php } ?>
						
						<?php 
						$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
						if ($check_doctor == 'Doctor') { ?>
						 <li>
                            <a href="zoom/meeting">
                              <img src="assets_ui/images/svg-icon/zoom.png" class="img-fluid" alt="dashboard"><span><?php  echo lang('my'); ?> <?php  echo lang('zoom'); ?> <?php  echo lang('meetings'); ?></span>
                            </a>
                        </li>
						<?php } ?>
						
						<?php if($this->ion_auth->in_group(array('Patient'))) { ?>
						 <li>
                            <a href="zoom/meeting">
                              <img src="assets_ui/images/svg-icon/zoom.png" class="img-fluid" alt="dashboard"><span><?php  echo lang('my'); ?> <?php  echo lang('zoom'); ?> <?php  echo lang('meetings'); ?></span>
                            </a>
                        </li>
						<?php } ?>
						
						<?php 
						$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
						if ($check_doctor == 'Doctor') { ?>
						 <li>
                            <a href="zoom/myZoomCredential">
                              <img src="assets_ui/images/svg-icon/advanced.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('my'); ?> <?php  echo 'Zoom Credentials'; ?></span>
                            </a>
                        </li>
						<?php } ?>

						
						<?php 
						$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
						if ($check_doctor == 'Doctor') { ?>
						 <li>
                            <a href="appointment/myAppointment">
                              <img src="assets_ui/images/svg-icon/maps.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('my'); ?> <?php  echo lang('appointment'); ?></span>
                            <?php 
							$check_doctor_id = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
							$query_appointment = $this->db->get('appointment')->result();
							$i = 0;
							foreach ($query_appointment as $q_appointment) {
								if ($q_appointment->date === date('d-m-Y') && $check_doctor_id === $q_appointment->doctor) {
									$i = $i + 1;
								}
							}
							if (!empty($i)) { ?>
							<span class="badge badge-primary pull-right"><?php echo $i; ?></span>
							<?php } else{?>
							<span class="badge badge-primary pull-right"><?php echo $i; ?></span>
							<?php } ?>
							</a>
							
                        </li>
						<?php } ?>
						
						<?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
						 <li>
                            <a href="appointment/mineAppointment">
                              <img src="assets_ui/images/svg-icon/maps.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('my'); ?> <?php  echo lang('appointment'); ?></span>
                            <?php 
							$patient_ion_id = $this->ion_auth->get_user_id();
							$patientt = $this->db->get_where('patient', array('ion_user_id' => $patient_ion_id))->row()->id;
							$query_appointment = $this->db->get('appointment')->result();
							$i = 0;
							foreach ($query_appointment as $q_appointment) {
								if ($q_appointment->date === date('d-m-Y') && $patientt === $q_appointment->patient) {
									$i = $i + 1;
								}
							}
							if (!empty($i)) { ?>
							<span class="badge badge-primary pull-right"><?php echo $i; ?></span>
							<?php } else{?>
							<span class="badge badge-primary pull-right"><?php echo $i; ?></span>
							<?php } ?>
							</a>
							
                        </li>
						<?php } ?>
						
						
						<?php if($this->ion_auth->in_group(array('Patient'))) { ?>
						 <li>
                            <a href="home/myDetails#appoint_head">
                              <img src="assets_ui/images/svg-icon/form_elements.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('calander'); ?></span>
                            </a>
                        </li>
						<?php } ?>
						
						
						<?php if (in_array('patient', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="javaScript:void();">
                                <img src="assets_ui/images/svg-icon/user.svg" class="img-fluid" alt="basic"><span><?php  echo lang('patient'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="patient"><?php  echo lang('list'); ?> <?php  echo lang('patient'); ?></a></li>
								
                                <li><a href="patient/patientTodayBirthday">
								<?php echo $birthdayss; ?>
								<?php 
								if (empty($birthdayss)) {
								 echo 'Birthday';
								}elseif($birthdayss == 1){
								 echo 'Birthday';	
								}else echo 'Bithdays'?> <?php  echo lang('today'); ?></a></li>
								
                            </ul>
                        </li>  
                        <?php } ?>	
						
						<?php if (in_array('human resources', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="javaScript:void();">
                                <img src="assets_ui/images/svg-icon/user.svg" class="img-fluid" alt="chart"><span><?php  echo lang('human_res'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
								 <li><a href="staff"> <?php  echo lang('list'); ?> <?php  echo lang('staff'); ?></a></li>
								 <li><a href="staff/staffPermission"> <?php  echo lang('staff'); ?> <?php  echo lang('permission'); ?></a></li>
                            </ul>
                        </li>
                        <?php } ?>
						
						<?php if (in_array('tpa', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
						<li>
                            <a href="tpa">
                              <img src="assets_ui/images/svg-icon/layouts.svg" class="img-fluid" alt="dashboard"><span><?php  echo 'TPA Management'; ?></span>
                            </a>
                        </li>
						<?php } ?>
						
						<?php if (in_array('bed', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="javaScript:void();">
							    <img src="assets_ui/images/svg-icon/tables.svg" class="img-fluid" alt="bed"><span><?php  echo lang('bed'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                    <li><a href="bed/bedTypes"> <?php  echo lang('bed'); ?> <?php  echo lang('types'); ?></a></li>
                                    <li><a href="bed"> <?php  echo lang('list'); ?> <?php  echo lang('bed'); ?></a></li>
                                    <li><a href="bed/bedAllotment"><?php  echo lang('allot'); ?> <?php  echo lang('bed'); ?></a></li>
                                </ul>
                        </li>
						<?php } ?>
						
						<?php if (in_array('appointment', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="appointment">
                              <img src="assets_ui/images/svg-icon/maps.svg" class="img-fluid" alt="dashboard"><span> <?php  echo lang('appointment'); ?></span>
                            <?php 
							$query_appointment = $this->db->get('appointment')->result();
							$i = 0;
							foreach ($query_appointment as $q_appointment) {
								if ($q_appointment->date === date('d-m-Y')) {
									$i = $i + 1;
								}
							}
							if (!empty($i)) { ?>
							<span class="badge badge-primary pull-right"><?php echo $i; ?></span>
							<?php } else{?>
							<span class="badge badge-primary pull-right"><?php echo $i; ?></span>
							<?php } ?>
							</a>
                        </li>
						<?php } ?>
						
						
						<?php if (in_array('bloodbank', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="javaScript:void();">
							     <img src="assets_ui/images/svg-icon/water.png" class="img-fluid" alt="blood"><span><?php  echo lang('bloodbank'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                    <li><a href="bloodbank"> <?php  echo lang('list'); ?> <?php  echo lang('bloodbank'); ?></a></li>
                                    <li><a href="bloodbank/donor"><?php  echo lang('list'); ?> <?php  echo lang('donor'); ?></a></li>
                                </ul>
                        </li>
						<?php } ?>
						
						
						<?php if (in_array('pharmacy', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
						
						<li>
                            <a href="javaScript:void();">
							     <img src="assets_ui/images/svg-icon/components.svg" class="img-fluid" alt="blood"><span><?php  echo lang('pharmacy'); ?></span>
                            <?php 
							$query_medicine = $this->db->get('payment_category')->result();
							$i = 0;
							foreach ($query_medicine as $q_medicine) {
								if(!empty($q_medicine->e_date) && $q_medicine->e_date <= time() &&  ($q_medicine->howmany) == 0 && empty($q_medicine->deletii)) {
							     $i = $i + 1;
								}
							}
							if (!empty($i)) { ?>
							<span class="badge badge-secondary pull-right"><?php echo $i; ?></span>
							<?php } else{?>
							<span class="badge badge-secondary pull-right"><?php echo $i; ?></span>
							<?php } ?>
							
							</a>
                            <ul class="vertical-submenu">
                                    <li><a href="pharmacy"> <?php  echo lang('medicine'); ?></a></li>
                                    <li><a href="pharmacy/medicineCategory"><?php  echo lang('category'); ?> </a></li>
                                    <li><a href="pharmacy/addMedicineSales"><?php  echo lang('add'); ?> <?php  echo lang('sales'); ?> </a></li>
                            </ul>
                        </li>
						<?php } ?>
						
						
						<?php if (in_array('ambulance', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
						 <li>
                            <a href="ambulance">
                              <img src="assets_ui/images/svg-icon/ambulance.png" class="img-fluid" alt="dashboard"><span> <?php  echo lang('ambulance'); ?></span>
							</a>
                        </li>
						<?php } ?>
						
						 
						<?php if (in_array('finance', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
						<li>
                            <a href="javaScript:void();">
                              <img src="assets_ui/images/svg-icon/widgets.svg" class="img-fluid" alt="pages"><span><?php  echo lang('finance'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
								<ul class="vertical-submenu">
									<li><a href="finance/allpayments"> <?php  echo lang('payments'); ?></a></li>
									<li><a href="finance/addpayments"> <?php  echo lang('add'); ?> <?php  echo lang('payment'); ?> </a></li>
									<li><a href="finance/paymentProcedures"> <?php  echo lang('paymentProcedures'); ?></a></li>
									<li><a href="finance/expense"><?php  echo lang('expense'); ?> </a></li>
                                    <li><a href="finance/addExpenseView"><?php  echo lang('add'); ?> <?php  echo lang('expense'); ?></a></li>
                                    <li><a href="finance/expenseCategory"><?php  echo lang('expense'); ?> <?php  echo lang('category'); ?> </a></li>
								</ul>
                        </li> 
						<?php } ?>
						
						
						
						<?php if (in_array('financial report', $permission1) || in_array('report', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
						<li>
                            <a href="javaScript:void();">
                              <img src="assets_ui/images/svg-icon/pages.svg" class="img-fluid" alt="pages"><span><?php  echo lang('reports'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
								<ul class="vertical-submenu">
									<?php if (in_array('financial report', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
									<li><a href="finance/Report">
									<?php  echo lang('financial'); ?> <?php  echo lang('report'); ?>
									</a></li>
									<?php } ?>
									
									<?php if (in_array('report', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
									<li><a href="report">
									<?php  echo lang('birth'); ?>, <?php  echo lang('death'); ?>, <?php  echo lang('operation'); ?>
									</a></li>
                                    <?php } ?>
                                </ul>
                        </li> 
						<?php } ?>
						
						<?php if (in_array('sms', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
						
						<li>
                            <a href="javaScript:void();">
                              <img src="assets_ui/images/svg-icon/email.svg" class="img-fluid" alt="pages"><span><?php  echo lang('sms'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
								<ul class="vertical-submenu">
									<li><a href="sms/sendNewText"><?php  echo lang('send'); ?> <?php  echo lang('sms'); ?> </a></li>
                                    <li><a href="sms/sent"><?php  echo lang('sent'); ?> <?php  echo lang('sms'); ?> </a></li>
									<li><a href="sms/settings"><?php  echo lang('sms'); ?> <?php  echo lang('settings'); ?></a></li>
									
                                </ul>
                        </li> 
                        <?php } ?>
						
						<?php if (in_array('leave', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="leave">
                              <img src="assets_ui/images/svg-icon/apps.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('leave_app'); ?></span>
                            <?php 
							$query_leave = $this->db->get('leave_application')->result();
							$i = 0;
							foreach ($query_leave as $q_leave) {
								if(empty($q_leave->status)) {
							     $i = $i + 1;
								}
							}
							if (!empty($i)) { ?>
							<span class="badge badge-warning pull-right"><?php echo $i; ?></span>
							<?php } else{?>
							<span class="badge badge-warning pull-right"><?php echo $i; ?></span>
							<?php } ?>
							</a>
                        </li>
                        <?php } ?>
						
					    <?php if ($this->ion_auth->in_group(array('Staff'))) { ?>
					    <li>
							<a href="leave/leaves">
							  <img src="assets_ui/images/svg-icon/apps.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('my'); ?> <?php  echo lang('leave_app'); ?></span>
							</a>
						</li>
						<?php } ?>
						
						<?php if (in_array('notice', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="notice">
                              <img src="assets_ui/images/svg-icon/notifications.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('notice'); ?></span>
                            </a>
                        </li>
                        <?php } ?>
						
					    <?php if ($this->ion_auth->in_group(array('Staff')) && in_array('notice', $permission1) == false) { ?>
					    <li>
							<a href="notice/notices">
							  <img src="assets_ui/images/svg-icon/notifications.svg" class="img-fluid" alt="dashboard"><span><?php  echo lang('notice'); ?></span>
							</a>
						</li>
						<?php } ?>
						
						
						<?php if (in_array('blog', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
                        <li>
                            <a href="javaScript:void();">
                                <img src="assets_ui/images/svg-icon/form_elements.svg" class="img-fluid" alt="maps"><span><?php  echo lang('blog'); ?></span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                               <li><a href="blog">  <?php  echo lang('blog'); ?> <?php  echo lang('post'); ?></a></li>
                            </ul><ul class="vertical-submenu">
                               <li><a href="blog/settings">  <?php  echo lang('blog'); ?> <?php  echo lang('settings'); ?></a></li>
                            </ul>
                        </li>   
						<?php } ?>		
                    </ul>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
		</div>
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href=" " class="mobile-logo"><img src="<?php echo $this->db->get('settings')->row()->logo;?>" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <img src="assets_ui/images/svg-icon/horizontal.svg" class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                            <img src="assets_ui/images/svg-icon/verticle.svg" class="img-fluid menu-hamburger-vertical" alt="verticle">
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                            <img src="assets_ui/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="assets_ui/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Topbar -->
            <div class="topbar">
               <!-- Start row -->
                <div class="row align-items-center">
                    <!-- Start col -->
                    <div class="col-md-12 align-self-center">
                        <div class="togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                           <img src="assets_ui/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                           <img src="assets_ui/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>
								<?php if ($this->ion_auth->in_group(array('admin', 'Staff'))) { ?>
                                <li class="list-inline-item">
                                    <div class="searchbar ">
                                        <form method="post" action="patient/patientSearch">
                                            <div class="input-group">
                                              <input type="search" name="patient_name" style="background-color:#f2f6fa !important; " class="form-control mysearch_put" placeholder="Search Patient By Name" aria-label="Search" aria-describedby="button-addon2">
                                              <div class="input-group-append">
                                                <button class="btn btn_search_put" type="submit" id="button-addon2"><img src="assets_ui/images/svg-icon/search.svg" class="img-fluid" alt="search"></button>
                                                
											 </div>
											  
                                            </div>
                                        </form>
                                    </div>
                                </li>
								<?php } ?>
                            </ul>
                        </div>
						
						
						<?php if (in_array('patient', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
						<?php 
						//Birthday Widget
						$query_bday = $this->db->get('patient')->result();
						$birthdayss = 0;
						foreach ($query_bday as $q_bday) {
							//$bday = substr($query_bday->dob, 0, 4);
							if (substr($q_bday->dob, 0, 5) === date("d-m")) {
								$birthdayss = $birthdayss + 1;
							}
						}
						if (!empty($birthdayss)) { ?>
							<li id="header_inbox_bar" class="birthday-float">
								<a class="no_borderr" href="patient/patientTodayBirthday" title="Today's Birthday">
									<i  class="fa fa-gift bday_red_bdd"></i>
									<span class="badge bg-redd flotting_not_bdayy"> 
										<?php
								
										echo $birthdayss;
										?>									
									</span>
								</a>
							</li>
						<?php } ?> 
						<?php } ?> 
						
						<!-- Notification Floating Icons -->
						<?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
							<?php
							$query = $this->db->get_where('payment', array('patient' => $patient->id))->result();
							$balance = array();

							foreach ($query as $gross) {

								$balance[] = $gross->gross_total - $gross->amount_received;
							}
							$balance = array_sum($balance);
							if($balance > '0') {
							?>
							 <div class="tooltip22">
							<a href="home/myDetails">
							<button class="btn  slim_button_yellow" id="">
							<?php echo $settings->currency; ?>
							<?php 
								$due_balance = $balance;
								echo number_format($due_balance);
								$due_balance = NULL; 
							?>
							</button>
							</a> <span class="tooltiptext22">My Due Payment</span>	
							</div>						
						<?php } ?>
						<?php } ?>
						
						
						<?php 
						$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
						if ($check_doctor == 'Doctor') { ?>
						<?php		
						$query_payment = $this->db->get('payment')->result();
						$i = 0;
						foreach ($query_payment as $q_payment) {
							if ($q_payment->doctor == $staff) {
								$i = $i + $q_payment->doc_com;
							}
						} 
						if(!empty($i)){
						?>
						 <div class="tooltip22" >
						<a href="staff/myDetails">
						<button class="btn  slim_button" id="">
						<?php echo $settings->currency . ' ' . $i; ?>
						</button>
                        </a> <span class="tooltiptext22">My Commission</span>	
                        </div>						
						<?php } ?>
						<?php } ?>
						
						<?php if ($this->ion_auth->in_group(array('Staff'))) { ?>
						<?php if (!empty($this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->dept)) { ?>
						 <div class="tooltip22" >
						<a href="javascript:void();">
						<button class="btn  slim_button1" id="">
						<img src="assets_ui/images/svg-icon/basic.svg"  width="20px" class="img-fluid" alt="bed"> <?php echo $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->dept; ?>
						</button>
                        </a> <span class="tooltiptext22">My Department</span>	
                        </div>						
						<?php } ?>
						<?php } ?>
						
						<!-- google Translate dropdown start-->
						<div class="tooltip22" >
						<a href="javascript:void();">
						<button class="btn  slim_button2" id="">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<div id="google_translate_element"></div>
							</a>
						</button>
						 </a> <span class="tooltiptext22">Language</span>	
                        </div>
						<!-- google Translate dropdown end-->
						
				
                        <div class="infobar">
                            <ul class="list-inline mb-0">
								
								<?php if (in_array('bed', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								<li class="list-inline-item" >
                                    <div class="settingbar tooltip22" >
                                        <a href="bed/bedStatus" class="infobar-icon">
                                            <img src="assets_ui/images/svg-icon/tables.svg"  class="img-fluid" alt="bed">
                                        </a><span class="tooltiptext22">Bed Status</span>
                                    </div>
                                </li>
								<?php } ?>
								
								
								<li class="list-inline-item" >
                                    <div class="settingbar tooltip22" >
                                        <a href="" class="infobar-icon ">
                                            <img src="assets_ui/images/svg-icon/globe.png"  class="img-fluid" alt="website">
                                        </a><span class="tooltiptext22">Visit Website</span>
                                    </div>
                                </li>
								
								<?php if (in_array('settings', $permission1) || $this->ion_auth->in_group(array('admin'))) { ?>
								<li class="list-inline-item" >
                                    <div class="settingbar tooltip22" >
                                        <a href="settings" class="infobar-icon">
                                            <img src="assets_ui/images/svg-icon/settings.svg"  class="img-fluid" alt="settings">
                                        </a><span class="tooltiptext22">Settings</span>
                                    </div>
                                </li>
								<?php } ?>
								
                                <li class="list-inline-item">
                                    <div class="profilebar tooltip22">
                                        <div class="dropdown">
                                          <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets_ui/images/users/girl.svg" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                <div class="dropdown-item">
                                                    <div class="profilename">
                                                      <h5><?php 
													  if($this->ion_auth->in_group(array('admin'))) {
													      echo 'Super Admin';
													  } elseif(!$this->ion_auth->in_group(array('Staff'))){
														  echo $this->ion_auth->get_users_groups()->row()->name;
													  }else{
													   echo $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
													  } ?>
													  </h5>
                                                    </div>
                                                </div>
                                                <div class="userbox">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media dropdown-item">
                                                            <center>
															<?php echo $this->ion_auth->user()->row()->username; ?>
                                                            </center>
                                                        </li>
														<li class="media dropdown-item">
                                                            <a href="profile" class="profile-icon"><img src="assets_ui/images/svg-icon/user.svg" class="img-fluid" alt="user">My Profile</a>
                                                        </li>  													
                                                        <li class="media dropdown-item">
                                                            <a href="auth/logout" class="profile-icon"><img src="assets_ui/images/svg-icon/logout.svg" class="img-fluid" alt="logout">Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                </li>	
							</ul>
						</div>
					</div>
					<!-- End col -->
				</div> 
			</div>
				
				
			
				<!-- SweetAlert2 -->
				<?php
				$message = $this->session->flashdata('feedback');
				if (!empty($message)) { ?>
				<script>
				function Slider() {		
				const Toast = Swal.mixin({
				customClass: 'sweet-slider',                 
				  toast: true,
				  timer: 7000,
				  position: 'top',
				  showConfirmButton: false,
				});
				Toast.fire({	
				  <?php if($message == '<p>Incorrect Login</p>' 
				  || $message == 'Invalid Username or Password'
				  || $message == 'Insufficient Credit'
				  || $message == 'Wishes Not Sent'
				  || $message == 'SMS not Sent'
				  || $message == 'Bed can not be empty'
				  || $message == 'error encountered going Live'
				  || $message == 'Invalid Zoom Meeting Token'
				  || $message == 'Email Not Sent'){ ?>
				  type: 'warning',
				  <?php } else {?>
				  type: 'success',
				  <?php } ?>
				  title: '<?php echo $message ?>'
				})
				}
				</script>
				<?php } ?>	
				
		<?php if ($this->ion_auth->in_group(array('Staff'))) { ?>
		
				<?php 
				$staff_ion_id = $this->ion_auth->get_user_id();
				$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
				
				$query_notice = $this->db->get('notice')->result();
				
				foreach ($query_notice as $q_notice) {
				$users_notice = $this->db->get_where('notice', array('id' => $q_notice->id))->row()->user;
				$users_notice1 = explode(',', $users_notice);
				
				if (in_array($staff_profile, $users_notice1) && $q_notice->from_date <= date('d-m-Y') && $q_notice->to_date >= date('d-m-Y')) { ?>
				
				<div class="breadcrumbbarTop <?php echo $q_notice->id; ?>" id="">
					<div class="alert alert-primary">
					   <a href="notice/viewNotice?id=<?php echo $q_notice->id; ?>"><img src="assets_ui/images/svg-icon/notifications.svg" class="img-fluid" alt="dashboard" style="width:20px; font-weight:strong;"> <?php echo $q_notice->title; ?></a>
					   <div class="close flip" onclick="setTimeout(function(){($('.<?php echo $q_notice->id; ?>').toggle()); }, 0000);">&times;</div>
					</div>
				</div>
				
				
				<?php } ?>
				<?php } ?>
			
		<?php } ?>
		
		<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
		
				<?php 
				
				$query_notice = $this->db->get('notice')->result();
				
				foreach ($query_notice as $q_notice) {
				
				if ($q_notice->from_date <= date('d-m-Y') && $q_notice->to_date >= date('d-m-Y')) { ?>
				
				<div class="breadcrumbbarTop <?php echo $q_notice->id; ?>" id="">
					<div class="alert alert-primary">
					   <a href="notice/viewNotice?id=<?php echo $q_notice->id; ?>"><img src="assets_ui/images/svg-icon/notifications.svg" class="img-fluid" alt="dashboard" style="width:20px; font-weight: strong;"> <?php echo $q_notice->title; ?></a>
					   <div class="close flip" onclick="setTimeout(function(){($('.<?php echo $q_notice->id; ?>').toggle()); }, 0000);">&times;</div>
					</div>
				</div>
				
				
				<?php } ?>
				<?php } ?>
			
		<?php } ?>
		
		<script type="text/javascript">
		function googleTranslateElementInit() {
			new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
		}
		</script>

		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		
		<div class="breadcrumbbar">
		
		</div>