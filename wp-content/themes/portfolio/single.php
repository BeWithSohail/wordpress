<?php 
get_header();
the_post();
?>  

<div class="main">
<h2><?php the_title(); ?></h2>
<?php
// Check if the post has a featured image
if (has_post_thumbnail()) {
    // Get the post thumbnail URL with a specific size
    $thumbnail_url = get_the_post_thumbnail_url(null, 'thumbnail'); // Change 'thumbnail' to desired image size (e.g., 'medium', 'large', 'full')

    // Output the image
    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . '">';
} else {
    // If no featured image is set
    echo 'No featured image available';
}
?>
<p>
<?php the_content(); ?> 
</p>
<p> 
    the Author
    <?php the_author(); ?>
</p>

<?php comment_form(); ?>
<?php comments_template(); ?>

</div>

<?php get_footer(); ?>