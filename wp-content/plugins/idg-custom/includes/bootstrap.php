<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/health.php';

add_action( 'plugins_loaded', 'idg_custom_init' );

function idg_custom_init() {
	idg_custom_register_acf_json_paths();
	add_action( 'acf/init', 'idg_custom_register_acf_field_groups' );
}

function idg_custom_register_acf_field_groups() {
	$field_groups_file = IDG_CUSTOM_PATH . 'acf-field-groups.php';

	if ( file_exists( $field_groups_file ) ) {
		require_once $field_groups_file;
	}
}

function idg_custom_register_acf_json_paths() {
	if ( ! function_exists( 'acf_update_setting' ) ) {
		return;
	}

	$load_json = array( IDG_CUSTOM_ACF_JSON_PATH );
	if ( function_exists( 'acf_get_setting' ) ) {
		$current_load_json = acf_get_setting( 'load_json' );
		if ( is_array( $current_load_json ) ) {
			$load_json = array_merge( $current_load_json, $load_json );
		}
	}

	acf_update_setting( 'load_json', array_values( array_unique( $load_json ) ) );

	if ( is_dir( IDG_CUSTOM_ACF_JSON_PATH ) && is_writable( IDG_CUSTOM_ACF_JSON_PATH ) ) {
		acf_update_setting( 'save_json', IDG_CUSTOM_ACF_JSON_PATH );
	}
}
