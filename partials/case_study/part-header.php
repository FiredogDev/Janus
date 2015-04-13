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
$featured_image_full 	= wp_get_attachment_image_src( $post_thumb_id, 'full' );


?>
<img 
class="case_study__featured_image width--full" 
src="<?php echo $featured_image_small['0']; ?>" 
alt="<?php echo $post_thumb_desc; ?>"
srcset="<?php echo $featured_image_small['0']; 	//Small ?> 	400w,
		<?php echo $featured_image_med['0']; 	//Medium ?> 800w,
		<?php echo $featured_image_lrg['0']; 	//Large ?> 	1200w,
		<?php echo $featured_image_full['0']; 	//Full ?> 	1600w" >

<header class="case_study__header wrap cf">
	<h1 class="case_study__title width--full"><?php the_title(); ?></h1>
	<h2 class="case_study__title width--full" itemprop="headline">
		<?php get_field('cs_article_title'); ?>
	</h2>
	<?php the_excerpt(); ?>
</header>