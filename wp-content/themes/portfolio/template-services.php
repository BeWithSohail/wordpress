
<?php
/**
 * Template Name: services
 */
?>

<?php get_header(); ?>

<?php
// Get the current page's excerpt
$page_excerpt = get_the_excerpt();

// Check if the excerpt exists and display it
if (!empty($page_excerpt)) {
    echo '<div class="page-excerpt">' . $page_excerpt . '</div>';
}
?>

<?php get_footer(); ?>