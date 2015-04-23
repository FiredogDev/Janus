<?php get_header(); ?>

<?php
	$terms = wp_get_post_terms( $post->ID, 'levels');
	foreach ($terms as $term) { 
		$template_slug = $term->slug;
	}
?>
	<main id="main" class="main cf template--<?php echo $template_slug; ?>" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php 
			// Thumb ID
			$post_thumb_id 				= 	get_post_thumbnail_id($post->ID);

			if ($post_thumb_id) {
				//Get Alt...
				$post_thumb 			= 	get_post($post_thumb_id);
				$post_thumb_desc 		= 	$post_thumb->post_content;
				// Sizes...
				$featured_image_small 	= 	wp_get_attachment_image_src( $post_thumb_id );
				$featured_image_med 	= 	wp_get_attachment_image_src( $post_thumb_id, 'medium' );
				$featured_image_lrg 	= 	wp_get_attachment_image_src( $post_thumb_id, 'large' );
				$featured_image_full 	= 	wp_get_attachment_image_src( $post_thumb_id, 'full' ); ?>

			<img class="case_study__featured_image width--full" 
			src="<?php echo $featured_image_small['0']; ?>" 
			alt="<?php echo $post_thumb_desc; ?>"
			srcset="<?php echo $featured_image_small['0']; 	//Small ?> 	400w,
					<?php echo $featured_image_med['0']; 	//Medium ?> 800w,
					<?php echo $featured_image_lrg['0']; 	//Large ?> 	1200w,
					<?php echo $featured_image_full['0']; 	//Full ?> 	1600w" >
			<?php } ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'width--full cf article case_study' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
				<?php get_template_part('partials/case_study/part', 'header'); ?>
				
				<div class="article__body case_study__body wrap cf">
					<?php the_content(); ?>
				</div>

			</article>

		<?php endwhile; endif; ?>
		
	</main>

<?php get_footer(); ?>