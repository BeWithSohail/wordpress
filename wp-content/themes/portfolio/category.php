

<!-- Header -->
<?php get_header();?>  
<style>
@import url(https://fonts.googleapis.com/css?family=Merriweather:400,300,700);
@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
body {
  background: #27ded96b;
  font-family: "Merriweather", serif;
  font-size: 16px;
  color: #777;
}

.row {
  padding: 50px 0;
}

.seperator {
  margin-bottom: 30px;
  width: 35px;
  height: 3px;
  background: #777;
  border: none;
}

.title {
  text-align: center;
}
.title .row {
  padding: 50px 0 0;
}
.title h1 {
  text-transform: uppercase;
}
.title .seperator {
  margin: 0 auto 10px;
}

.item {
  position: relative;
  margin-bottom: 30px;
  min-height: 1px;
  float: left;
  -webkit-backface-visibility: hidden;
  -webkit-tap-highlight-color: transparent;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.item .item-in {
  background: #fff;
  padding: 40px;
  position: relative;
}
.item .item-in:hover:before {
  width: 100%;
}
.item .item-in::before {
  content: "";
  position: absolute;
  bottom: 0px;
  height: 2px;
  width: 0%;
  background: #333333;
  right: 0px;
  transition: width 0.4s;
}

.item h4 {
  font-size: 18px;
  margin-top: 25px;
  letter-spacing: 2px;
  text-transform: uppercase;
}
.item p {
  font-size: 12px;
}
.item a {
  font-family: "Montserrat", sans-serif;
  font-size: 12px;
  text-transform: uppercase;
  color: #666666;
  margin-top: 10px;
}
.item a i {
  opacity: 0;
  padding-left: 0px;
  transition: 0.4s;
  font-size: 24px;
  display: inline-block;
  top: 5px;
  position: relative;
}
.item a:hover {
  text-decoration: none;
}
.item a:hover i {
  padding-left: 10px;
  opacity: 1;
  font-weight: 300;
}

.item .icon {
  position: absolute;
  top: 27px;
  left: -16px;
  cursor: pointer;
}
.item .icon a {
  font-family: "Merriweather", serif;
  font-size: 14px;
  font-weight: 400;
  color: #999;
  text-transform: none;
}
.item .icon svg {
  width: 32px;
  height: 32px;
  float: left;
}
.item .icon .icon-topic {
  opacity: 0;
  padding-left: 0px;
  transition: 0.4s;
  display: inline-block;
  top: 0px;
  position: relative;
}
.item .icon:hover .icon-topic {
  opacity: 1;
  padding-left: 10px;
}

@media only screen and (max-width: 768px) {
  .item .icon {
    position: relative;
    top: 0;
    left: 0;
  }
}
</style>     
<!-- End -->  
       
<!-- Blog Page design -->
<section class="title container">
  <div class="row">
    <div class="col-md-12">
      <h1>Blog Layout</h1>
      <div class="seperator"></div>
      <p>Blocks with hover effects</p>
    </div>
  </div>
</section>

<!-- Start Blog Layout -->
<div class="container">
  <div class="row">
  <?php
$args = array(
    'post_type' => 'post', // Fetching posts
    'posts_per_page' => 1, // Number of posts per page
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1 // Current page
);
$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        ?>
        <div class="col-md-6 item">
            <div class="item-in">
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="seperator"></div>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>">Read More <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
        <?php
    }
    // Display Simple Pagination
    echo '<div class="pagination">';
    echo paginate_links(array(
        'total' => $query->max_num_pages // Total number of pages
    ));
    echo '</div>';

    wp_reset_postdata(); // Restore original post data
} else {
    // If no posts are found
    echo 'No posts found';
}
?>





  </div>
</div>
<!-- End --> 


<!-- Footer -->
<?php get_footer(); ?>
<!-- End -->
