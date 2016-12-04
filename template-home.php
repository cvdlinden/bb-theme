<?php
/**
 * Template Name: Home Page
 *
 * Displays the Home page with Parallax effects.
 *
 * @package BijBest
 */

?>

<?php get_header(); ?>

	<?php $layout_class = ( function_exists( 'bb_get_layout_class' ) ) ? bb_get_layout_class(): ''; ?>  
	<div id="primary" class="col-md-12 <?php echo esc_attr( $layout_class ); ?>">
		<main id="main" class="site-main" role="main">

			<?php if ( ! is_active_sidebar( 'sidebar-home' ) ) : ?>

				<?php
				while ( have_posts() ) : the_post();
				?>

				<div class="jumbotron">
					<h3><?php esc_html_e( 'This is the "Home Sidebar Section", add some widgets to it to override the look and feel.', 'bb' ); ?></h3>
				</div>

				<div class="entry-content">
					<div class="entry-content-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
					<?php the_content(); ?>
				</div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									/* translators: %s: Name of current post */
									esc_html__( 'Edit %s', 'bb' ),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>

				<?php
				endwhile; // End of the loop.
				?>

			<?php else :
				dynamic_sidebar( 'sidebar-home' );
			endif ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
