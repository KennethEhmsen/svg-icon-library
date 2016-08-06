<?php
/*
Plugin Name: SVG Icon Library
Plugin URI:  http://webseitler.com/wordpress-plugins/svg-icon-library/
Description: Font icons are SO last year! All the cool cats are using SVGs now. This plugin makes it easy to build a library of SVGs in WordPress and uses the WP REST API (v2) to insert them on your site.
Version:     0.1
Author:      Travis Seitler
Author URI:  http://webseitler.com/wordpress-plugins/svg-icon-library/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages/
Text Domain: svgiconlib
*/

/**
 * @package    SVG Icon Library
 * @version    0.1
 * @author     Travis Seitler <travis@webseitler.com>
 * @copyright  Copyright (c) 2016, Travis Seitler
 * @link       http://webseitler.com/wordpress-plugins/svg-icon-library/
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 */

add_action( 'plugins_loaded', 'svgiconlib_load_textdomain' );
/**
 * Load any translations for the plugin's textdomain
 *
 * @since 0.1
 */
function svgiconlib_load_textdomain() {

  load_plugin_textdomain( 'svgiconlib',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages'
	);

}

add_action( 'init', 'svgiconlib_setup_post_type' );
/**
 * Registers the SVG Icon post type
 *
 * @since 0.1
 */
function svgiconlib_setup_post_type() {

	// Register our "svgicon" custom post type
	register_post_type( 'svgicon',
		array(
			'labels'      => array(
				'name'          => __( 'SVG Icons' ),
				'singular_name' => __( 'SVG Icon' )
			),
			'public'      => true,
			'has_archive' => false,
			'rewrite'     => array( 'slug' => 'svgicon' ),
		)
	);

}


/**
 * TODO:
*/


/* ***************************** *
 * 1. Activation / Deactivation
 * ***************************** */


register_activation_hook( __FILE__, 'svgiconlib_activate' );
/**
 * Registers the SVG Icon post type
 *
 * @since 0.1
 */
function svgiconlib_activate() {

  // Trigger our function that registers the custom post type
  svgiconlib_setup_post_type();

  // Clear the permalinks after the post type has been registered
  flush_rewrite_rules();

}


register_deactivation_hook( __FILE__, 'svgiconlib_deactivate' );
/**
 * Removes all traces of the SVG Icon post type when plugin is deactivated.
 *
 * @since 0.1
 */
function svgiconlib_deactivate() {

	// Clear the permalinks to remove our post type's rules
  flush_rewrite_rules();

}
