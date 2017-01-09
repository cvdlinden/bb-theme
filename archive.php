<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BijBest
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<?php $layout_class = ( function_exists( 'bb_get_layout_class' ) ) ? bb_get_layout_class(): ''; ?>
			<section id="primary" class="col-md-9 <?php echo esc_attr( $layout_class ); ?>">

				<?php
				if ( have_posts() ) : ?>
					
					<?php if ( ! get_theme_mod( 'top_callout', true ) ) { ?>
						<header>
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?>
						</header><!-- .page-header --><?php
					} ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</section><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!--end of row-->
	</div><!--end of container-->

<?php get_footer(); ?>
