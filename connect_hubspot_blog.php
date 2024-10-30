<?php
/*
Plugin Name: Connect Hubspot Blog
Plugin URI: https://wordpress.org/plugins/connect-hubspot-blog
Description: Connect hubspot blog WordPress blogs connector is a powerful plugin that allow to include directly your HubSpot blog and much more in pages, articles, and wherever you want.
Version: 1.0.3
Author: Rohit kumar
Author URI: https://profiles.wordpress.org/rohitcse05/
*/
add_action( 'plugins_loaded', 'chb_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.2
 */
function chb_load_textdomain() {
  load_plugin_textdomain( 'chbTd'); 
}
/**
 * Load all plugin functions.
 *
 * 
 */
add_action('init','plugin_chb_loaded');
function plugin_chb_loaded(){

	//=============================================
	// Include Needed Files
	//=============================================
	require_once( dirname( __FILE__ ) . '/function.php' );
    require_once( dirname( __FILE__ ) . '/assets/classes/main-class.php' );
}
/**
 * Plugin activation hook.
 *
 * 
 */
register_activation_hook(__FILE__,'chb_connect_activation');
function chb_connect_activation(){

	/* Do my stuff here */
}
/**
 * Plugin deactivation hook.
 *
 * 
 */
register_deactivation_hook(__FILE__,'chb_connect_deactivation');
function chb_connect_deactivation(){

	require_once( dirname( __FILE__ ) . '/uninstall.php' );

	/* Do my stuff here */

}
