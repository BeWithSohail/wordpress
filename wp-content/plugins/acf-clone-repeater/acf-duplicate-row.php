<?php
/*
Plugin Name: ACF Clone Repeater
Plugin URI: https://github.com/sumanengbd/acf-clone-repeater
Description: This Plugin is Duplicate Repeater and Layout Fields in ACF Pro
Author: Suman Ali
Version: 1.0.4
Author URI: https://github.com/sumanengbd/acf-clone-repeater
License: GPL3
Text Domain: acf-clone-repeater
*/
// Make sure we don't expose any info if called directly

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if ( !class_exists('acf_field_section_styles') ) :

    function acf_clone_repeater_admin_head() 
    {
        ?>  
        <style type="text/css">
            .acf-repeater .acf-row:hover > .acf-row-handle .acf-icon.show-on-shift, 
            .acf-repeater .acf-row.-hover > .acf-row-handle .acf-icon.show-on-shift {
                top: auto;
                z-index: 1;
                bottom: -12px;
                display: block !important;
            }
        </style>
        <?php
    }
    add_action('acf/input/admin_head', 'acf_clone_repeater_admin_head');

endif;
