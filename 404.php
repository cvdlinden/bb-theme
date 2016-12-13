<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BijBest
 */

get_header(); ?>

	<div id="primary" class="col-md-12">

		<?php // Add the class "panel" below here to wrap the content-padder in Bootstrap style. ?>
		<section class="content-padder error-404 not-found">

			<?php if ( ! get_theme_mod( 'top_callout', true ) ) { ?>
				<header>
					<h1 class="page-title"><?php esc_html_e( 'Oops! Something went wrong here.', 'bb' ); ?></h1>
				</header><!-- .page-header -->
			<?php }; ?>

			<div class="page-content">

				<p><?php esc_html_e( 'Nothing could be found at this location. Maybe try a search?', 'bb' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->

		</section><!-- .content-padder -->

	</div><!-- #primary -->

<?php // Obsolete get_sidebar();. ?>
<?php get_footer(); ?>
