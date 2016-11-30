<?php
/**
 * BijBest functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BijBest
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750; /* pixels */
}

if ( ! function_exists( 'bb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bb_setup() {
	global $cap, $content_width;

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BijBest, use a find and replace
	 * to change 'bb' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bb', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'bb' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

}
endif; // bb_setup
add_action( 'after_setup_theme', 'bb_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bb_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bb_content_width', 1140 );
}
add_action( 'after_setup_theme', 'bb_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bb_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bb' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bb' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage', 'bb' ),
		'id'            => 'sidebar-home',
		'description'   => esc_html__( 'Used for homepage widget area', 'bb' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	for( $i=1; $i<5; $i++ ) {
		register_sidebar(array(
			'id'            => 'footer-widget-'.$i,
			'name'          =>  sprintf( esc_html__( 'Footer Widget %s', 'bb' ), $i),
			'description'   =>  esc_html__( 'Used for footer widget area', 'bb' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
	}

	register_widget( 'bb_recent_posts' );
	register_widget( 'bb_categories' );
	register_widget( 'bb_home_parallax' );
	register_widget( 'bb_home_features' );
	register_widget( 'bb_home_testimonial' );
	register_widget( 'bb_home_CFA' );
	register_widget( 'bb_home_clients' );
	register_widget( 'bb_home_portfolio' );
	
}
add_action( 'widgets_init', 'bb_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bb_scripts() {

	// Add slider CSS
	wp_enqueue_style( 'flexslider-css', get_template_directory_uri().'/inc/css/flexslider.css' );

	// Add custom theme css
	//wp_enqueue_style( 'bb-style', get_stylesheet_uri() ); // Default WP Style.css
	wp_enqueue_style( 'bb-style', get_template_directory_uri() . '/style.min.css' );

	// load bootstrap js
	wp_enqueue_script('bb-bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( 'bb-bootstrapwp', get_template_directory_uri() . '/js/bootstrap-wp.min.js', array('jquery') );

	wp_enqueue_script( 'bb-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

	wp_enqueue_script( 'bb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20160115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( post_type_exists( 'jetpack-portfolio' ) ){
		 wp_enqueue_script( 'jquery-masonry' );
	}

	if (post_type_exists( 'jetpack-portfolio' ) ) {
		wp_enqueue_script( 'jquery-masonry', array( 'jquery' ), '20160115', true );
	}
	
	// Add slider JS
	wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array('jquery'), '20160222', true );
	
	if ( is_page_template( 'template-home.php' ) ) {
		wp_enqueue_script( 'bb-parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery'), '20160115', true );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'bb-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_script( 'bb-scripts', get_template_directory_uri() . '/js/bb-scripts.min.js', array('jquery'), '20160115', true );
}
add_action( 'wp_enqueue_scripts', 'bb_scripts' );

// add admin scripts
function bb_admin_script($hook) {

	wp_enqueue_media();
	
	if( $hook == 'widgets.php' || $hook == 'customize.php' ){
	  wp_enqueue_script( 'bb_cloneya_js', get_template_directory_uri() . '/js/jquery-cloneya.min.js', array( 'jquery' ) );
	  wp_enqueue_script('widget-js', get_template_directory_uri() . '/js/widget.js', array('media-upload'), '1.0', true);
	  
	  // Add Font Awesome stylesheet    
	  wp_enqueue_style( 'bb-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );
	
	}
}
add_action('admin_enqueue_scripts', 'bb_admin_script');

/**
* Enable support for Post Thumbnails on posts and pages.
*
* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
*/
add_theme_support( 'post-thumbnails' );

add_image_size( 'bb-featured', 848, 566, true );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

// /**
//  * Adds WooCommerce support
//  */
// add_action( 'after_setup_theme', 'woocommerce_support' );
// function woocommerce_support() {
// 	add_theme_support( 'woocommerce' );
// }
/**
 * Adds WooCommerce support
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woo-setup.php';
}

/**
 * Load Social Navition
 */
require get_template_directory() . '/inc/socialnav.php';

/**
 * Load Metboxes
 */
require get_template_directory() . '/inc/metaboxes.php';

/* --------------------------------------------------------------
	   Theme Widgets
-------------------------------------------------------------- */
foreach ( glob( get_template_directory() . '/inc/widgets/*.php' ) as $lib_filename ) {
	require_once( $lib_filename );
}

/**
 * Recommended or Required Plugins
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bb_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function bb_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Jetpack by WordPress.com',
			'slug'      => 'jetpack',
			'required'  => false,
		),
		array(
			'name'      => 'Yoast Seo',
			'slug'      => 'wordpress-seo',
			'required'  => false,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/*
 * GLOBALS
 */
/* Globals */
global $bb_site_layout;
$bb_site_layout = array('pull-right' =>  esc_html__('Left Sidebar','bb'), 'side-right' => esc_html__('Right Sidebar','bb'), 'no-sidebar' => esc_html__('No Sidebar','bb'),'full-width' => esc_html__('Full Width', 'bb'));
