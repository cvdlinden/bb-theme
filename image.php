<?php
/**
 * The template for displaying image attachments.
 *
 * @package BijBest
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<?php $layout_class = ( function_exists( 'bb_get_layout_class' ) ) ? bb_get_layout_class(): ''; ?>  
			<div id="primary" class="col-md-9 <?php echo esc_attr( $layout_class ); ?>">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="entry-header">

							<?php 
							if ( ! get_theme_mod( 'top_callout', true ) ) {
								the_title( '<h1 class="page-title">Image: ', '</h1>' ); 
							};
							?>

						</header><!-- .entry-header -->

						<div class="entry-content">

							<figure class="figure">
								<div class="attachment cast-shadow bg-transparent-grid">
									<?php bb_the_attached_image(); ?>
								</div><!-- .attachment -->

								<?php if ( has_excerpt() ) : ?>
									<figcaption class="figure-caption">
										<?php the_excerpt(); ?>
									</figcaption><!-- .entry-caption -->
								<?php endif; ?>
							</figure><!-- .entry-attachment -->

							<?php
								the_content();
							?>

						</div><!-- .entry-content -->

						<footer class="entry-footer">

							<div class="entry-meta">

								<div class="text-center">
									<nav role="navigation" id="image-navigation" class="image-navigation" aria-label="Page navigation">
										<ul class="pagination">
											<li class="page-item">
												<?php previous_image_link( false, wp_kses_post( '<span aria-hidden="true"">&laquo;</span> <span>Previous</span>', 'bb' ) ); ?>
											</li>
											<li class="page-item">
												<?php next_image_link( false, wp_kses_post( '<span>Next</span> <span aria-hidden="true">&raquo;</span>', 'bb' ) ); ?>
											</li>
										</ul>
									</nav><!-- #image-navigation -->
								</div>

								<ul class="list-inline">

									<?php $metadata = wp_get_attachment_metadata(); ?>

									<li>
										<i class="fa fa-calendar-o" title="<?php echo esc_attr_e( 'Published' )?>" aria-hidden="true"></i> <span class="entry-date">
											<?php printf( '<time class="entry-date" datetime="%1$s">%2$s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ) ?>
										</span>
									</li>

									<li>
										<i class="fa fa-expand" title="<?php echo esc_attr_e( 'Image size', 'bb' )?>" aria-hidden="true"></i> 
										<?php printf( '<a href="%1$s" title="Link to full-size image">%2$s &times; %3$s</a>', esc_url( wp_get_attachment_url() ), esc_attr( $metadata['width'] ), esc_attr( $metadata['height'] ) ); ?>
									</li>

									<?php
										edit_post_link(
											sprintf(
												/* translators: %s: Name of current post */
												esc_html__( 'Edit %s', 'bb' ),
												the_title( '<span class="screen-reader-text">"', '"</span>', false )
											),
											'<li><i class="fa fa-pencil" title="' . esc_attr__( 'Edit' ) . '" aria-hidden="true"></i> <span class="edit-link">',
											'</span></li>'
										);
									?>

								</ul>

							</div><!-- .entry-meta -->

						</footer><!-- .entry-footer -->

					</article><!-- #post-## -->

					<?php
					bb_author_bio();
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!--end of row-->
	</div><!--end of container-->

<?php get_footer(); ?>
