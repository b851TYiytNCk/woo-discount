<?php
/**
 * Plugin Name: WooCommerce Dynamic Discount
 * Plugin URI: https://github.com/b851TYiytNCk/woo-discount
 * Description: Automatic dynamic discount extension for WooCommerce
 * Version: 1.0.0
 * Requires PHP: 7.4
 * Author: Vladyslav Nahornyi
 * Author URI: https://github.com/b851TYiytNCk
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wdsct
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PLUGIN_DIR', __DIR__ );
$handler = PLUGIN_DIR  . '/handlers/manager.php';

if ( file_exists($handler) ) {
	include_once $handler;
	register_activation_hook( __FILE__, 'wdsct_activate' );
	register_deactivation_hook( __FILE__, 'wdsct_deactivate' );
} else {
	throw new \RuntimeException('Plugin files are missing, try reinstalling the plugin' );
}