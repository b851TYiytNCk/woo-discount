<?php

namespace wdsct;

class Initializer {
	public function __construct () {
		// Add Discount Tab
		new SettingsTab();
		new CartDiscount();
	}

	public function __clone() {
		// Override this PHP function to prevent unwanted copies of your instance.
		//   Implement your own error or use `wc_doing_it_wrong()`
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
		// Override this PHP function to prevent unwanted copies of your instance.
		//   Implement your own error or use `wc_doing_it_wrong()`
	}
}