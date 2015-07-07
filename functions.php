<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Mobile First Theme with Sass' );
define( 'CHILD_THEME_URL', 'http://pmgllc.github.io/bg-mobile-first-jp-sass' );
define( 'CHILD_THEME_VERSION', '1.0.4' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'mobile_first_sass_scripts_styles' );
function mobile_first_sass_scripts_styles() {

	wp_enqueue_script( 'mobile-first-sass-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'mobile-first-sass-sticky-message', get_bloginfo( 'stylesheet_directory' ) . '/js/sticky-message.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 114,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Hook sticky message before site header
add_action( 'genesis_before', 'mobile_first_sass_sticky_message' );
function mobile_first_sass_sticky_message() {

	genesis_widget_area( 'sticky-message', array(
		'before' => '<div class="sticky-message">',
		'after'  => '</div>',
	) );

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mobile_first_sass_remove_comment_form_allowed_tags' );
function mobile_first_sass_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'mobile_first_sass_author_box_gravatar' );
function mobile_first_sass_author_box_gravatar( $size ) {

	return 160;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'mobile_first_sass_comments_gravatar' );
function mobile_first_sass_comments_gravatar( $args ) {

	$args['avatar_size'] = 100;
	return $args;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'sticky-message',
	'name'        => __( 'Sticky Message', 'bg-mobile-first-jp-sass' ),
	'description' => __( 'This is the sticky message widget area.', 'bg-mobile-first-jp-sass' ),
) );
