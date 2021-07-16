<div class="contentbar">
	<!-- Start row -->
	<div class="row">
		<!-- Start col -->
		<div class="col-lg-12">
			<div class="card m-b-30">
				<div class="card-header">
					<h5 class="card-title">   <?php echo lang('blog'); ?> <?php  echo lang('posts'); ?></</h5>
				</div>
				<div class="card-body">
				<section id="main-content">
					<section class="wrapper site-min-height">
							<div class="panel-body">
								<div class="adv-table editable-table ">
									<div class="clearfix">
										<a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add'); ?> <?php  echo lang('post'); ?>
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
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php foreach ($blogs as $blog) { ?>
                            <tr class="">
                                <td> <a href="<?php echo $blog->img; ?>"><img src="<?php echo $blog->img; ?>" width="40px"></a></td>
                                <td> <?php echo $blog->name; ?></td>
                                <td> <?php echo substr($blog->description, 0, 120) . '. . .'; ?></td>
                                <td>
								<!--
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $blog->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                   -->
									<a class="" href="blog/editBlogPost?id=<?php echo $blog->id; ?>"><button type="button" class="btn btn-success btn-xs btn_width" ><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php echo lang('post'); ?></button></a>   
                                    <a class="" href="blog/viewBlogPost?id=<?php echo $blog->id; ?>"><button type="button" class="btn btn-primary btn-xs btn_width" ><i class="glyphicon glyphicon-th-large"></i> <?php echo lang('view'); ?> <?php echo lang('blog'); ?> <?php echo lang('post'); ?></button></a>   
                                    <a class="" href="blog/deleteblogItem?id=<?php echo $blog->id; ?>"><button type="button" class="btn btn-danger btn-xs btn_width" onclick="return confirm('Are you sure you want to delete this post?');"><i class="fa fa-trash-o"></i> </button></a>   
                                    </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Blog Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add'); ?> <?php  echo lang('post'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="blog/addNew" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
						<textarea  maxlength="" class="ckeditor form-control editor" name="description" cols="" id="" rows="" placeholder=""></textarea>	
                    </div>
					
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
								<label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
							<div class="">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail " >
									<img class="" src="" />	
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" ></div>
									<div >
									<span class="btn btn-white btn-file">
										<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
										<input type="file" class="default" name="img_url" value=""/></span>
									<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
									<br>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					
                    <input type="hidden" name="id" value=''>
        
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Blog Modal-->







<!-- Edit Blog Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> <?php  echo lang('post'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBlogForm" action="blog/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
					
					<div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
						
						<textarea  maxlength="" class="ckeditor form-control editor" name="description" cols="" id="editor1" rows="" placeholder=""></textarea>	
                    </div>
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
								<label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
							<div class="">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail " >		
									<img id="img1" class="" src="" />
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" ></div>
									<div >
									<span class="btn btn-white btn-file">
										<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Change image</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
										<input type="file" class="default" id="img2" name="img_url" value=""/>
									</span>
									<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"> Remove</a>
									<br>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					
                    <input type="hidden" name="id" value=''>
                    
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Blog Modal-->


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
<script type="text/javascript">
		$(document).ready(function () {
			$(".editbutton").click(function (e) {
				e.preventDefault(e);
				// Get the record's ID via attribute  
				var iid = $(this).attr('data-id');
				var image = $("#img1").attr("src", "uploads/img");
				$('#editBlogForm').trigger("reset");
				$('#myModal2').modal('show');
				$.ajax({
					url: 'blog/editBlogByJason?id=' + iid,
					method: 'GET',
					data: '',
					dataType: 'json',
				}).success(function (response) {
					// Populate the form fields with the data returned from server

					$('#editBlogForm').find('[name="id"]').val(response.blog.id).end()
					$('#editBlogForm').find('[name="name"]').val(response.blog.name).end()
					CKEDITOR.instances['editor1'].setData(response.blog.description)
					
					var image_return = response.blog.img;
					//document.getElementById("img2").value = image_return;
					 
					if (typeof response.blog.img !== 'undefined' && response.blog.img != '') {
					$("#img1").attr("src", response.blog.img);
					$("#img2").attr("value", image_return);
					}
				});
			});
		});
</script>