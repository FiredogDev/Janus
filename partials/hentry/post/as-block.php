<?php 
$post_type = $post->post_type;
$post_class_string = 'hentry--as-block prel fl cf';
$show_byline = $post_type != "our_work"; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class_string ); ?> role="article">

	<header class="hentry__header pabs">
		<p class="hentry__meta">
			<?php // CATEGORY & BYLINE
			get_template_part( 'partials/hentry/meta/meta', 'category' ); ?>
		</p>
		<h3 class="hentry__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	</header>
	
	<?php if (has_post_thumbnail()){
		// Thumb ID
		$post_thumb_id 			= get_post_thumbnail_id($post->ID);
		// Sizes...
		$featured_image_small 	= wp_get_attachment_image_src( $post_thumb_id );
		$featured_image_med 	= wp_get_attachment_image_src( $post_thumb_id, 'medium' );
	?>
	<a  class="fl pabs pcover hentry__featured_img" 
		href="<?php the_permalink() ?>" 
		rel="bookmark" 
		title="<?php the_title_attribute(); ?>"
		style="background-image: url(<?php echo $featured_image_med['0']; //Medium ?>);" >
		<?php
		// // Thumb ID
		// $post_thumb_id 			= get_post_thumbnail_id($post->ID);
		// //Get Alt...
		// $post_thumb 				= get_post($post_thumb_id);
		// $post_thumb_desc 		= $post_thumb->post_content;
		// // Sizes...
		// $featured_image_small 	= wp_get_attachment_image_src( $post_thumb_id );
		// $featured_image_med 		= wp_get_attachment_image_src( $post_thumb_id, 'medium' ); ?>
		
		<!-- <img 
		class="hentry__featured_img fl" src="<?php echo $featured_image_small['0']; ?>" 
		alt="<?php echo $post_thumb_desc; ?>"
		sizes="(min-width: 800px) 60vw, 100vw"
		srcset="<?php echo $featured_image_small['0']; //Small ?> 600w,
				<?php echo $featured_image_med['0']; //Medium ?> 800w"> -->
	</a>
	<?php } //end if ?>

</article>