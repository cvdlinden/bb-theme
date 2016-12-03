<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BijBest
 */

get_header(); ?>

	<?php // Add the class "panel" below here to wrap the content-padder in Bootstrap style. ?>
	<section class="content-padder error-404 not-found">

			<header>
				<h1 class="page-title"><?php esc_html_e( 'Oops! Something went wrong here.', 'bb' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">

				<p><?php esc_html_e( 'Nothing could be found at this location. Maybe try a search?', 'bb' ); ?></p>

				<?php
				get_search_form();

				the_widget( 'WP_Widget_Recent_Posts' );

				// Only show the widget if site has multiple categories.
				if ( bb_categorized_blog() ) :
				?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'bb' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->

				<?php
				endif;

				/* translators: %1$s: smiley */
				$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'bb' ), convert_smilies( ':)' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

				the_widget( 'WP_Widget_Tag_Cloud' );
				?>

			</div><!-- .page-content -->

	</section><!-- .content-padder -->

<?php // Obsolete get_sidebar();. ?>
<?php get_footer(); ?>
