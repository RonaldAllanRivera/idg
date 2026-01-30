<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'plugins_loaded', 'idg_custom_woocommerce_init' );

function idg_custom_woocommerce_init() {
	if ( ! function_exists( 'idg_custom_is_woocommerce_active' ) || ! idg_custom_is_woocommerce_active() ) {
		return;
	}

	add_action( 'woocommerce_before_shop_loop_item_title', 'idg_custom_output_product_badge', 8 );
	add_action( 'woocommerce_before_single_product_summary', 'idg_custom_output_product_badge', 8 );
	add_action( 'woocommerce_single_product_summary', 'idg_custom_output_product_badge', 4 );

	add_action( 'woocommerce_single_product_summary', 'idg_custom_output_product_custom_field', 25 );
}

function idg_custom_get_product_badge_text( $product_id ) {
	$badge_text = '';

	if ( function_exists( 'get_field' ) ) {
		$badge_text = (string) get_field( 'product_badge_text', $product_id );
		$badge_text = trim( $badge_text );
	}

	if ( $badge_text !== '' ) {
		return $badge_text;
	}

	if ( has_term( 'best-seller', 'product_tag', $product_id ) ) {
		return 'Best Seller';
	}

	if ( function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $product_id );
		if ( $product && method_exists( $product, 'is_featured' ) && $product->is_featured() ) {
			return 'Featured';
		}
	}

	return '';
}

function idg_custom_output_product_badge() {
	static $did_print = false;
	if ( $did_print ) {
		return;
	}

	if ( ! function_exists( 'wc_get_product' ) ) {
		return;
	}

	global $product;
	$product_id = 0;
	if ( $product && is_object( $product ) && method_exists( $product, 'get_id' ) ) {
		$product_id = (int) $product->get_id();
	} elseif ( is_singular( 'product' ) ) {
		$product_id = (int) get_the_ID();
	}

	if ( $product_id <= 0 ) {
		return;
	}

	$badge_text = idg_custom_get_product_badge_text( $product_id );

	if ( $badge_text === '' ) {
		return;
	}

	$did_print = true;

	echo '<div class="idg-product-badge-wrap"><h3 class="idg-product-badge">' . esc_html( $badge_text ) . '</h3></div>';
}

function idg_custom_output_product_custom_field() {
	if ( ! function_exists( 'wc_get_product' ) ) {
		return;
	}

	global $product;
	if ( ! $product || ! is_object( $product ) || ! method_exists( $product, 'get_id' ) ) {
		return;
	}

	$product_id = (int) $product->get_id();

	$value = '';
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( 'product_highlight', $product_id );
	} else {
		$value = get_post_meta( $product_id, 'product_highlight', true );
	}

	if ( ! $value ) {
		return;
	}

	$value = is_string( $value ) ? trim( $value ) : $value;
	if ( $value === '' ) {
		return;
	}

	$value = wp_strip_all_tags( (string) $value );
	$value = trim( $value );
	if ( $value === '' ) {
		return;
	}

	echo '<div class="idg-product-highlight"><strong>' . esc_html( $value ) . '</strong></div>';
}
