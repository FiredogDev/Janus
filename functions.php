<?php
/*
Author: Firedog Design
URL: http://firedog.co.uk

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD firedog CORE (if you remove this, the theme will break)
require_once( 'library/firedog.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

/*********************
LAUNCH Firedog
Let's get everything up and running.
*********************/

function firedog_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'firedog', get_template_directory() . '/library/translation' );

  // CUSTOM POST TYPES
  require_once('library/custom-post-types.php');

  // launching operation cleanup
  add_action( 'init', 'firedog_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'firedog_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'firedog_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'firedog_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'firedog_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'firedog_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  firedog_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'firedog_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'firedog_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'firedog_excerpt_more' );

} /* end firedog ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'firedog_ahoy' );

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'firedog-one-third', 540, 9999, false );

add_filter( 'image_size_names_choose', 'firedog_custom_image_sizes' );
function firedog_custom_image_sizes( $sizes ) {
  return array_merge( $sizes, array(
      'firedog-one-third' => __('One Third'),
  ));
}

/************* ACTIVE SIDEBARS ********************/

  // Sidebars & Widgetizes Areas
  function firedog_register_sidebars() {

  	// register_sidebar(array(
  	// 	'id' => 'sidebar1',
  	// 	'name' => __( 'Sidebar 1', 'firedog' ),
  	// 	'description' => __( 'The first (primary) sidebar.', 'firedog' ),
  	// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
  	// 	'after_widget' => '</div>',
  	// 	'before_title' => '<h4 class="widgettitle">',
  	// 	'after_title' => '</h4>',
  	// ));

  	/*
  	to add more sidebars or widgetized areas, just copy
  	and edit the above sidebar code. In order to call
  	your new sidebar just use the following code:

  	Just change the name to whatever your new
  	sidebar's id is, for example:

  	register_sidebar(array(
  		'id' => 'sidebar2',
  		'name' => __( 'Sidebar 2', 'firedog' ),
  		'description' => __( 'The second (secondary) sidebar.', 'firedog' ),
  		'before_widget' => '<div id="%1$s" class="widget %2$s">',
  		'after_widget' => '</div>',
  		'before_title' => '<h4 class="widgettitle">',
  		'after_title' => '</h4>',
  	));

  	To call the sidebar in your template, you can just copy
  	the sidebar.php file and rename it to your sidebar's name.
  	So using the above example, it would be:
  	sidebar-sidebar2.php

  	*/
  }

  // Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );
?>