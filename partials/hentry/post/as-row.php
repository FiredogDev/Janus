<?php 
$post_type = $post->post_type;

$post_is_featured = $post->fd_is_featured;

$additional_classes = 'hentry--as-row prel cf';

if ($post_is_featured) {
	$additional_classes .= " is--featured";
} ?>

<article 
	id="post-<?php the_ID(); ?>" 
	<?php post_class( $additional_classes ); ?> 
	role="article">
		

			<?php if (has_post_thumbnail() && $post_is_featured){ ?>
				<a  class="cf width--full" 
					href="<?php the_permalink() ?>" 
					rel="bookmark" 
					title="<?php the_title_attribute(); ?>">
					<?php
					// Thumb ID
					$post_thumb_id 			= get_post_thumbnail_id($post->ID);
					//Get Alt...
					$post_thumb 			= get_post($post_thumb_id);
					$post_thumb_desc 		= $post_thumb->post_content;
					// Sizes...
					$featured_image_small 	= wp_get_attachment_image_src( $post_thumb_id );
					$featured_image_med 	= wp_get_attachment_image_src( $post_thumb_id, 'medium' );
					$featured_image_lrg 	= wp_get_attachment_image_src( $post_thumb_id, 'large' );
					$featured_image_full 	= wp_get_attachment_image_src( $post_thumb_id, 'full' ); ?>
					
					<img 
					class="hentry__featured_image width--full" 
					src="<?php echo $featured_image_small['0']; ?>" 
					alt="<?php echo $post_thumb_desc; ?>"
					srcset="<?php echo $featured_image_small['0']; 	//Small ?> 	320w,
							<?php echo $featured_image_med['0']; 	//Medium ?> 800w,
							<?php echo $featured_image_lrg['0']; 	//Large ?> 	1200w,
							<?php echo $featured_image_full['0']; 	//Full ?> 	1600w">
				</a>
			<?php } //end if ?>


			<?php if ($post_is_featured){ ?>
				<div class="hentry__title_wrapper--outer fl width--full">
			<?php } ?>

			
			<div class="hentry__title_wrapper cf prel">

				<!-- Hentry Footer -->
				<footer class="hentry__footer cf">
					<!-- Hentry Meta -->
					<p class="hentry__meta">
						<?php // CATEGORY, BYLINE & COMMENT COUNT
						get_template_part( 'partials/hentry/meta/meta', 'category' );
						get_template_part( 'partials/hentry/meta/meta', 'pub-date' );
						get_template_part( 'partials/hentry/meta/meta', 'byline' );
						get_template_part( 'partials/hentry/meta/meta', 'comment-count' ); ?>
					</p>
				</footer>

				<!-- Hentry Header -->
				<header class="hentry__header">
					<!-- Hentry Title -->
					<h3 class="hentry__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</header>
				
				<!-- Hentry Excerpt -->
				<section class="hentry__excerpt cf">
					<?php the_excerpt(); ?>
				</section>

			</div>


			<?php if ($post_is_featured){ ?>
				<button type="button" data-role="none" 
				class="slider__control slider__control--next slider__control--in_slide slider__control--in_slide--next">
					<span class="slider__control__text">Next</span>
					<span class="slider__control__icon icon-arrow--right"></span>
				</button>
				<button type="button" data-role="none" class="slider__control slider__control--prev slider__control--in_slide slider__control--in_slide--prev">
					<span class="slider__control__text">Prev</span>
					<span class="slider__control__icon icon-arrow--left"></span>
				</button>
			</div>
			<?php } ?>


</article>