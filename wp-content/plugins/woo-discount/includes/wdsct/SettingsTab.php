<?php

namespace wdsct;

class SettingsTab {
	public $tab_name = 'wdsct_tab';

	public function __construct() {
		// Add a custom tab to the WooCommerce settings
		add_filter(
			'woocommerce_settings_tabs_array',
			array( $this, 'wdsct_woo_settings_tab' ),
			50
		);
		// Display the content of the custom tab
		add_action(
			"woocommerce_settings_tabs_$this->tab_name",
			array( $this, 'wdsct_output_settings_content' )
		);
		// Save custom settings
		add_action(
			"woocommerce_update_options_$this->tab_name",
			array( $this, 'wdsct_save_settings' )
		);
	}

	public function wdsct_woo_settings_tab( $settings_tabs ) {
		$settings_tabs['wdsct_tab'] = 'Dynamic Discount';
		return $settings_tabs;
	}

	private function settings() {

		$settings = array(
			array(
				'name' => __( 'Dynamic Discount', 'wdsct'),
				'type' => 'title',
			),
			array(
				'id'       => 'wdsct-enable-toggle',
				'name'     => 'Enable dynamic discounts',
				'type'     => 'checkbox',
			),
			array(
				'type' => 'sectionend',
			)
		);
		return $settings;

	}

	public function wdsct_output_settings_content(): void {
		\WC_Admin_Settings::output_fields( $this->settings() );
	}

	public function wdsct_save_settings(): void {
		\WC_Admin_Settings::save_fields( $this->settings() );
	}
}