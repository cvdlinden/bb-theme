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
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

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
	
	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

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
	$GLOBALS['content_width'] = apply_filters( 'bb_content_width', 640 );
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
}
add_action( 'widgets_init', 'bb_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bb_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( 'bb-bootstrap-wp', get_template_directory_uri() . '/inc/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( 'bb-bootstrap', get_template_directory_uri() . '/inc/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( 'bb-font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', false, '4.1.0' );

	// load bb styles
	wp_enqueue_style( 'bb-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('bb-bootstrapjs', get_template_directory_uri() . '/inc/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( 'bb-bootstrapwp', get_template_directory_uri() . '/inc/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( 'bb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'bb-keyboard-image-navigation', get_template_directory_uri() . '/inc/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'bb_scripts' );

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

/**
 * Adds WooCommerce support
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
