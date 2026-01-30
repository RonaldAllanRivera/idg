<?php
/**
 * Plugin Name: IDG Custom
 * Description: Custom functionality for the IDG WordPress skills test (CPT/ACF/Woo customizations).
 * Version: 0.1.0
 * Author: Ronald Allan Rivera
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'IDG_CUSTOM_VERSION', '0.1.0' );
define( 'IDG_CUSTOM_PATH', plugin_dir_path( __FILE__ ) );
define( 'IDG_CUSTOM_URL', plugin_dir_url( __FILE__ ) );

define( 'IDG_CUSTOM_ACF_JSON_PATH', IDG_CUSTOM_PATH . 'acf-json' );

require_once IDG_CUSTOM_PATH . 'includes/bootstrap.php';
