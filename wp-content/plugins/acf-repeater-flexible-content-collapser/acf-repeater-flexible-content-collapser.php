<?php
/*
Plugin Name: ACF Repeater & Flexible Content Collapser
Plugin URI:  https://wordpress.org/plugins/acf-repeater-flexible-content-collapser/
Description: Collapse and expand ACF Repeater and Flexible Content fields all at once to get a better overview and enable easier sorting.
Version: 1.2.8
Author: Thomas Meyer
Author URI: https://dreihochzwo.de
Text Domain: acf-collapse-fields
Domain Path: /languages
License: GPLv2 or later.
Copyright: Thomas Meyer
*/

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if( !class_exists('DHZ_ACF_COLLAPSE_FIELDS') ) :

class DHZ_ACF_COLLAPSE_FIELDS {

	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	public $settings;

	function __construct() {

		// vars
		$this->settings = array(
			'plugin'				=> 'ACF Repeater & Flexible Content Collapser',
			'this_acf_version'		=> 0,
			'min_acf_pro_version'	=> '5.5.0',
			'min_acf_free_version'	=> '5.7.0',
			'version'				=> '1.2.8',
			'url'					=> plugin_dir_url( __FILE__ ),
			'path'					=> plugin_dir_path( __FILE__ ),
			'plugin_path'			=> 'https://wordpress.org/plugins/acf-repeater-flexible-content-collapser/'
		);

		// set text domain
		load_plugin_textdomain( 'acf-collapse-fields', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );

		// check for ACF and min version
		add_action( 'admin_init', array($this, 'acf_or_die'), 11);

		// add additional settings to Repeater and Flexible Content fields
		add_action( 'admin_init', array($this, 'acf_render_field_settings'), 11 );

		// enqueue scripts and styles
		add_action( 'acf/input/admin_enqueue_scripts', array($this, 'acf_repeater_flexible_content_collapser_enqueue'), 11 );

	}

	/**
	 * Let's make sure ACF Pro is installed & activated
	 * If not, we give notice and kill the activation of ACF RGBA Color Picker.
	 * Also works if ACF Pro is deactivated.
	 */
	function acf_or_die() {

		if ( !class_exists('acf') ) {
			$this->kill_plugin();
		} else if ( !acf_get_setting('pro') == 1 && ( !class_exists('acf_plugin_repeater') && !class_exists('acf_plugin_flexible_content') ) ) {
			$this->kill_plugin();
		} else {
			$this->settings['this_acf_version'] = acf()->settings['version'];
			if ( version_compare( $this->settings['this_acf_version'], $this->settings['min_acf_pro_version'], '<' ) ) {
				$this->kill_plugin();
			}
		}
	}

