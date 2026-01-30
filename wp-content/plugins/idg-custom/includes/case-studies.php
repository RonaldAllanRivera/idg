<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'idg_custom_register_case_studies_cpt' );

function idg_custom_register_case_studies_cpt() {
	$labels = array(
		'name'               => 'Case Studies',
		'singular_name'      => 'Case Study',
		'menu_name'          => 'Case Studies',
		'name_admin_bar'     => 'Case Study',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Case Study',
		'new_item'           => 'New Case Study',
		'edit_item'          => 'Edit Case Study',
		'view_item'          => 'View Case Study',
		'all_items'          => 'All Case Studies',
		'search_items'       => 'Search Case Studies',
		'not_found'          => 'No case studies found.',
		'not_found_in_trash' => 'No case studies found in Trash.',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'case-studies', 'with_front' => false ),
		'show_in_nav_menus'  => true,
		'publicly_queryable' => true,
		'exclude_from_search'=> false,
	);

	register_post_type( 'case_study', $args );
}

add_shortcode( 'idg_case_studies', 'idg_custom_case_studies_shortcode' );

add_action( 'wp_enqueue_scripts', 'idg_custom_case_studies_enqueue_styles' );

function idg_custom_case_studies_enqueue_styles() {
	wp_register_style( 'idg-custom-inline', false );
	wp_enqueue_style( 'idg-custom-inline' );

	$css = '.idg-case-studies-pagination .idg-pagination{display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin:16px 0;padding:0}.idg-case-studies-pagination .idg-pagination-item{display:inline-flex}.idg-case-studies-pagination .idg-pagination-item .page-numbers{display:inline-flex;align-items:center;justify-content:center;line-height:1;padding:6px 10px}';
	wp_add_inline_style( 'idg-custom-inline', $css );
}

function idg_custom_case_studies_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts_per_page' => 6,
		),
		$atts,
		'idg_case_studies'
	);

	$paged = 1;

	$qs_page = filter_input( INPUT_GET, 'idg_cs_page', FILTER_SANITIZE_NUMBER_INT );
	if ( $qs_page ) {
		$paged = (int) $qs_page;
	} else {
		$paged_qv = get_query_var( 'paged' );
		if ( $paged_qv ) {
			$paged = (int) $paged_qv;
		}
	}
	if ( $paged < 1 ) {
		$paged = 1;
	}

	$query = new WP_Query(
		array(
			'post_type'      => 'case_study',
			'post_status'    => 'publish',
			'posts_per_page' => (int) $atts['posts_per_page'],
			'paged'          => $paged,
		)
	);

	ob_start();

	if ( $query->have_posts() ) {
		echo '<div class="idg-case-studies">';
		while ( $query->have_posts() ) {
			$query->the_post();

			$client_name  = function_exists( 'get_field' ) ? get_field( 'client_name' ) : null;
			$industry     = function_exists( 'get_field' ) ? get_field( 'industry' ) : null;
			$featured_num = function_exists( 'get_field' ) ? get_field( 'featured_result' ) : null;
			$featured_suf = function_exists( 'get_field' ) ? get_field( 'featured_result_suffix' ) : null;

			$featured_text = '';
			if ( $featured_num !== null && $featured_num !== '' ) {
				$featured_text = (string) $featured_num;
				if ( $featured_suf !== null && $featured_suf !== '' ) {
					$featured_suf_str = is_string( $featured_suf ) ? trim( $featured_suf ) : (string) $featured_suf;
					$needs_space = true;
					if ( is_string( $featured_suf_str ) && $featured_suf_str !== '' ) {
						$needs_space = ( substr( $featured_suf_str, 0, 1 ) !== '%' );
					}
					$featured_text .= ( $needs_space ? ' ' : '' ) . $featured_suf_str;
				}
			}
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'idg-case-study-card' ); ?>>
				<h2 class="idg-case-study-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h2>

				<?php if ( $client_name ) : ?>
					<p><strong>Client:</strong> <?php echo esc_html( $client_name ); ?></p>
				<?php endif; ?>

				<?php if ( $industry ) : ?>
					<p><strong>Industry:</strong> <?php echo esc_html( is_array( $industry ) ? implode( ', ', $industry ) : $industry ); ?></p>
				<?php endif; ?>

				<?php if ( $featured_text ) : ?>
					<p><strong>Result:</strong> <?php echo esc_html( $featured_text ); ?></p>
				<?php endif; ?>

				<div class="idg-case-study-excerpt">
					<?php echo wp_kses_post( wpautop( get_the_excerpt() ) ); ?>
				</div>
			</article>
			<?php
		}
		echo '</div>';

		$pagination_links = paginate_links(
			array(
				'base'    => esc_url_raw( add_query_arg( 'idg_cs_page', '%#%' ) ),
				'total'   => (int) $query->max_num_pages,
				'current' => $paged,
				'type'    => 'array',
			)
		);

		if ( $pagination_links && is_array( $pagination_links ) ) {
			echo '<nav class="idg-case-studies-pagination" aria-label="Case studies pagination"><div class="idg-pagination">';
			foreach ( $pagination_links as $link_html ) {
				echo '<span class="idg-pagination-item">' . wp_kses_post( $link_html ) . '</span>';
			}
			echo '</div></nav>';
		}
	} else {
		echo '<p>No case studies found.</p>';
	}

	wp_reset_postdata();

	return ob_get_clean();
}

add_action( 'admin_menu', 'idg_custom_case_studies_admin_menu' );

function idg_custom_case_studies_admin_menu() {
	add_submenu_page(
		'edit.php?post_type=case_study',
		'Case Studies Listing Shortcode',
		'Listing Shortcode',
		'edit_posts',
		'idg-case-studies-shortcode',
		'idg_custom_case_studies_shortcode_admin_page'
	);
}

function idg_custom_case_studies_shortcode_admin_page() {
	?>
	<div class="wrap">
		<h1><?php echo esc_html( 'Case Studies Listing Shortcode' ); ?></h1>
		<p><?php echo esc_html( 'Use this shortcode to create a Case Studies listing page that uses a WP_Query loop.' ); ?></p>
		<h2><?php echo esc_html( 'Shortcodes' ); ?></h2>
		<ul>
			<li><code><?php echo esc_html( '[idg_case_studies]' ); ?></code></li>
			<li><code><?php echo esc_html( '[idg_case_studies posts_per_page="6"]' ); ?></code></li>
		</ul>
		<h2><?php echo esc_html( 'How to add it to a page (Avada)' ); ?></h2>
		<ol>
			<li><?php echo esc_html( 'Pages → Add New (e.g. “Case Studies Listing”)' ); ?></li>
			<li><?php echo esc_html( 'Add an Avada “Shortcode” element and paste one of the shortcodes above.' ); ?></li>
			<li><?php echo esc_html( 'Publish the page.' ); ?></li>
		</ol>
		<p><?php echo esc_html( 'Pagination links are generated automatically. If needed, page 2 will look like: ?idg_cs_page=2' ); ?></p>
	</div>
	<?php
}
