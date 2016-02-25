<?php
/**
 * brandi functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package brandi
 */

if ( ! function_exists( 'brandi_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function brandi_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on brandi, use a find and replace
	 * to change 'brandi' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'brandi', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary Menu', 'brandi' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'brandi_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // brandi_setup
add_action( 'after_setup_theme', 'brandi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function brandi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'brandi_content_width', 640 );
}
add_action( 'after_setup_theme', 'brandi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brandi_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'brandi' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'brandi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function brandi_scripts() {
    /***************** 
     *  Stylesheets  *
     *****************/
    //Normalize
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.min.css' );
    
    //Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
    
    //Bootstrap Stylesheet
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' );
    
    //Animate
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
    
    //Main Stylesheet
	wp_enqueue_style( 'brandi-style', get_stylesheet_uri() );

    /************* 
     *  Scripts  *
     *************/
    //jQuery
    wp_enqueue_script( 'jquery' );
    
    //Modernizr
    wp_enqueue_script( 'modernizr-2.8.3', get_template_directory_uri() . '/js/vendor/modernizr-2.8.3.min.js', array() );
    
    //Picturefill
    wp_enqueue_script( 'picturefill', 'https://cdn.rawgit.com/scottjehl/picturefill/master/dist/picturefill.min.js', array() );
    
    //Bootstrap
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ) );
    
    //Mixitup
    wp_enqueue_script( 'mixitup', 'https://cdn.jsdelivr.net/jquery.mixitup/2.1.11/jquery.mixitup.min.js', array( 'jquery' ) );
    
    //Scrollspy
    wp_enqueue_script( 'scrollspy', get_template_directory_uri() . '/js/scrollspy.js', array( 'jquery' ) );
    
    //Plugins
    wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ) );
    
    //Viewport Checker
    wp_enqueue_script( 'viewport-checker', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-viewport-checker/1.8.7/jquery.viewportchecker.min.js', array( 'jquery' ) );
    
    //Main
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );
    
	wp_enqueue_script( 'brandi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'brandi-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brandi_scripts' );

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
 * Load Titan Framework plugin checker
 */
//require get_template_directory() . '/titan-framework-checker.php';

/**
 * Load Titan Framework embed checker
 */
require_once( 'titan-framework/titan-framework-embedder.php' );

/**
 * Load Titan Framework options
 */
require get_template_directory() . '/titan-options.php';