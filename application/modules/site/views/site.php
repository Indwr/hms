<style>
.pad_doctor{
	margin-bottom:30px !important;
}
</style>
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-xl-5">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1><?php echo $this->db->get('settings')->row()->welcome_short;?></h1>
                            <p><?php echo $this->db->get('settings')->row()->welcome_long;?> </p>
                            <a href="#appointmentHead" class="btn_2">Make an appointment</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner_img">
                        <img src="website_ui/img/banner_img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- about us part start-->
    <section class="about_us padding_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 col-lg-6">
                    <div class="about_us_img">
                        <img src="website_ui/img/top_service.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="about_us_text">
                        <h2>About us</h2>
                        <p><?php echo $this->db->get('settings')->row()->about_us;?></p>
                        <a class="btn_2 " href="site/aboutUs">learn more</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us part end-->

    <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                   
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3 col-sm-12">
                    
                    
                </div>
                <div class="col-lg-4 col-sm-12">
                        <div class="single_feature_img js-tilt">
                            <img src="website_ui/img/service.png" alt="">
                        </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    
                    
                </div>
            </div>
        </div>
    </section>
    <!-- feature_part start-->

    <!-- our depertment part start-->
    <section class="our_depertment section_padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-12">
                    <div class="depertment_content">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <h2>Our Depertment</h2>
                                <div class="row">
								
								<?php 
								shuffle($departments);
								foreach ($departments as $department) { ?>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="website_ui/img/dept_icon.png"alt=""></span>
                                            <h4><?php  echo $department->dept; ?></h4>
                                            <p><?php  echo substr($department->description, 0, 90) . '. . .'; ?></p>
                                        </div>
                                    </div>
								<?php } ?>  								
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our depertment part end-->

    <!--::doctor_part start::-->
    <section class="doctor_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2> Experienced Doctors</h2>
                    </div>
                </div>
            </div>
            <div class="row">
			<?php 
			shuffle($staffs);
			foreach ($staffs as $staff) {  if($staff->profile == 'Doctor'){?>
                <div class="col-sm-6 col-lg-3 pad_doctor">
                    <div class="single_blog_item">
						<div class="single_blog_img">
							<img src="<?php echo $staff->img_url; ?>" alt="doctor">
						</div>
						<div class="single_text">
							<div class="single_blog_text">
								<h3><?php echo $staff->name; ?></h3>
								<p><?php echo $staff->dept; ?></p>
							</div>
						</div>
                    </div>
                </div>
			<?php } }?>
            
        </div>
    </section>
    <!--::doctor_part end::-->

    <!--::regervation_part start::-->
    <section class="regervation_part section_padding" id="appointmentHead">
        <div class="container">
            <div class="row align-items-center regervation_content">
                <div class="col-lg-7">
                    <div class="regervation_part_iner">
                        <form action="appointment/fromWebsite" method="post">
                            <h2>Make an Appointment</h2>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="input1" name="name" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" name="email" id="input2"
                                        placeholder="Email address" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="phone" id="input3"
                                        placeholder="Phone" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="date" class="form-control form_datetime-meridian" name="date"  id="input4"
                                        placeholder="Date" required>
                                </div>
								 <div class="form-group col-md-6">
                                    <input type="time" class="form-control form_datetime-meridian" name="time"  id="input5"
                                        placeholder="time" required>
                                </div>
								<div class="form-group col-md-6">
                                    <select class="form-control" name="dept" id="input6" required>
                                        <option value="" selected>Depertment</option>
										<?php foreach ($departments as $department) { ?>
                                        <option value="<?php  echo $department->dept; ?>"><?php  echo $department->dept; ?></option>
											<?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea required class="form-control" id="input6" name="note" rows="4"
                                        placeholder="Your Note "></textarea>
                                </div>
                            </div>
                            <div class="regerv_btn">
                                <button type="submit" onclick="" class="btn_1">Make an Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="reservation_img">
                        <img src="website_ui/img/reservation.png" alt="" class="reservation_img_iner">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::regervation_part end::-->

    <!--::blog_part start::-->
    <section class="blog_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2>Our Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
			<?php 
			$i = 0;
			shuffle($blogs);
			foreach ($blogs as $blog) { 
			$i = $i + 1; ?>
                <div class="col-sm-6">
                    <div class="single-home-blog">
                        <div class="card">
						 <a href="blog/viewBlogPost?id=<?php echo $blog->id; ?>">
                            <img src="<?php echo $blog->img; ?>" class="card-img-top" alt="blog">
						</a>
                            <div class="card-body">
                                <a href="blog/viewBlogPost?id=<?php echo $blog->id; ?>">
                                    <h5 class="card-title"><?php echo $blog->name; ?></h5>
                                </a>
                                <ul>
                                    <li> <span class="ti-user"></span><?php echo $blog->user; ?></li>
                                    <li> <span class="ti-alarm-clock"></span><?php echo date('d-m-Y', $blog->post_date); ?></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
			<?php 
			if ($i == 2)
				break;
			} ?>
            </div>
        </div>
		 <nav class="blog-pagination justify-content-center d-flex" >
			<div class="section_tittle text-center justify-content-center" style="">            
		            <a class="btn_2 d-none d-lg-block" href="blog/blogPosts" >View More</a>
			</div>
	     </nav>
		</section>
    <!--::blog_part end::-->
	
		<section class="blog_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
            </div>
                <div class="">
                    <div class="single-home-blog">
                        <div class="card">
						   <iframe src="<?php echo $this->db->get('settings')->row()->map_iframe;?>" width="1140" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	
							   <div class="card-body">
										<ul>
											<li> <span class="ti-location-pin"></span><?php echo $this->db->get('settings')->row()->address;?></li>
										</ul>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
		</section>

	<?php
	$message = $this->session->flashdata('feedback');
	if (!empty($message)) { ?>
	<script>
	function Slider() {		
	const Toast = Swal.mixin({
	customClass: 'sweet-slider',                 
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	});
	Toast.fire({	
	  <?php if($message == '<p>Incorrect Login</p>' 
	  || $message == 'contact company Administrator to activate your account'
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
	
    <script src="common/js/sweetAlert2.js"></script>