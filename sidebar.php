<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BijBest
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || ( function_exists('bb_show_sidebar') && !bb_show_sidebar() ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-md-3 hidden-sm" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
