 
 <style>
 .breadcrumb_bgg {
  background-image: url("<?php echo $blog->img; ?>");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-size: 2100px;
  //background-image: rgba(76, 175, 80, 0.3)   
  filter: blur(4px);
  -webkit-filter: blur(4px);
}
 
 </style>
 
 <!-- breadcrumb start-->
    <section class="breadcrumb_part breadcrumb_bgg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Blog Post</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="<?php echo $blog->img; ?>" alt="">
                  </div>
                  <div class="blog_details">
                     <h2><?php echo $blog->name; ?></h2>
                     <ul class="blog-info-link mt-3 mb-4">
						<li><i class="ti-user"></i><?php echo $blog->user; ?></li>
                        <li><i class="ti-alarm-clock"></i><?php echo date('d-m-Y', $blog->post_date); ?></li>
                                    
                     </ul>
                     <p class="excert">
                        <?php echo $blog->description; ?>
                     </p>
                  </div>
               </div>
               <div class="navigation-top">
                  <div class="d-sm-flex justify-content-between text-center">
                     <p class="like-info"><span class="align-middle"><i class="far fa-heart"></i></span> </p>
                     <div class="col-sm-4 text-center my-2 my-sm-0">
                     </div>
                     <ul class="social-icons">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fab fa-behance"></i></a></li>
                     </ul>
                  </div>
                  <div class="navigation-area">
                     <div class="row">
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                           <div class="thumb">
                              <a href="#">
                                 <img class="img-fluid" src="img/post/preview.png" alt="">
                              </a>
                           </div>
                           
                           <div class="detials">
						      <?php 
							  $theId =  $blog->id; 
							  $prevId = $theId - 1;
							  $search_post = $this->db->get_where('blog', array('id' => $prevId))->row();
							  if(!empty($search_post)) {
							  ?>
                              <a href="blog/viewBlogPost?id=<?php echo $prevId; ?>">
                                 <h4> < Prev Post</h4>
							  </a>
							  <?php } ?>
                           </div>
                        </div>
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                           <div class="detials">
						    <?php 
							$theId1 =  $blog->id; 
							$prevId1 = $theId1 + 1;
							$search_post1 = $this->db->get_where('blog', array('id' => $prevId1))->row();
							if(!empty($search_post1)) {
							?>
                              <a href="blog/viewBlogPost?id=<?php echo $prevId1; ?>">
                                 <h4>Next Post ></h4>
							  </a>
							<?php  } ?>
                           </div>
                           
                           <div class="thumb">
                              <a href="#">
                                 <img class="img-fluid" src="img/post/next.png" alt="">
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="comments-area" style="display:none;">
			   
					<div class="comment-list">
						 <div class="single-comment justify-content-between d-flex">
									<div class="user justify-content-between d-flex">
										   
										   <div class="desc">
											  
												  <div class="d-flex justify-content-between">
													 <div class="d-flex align-items-center">
														<h5>
														   <a href="#">Emilly Blunt</a>
														</h5>
														<p class="date">December 4, 2017 at 3:12 pm </p>
													 </div>
													 <div class="reply-btn">
														<a href="#" class="btn-reply text-uppercase">reply</a>
											      </div>
										</div>
									</div>
							</div>
					</div>
               </div>
				  
                  <div class="comment-list" style="display:none;">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="img/comment/comment_2.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                 Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">Emilly Blunt</a>
                                    </h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                 </div>
                                 <div class="reply-btn">
                                    <a href="#" class="btn-reply text-uppercase">reply</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="img/comment/comment_3.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                 Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">Emilly Blunt</a>
                                    </h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                 </div>
                                 <div class="reply-btn">
                                    <a href="#" class="btn-reply text-uppercase">reply</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="comment-form" style="display:none;">
                  <h4>Leave a Reply</h4>
                  <form class="form-contact comment_form" action="#" id="commentForm">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                 placeholder="Write Comment"></textarea>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group">
                              <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="button btn_1 button-contactForm">Send Message</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget search_widget">
                     <form action="blog/blogSearch" method="post">
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder='Search Keyword' name="search" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                              <div class="input-group-append">
                                 <button class="btn" type="submit"><i class="ti-search"></i></button>
                              </div>
                           </div>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">Search</button>
                     </form>
                  </aside>
                  
						 <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Other Posts</h3>
							<?php 
							$i = 0;
							shuffle($blogs);
							foreach ($blogs as $blog) { 
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
   <!--================Blog Area end =================-->