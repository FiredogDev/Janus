<?php
/*
 * File: Firedog Functions
 * Author: Firedog Design
 * URL: http://firedog.co.uk
*/

/*********************
WP_HEAD GOODNESS
*********************/
function firedog_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'firedog_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'firedog_remove_wp_ver_css_js', 9999 );
}
// A better title
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;
}
// remove WP version from RSS
function firedog_rss_version() { return ''; }
// remove WP version from scripts
function firedog_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
// remove injected CSS for recent comments widget
function firedog_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
// remove injected CSS from recent comments widget
function firedog_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
// remove injected CSS from gallery
function firedog_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/
// loading modernizr and jquery, and reply script
function firedog_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'firedog-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		wp_register_style( 'firedog-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

		// ie-only style sheet
		wp_register_style( 'firedog-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

	    // comment reply script for threaded comments
	    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			  wp_enqueue_script( 'comment-reply' );
	    }

		//adding scripts file in the footer
		wp_register_script( 'firedog-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_script( 'firedog-modernizr' );
		wp_enqueue_style( 'firedog-stylesheet' );
		wp_enqueue_style( 'firedog-ie-only' );

		$wp_styles->add_data( 'firedog-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'firedog-js' );

	}
}

/*********************
THEME SUPPORT
*********************/
// Adding WP 3+ Functions & Theme Support
function firedog_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// adding post format support
	// add_theme_support( 'post-formats',
	// 	array(
	// 		'aside',             // title less blurb
	// 		'gallery',           // gallery of images
	// 		'link',              // quick link to other site
	// 		'image',             // an image
	// 		'quote',             // a quick quote
	// 		'status',            // a Facebook like status update
	// 		'video',             // video
	// 		'audio',             // audio
	// 		'chat'               // chat transcript
	// 	)
	// );

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'primary-nav' => __( 'Primary Navigation', 'firedog' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'firedog' ) // secondary nav in footer
		)
	);
} /* end firedog theme support */

