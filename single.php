<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BijBest
 */

get_header(); ?>

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', get_post_format() );

		// bb_content_nav( 'nav-below' );
		//the_post_navigation();
		bb_pagination();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>