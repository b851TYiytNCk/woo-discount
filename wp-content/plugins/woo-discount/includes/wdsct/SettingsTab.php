<?php

namespace wdsct;

class SettingsTab {
	public function __construct() {
		// Add a custom tab to the WooCommerce settings
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'wdsct_woo_settings_tab' ), 50 );
		// Display the content of the custom tab
		add_action( 'woocommerce_settings_tabs_wdsct_tab', array( $this, 'wdsct_woo_settings_content' ) );
		// Save custom settings
		add_action( 'woocommerce_update_options_wdsct_tab', array( $this, 'save_wdsct_woocommerce_settings' ) );
	}

	public function wdsct_woo_settings_tab( $settings_tabs ) {
		$settings_tabs['wdsct_tab'] = 'Dynamic Discount';
		return $settings_tabs;
	}

	public function wdsct_woo_settings_content(): void {
		// Start Tab content
		include_once( PLUGIN_DIR . '/templates/settings/table.php' );
	}

	public function save_wdsct_woocommerce_settings(): void {
		// Save settings
	}



}