<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo base_url(); ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keyword" content="<?php echo $this->db->get('settings')->row()->system_vendor;?>">
	<link rel="shortcut icon" href="<?php echo $this->db->get('settings')->row()->favicon;?>">

	<title>Reset Password - <?php echo $this->db->get('settings')->row()->system_vendor;?></title>
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="login_ui/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="login_ui/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link href="//fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="login_ui/vendor/animate/animate.css">
	<!--===============================================================================================-->	
		<link rel="stylesheet" type="text/css" href="login_ui/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="login_ui/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="login_ui/css/util.css">
		<link rel="stylesheet" type="text/css" href="login_ui/css/main.css">
	<!--===============================================================================================-->
	
</head>
<body> 
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt style="margin-top: 50px;">
					<img src="login_ui/images/oja_tilt.png" alt="<?php echo $this->db->get('settings')->row()->system_vendor;?>">
				</div>

				<form class="login100-form validate-form" method="post" action="auth/reset_password/<?php echo $code; ?>">
					<span class="login100-form-title">
						Reset Password
					</span>

					
					<<div class="login-wrap">
             <div id="infoMessage"><p><?php if(!empty($message)){echo 'password does not match';} ?></p></div>
            
            <p>
		<label for="new_password" ><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
		<?php echo form_input($new_password);?>
		
			</p>

			<p>
				<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
				<?php echo form_input($new_password_confirm);?>
			</p>

			<?php echo form_input($user_id);?>
			<?php echo form_hidden($csrf); ?>
							
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset Password
						</button>
					</div>

					<div class="text-center p-t-136">
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="login_ui/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login_ui/vendor/bootstrap/js/popper.js"></script>
	<script src="login_ui/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login_ui/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login_ui/vendor/tilt/tilt.jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="login_ui/js/main.js"></script>

</body>
</html>