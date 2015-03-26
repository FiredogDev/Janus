<?php 
$post_type = $post->post_type;

$post_is_featured = $post->fd_is_featured;

$additional_classes = 'hentry--as-row prel cf';

if ($post_is_featured) {
	$additional_classes .= " hentry--is-featured";
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_classes ); ?> role="article">
	
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
		

</article>