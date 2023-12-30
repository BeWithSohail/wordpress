<?php 
function register_my_menu() {
    register_nav_menu('primary-menu', __( 'Primary Menu' ));
}
add_action('after_setup_theme', 'register_my_menu');

add_theme_support('post-thumbnails');
add_theme_support('custom-header');
add_theme_support('custom-background');
register_sidebar( array(
    'name'          => __( 'Sidebar Location', 'custom-theme' ), // Sidebar name
    'id'            => 'main-sidebar' // Sidebar ID, used in the template
));

function enable_excerpts_for_pages() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'enable_excerpts_for_pages');
?>
