<?php 
get_header();
the_post(); 
?>

    <?php echo get_the_content(); ?>

    <?php
// Check if a featured image is set for the post
if (has_post_thumbnail()) {
    // Get the featured image URL
    $thumbnail_url = get_the_post_thumbnail_url(null, 'large'); // Change 'large' to your preferred image size

    // Display the featured image with an <img> tag
    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . '">'; // Displaying the image with alt text as the post title
}
?>

<?php 
get_footer();
?>