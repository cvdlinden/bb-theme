<?php
/**
 * The template for displaying Jetpack Porfolio archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BijBest
 */

get_header(); ?>

	<?php $layout_class = ( function_exists( 'bb_get_layout_class' ) ) ? bb_get_layout_class(): ''; ?>  
	<section id="primary" class="content-area col-md-12 <?php echo esc_attr( $layout_class ); ?>">

	<?php
	if ( have_posts() ) : ?>
		
		<header>
			<?php
				echo ( '' !== get_theme_mod( 'portfolio_name' ) ) ? '<h1 class="post-title">' . esc_html( get_theme_mod( 'portfolio_name' ) ) . '</h1>' : '';
				echo ( '' !== get_theme_mod( 'portfolio_description' ) ) ? '<p>' . esc_html( get_theme_mod( 'portfolio_description' ) ) . '</p>' : '';
			?>
		</header><!-- .page-header -->
		
		<div class="masonry-loader fixed-center">
			<div class="col-sm-12 text-center">
				<div class="spinner"></div>
			</div>
		</div><!-- .masonry-loader -->
		<div class="masonry masonryFlyIn">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-snippet col-md-3 col-sm-6 masonry-item project' ); ?>>
					<div class="image-tile inner-title hover-reveal text-center"><?php
					if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail( 'medium' ); ?>
							<div class="title"><?php
								the_title( '<h4>','</h4>' );

								$terms = get_the_terms( get_the_ID(), 'jetpack-portfolio-type' );
								if ( $terms ) {
									$out = array();
									foreach ( $terms as $term ) {
										$out[] = '<span>' . $term->name . '</span>';
									}
									echo wp_kses_post( join( ' / ', $out ) );
								}
								?>
							</div>
						</a><?php
					} ?>
					</div>
				</article><!-- #post-## -->
			
			<?php
			endwhile;
			?>
		</div><!-- .masonry -->

		<?php
		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>
	</section><!-- #primary -->

<?php get_footer(); ?>
