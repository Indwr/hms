<!-- breadcrumb start-->
    <section class="breadcrumb_part breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>our blog</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <!--================Blog Area =================-->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
					
					<?php 
					foreach ($blogs as $blog) { 
					if(strpos(strtolower($blog->name), strtolower($search)) !== FALSE  || strpos(strtolower($blog->description), strtolower($search))) {
					?>
                        <article class="blog_item">
                            <div class="blog_item_img">
							<a href="blog/viewBlogPost?id=<?php echo $blog->id; ?>" >
                                <img class="card-img rounded-0" src="<?php echo $blog->img; ?>" alt="">
							</a>
                                <a href="blog/viewBlogPost?id=<?php echo $blog->id; ?>" class="blog_item_date">
                                    <h3><?php echo date('d F', $blog->post_date); ?></h3>
                                   
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="blog/viewBlogPost?id=<?php echo $blog->id; ?>">
                                    <h2><?php echo $blog->name; ?></h2>
                                </a>
                                <p>
								<?php  echo substr($blog->description, 0, 200) . '. . .'; ?></p>
                                <ul class="blog-info-link">
                                    <li><a href="blog/viewBlogPost?id=<?php echo $blog->id; ?>"><i class="ti-user"></i><?php echo $blog->user; ?></a></li>
                                    <li><a href="blog/viewBlogPost?id=<?php echo $blog->id; ?>"><i class="ti-alarm-clock"></i><?php echo date('d-m-Y', $blog->post_date); ?></a></li>
                                    
                                </ul>
                            </div>
                        </article>
					<?php } ?>
					<?php } ?>
					<nav class="justify-content-center d-flex" >
						<ul class="" >
							<li class="" >
								<span class=""><?php echo  $links; ?></span>
							</li>
						</ul>
					</nav>
						
						
					
                    </div>
                </div>
				
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="blog/blogSearch" method="post">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="search" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Other Posts</h3>
							<?php 
							$i = 0;
							shuffle($blogss);
							foreach ($blogss as $blog) { 
							$i = $i + 1; ?>
                            <div class="media post_item">
							 <img src="<?php echo $blog->img; ?>" alt="post" style="max-width:70px;">
                                <div class="media-body">
                                    <a href="blog/viewBlogPost?id=<?php echo $blog->id; ?>">
                                        <h3><?php echo $blog->name; ?></h3>
                                    </a>
                                    <p><?php echo date('d-m-Y', $blog->post_date); ?></p>
                                </div>
                            </div>
							<?php 
							if ($i == $this->db->get('blog_settings')->row()->related)
                                break;
							} ?>
                        </aside>
                        


                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
