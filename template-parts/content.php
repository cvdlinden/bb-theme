<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BijBest
 */

?>


<?php // Styling Tip!

// Want to wrap for example the post content in blog listings with a thin outline in Bootstrap style?
// Just add the class "panel" to the article tag here that starts below.
// Simply replace post_class() with post_class('panel') and check your site!
// Remember to do this for all content templates you want to have this,
// for example content-single.php for the post single view. ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-snippet' . ( is_single() ? ' content': '') ); ?>>

	<header class="entry-header">

		<?php
		if ( has_post_thumbnail() && ! is_single() ) { ?>
			<a class="text-center" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
				the_post_thumbnail( 'bb-featured' ); ?>
			</a><?php
		}

		if ( is_single() ) {
			if ( ! get_theme_mod( 'top_callout', true ) ) {
				the_title( '<h1 class="page-title">', '</h1>' );
			}
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>

	</header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search and Archive Pages. ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php
				if ( ! is_single() ) {
					the_excerpt();
				} else {
					the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bb' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

			echo '<hr>';
				}
			?>
			<?php bb_link_pages(); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">

		<?php
			if ( is_single() ) {
				echo '<div class="pull-right">';
				bb_entry_footer();
				echo '</div>';
			}
		?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php bb_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</footer> 

</article><!-- #post-## -->
