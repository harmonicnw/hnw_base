<?php
/**
 * Harmonic Northwest Underscores Base Theme functions and definitions
 *
 * @package Harmonic Northwest Underscores Base Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'base_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function base_s_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Harmonic Northwest Underscores Base Theme, use a find and replace
	 * to change 'base_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'base_s', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'base_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'base_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // base_s_setup
add_action( 'after_setup_theme', 'base_s_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function base_s_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'base_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'base_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
/*
function base_s_scripts() {
	wp_enqueue_style( 'base_s-style', get_stylesheet_uri() );

	wp_enqueue_script( 'base_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'base_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'base_s_scripts' );
*/

function base_s_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'custom_plugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bower_components/bootstrap/dist/js/bootstrap.min.js', NULL);
	wp_enqueue_script( 'custom_scripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery', 'custom_plugins', 'bootstrap'), NULL );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function base_s_styles() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bower_components/bootstrap/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/bower_components/components-font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'foundation-icons', get_template_directory_uri() . '/fonts/foundation-icons.css' );
	wp_enqueue_style( 'hnw-business-theme-style', get_template_directory_uri() . '/assets/styles/build/main.css', array('bootstrap'), false, 'screen');
	wp_enqueue_style( 'print-styles', get_template_directory_uri() . '/assets/styles/build/print.css', array(), false, 'print');
}

// Enqueue styles and scripts
add_action( 'wp_enqueue_scripts', 'base_s_styles' );
add_action( 'wp_enqueue_scripts', 'base_s_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
//require get_template_directory() . '/inc/jetpack.php';


/**
 * Create custom post types.
 */
/*
function custom_post_types() {
	$article_args = array(
		'labels' => label_array_maker('Article', 'Articles', 'article'),
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'thumbnail',
			'page-attributes',
			'excerpt'
		),
		'capability_type' => 'page',
		'hierarchical' => true,
		'public' => true,
		'query_var' => 'article',
		'show_ui' => true,
		'rewrite' => true,
		'exclude_from_search' => false,
		'taxonomies' => array('tag'),
		'menu_icon' => 'dashicons-media-document'
	);
	register_post_type( 'article', $article_args );
}
add_action( 'init', 'custom_post_types');
*/


/* ============================================
  WHIP OUT A CUSTOM POST TYPE'S LABEL ARRAY LIKE IT'S NO BIG DEAL
============================================ */

function label_array_maker($sing='Post', $plur='Posts', $type=NULL) {
	if (!$type) {$type = strtolower($sing);}
	$labels = array(
		'name' => __( $plur ), // option to show in menu
		'singular_name' => __( $sing ),
		'add_new_item' => __( 'Add New ' . $sing ),
		'edit_item' => __( 'Edit ' . $sing ),
		'new_item' => __( 'New ' . $sing ),
		'view' => __( 'View ' . $sing ),
		'view_item' => __( 'View ' . $sing ),
		'search_items' => __( 'Search ' . $plur ),
		'not_found' => __( "No " . $plur . " found - <a href='" . get_bloginfo('url') . "/wp-admin/post-new.php?post_type=" . $type . "' style='font-style: italic;'>create one</a>" ),
		'not_found_in_trash' => __( 'No ' . $plur . ' found in Trash' ),
		'parent' => __( 'Parent ' . $sing ),
	);
	return($labels);
}