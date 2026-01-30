<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_notices', 'idg_custom_admin_notices' );

function idg_custom_admin_notices() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$messages = array();

	if ( ! idg_custom_is_acf_active() ) {
		$messages[] = 'ACF is not active. ACF-related features will not run.';
	}

	if ( ! idg_custom_is_woocommerce_active() ) {
		$messages[] = 'WooCommerce is not active. WooCommerce-related features will not run.';
	}

	if ( empty( $messages ) ) {
		return;
	}

	echo '<div class="notice notice-warning"><p>' . esc_html( implode( ' ', $messages ) ) . '</p></div>';
}
