<?php

namespace wdsct;

class CartDiscount {
	public mixed $first_count;
	public mixed $first_amount;
	public mixed $sec_count;
	public mixed $sec_amount;
	public mixed $item_count;
	public mixed $discount_percentage;

	public function __construct() {
		// Check if Dynamic Discount should be applied
		$discount_on = get_option( 'wdsct-enable-toggle' ) === 'yes';

		if ( ! $discount_on ) {
			return;
		}

		// Check options set in Dynamic Discount tab
		$this->first_count  = get_option( 'product_1st_count' );
		$this->first_amount = get_option( 'product_1st_amount' );
		$this->sec_count    = get_option( 'product_2nd_count' );
		$this->sec_amount   = get_option( 'product_2nd_amount' );

		add_action( 'woocommerce_cart_calculate_fees', array( $this, 'apply_cart_dynamic_discount' ) );
	}

	public function apply_cart_dynamic_discount(): void {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}

		// Retrieve Cart contents
		$cart              = WC()->cart;
		$this->items_count = $cart->get_cart_contents_count();

		// Determine discount percentage
		$this->set_discount_percentage();

		// Apply discount
		if ( ! empty( $this->discount_percentage ) ) {
			$cart_total      = $cart->get_cart_contents_total();
			$discount_amount = ( $cart_total * $this->discount_percentage ) / 100;
			$cart->add_fee( __( "$this->discount_percentage% Discount", 'wdsct' ), - $discount_amount, false, '' );
		}
	}

	public function set_discount_percentage() {
		// Check for First Discount Level
		if ( $this->first_count && $this->items_count >= $this->first_count
		     && is_numeric( $this->first_amount ) ) {
			$this->discount_percentage = $this->first_amount;
		}
		// Check for Second Discount Level
		if ( $this->sec_count && $this->items_count >= $this->sec_count
		     && is_numeric( $this->sec_amount ) ) {
			$this->discount_percentage = $this->sec_amount;
		}
	}
}