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

	<title><?php echo $this->db->get('settings')->row()->title;?> - <?php echo $this->db->get('settings')->row()->system_vendor;?></title>
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
<body onload="feedback()"> 
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt style="margin-top: 50px;">
					<img src="login_ui/images/omnimedy_tilt.png" alt="<?php echo $this->db->get('settings')->row()->system_vendor;?>">
				</div>

				<form class="login100-form validate-form" method="post" action="auth/login">
					<span class="login100-form-title">
						<img class="js-tilt" style="margin-left:-19px;" src="<?php echo $this->db->get('settings')->row()->logo;?>" title="<?php echo $this->db->get('settings')->row()->system_vendor;?>">
					</span>
					
					<div class="wrap-input100 validate-input" data-validate = "Email is required: omnimedy@abc.xyz">
						<input class="input100" type="text" name="identity" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="text-center p-t-12">
						<a class="txt2 js-tilt" href="auth/forgot_password">
							Forgot Password?
						</a>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-12">
						 <br>
						<a class="txt2 js-tilt website_font" href="">
							<i class="fa fa-globe m-l-5" aria-hidden="true"></i> website <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

					<div class="text-center p-t-136">
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->	
	<script src="login_ui/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="common/js/sweetAlert2.js"></script>	
<!--===============================================================================================-->
	<script src="login_ui/vendor/bootstrap/js/popper.js"></script>
	<script src="login_ui/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login_ui/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login_ui/vendor/tilt/tilt.jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="login_ui/js/main.js"></script>
	
	<?php if (!empty($message)) { ?>
	<script>
	function feedback() {		
		const Toast = Swal.mixin({
		customClass: 'format-slider',                 
		  toast: true,
		  timer: 0,
		  position: 'top',
		  showConfirmButton: false,
		});
		Toast.fire({
		  <?php if($message == '<p>Incorrect Login</p>' 
		  || $message == 'contact company Administrator to activate your account' 
		  || $message == '<p>Temporarily Locked Out.  Try again later.</p>' 
		  || $message == 'you have been temporarily frozen') 
		  { ?>
		  type: 'warning',
		  <?php } else {?>
		  type: 'success',
		  <?php } ?>
		  title: '<?php echo $message; ?>'
		})
	}
	</script> 
	<?php } ?>
	
</body>
</html>