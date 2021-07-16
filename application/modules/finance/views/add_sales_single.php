<!--sidebar end-->
<!-- Start Contentbar -->    
<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title"> Add Payment</h5>
				</div>
				<div class="card-body">
				
							<form role="form" id="editPaymentForm" class="clearfix" action="finance/addPayment" method="post" enctype="multipart/form-data">

								<div class="row">
								<div class="col-md-5">
										<div class="form-group"> 
                                            <label for="exampleInputEmail1"> Patient </label>
											
                                              <input type="text" name="" class='form-control' value="<?php echo $patient->name; ?>">
                                              <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
												
										</div>
										
                                            <div class="form-group">
												<label for="exampleInputEmail1"><?php echo lang('doctor'); ?> </label>
												<select class="form-control js-example-basic-single" name="doctor" value='' required> 
												<option value="">Select Doctor</option>
													<?php foreach ($staffs as $staff) { 
													if ($staff->profile == 'Doctor'){?>
														<option value="<?php echo $staff->id; ?>">
														<?php echo $staff->name; ?>  - <strong> <?php echo $staff->dept; ?></strong>
														</option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
										
											<div class="form-group"> 
                                            <label for="exampleInputEmail1"> Select Product </label>
												  <select name="category_name[]" id="" class="multi-select" multiple="" id="my_multi_select3" >
												<?php foreach ($categories as $category) { 
												if(empty($category->deletii) && empty($category->e_date)){
															?>
													<option class="ooppttiioonn" data-id="<?php echo $category->c_price; ?>" data-idd="<?php echo $category->id; ?>" data-cat_name="<?php echo $category->category; ?>" data-cs = "<?php echo $category->howmany; ?>"  data-cc = "<?php echo $category->description; ?>" value="<?php echo $category->category; ?>"
													<?php if (!empty($payment->category_name)) {
														$category_name = $payment->category_name;
														$category_name1 = explode(',', $category_name);
														foreach ($category_name1 as $category_name2) {
															$category_name3 = explode('*', $category_name2);
															if ($category_name3[0] == $category->category) {
																echo 'data-qtity=' . $category_name3[2];
															}
														}
													}
													
													?><?php if (!empty($payment->category_name)) {
															$category_name = $payment->category_name;
															$category_name1 = explode(',', $category_name);
															foreach ($category_name1 as $category_name2) {
																$category_name3 = explode('*', $category_name2);
																if ($category_name3[0] == $category->category) {
																	
																	echo 'selected';
																}
															}
														}
														?>
														 required="">		
															<?php echo $category->category;; ?>
															</option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div>
					
								<div class="col-md-1">
								<div class="form-group"> 		
                                
								</div>
								</div>
								
								<div class="col-md-3">
								<div class="form-group"> 		
                                <div class="qfloww auto_heightt" ></div>
								</div>
								</div>
															
                                        <div class="col-md-3">
											<div class="form-group"> 
												<label for="exampleInputEmail1"><?php echo lang('sub_total'); ?> </label>
                                                    <input type="text" class="form-control payment_font_weight" name="subtotal" id="subtotal" value='<?php
                                                    if (!empty($payment->amount)) {

                                                        echo $payment->amount;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                            </div>

                                            

                                               <div class="col-md-3 payment_label"> 

                                                     <?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> 
                                                </div>
                                                <div class="form-group">
												 <label for="exampleInputEmail1"><?php echo lang('discount'); ?></label>
												 
                                                    <input type="number" class="form-control payment_font_weight" pattern="[0-9]{5}" name="discount" id="dis_id" value='<?php
                                                    if (!empty($payment->discount)) {
                                                        $discount = explode('*', $payment->discount);
                                                        echo $discount[0];
                                                    }
                                                    ?>' placeholder="" autocomplete='off'>
                                                </div>

                                            

                                                <div class="form-group">
												 <label  for="exampleInputEmail1"><?php echo lang('gross_total'); ?> </label>
                                               
                                                    <input type="text" class="form-control payment_font_weight" name="grsss" id="gross" value='<?php
                                                    if (!empty($payment->gross_total)) {

                                                        echo $payment->gross_total;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>
												
												
                                            <div class="form-group">
												
											  <label style="font-weight: 600;" for="exampleInputEmail1"><?php echo lang('amount_received'); ?> </label>
												<input type="number" class="form-control payment_font_weight" pattern="[0-9]{5}" name="amount_received" id="amount_received" value='<?php
                                                    if (!empty($payment->amount_received)) {

                                                        echo $payment->amount_received;
                                                    }
                                                    ?>' placeholder=" " autocomplete='off'>
                                                

                                            </div>
											
											<div class="form-group">
										        <label for="exampleInputEmail1"><?php echo lang('payment_mode'); ?> </label>
													<select type="text" class="form-control payment_font_weight" name="payment_mode" required>
													  <option class="form-control "  value="cash" >Cash</option>
													  <option class="form-control "  value="bank" >POS/Bank Transfer</option>
													</select>
                                            </div>
											
                                            <div class="form-group">
                                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                                    
                                                </div>
                                        </div>
                                            <!--
                                            <div class="col-md-12 payment">
                                                <div class="col-md-3 payment_label"> 
                                                  <label for="exampleInputEmail1">Vat (%)</label>
                                                </div>
                                                <div class="col-md-9"> 
                                                  <input type="text" class="form-control pay_in" name="vat" id="exampleInputEmail1" value='<?php
                                            if (!empty($payment->vat)) {
                                                echo $payment->vat;
                                            }
                                            ?>' placeholder="%">
                                                </div>
                                            </div>
                                            -->

                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($payment->id)) {
                                                echo $payment->id;
                                            }
                                            ?>'>
                                            <div class="row">
                                            </div>
                                            <div class="form-group">
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
        </section>

    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/bateristaworks.min.js"></script>
<script>
    $(document).ready(function () {

        var tot = 0;
        //  $(".qfloww").html("");
        $(".ms-selected").click(function () {
            var idd = $(this).data('idd');
            $('#id-div' + idd).remove();
            $('#idinput-' + idd).remove();
            $('#categoryinput-' + idd).remove();

        });
        $.each($('select.multi-select option:selected'), function () {
            var curr_val = $(this).data('id');
            var cs = $(this).data('cs');
            var cc = $(this).data('cc');
            var idd = $(this).data('idd');
            var qtity = $(this).data('qtity');
            //  tot = tot + curr_val;
            var cat_name = $(this).data('cat_name');
            if ($('#idinput-' + idd).length)
            {

            } else {
                if ($('#id-div' + idd).length)
                {

                } else {
                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div></div></div><div class="pos_element"><div></div>')
                }


                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + idd,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editPaymentForm .qfloww');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'categoryinput-' + idd,
                    name: 'category_id[]',
                    value: idd,
                }).appendTo('#editPaymentForm .qfloww');
            }


            $(document).ready(function () {
                $('#idinput-' + idd).keyup(function () {
                    var qty = 0;
                    var total = 0;
                    $.each($('select.multi-select option:selected'), function () {
                        var id1 = $(this).data('idd');
                        qty = $('#idinput-' + id1).val();
                        var ekokk = $(this).data('id');
                        total = total + qty * ekokk;
                    });

                    tot = total;

                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                    $('#editPaymentForm').find('[name="grsss"]').val(gross)
                });
            });
            var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
            tot = tot + sub_total;


        });

        var discount = $('#dis_id').val();

<?php
if ($discount_type == 'flat') {
    ?>

            var gross = tot - discount;

<?php } else { ?>

            var gross = tot - tot * discount / 100;

<?php } ?>

        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()

        $('#editPaymentForm').find('[name="grsss"]').val(gross)
    }

    );




    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                ggggg = amount - val_dis;
<?php } else { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 


<script>
    $(document).ready(function () {

        $('.multi-select').change(function () {
            var tot = 0;
            //  $(".qfloww").html("");
            $(".ms-selected").click(function () {
                var idd = $(this).data('idd');
                $('#id-div' + idd).remove();
                $('#idinput-' + idd).remove();
                $('#categoryinput-' + idd).remove();

            });
            $.each($('select.multi-select option:selected'), function () {
                var curr_val = $(this).data('id');
                var idd = $(this).data('idd');
                //  tot = tot + curr_val;
                var cat_name = $(this).data('cat_name');
				var cs = $(this).data('cs');
				var cc = $(this).data('cc');
                if ($('#idinput-' + idd).length)
                {

                } else {
                    if ($('#id-div' + idd).length)
                    {

                    } else {
                        $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div></div><div class="quantity pos_element"><div></div>')
                    }


                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + idd,
                        name: 'quantity[]',
                        value: '1',
                    }).appendTo('#editPaymentForm .qfloww');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'categoryinput-' + idd,
                        name: 'category_id[]',
                        value: idd,
                    }).appendTo('#editPaymentForm .qfloww');
                }


                $(document).ready(function () {
                    $('#idinput-' + idd).keyup(function () {
                        var qty = 0;
                        var total = 0;
                        $.each($('select.multi-select option:selected'), function () {
                            var id1 = $(this).data('idd');
                            qty = $('#idinput-' + id1).val();
                            var ekokk = $(this).data('id');
                            total = total + qty * ekokk;
                        });

                        tot = total;

                        var discount = $('#dis_id').val();
                        var gross = tot - discount;
                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                        $('#editPaymentForm').find('[name="grsss"]').val(gross)
                    });
                });
                var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
                tot = tot + sub_total;


            });

            var discount = $('#dis_id').val();

<?php
if ($discount_type == 'flat') {
    ?>

                var gross = tot - discount;

<?php } else { ?>

                var gross = tot - tot * discount / 100;

<?php } ?>

            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()

            $('#editPaymentForm').find('[name="grsss"]').val(gross)
        }

        );
    });

    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                ggggg = amount - val_dis;
<?php } else { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 


<script>
    $(document).ready(function () {
        $('.pos_client').hide();
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == 'add_new') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });


</script>
