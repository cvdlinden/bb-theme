<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BijBest
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<?php $layout_class = ( function_exists( 'bb_get_layout_class' ) ) ? bb_get_layout_class(): ''; ?>  
			<div id="primary" class="col-md-9 <?php echo esc_attr( $layout_class ); ?>">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					bb_author_bio();

					bb_pagination();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!--end of row-->
	</div><!--end of container-->

<?php get_footer(); ?>
