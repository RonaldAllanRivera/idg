<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) {
	the_post();

	$client_name   = function_exists( 'get_field' ) ? get_field( 'client_name' ) : null;
	$project_url   = function_exists( 'get_field' ) ? get_field( 'project_url' ) : null;
	$industry      = function_exists( 'get_field' ) ? get_field( 'industry' ) : null;
	$featured_num  = function_exists( 'get_field' ) ? get_field( 'featured_result' ) : null;
	$featured_suf  = function_exists( 'get_field' ) ? get_field( 'featured_result_suffix' ) : null;
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
	<main id="primary" class="site-main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
			</header>

			<div class="entry-content">
				<?php
				if ( $client_name ) {
					echo '<p><strong>Client:</strong> ' . esc_html( $client_name ) . '</p>';
				}

				if ( $industry ) {
					echo '<p><strong>Industry:</strong> ' . esc_html( is_array( $industry ) ? implode( ', ', $industry ) : $industry ) . '</p>';
				}

				if ( $project_url ) {
					echo '<p><strong>Project URL:</strong> <a href="' . esc_url( $project_url ) . '" target="_blank" rel="noopener">' . esc_html( $project_url ) . '</a></p>';
				}

				if ( $featured_text ) {
					echo '<p><strong>Featured Result:</strong> ' . esc_html( $featured_text ) . '</p>';
				}

				the_content();

				if ( function_exists( 'have_rows' ) && have_rows( 'flexible_content' ) ) {
					while ( have_rows( 'flexible_content' ) ) {
						the_row();
						$layout = get_row_layout();

						if ( $layout === 'content_block' ) {
							$heading = get_sub_field( 'heading' );
							$content = get_sub_field( 'content' );
							echo '<section class="idg-case-study-block">';
							if ( $heading ) {
								echo '<h2>' . esc_html( $heading ) . '</h2>';
							}
							if ( $content ) {
								echo wp_kses_post( $content );
							}
							echo '</section>';
						} elseif ( $layout === 'image_text' ) {
							$image = get_sub_field( 'image' );
							$text  = get_sub_field( 'text' );
							echo '<section class="idg-case-study-image-text">';

							$image_id = 0;
							$image_src = '';
							$image_alt = '';

							if ( is_array( $image ) ) {
								if ( ! empty( $image['ID'] ) ) {
									$image_id = (int) $image['ID'];
								} elseif ( ! empty( $image['id'] ) ) {
									$image_id = (int) $image['id'];
								}

								if ( ! empty( $image['url'] ) ) {
									$image_src = (string) $image['url'];
								}
								if ( ! empty( $image['alt'] ) ) {
									$image_alt = (string) $image['alt'];
								}
							} elseif ( is_int( $image ) || ( is_string( $image ) && ctype_digit( $image ) ) ) {
								$image_id = (int) $image;
							} elseif ( is_string( $image ) ) {
								$image_src = $image;
							}

							if ( $image_id ) {
								$image_html = wp_get_attachment_image( $image_id, 'large', false, array( 'loading' => 'lazy' ) );
								if ( $image_html ) {
									echo '<figure>' . $image_html . '</figure>';
								}
							} elseif ( $image_src ) {
								echo '<figure><img src="' . esc_url( $image_src ) . '" alt="' . esc_attr( $image_alt ) . '" loading="lazy"></figure>';
							}
							if ( $text ) {
								echo '<div>' . wp_kses_post( $text ) . '</div>';
							}
							echo '</section>';
						}
					}
				}
				?>
			</div>
		</article>
	</main>
	<?php
}

get_footer();
