<?php
/**
 * Social Navigation Menu
 *
 * @package BijBest
 */

/**
 * Register Social Icon menu.
 */
function register_social_menu() {
	register_nav_menu( 'social-menu', _x( 'Social Menu', 'nav menu location', 'bb' ) );
}
add_action( 'init', 'register_social_menu' );

if ( ! function_exists( 'bb_social_icons' ) ) :
	/**
	 * Display social links in footer and widgets.
	 */
	function bb_social_icons() {
		if ( has_nav_menu( 'social-menu' ) ) {
			wp_nav_menu(
				array(
					'menu'            => 'social-menu',
					'menu_id'         => 'menu-social-items',
					'theme_location'  => 'social-menu',
					'depth'           => 1,
					'container'       => 'nav',
					'container_id'    => 'social',
					'container_class' => 'social-icons',
					'menu_class'      => 'list-inline social-list',
					'fallback_cb'     => '',
					'link_before'     => '<i class="social_icon fa"><span>',
					'link_after'      => '</span></i>',
				)
			);
		}
	}
endif;
