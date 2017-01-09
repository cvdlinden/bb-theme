<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
							<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'bb' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->
					<?php }; ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						* Run the loop for the search to output the results.
						* If you want to overload this in a child theme then include a file
						* called content-search.php and that will be used instead.
						*/
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

					bb_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</section><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!--end of row-->
	</div><!--end of container-->

<?php get_footer(); ?>
