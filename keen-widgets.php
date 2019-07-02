<?php
/**
 * Plugin Name: Keen Widgets
 * Plugin URI: 
 * Description: Keen Widgets
 * Version: 1.0.0
 * Author: Mahedi Hasan
 * Author URI: 
 * Text Domain: keen-widgets
 *
 * @package Keen Widgets
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Set constants.
 */
define( 'KEEN_WIDGETS_FILE', __FILE__ );
define( 'KEEN_WIDGETS_BASE', plugin_basename( KEEN_WIDGETS_FILE ) );
define( 'KEEN_WIDGETS_DIR', plugin_dir_path( KEEN_WIDGETS_FILE ) );
define( 'KEEN_WIDGETS_URI', plugins_url( '/', KEEN_WIDGETS_FILE ) );
define( 'KEEN_WIDGETS_VER', '1.0.0' );
define( 'KEEN_WIDGETS_TEMPLATE_DEBUG_MODE', false );

require_once KEEN_WIDGETS_DIR . 'classes/class-keen-widgets.php';
