<?php
/**
 * Platinum-2016 functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Platinum_2016
 * @since Platinum-2016 1.0
 */

/**
 * Platinum-2016 only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'platinum2016_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own platinum2016_setup() function to override in a child theme.
 *
 * @since Platinum-2016 1.0
 */
function platinum2016_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/platinum2016
	 * If you're building a theme based on Platinum-2016, use a find and replace
	 * to change 'platinum2016' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'platinum2016' );

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
	 * Enable support for custom logo.
	 *
	 *  @since Platinum-2016 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'platinum2016' ),
		'social'  => __( 'Social Links Menu', 'platinum2016' ),
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
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', platinum2016_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // platinum2016_setup
add_action( 'after_setup_theme', 'platinum2016_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Platinum-2016 1.0
 */
function platinum2016_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'platinum2016_content_width', 840 );
}
add_action( 'after_setup_theme', 'platinum2016_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Platinum-2016 1.0
 */
function platinum2016_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'platinum2016' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'platinum2016' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'platinum2016' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'platinum2016' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'platinum2016' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'platinum2016' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'platinum2016_widgets_init' );

if ( ! function_exists( 'platinum2016_fonts_url' ) ) :
/**
 * Register Google fonts for Platinum-2016.
 *
 * Create your own platinum2016_fonts_url() function to override in a child theme.
 *
 * @since Platinum-2016 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function platinum2016_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'platinum2016' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'platinum2016' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'platinum2016' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( 'off' !== _x( 'on', 'Orbitron font: on or off', 'platinum2016' ) ) {
		$fonts[] = 'Orbitron:400,500,700,900';
	}
	

	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'platinum2016' ) ) {
		$fonts[] = 'Lato:400,700,900,400italic,700italic,900italic';
	}


	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Platinum-2016 1.0
 */
function platinum2016_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'platinum2016_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Platinum-2016 1.0
 */
function platinum2016_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'platinum2016-fonts', platinum2016_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'platinum2016-style', get_stylesheet_uri() );
	
		
	// Load flexbox grid stylesheet.
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/flexboxgrid.css', array( 'platinum2016-style' ), '20160816' );
	
	// Load custom stylesheet.
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css', array( 'platinum2016-style' ), '20160816' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'platinum2016-ie', get_template_directory_uri() . '/css/ie.css', array( 'platinum2016-style' ), '20160816' );
	wp_style_add_data( 'platinum2016-ie', 'conditional', 'lt IE 10' );

	wp_enqueue_script( 'platinum2016-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'platinum2016-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}


	wp_enqueue_script( 'platinum2016-jquery','https://code.jquery.com/jquery-2.2.4.min.js', array( 'jquery' ), '20160816', true );
	


	wp_enqueue_script( 'platinum2016-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );
	
	wp_enqueue_script( 'platinum2016-global', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'platinum2016-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'platinum2016' ),
		'collapse' => __( 'collapse child menu', 'platinum2016' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'platinum2016_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Platinum-2016 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function platinum2016_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'platinum2016_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Platinum-2016 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function platinum2016_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Platinum-2016 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function platinum2016_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'platinum2016_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Platinum-2016 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function platinum2016_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'platinum2016_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Platinum-2016 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function platinum2016_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list'; 

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'platinum2016_widget_tag_cloud_args' );


function create_posttypes() {
	 
    //Intellectual Properties post type
    register_post_type( 'ip',
        array(
            'labels' => array(
                'name' => __( 'IPs' ),
                'singular_name' => __( 'IP Post' )
            ),
            'public' => true,
            'has_archive' => 'ip',
            'show_ui'      => true,
            'taxonomies'   => array(
                'ip_cats'
            ),
            'rewrite' => array(
            	'slug' => 'ip',
                'with_front' => false
            ),
            'hierarchical' => false,
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
        ) );
        
    
    //Intellectual Properties taxonomy
    register_taxonomy( 'ip_cats', 'ip', array(
        'label'        => 'IP Categories',
        'labels'       => array(
            'menu_name' => __( 'IP Categories', 'IPs' )
        ),
        'hierarchical' => true,
        'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_ui'      => true
    ) );
    
    //Story post type
    register_post_type( 'stories',
        array(
            'labels' => array(
                'name' => __( 'Stories' ),
                'singular_name' => __( 'Story' )
            ),
            'public' => true,
            'has_archive' => 'stories',
            'show_ui'      => true,
            'taxonomies'   => array(
                'story_cats'
            ),
            'rewrite' => array(
            	'slug' => 'stories',
                'with_front' => false
            ),
            'hierarchical' => false,
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
        ) );
        
    
    //Story taxonomy
    register_taxonomy( 'story_cats', 'stories', array(
        'label'        => 'Story Categories',
        'labels'       => array(
            'menu_name' => __( 'Story Categories', 'Stories' )
        ),
        'hierarchical' => true,
        'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_ui'      => true
    ) );

    
    //Character post type
    register_post_type( 'characters',
        array(
            'labels' => array(
                'name' => __( 'Characters' ),
                'singular_name' => __( 'Character Post' )
            ),
            'public' => true,
            'has_archive' => 'characters',
            'show_ui'      => true,
            'taxonomies'   => array(
                'character_cats'
            ),
            'rewrite' => array(
            	'slug' => 'characters',
                'with_front' => false
            ),
            'hierarchical' => false,
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
        ) );
        
    
    //Character taxonomy
    register_taxonomy( 'character_cats', 'character', array(
        'label'        => 'Character Categories',
        'labels'       => array(
            'menu_name' => __( 'Character Categories', 'Characters' )
        ),
        'hierarchical' => true,
        'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_ui'      => true
    ) );
    
    //Character post type
    register_post_type( 'monsters',
        array(
            'labels' => array(
                'name' => __( 'Monsters' ),
                'singular_name' => __( 'Monster Post' )
            ),
            'public' => true,
            'has_archive' => 'monsters',
            'show_ui'      => true,
            'taxonomies'   => array(
                'monsters_cats'
            ),
            'rewrite' => array(
            	'slug' => 'monsters',
                'with_front' => false
            ),
            'hierarchical' => false,
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
        ) );
        
    
    //Character taxonomy
    register_taxonomy( 'monsters_cats', 'monster', array(
        'label'        => 'Monster Categories',
        'labels'       => array(
            'menu_name' => __( 'Monster Categories', 'Monsters' )
        ),
        'hierarchical' => true,
        'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_ui'      => true
    ) );
    
    
    
    
        //Character post type
    register_post_type( 'universes',
        array(
            'labels' => array(
                'name' => __( 'Universes' ),
                'singular_name' => __( 'Universe' )
            ),
            'public' => true,
            'has_archive' => 'universes',
            'show_ui'      => true,
            'rewrite' => array(
            	'slug' => 'universes',
                'with_front' => false
            ),
            'hierarchical' => false,
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
        ) );
        
        //Character post type
    register_post_type( 'teams',
        array(
            'labels' => array(
                'name' => __( 'Teams' ),
                'singular_name' => __( 'Team' )
            ),
            'public' => true,
            'has_archive' => 'teams',
            'show_ui'      => true,
            'rewrite' => array(
            	'slug' => 'teams',
                'with_front' => false
            ),
            'hierarchical' => false,
            'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
        ) );

}

add_action( 'init', 'create_posttypes' );


