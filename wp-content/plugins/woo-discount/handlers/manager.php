<?php
/* ACTIVATION */
function wdsct_activate() {
	if ( ! defined( 'PLUGIN_DIR' ) ) {
		exit;
	}
}

/* DEACTIVATION */
function wdsct_deactivate() {

}

/* LOAD FUNCTIONALITY */
add_action( 'init', function () {
	spl_autoload_register( function ( $class ) {
		$className  = str_replace( '\\', DIRECTORY_SEPARATOR, $class );
		$class_file = PLUGIN_DIR . '/includes/' . $className . '.php';

		if ( file_exists( $class_file ) ) {
			require_once $class_file;
		}
	} );

	new \wdsct\Initializer();
} );