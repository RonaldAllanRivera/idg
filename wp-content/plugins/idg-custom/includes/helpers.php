<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function idg_custom_is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

function idg_custom_is_acf_active() {
	return function_exists( 'acf' ) || function_exists( 'get_field' );
}
