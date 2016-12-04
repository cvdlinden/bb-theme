<?php

/**
 * Social Navigation Menu
 */

/**
 * Register Social Icon menu
 */
add_action( 'init', 'register_social_menu' );

function register_social_menu() {
	register_nav_menu( 'social-menu', _x( 'Social Menu', 'nav menu location', 'bb' ) );
}

/**
 * Display social links in footer and widgets
 *
 * @package Bij Best
 */
if ( ! function_exists( 'bb_social_icons' ) ) :
	function bb_social_icons() {
		if ( has_nav_menu( 'social-menu' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'social-menu',
					'container'       => 'nav',
					'container_id'    => 'social',
					'container_class' => 'social-icons',
					'menu_id'         => 'menu-social-items',
					'menu_class'      => 'list-inline social-list',
					'depth'           => 1,
					'fallback_cb'     => '',
					'link_before'     => '<i class="social_icon fa"><span>',
					'link_after'      => '</span></i>',
				)
			);
		}
	}
endif;
