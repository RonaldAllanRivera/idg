<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

?>
<main id="primary" class="site-main">
	<header class="page-header">
		<h1 class="page-title">Case Studies</h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="idg-case-studies">
			<?php
			while ( have_posts() ) :
				the_post();

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
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p>No case studies found.</p>
	<?php endif; ?>
</main>
<?php

get_footer();
