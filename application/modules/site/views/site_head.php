<!doctype html>
<html lang="en">

<head>
    <base href="<?php echo base_url(); ?>">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->db->get('settings')->row()->title;?> - <?php echo $this->db->get('settings')->row()->system_vendor;?></title>
    <link rel="icon" href="<?php echo $this->db->get('settings')->row()->favicon;?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="website_ui/css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="website_ui/css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="website_ui/css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="website_ui/css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="website_ui/css/flaticon.css">
    <!-- magnific popup CSS -->
    <link rel="stylesheet" href="website_ui/css/magnific-popup.css">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="website_ui/css/nice-select.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="website_ui/css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="website_ui/css/style.css">
	
	
    <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
	
	 <!--Google Font-->
	<link href="//fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <!--Google Font-->
	
</head>

<body onload="Slider()">
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href=""> <img src="<?php echo $this->db->get('settings')->row()->logo;?>" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-center"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="site/aboutUs">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="site/aboutUs">Contact</a>
                                </li>
								<?php if ($this->ion_auth->in_group(array('Staff', 'Doctor', 'admin'))) { ?>
						         <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Blog
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="blog">Blog Dashboard</a>
                                        <a class="dropdown-item" href="blog/blogPosts">Blog</a>
                                    </div>
                                </li>
                                <?php } else{?>
								<li class="nav-item">
                                    <a class="nav-link" href="blog/blogPosts">Blog</a>
                                </li>
                                <?php } ?>
								<?php if (!$this->ion_auth->logged_in()) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="auth/login">ERP Login</a>
                                </li>
								<?php } else { ?>
								<li class="nav-item">
                                    <a class="nav-link" href="home">ERP Dashboard</a>
                                </li>
								<?php } ?>
                            </ul>
                        </div>
                        <a class="btn_2 d-none d-lg-block" href="javascript:void();"><i class="ti-mobile"></i> <?php echo $this->db->get('settings')->row()->phone;?></a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->
