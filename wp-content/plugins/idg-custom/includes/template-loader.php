<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'template_include', 'idg_custom_template_include', 20 );

function idg_custom_template_include( $template ) {
	if ( is_singular( 'case_study' ) ) {
		$plugin_template = IDG_CUSTOM_PATH . 'templates/single-case_study.php';
		if ( file_exists( $plugin_template ) ) {
			return $plugin_template;
		}
	}

	if ( is_post_type_archive( 'case_study' ) ) {
		$plugin_template = IDG_CUSTOM_PATH . 'templates/archive-case_study.php';
		if ( file_exists( $plugin_template ) ) {
			return $plugin_template;
		}
	}

	return $template;
}
