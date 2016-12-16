<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BijBest
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! get_theme_mod( 'top_callout', true ) ) { ?>
		<header>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->
	<?php }; ?>

	<div class="entry-content">
		<div class="entry-content-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php the_content(); ?>
		<?php bb_link_pages(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php bb_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( esc_html__( ', ', 'bb' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', esc_html__( ', ', 'bb' ) );

			if ( ! bb_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text.
				if ( '' !== $tag_list ) {
					$meta_text = esc_html__( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bb' );
				} else {
					$meta_text = esc_html__( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bb' );
				}
			} else {
				// But this blog has loads of categories so we should probably display them here.
				if ( '' !== $tag_list ) {
					$meta_text = esc_html__( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bb' );
				} else {
					$meta_text = esc_html__( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bb' );
				}
			} // End check for categories on this blog.

			printf(
				esc_attr( $meta_text ),
				esc_attr( $category_list ),
				esc_attr( $tag_list ),
				esc_url( get_permalink() ),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php if ( get_edit_post_link() ) :
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'bb' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<i class="fa fa-pencil" title="' . esc_attr__( 'Edit' ) . '" aria-hidden="true"></i> <span class="edit-link">',
				'</span>'
			);
		endif; ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
