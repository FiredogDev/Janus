<?php if (has_post_thumbnail()){
	// Thumb ID
	$post_thumb_id 			= get_post_thumbnail_id($post->ID);
	// Sizes...
	$featured_image_large 	= wp_get_attachment_image_src( $post_thumb_id, 'large' );
} //end if ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "showcase__entry hoverboard__entry full_height prel fl" ); ?> role="article">
	<a 	href="<?php the_permalink(); ?>"
		rel="bookmark" 
		title="<?php the_title_attribute(); ?>" 
		class="pabs pcover showcase__entry__featured_image"
		style="background-image: url(<?php echo $featured_image_large['0']; //Large ?>);" >
	</a>

	<header class="hentry__header showcase__entry__header pabs">
		<p class="hentry__meta">
			<?php // CATEGORY & BYLINE
			echo "Case Study: ";
			get_template_part( 'partials/hentry/meta/meta', 'clientname' ); ?>
		</p>
		<h3 class="hentry__title showcase__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	</header>
</article>
