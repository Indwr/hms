
  <!-- breadcrumb start-->
  <section class="breadcrumb_part breadcrumb_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>contact</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!-- ================ contact section start ================= -->
  <section class="contact-section section_padding">
    <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">		
		<iframe src="<?php echo $this->db->get('settings')->row()->map_iframe;?>" width="1140" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	  </div>


      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">About Us</h2>
        </div>
        <div class="col-lg-8">
          <?php echo $this->db->get('settings')->row()->about_us;?>
        </div>
        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3><?php echo $this->db->get('settings')->row()->address;?></h3>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3><?php echo $this->db->get('settings')->row()->phone;?></h3>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><?php echo $this->db->get('settings')->row()->email;?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->