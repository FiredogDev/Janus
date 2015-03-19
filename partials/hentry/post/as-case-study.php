<?php 
$post_type = $post->post_type;
$post_class_string = 'hentry--as-block prel fl cf'; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class_string ); ?> role="article">

	<header class="hentry__header pabs">
		<p class="hentry__meta">
			<?php // ASK SAM WHAT SHOULD GO HERE??? ?>
		</p>
		<h3 class="hentry__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	</header>
	
	<?php if (has_post_thumbnail()){
		// Thumb ID
		$post_thumb_id 			= get_post_thumbnail_id($post->ID);
		// Sizes...
		$featured_image_med 	= wp_get_attachment_image_src( $post_thumb_id, 'medium' ); ?>
		<a  class="fl pabs pcover hentry__featured_img" 
			href="<?php the_permalink(); ?>" 
			rel="bookmark" 
			title="<?php the_title_attribute(); ?>"
			style="background-image: url(<?php echo $featured_image_med['0']; ?>);" >
		</a>
	<?php } //end if ?>

</article>