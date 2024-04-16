<?php

namespace wdsct;

class Initializer {
	public function __construct () {
		// Activate classes
		if ( is_admin() && current_user_can( 'administrator' ) ) {
			new SettingsTab();
		}
	}
}