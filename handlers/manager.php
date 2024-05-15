<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ACTIVATION */

function wdsct_activate() {
	if ( ! defined( 'PLUGIN_DIR' ) ) {
		error_log( 'Plugin directory is not set' );
		exit;
	}
}

/* DEACTIVATION */
function wdsct_deactivate() {

}


add_action( 'init', 'wdsct_init' );
function wdsct_init() {
	spl_autoload_register( function ( $class ) {
		$className  = str_replace( '\\', DIRECTORY_SEPARATOR, $class );
		$class_file = PLUGIN_DIR . '/includes/' . $className . '.php';

		if ( file_exists( $class_file ) ) {
			require_once $class_file;
		}
	} );

	new \wdsct\Initializer();
}