	function kill_plugin() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		add_action( 'admin_notices', array($this, 'acf_dependent_plugin_notice') );
	}

	function acf_dependent_plugin_notice() {
		echo '<div class="error"><p>' . sprintf( __('%1$s requires ACF PRO v%2$s or higher or ACF v%3$s or higher with either the Repeater or Flexible Content plugin to be installed and activated.', 'acf-collapse-fields'), $this->settings['plugin'], $this->settings['min_acf_pro_version'], $this->settings['min_acf_free_version']) . '</p></div>';
	}

	/*
	*  Add actions to add additional settings to Repeater and Flexible Content fields
	*/
	function acf_render_field_settings() {

		if ( class_exists('acf') ) {

			if ( version_compare( $this->settings['this_acf_version'], $this->settings['min_acf_pro_version'], '>=' ) ) {
				add_action('acf/render_field_settings/type=repeater', array($this, '_dhz_repeater_render_field_settings') );
				add_filter('acf/prepare_field/type=repeater', array($this, '_dhz_collapse_all_repeater_fields') );
				add_action('acf/render_field_settings/type=flexible_content', array($this, '_dhz_flexible_render_field_settings') );
				add_filter('acf/prepare_field/type=flexible_content', array($this, '_dhz_collapse_all_flexible_fields') );
			}

		}

	}

	/*
	*  Load the javascript and CSS files on the ACF admin pages
	*/
	function acf_repeater_flexible_content_collapser_enqueue() {

		if ( class_exists('acf') ) {

			if ( version_compare( $this->settings['this_acf_version'], $this->settings['min_acf_pro_version'], '>=' ) ) {

				$url = $this->settings['url'];
				$version = $this->settings['version'];

				wp_register_script(
					"acf-repeater-flexible-content-collapser-js",
					"{$url}assets/js/acf-repeater-flexible-content-collapser.js",
					array( 'jquery' ),
					$version
				);

				// Localize the script with new data
				$translation_array = array(
					'expandAll'			=> __( 'Expand All Elements', 'acf-collapse-fields' ),
					'collapseAll'		=> __( 'Collapse All Elements', 'acf-collapse-fields' )
				);
				wp_localize_script( 'acf-repeater-flexible-content-collapser-js', 'collapsetranslation', $translation_array );

				wp_enqueue_script('acf-repeater-flexible-content-collapser-js');

				wp_enqueue_style(
					"acf-collapse-fields_admin-css",
					"{$url}assets/css/acf-repeater-flexible-content-collapser.css",
					false,
					$version
				);
			}

		}

	}

	/*
	*  Add a setting to the repeater fields
	*/
	function _dhz_repeater_render_field_settings( $field ) {
		acf_render_field_setting( $field, array(
			'label'			=> __("Hide collapse button", "acf-collapse-fields"),
			'instructions'	=> __("Don't show the collapse button for this group", "acf-collapse-fields"),
			'name'			=> 'hide_collapse',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'class'			=> 'hide-collapse',
		));
		acf_render_field_setting( $field, array(
			'label'			=> __("Collapse all on load", "acf-collapse-fields"),
			'instructions'	=> __("Collapse all fields of this repeater field on page load", "acf-collapse-fields"),
			'name'			=> 'collapse_all_repeater',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'class'			=> 'collapse-all',
		));
		acf_render_field_setting( $field, array(
			'label'			=> __("Button only with icon?", "acf-collapse-fields"),
			'instructions'	=> __("Hides the text on the collapse/expand buttons", "acf-collapse-fields"),
			'name'			=> 'btn-icon-only',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'class'			=> 'btn-icon-only',
		));
	}

	/*
	*  Check if all repeater fields should be collapsed and add a class if true
	*/
	function _dhz_collapse_all_repeater_fields( $field ) {

		if ( array_key_exists('hide_collapse', $field) ) {

			if ( $field['hide_collapse'] == 1 ) return $field;

		}

		$field['wrapper']['class'] = "repeater-collapse";

		if ( array_key_exists('collapse_all_repeater', $field) && array_key_exists('btn-icon-only', $field) ) {

			// bail early if no 'admin_only' setting
			if( empty($field['collapse_all_repeater']) && empty($field['btn-icon-only'])) return $field;

			if ( $field['collapse_all_repeater'] == 1 && $field['btn-icon-only'] == 1 ) {
				$field['wrapper']['class'] = "repeater-collapse collapse-all btn-icon-only";
			} else if ( $field['collapse_all_repeater'] == 1 ) {
				$field['wrapper']['class'] = "repeater-collapse collapse-all";
			} else if ( $field['btn-icon-only'] == 1 ) {
				$field['wrapper']['class'] = "repeater-collapse btn-icon-only";
			}

		}

		return $field;
	}

	/*
	*  Add a setting to the flexible content fields
	*/
	function _dhz_flexible_render_field_settings( $field ) {
		acf_render_field_setting( $field, array(
			'label'			=> __("Hide collapse button", "acf-collapse-fields"),
			'instructions'	=> __("Don't show the collapse button for this group", "acf-collapse-fields"),
			'name'			=> 'hide_collapse',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'class'			=> 'hide-collapse',
		));
		acf_render_field_setting( $field, array(
			'label'			=> __("Collapse all on load", "acf-collapse-fields"),
			'instructions'	=> __("Collapse all fields of this flexible content field on page load", "acf-collapse-fields"),
			'name'			=> 'collapse_all_flexible',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'class'			=> 'collapse-all',
		));
		acf_render_field_setting( $field, array(
			'label'			=> __("Button only with icon?", "acf-collapse-fields"),
			'instructions'	=> __("Hides the text on the collapse/expand buttons", "acf-collapse-fields"),
			'name'			=> 'btn-icon-only',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'class'			=> 'btn-icon-only',
		));
	}

	/*
	*  Check if all flexible content fields should be collapsed and add a class if true
	*/
	function _dhz_collapse_all_flexible_fields( $field ) {

		if ( array_key_exists('hide_collapse', $field) ) {

			if ( $field['hide_collapse'] == 1 ) return $field;

		}

		$field['wrapper']['class'] = "flexible-collapse";

		if ( array_key_exists('collapse_all_flexible', $field) && array_key_exists('btn-icon-only', $field) ) {

			// bail early if no 'collapse_all_flexible' and 'btn-icon-only' setting
			if( empty($field['collapse_all_flexible']) && empty($field['btn-icon-only'])) return $field;

			if ( $field['hide_collapse'] == 1 ) return $field;

			if ( $field['collapse_all_flexible'] == 1 && $field['btn-icon-only'] == 1 ) {
				$field['wrapper']['class'] = "flexible-collapse collapse-all btn-icon-only";
			} else if ( $field['collapse_all_flexible'] == 1 ) {
				$field['wrapper']['class'] = "flexible-collapse collapse-all";
			} else if ( $field['btn-icon-only'] == 1 ) {
				$field['wrapper']['class'] = "flexible-collapse btn-icon-only";
			}
		}

		return $field;
	}
}
// initialize
new DHZ_ACF_COLLAPSE_FIELDS();

// class_exists check
endif;

?>
