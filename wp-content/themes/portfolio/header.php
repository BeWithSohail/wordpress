<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="https://bewithsohail.netlify.app/assets/img/apple-touch-icon.png" type="image/png">
        <title>MeetMe Personal</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/linericon/style.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/animate-css/animate.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/popup/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/flaticon/flaticon.css">
        <!-- main css -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/responsive.css">
        <?php wp_head(); ?>
    </head>
    <body>
         
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container box_1620">
						<!-- Brand and toggle get grouped for better mobile display -->
                        <?php 
                            $logoimg = get_header_image();
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand logo_h" rel="home">
                            <img src="<?php echo $logoimg; ?>" alt="">
                        </a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<!-- <ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li> 
								<li class="nav-item"><a class="nav-link" href="about-us.php">About</a></li> 
								<li class="nav-item"><a class="nav-link" href="services.php">Services</a></li> 
								<li class="nav-item submenu dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
									<ul class="dropdown-menu">
										<li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
										<li class="nav-item"><a class="nav-link" href="elements.php">Elements</a></li>
									</ul>
								</li> 
								<li class="nav-item submenu dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
									<ul class="dropdown-menu">
										<li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
										<li class="nav-item"><a class="nav-link" href="single-blog.php">Blog Details</a></li>
									</ul>
								</li> 
								<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
							</ul> -->

                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary-menu',
                                    'menu_class'     => 'nav navbar-nav menu_nav ml-auto',
                                    'container'      => false,
                                    'fallback_cb'    => false,
                                    'depth'          => 2,
                                    // 'walker'         => new Custom_Nav_Walker(), // Use the custom walker
                                ));
                            ?>
                            
						</div> 
					</div>
            	</nav>
            </div>
        </header>
<!--================Header Menu Area =================-->
