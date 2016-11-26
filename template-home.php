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

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( ! dynamic_sidebar( 'sidebar-home' ) ) : ?>

            <?php 
            while ( have_posts() ) : the_post(); 
            ?>

                <div class="jumbotron">
                    <h3><?php esc_html_e('This is the "Home Sidebar Section", add some widgets to it to override the look and feel.', 'bb'); ?></h3>
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

    </article><!-- #post-## -->

<?php get_footer(); ?>