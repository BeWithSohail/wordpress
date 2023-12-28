<?php 
function register_my_menu() {
    register_nav_menu('primary-menu', __( 'Primary Menu' ));
}
add_action('after_setup_theme', 'register_my_menu');

add_theme_support('post-thumbnails');
add_theme_support('custom-header');

?>
