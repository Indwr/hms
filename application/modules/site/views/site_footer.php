
    <!-- footer part start-->
    <footer class="footer-area">
        <div class="copyright_part">
            <div class="container">
                <div class="row align-items-center">
                    <p class="footer-text m-0 col-lg-8 col-md-12"> <a href>Copyright &copy; <?php echo date("Y"); ?> All rights reserved.</a>

                    </p>
                    <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                        <a href="<?php echo $this->db->get('settings')->row()->facebook;?>"><i class="ti-facebook"></i></a>
                        <a href="<?php echo $this->db->get('settings')->row()->twitter;?>"> <i class="ti-twitter"></i> </a>
                        <a href="<?php echo $this->db->get('settings')->row()->instagram;?>"><i class="ti-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- footer part end-->
				
	<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
	<script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	
	<script>
    $('.default-date-picker').datepicker({
        format: 'dd-mm-yyyy'
    });
    </script>
	
	<script>
    $(document).ready(function () {
        $('.timepicker-default').timepicker({defaultTime: 'value'});

    });
   </script>


    <!-- jquery plugins here-->
    
    <script src="common/js/sweetAlert2.js"></script>
    <script src="website_ui/js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="website_ui/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="website_ui/js/bootstrap.min.js"></script>
    <!-- owl carousel js -->
    <script src="website_ui/js/owl.carousel.min.js"></script>
    <script src="website_ui/js/jquery.nice-select.min.js"></script>
    <!-- contact js -->
    <script src="website_ui/js/jquery.ajaxchimp.min.js"></script>
    <script src="website_ui/js/jquery.form.js"></script>
    <script src="website_ui/js/jquery.validate.min.js"></script>
    <script src="website_ui/js/mail-script.js"></script>
    <script src="website_ui/js/contact.js"></script>
    <!-- custom js -->
    <script src="website_ui/js/custom.js"></script>
	<script src="login_ui/vendor/tilt/tilt.jquery.min.js"></script>
	<script src="login_ui/js/main.js"></script>
</body>

</html>