/*********************
RELATED POSTS FUNCTION
*********************/
// Related Posts Function (call using firedog_related_posts(); )
function firedog_related_posts() {
	echo '<ul id="firedog-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'firedog' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end firedog related posts function */

/****************
CUSTOM FILTERING
*****************/
// Customize wp body class
add_filter('body_class', 'firedog_body_classes');
function firedog_body_classes($classes) {
		global $post;

		// On any single page
		if(is_page()){
			$classes[] = "page--" . $post->post_name;
		}
		// On any archive
		else if(is_archive()){
			$cat = get_category( get_query_var( 'cat' ) );
			$classes[] = "archive--" . $cat->slug;
		}
		// On single post...
		else if (is_single()) {
			// ...add the post categories to the body.
	        foreach((get_the_category($post->ID)) as $category) {
				$classes[] = "category--" . $category->category_nicename;
			}
		}

		


        return $classes;
}

// Filter Gallery Output.
add_filter( 'post_gallery', 'customize_my_gallery', 10, 4 );
function customize_my_gallery( $output = '', $atts, $content = false, $tag = false ) {
	$return = $output; // fallback
	// retrieve content of your own gallery function
	$my_result = get_my_gallery_content( $atts );
	// boolean false = empty, see http://php.net/empty
	if( !empty( $my_result ) ) { $return = $my_result; }
	return $return;
}

// Turn gallery content into html appropriate for fd slider.
function get_my_gallery_content($attr){

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
	  $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	  if ( ! $attr['orderby'] ) {
	    unset( $attr['orderby'] );
	  }
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts = shortcode_atts( array(
	  'order'      => 'ASC',
	  'orderby'    => 'menu_order ID',
	  'id'         => $post ? $post->ID : 0,
	  'itemtag'    => $html5 ? 'figure'     : 'dl',
	  'icontag'    => $html5 ? 'div'        : 'dt',
	  'captiontag' => $html5 ? 'figcaption' : 'dd',
	  'columns'    => 3,
	  'size'       => 'thumbnail',
	  'include'    => '',
	  'exclude'    => '',
	  'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );
	if ( 'RAND' == $atts['order'] ) { $atts['orderby'] = 'none'; }

	if ( ! empty( $atts['include'] ) ) {
	  $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	  $attachments = array();
	  foreach ( $_attachments as $key => $val ) { $attachments[$val->ID] = $_attachments[$key]; }
	} elseif ( ! empty( $atts['exclude'] ) ) {
	  $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
	  $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) { return ''; }

	if ( is_feed() ) {
	  $output = "\n";
	  foreach ( $attachments as $att_id => $attachment ) {
	    $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
	  }
	  return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
	  $itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
	  $captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
	  $icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';

	$size_class = sanitize_html_class( $atts['size'] );
	$gallery_side = 'right';
	if ($attr['caption_side']) { $gallery_side = $attr['caption_side']; }

	$output = "<div id='$selector' class='gallery gallery--cols-{$columns} gallery--size-{$size_class} gallery--caption-side-{$gallery_side}'>";

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

	  	$image_url_output 		= get_attachment_as_url( $id, $atts['size'], true);
	  	$image_html_output 		= wp_get_attachment_image( $id, $atts['size'], true );
	  	$image_meta  			= wp_get_attachment_metadata( $id );

	  	if ( $captiontag && trim($attachment->post_excerpt) ) {
	  		$captions .= "<div class='gallery__caption'>" . wptexturize($attachment->post_excerpt) . "</div>";
		}

		$items .= "<div class=\"gallery__item\">";
	 	$items .= "<dt class=\"gallery__item__image\" style=\"background-image: url('$image_url_output')\"><dfn>$image_html_output</dfn></dt>";
	  	$items .= "<dd>" . wptexturize($attachment->post_excerpt) . "</dd>";
	  	$items .= "</div>";
	}

	$output .= "<dl class=\"gallery__items\">$items</dl>
	<div class=\"gallery__captions\">$captions
		<button type=\"button\" data-role=\"none\" class=\"gallery__control gallery__control--prev\"><span class=\"icon icon--prev\"></span>Prev</button>
		<button type=\"button\" data-role=\"none\" class=\"gallery__control gallery__control--next\">Next<span class=\"icon icon--next\"></span></button>
	</div>";
	$output .= "</div>\n";
	
	return $output;
}

// Filter attachments - remove dimensions.
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Change Image tag class
add_filter('get_image_tag_class', 'my_image_class_filter', 0, 4);
function my_image_class_filter($class, $id, $align, $size) {
	return 'attachment__image attachment__image--' . $id . ' attachment--' . $align . ' attachment--' . $size;
}

// Filter attachments with captions.
add_filter( 'img_caption_shortcode', 'edit_caption_shortcode', 10, 3 );
function edit_caption_shortcode($empty, $attr, $content) {

	$attr = shortcode_atts( array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	), $attr );

	if ( 1 > (int) $attr['width'] || empty( $attr['caption'] ) ) { return ''; }
	if ( $attr['id'] ) { $attr['id'] = 'id="' . esc_attr( $attr['id'] ) . '" '; }

	$attrib_width = esc_attr( $attr['width'] );
	
	
	if ($attr['width'] > 1200) {
		$caption_width = 'full-width';
	}else{
		$caption_width = $attrib_width;
	}

	return '<div ' . $attr['id'] .
	'class="attachment attachment--has-caption attachment--' . esc_attr( $attr['align'] ) . ' attachment--w-' . $caption_width . ' ">' .
	do_shortcode( $content ) .
	'<p class="attachment__caption">' . $attr['caption'] . '</p>' .
	'</div>';
}

/****************
CUSTOM SHORTCODES
*****************/
// function firedog_full_width_image( $atts, $content = null ) {
// 	extract( shortcode_atts( array('url' => ''), $atts ) );
//    	return '<div class="full-width-image"><div style="background-image: url(' . $url . ');"></div></div>';
// }

// add_action( 'init', 'firedog_register_shortcodes');
// function firedog_register_shortcodes(){
//    add_shortcode('full_width_image', 'firedog_full_width_image');
// }

// // Add Shortcode Controls to MCE
// add_action( 'init', 'firedog_buttons' );
// function firedog_buttons() {
//     add_filter( "mce_external_plugins", "firedog_add_buttons" );
//     add_filter( 'mce_buttons', 'firedog_register_buttons' );
// }

// function firedog_add_buttons( $plugin_array ) {
//     $plugin_array['firedog_btns'] = get_template_directory_uri() . '/library/js/plugins/wp_custom_tinyMCE_controls.js';
//     return $plugin_array;
// }

// function firedog_register_buttons( $buttons ) {
//     array_push( $buttons, 'full_width_image' );
//     return $buttons;
// }

/********************
RANDOM CLEANUP ITEMS
*********************/
// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function firedog_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'firedog_filter_ptags_on_images');

// This removes the annoying […] to a Read More link
function firedog_excerpt_more($more){
	global $post;
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'firedog' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'firedog' ) .'</a>';
}

add_action('print_media_templates', 'add_caption_side_control_to_gallery');
function add_caption_side_control_to_gallery(){ ?>
	<script type="text/html" id="tmpl-caption-side-gallery-setting">
		<label class="setting">
			<span><?php _e('Caption Side', 'firedog'); ?></span>
			<select data-setting="caption_side">
				<option value="right">Right</option>
				<option value="left">Left</option>        
				<option value="bottom">Bottom</option>        
			</select>
		</label>
	</script>
	<script>
	    jQuery(document).ready(function(){
			_.extend(wp.media.gallery.defaults, { caption_side: 'right' });
			wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
				template: function(view){
				  	return wp.media.template('gallery-settings')(view)
				       	+ wp.media.template('caption-side-gallery-setting')(view);
				}
			});
	    });
  	</script>

<?php } ?>
