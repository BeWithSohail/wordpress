<?php 
/**
 * Template Name: Home
 */
?>

<?php 
	get_header(); 
		$title_description = get_field('small_title');
		$author_description = get_field("author_description");
		$author_name = get_field("author_name");
		$author_designation = get_field("author_designation");
		$long_description = get_field('long_description');
		$author_image = get_field('author_image');
		$author_img_src = $author_image['sizes']['medium'];
		$author_img_title =  $author_image["title"];
		$embed = get_Field('video_imbed');
		
?>
 <!--================Home Banner Area =================-->

 <section class="home_banner_area">
           	<div class="container box_1620">
           		<div class="banner_inner d-flex align-items-center">
					<div class="banner_content">
						<div class="media">
							<div class="d-flex">
									<img src="<?php echo ($author_img_src); ?>" alt="Author Image" title="<?php  echo $author_img_title?>">
							</div>
							<div class="media-body">
								<div class="personal_text">
							    	<?php if ($title_description): ?>
									<h6> 
										<?php echo $title_description; ?>
									</h6>
									<?php endif; ?>
									<h3>
										<?php echo $author_name; ?>
									</h3>
									<h4>
										<?php echo $author_designation; ?>
									</h4>

									<?php if($author_description):?>
										<p>
											<?php echo $author_description; ?>
										</p>
									<?php endif; ?>



									<?php 
