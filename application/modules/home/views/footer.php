		<div class="footerbar">
			<footer class="footer">
				<p class="mb-0"><?php echo $this->db->get('settings')->row()->title;?> ©  <?php echo date("Y"); ?></p>
			</footer>
		</div>
		<!-- End Footerbar -->
	</div>
	<!-- End Rightbar -->
</div>
<!-- End Containerbar -->


<script>
var $slider = document.getElementById('slider');
var $toggle = document.getElementById('toggle');

$toggle.addEventListener('click', function() {
	var isOpen = $slider.classList.contains('slide-in');

	$slider.setAttribute('class', isOpen ? 'slide-out' : 'slide-in');
});
</script>

<!-- js placed at the end of the document so the pages load faster -->	
<script src="assets_ui/js/jquery.min.js"></script>
<script src="assets_ui/js/popper.min.js"></script>
<script src="assets_ui/js/bootstrap.min.js"></script>
<script src="assets_ui/js/modernizr.min.js"></script>
<script src="assets_ui/js/detect.js"></script>
<script src="assets_ui/js/jquery.slimscroll.js"></script>
<script src="assets_ui/js/vertical-menu.js"></script>
<!-- Switchery js -->
<script src="assets_ui/plugins/switchery/switchery.min.js"></script> 
<!-- Slick js -->
<script src="assets_ui/plugins/slick/slick.min.js"></script>
<!-- Custom Dashboard js -->   
<script src="assets_ui/js/custom/custom-dashboard.js"></script>
<!-- Core js -->
<script src="assets_ui/js/core.js"></script>


<script src="common/js/jquery.js"></script>
<script src="common/js/jquery-1.8.3.min.js"></script>

<script src="common/js/bootstrap.min.js"></script>
<script src="common/js/jquery.scrollTo.min.js"></script>


<script src="common/js/moment.min.js"></script>

<script src="common/js/sweetAlert2.js"></script>


<script type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>
<link href="common/assets/DataTables/datatables.min.css" rel="stylesheet" />

<script src="common/js/respond.min.js" ></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="common/assets/ckeditor/ckeditor.js"></script>
<script src="common/js/advanced-form-components.js"></script>
<script src="common/js/jquery.cookie.js"></script>

<script src="common/js/common-scripts.js"></script>
<script class="include" type="text/javascript" src="common/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="common/assets/fullcalendar/fullcalendar.js"></script>
<script type="text/javascript" src="common/assets/select2/js/select2.min.js"></script>


<script type="text/javascript" src="common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $(".js-example-basic-single").select2();

        $(".js-example-basic-multiple").select2();
    });

</script>


<script src="common/js/editable-table.js"></script>



<script>
    jQuery(document).ready(function () {
        EditableTable.init();
    });

</script>

<script>
    $('#calender').fullCalendar()
</script>

<script>
    $('.multi-select').multiSelect({
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' search...'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=''>",
        afterInit: function (ms) {
            var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
</script>

<script>
    $('#my_multi_select3').multiSelect()
</script>

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

<script type="text/javascript">

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            lang: 'en',
            events: 'appointment/getAppointmentByJason',
            header:
                    {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month',
                    },
            timeFormat: 'll',
            eventRender: function (event, element) {
                element.find('.fc-title').html(element.find('.fc-title').text());

            },
            slotDuration: '00:5:00',
            businessHours: false,
            slotEventOverlap: false,
            editable: false,
            selectable: false,
            lazyFetching: true,
            //minTime: "6:00:00",
            //maxTime: "24:00:00",
            defaultView: 'month',
            allDayDefault: false,
            displayEventEnd: false,
            timezone: false,

        });
    });

</script>


</body>
</html>
