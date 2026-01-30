<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/health.php';

add_action( 'plugins_loaded', 'idg_custom_init' );

function idg_custom_init() {
	idg_custom_register_acf_json_paths();
}

function idg_custom_register_acf_json_paths() {
	if ( ! function_exists( 'acf_update_setting' ) ) {
		return;
	}

	acf_update_setting( 'save_json', IDG_CUSTOM_ACF_JSON_PATH );
	acf_update_setting( 'load_json', array( IDG_CUSTOM_ACF_JSON_PATH ) );
}
