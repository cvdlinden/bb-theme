<?php
/**
 * The template for displaying image attachments.
 *
 * @package BijBest
 */

get_header(); ?>

	<div id="primary" class="col-md-9">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			// Add the class "panel" below here to wrap the content-padder in Bootstrap style.
			// Simply replace post_class() with post_class('panel') below here. ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php 
					if ( ! get_theme_mod( 'top_callout', true ) ) {
						the_title( '<h1 class="entry-title">Image: ', '</h1>' ); 
					};
					?>

					<div class="entry-meta">
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

				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment cast-shadow bg-transparent-grid">
							<?php bb_the_attached_image(); ?>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bb' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-meta">
					<?php
						if ( comments_open() && pings_open() ) : // Comments and trackbacks open.
							printf( wp_kses_post( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'bb' ), esc_url( get_trackback_url() ) );
						elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open.
							printf( wp_kses_post( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'bb' ), esc_url( get_trackback_url() ) );
						elseif ( comments_open() && ! pings_open() ) : // Only comments open.
							echo wp_kses_post( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'bb' );
						elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed.
							echo esc_html_e( 'Both comments and trackbacks are currently closed.', 'bb' );
						endif;
					?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-## -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' !== get_comments_number() ) {
					comments_template();
				}
			?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