$count = array("sohail", "adil", "wakil");
foreach ($count as $index => $value) {
    echo "Index: " . $index . ", Value: " . $value . "<br>";
}
?>



									<ul class="list basic_info">				
										<li><a href="#"><i class="lnr lnr-calendar-full"></i> <?php  echo the_field('dob'); ?> </a></li>
										<li><a href="#"><i class="lnr lnr-phone-handset"></i><?php  echo the_field('phone_number'); ?> </a></li>
										<li><a href="mailto:<?php the_field('email_field'); ?>"><i class="lnr lnr-envelope"></i><?php  echo the_field('email_field'); ?></a></li>
										<li><a href="#"><i class="lnr lnr-home"></i><?php  echo the_field('author_address'); ?></a></li>
									</ul>

									<ul class="list personal_social">
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Welcome Area =================-->
        <section class="welcome_area p_120">
        	<div class="container">
        		<div class="row welcome_inner">
        			<div class="col-lg-6">
        				<div class="welcome_text">
        					<h4> <?php echo  get_field('aboutmyself')?> </h4>
							
							<?php if($long_description): ?>
        					<p><?php echo $long_description;?></p>
        					<?php endif; ?>
							<div class="row">
        						<div class="col-md-4">
        							<div class="wel_item">
        								<i class="lnr lnr-database"></i>
        								<h4>$2.5M</h4>
        								<p>Total Donation</p>
        							</div>
        						</div>
        						<div class="col-md-4">
        							<div class="wel_item">
        								<i class="lnr lnr-book"></i>
        								<h4>1465</h4>
        								<p>Total Projects</p>
        							</div>
        						</div>
        						<div class="col-md-4">
        							<div class="wel_item">
        								<i class="lnr lnr-users"></i>
        								<h4>3965</h4>
        								<p>Total Volunteers</p>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-6">
        				<div class="tools_expert">
        					<div class="skill_main">
								<div class="skill_item">
									<h4>After Effects <span class="counter">85</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Photoshop <span class="counter">90</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Illustrator <span class="counter">70</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Sublime <span class="counter">95</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Sketch <span class="counter">75</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Welcome Area =================-->
		<!-- video embeds -->
			<!-- <div class="video_embed"> 
					<?php if($embed): ?>
						<?php echo $embed; ?>
					<?php endif; ?>
			</div> -->

			<div class="select_field"> 

			</div>

		<!-- end -->
        
        <!--================My Tabs Area =================-->
        <section class="mytabs_area p_120">
        	<div class="container">
        		<div class="tabs_inner">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My Experiences</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Education</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<ul class="list">
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>March 2017 to present</p>
										</div>
										<div class="media-body">
											<h4>Colorlib</h4>
											<p>Senior Web Developer <br />Santa monica, Los angeles</p>
										</div>
									</div>
								</li>
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>March 2017 to present</p>
										</div>
										<div class="media-body">
											<h4>Colorlib</h4>
											<p>Senior Web Developer <br />Santa monica, Los angeles</p>
										</div>
									</div>
								</li>
								<li>
								<span></span>
									<div class="media">
										<div class="d-flex">
											<p>March 2017 to present</p>
										</div>
										<div class="media-body">
											<h4>Colorlib</h4>
											<p>Senior Web Developer <br />Santa monica, Los angeles</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<ul class="list">
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>March 2017 to present</p>
										</div>
										<div class="media-body">
											<h4>Colorlib</h4>
											<p>Senior Web Developer <br />Santa monica, Los angeles</p>
										</div>
									</div>
								</li>
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>March 2017 to present</p>
										</div>
										<div class="media-body">
											<h4>Colorlib</h4>
											<p>Senior Web Developer <br />Santa monica, Los angeles</p>
										</div>
									</div>
								</li>
								<li>
								<span></span>
									<div class="media">
										<div class="d-flex">
											<p>March 2017 to present</p>
										</div>
										<div class="media-body">
											<h4>Colorlib</h4>
											<p>Senior Web Developer <br />Santa monica, Los angeles</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
        		</div>
        	</div>
        </section>
        <!--================End My Tabs Area =================-->
        
        <!--================Feature Area =================-->
        <section class="feature_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>offerings to my clients</h2>
        			<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $.17 each.</p>
        		</div>
        		<div class="feature_inner row">
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<i class="flaticon-city"></i>
        					<h4>Architecture</h4>
        					<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $17 each.</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<i class="flaticon-skyline"></i>
        					<h4>Interior Design</h4>
        					<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $17 each.</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<i class="flaticon-sketch"></i>
        					<h4>Concept Design</h4>
        					<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $17 each.</p>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Feature Area =================-->
        
        <!--================Home Gallery Area =================-->
        <section class="home_gallery_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Our Latest Featured Projects</h2>
        			<p>Who are in extremely love with eco friendly system.</p>
        		</div>
        		<div class="isotope_fillter">
        			<ul class="gallery_filter list">
						<li class="active" data-filter="*"><a href="#">All</a></li>
						<li data-filter=".brand"><a href="#">Vector</a></li>
						<li data-filter=".manipul"><a href="#">Raster</a></li>
						<li data-filter=".creative"><a href="#">UI/UX</a></li>
						<li data-filter=".design"><a href="#">Printing</a></li>
					</ul>
        		</div>
        	</div>
        	<div class="container">
        		<div class="gallery_f_inner row imageGallery1">
        			<div class="col-lg-4 col-md-4 col-sm-6 brand manipul design print">
        				<div class="h_gallery_item">
        					<div class="g_img_item">
        						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/project-1.jpg" alt="">
        						<a class="light" href="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/project-1.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/icon.png" alt=""></a>
        					</div>
        					<div class="g_item_text">
        						<h4>3D Helmet Design</h4>
        						<p>Client Project</p>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-4 col-sm-6 brand manipul creative">
        				<div class="h_gallery_item">
        					<div class="g_img_item">
        						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/project-2.jpg" alt="">
        						<a class="light" href="img/gallery/project-2.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/icon.png" alt=""></a>
        					</div>
        					<div class="g_item_text">
        						<h4>2D Vinyl Design</h4>
        						<p>Client Project</p>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-4 col-sm-6 manipul creative design print">
        				<div class="h_gallery_item">
        					<div class="g_img_item">
        						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/project-3.jpg" alt="">
        						<a class="light" href="img/gallery/project-3.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/icon.png" alt=""></a>
        					</div>
        					<div class="g_item_text">
        						<h4>Creative Poster Design</h4>
        						<p>Client Project</p>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-4 col-sm-6 brand creative print">
        				<div class="h_gallery_item">
        					<div class="g_img_item">
        						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/project-4.jpg" alt="">
        						<a class="light" href="img/gallery/project-4.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/icon.png" alt=""></a>
        					</div>
        					<div class="g_item_text">
        						<h4>Embosed Logo Design</h4>
        						<p>Client Project</p>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-4 col-sm-6 brand manipul design">
        				<div class="h_gallery_item">
        					<div class="g_img_item">
        						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/project-5.jpg" alt="">
        						<a class="light" href="img/gallery/project-5.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/icon.png" alt=""></a>
        					</div>
        					<div class="g_item_text">
        						<h4>3D Disposable Bottle</h4>
        						<p>Client Project</p>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-4 col-sm-6 brand creative">
        				<div class="h_gallery_item">
        					<div class="g_img_item">
        						<img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/project-6.jpg" alt="">
        						<a class="light" href="img/gallery/project-6.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery/icon.png" alt=""></a>
        					</div>
        					<div class="g_item_text">
        						<h4>3D Logo Design</h4>
        						<p>Client Project</p>
        					</div>
        				</div>
        			</div>
        		</div>
        		<div class="more_btn">
        			<a class="main_btn" href="#">Load More Items</a>
        		</div>
        	</div>
        </section>
        <!--================End Home Gallery Area =================-->
        
        <!--================Testimonials Area =================-->
        <section class="testimonials_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Testimonials</h2>
        			<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $.17 each.</p>
        		</div>
        		<div class="testi_inner">
					<div class="testi_slider owl-carousel">
						<div class="item">
							<div class="testi_item">
								<p>As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel across her face</p>
								<h4>Fanny Spencer</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star-half-o"></i></a>
							</div>
						</div>
						<div class="item">
							<div class="testi_item">
								<p>As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel across her face</p>
								<h4>Fanny Spencer</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star-half-o"></i></a>
							</div>
						</div>
						<div class="item">
							<div class="testi_item">
								<p>As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel across her face</p>
								<h4>Fanny Spencer</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star-half-o"></i></a>
							</div>
						</div>
					</div>
        		</div>
        	</div>
        </section>
        <!--================End Testimonials Area =================-->
<?php get_footer(); ?>