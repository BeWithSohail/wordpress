<?php
	// if uninstall.php is not called by WordPress, die
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	    die;
	}

	$option_name = 'splcpn_options';

	delete_option( $option_name );

	// for site options in Multisite
	delete_site_option( $option_name );

?>
