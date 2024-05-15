<?php

namespace wdsct;

class SettingsTab {
	public string $tab_name = 'wdsct_tab';

	public function __construct() {
		$this->setup_settings();
	}

	public function setup_settings() {
		// Add the tab to WooCommerce settings
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
		$settings_tabs[ $this->tab_name ] = 'Dynamic Discount';
		return $settings_tabs;
	}

	private function settings(): array {
		$settings = array(
			array(
				'name' => __( 'Dynamic Discount', 'wdsct' ),
				'type' => 'title',
			),
			array(
				'id'   => 'wdsct-enable-toggle',
				'name' => 'Enable dynamic discounts',
				'type' => 'checkbox',
			),
			array(
				'type' => 'sectionend',
			),
			array(
				'name' => __( 'Level 1', 'wdsct' ),
				'type' => 'title',
			),
			array(
				'id'   => 'product_1st_count',
				'name' => 'If product count in cart > than',
				'type' => 'number',
			),
			array(
				'id'   => 'product_1st_amount',
				'name' => 'Apply Discount (%)',
				'type' => 'number',
			),
			array(
				'type' => 'sectionend',
			),
			array(
				'name' => __( 'Level 2', 'wdsct' ),
				'type' => 'title',
			),
			array(
				'id'   => 'product_2nd_count',
				'name' => 'If product count in cart > than',
				'type' => 'number',
			),
			array(
				'id'   => 'product_2nd_amount',
				'name' => 'Apply Discount (%)',
				'type' => 'number',
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