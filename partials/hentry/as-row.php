<?php 
$post_type = $post->post_type;
$post_class_string = 'hentry--as-row prel fl cf';
$show_byline = $post_type != "our_work"; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class_string ); ?> role="article">
	
	<!-- Hentry Header -->
	<header class="hentry__header">
		<!-- Hentry Title -->
		<h3 class="hentry__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	</header>
	
	<!-- Hentry Excerpt -->
	<section class="hentry__excerpt cf">
		<?php the_excerpt(); ?>
	</section>
	
	<!-- Hentry Footer -->
	<footer class="hentry__footer cf">
		<!-- Hentry Meta -->
		<p class="hentry__meta">
			<?php // CATEGORY & COMMENT COUNT
			get_template_part( 'partials/hentry/meta/meta', 'category' );
			echo "<span class=\"hentry__meta__separator\"> | </span>";
			get_template_part( 'partials/hentry/meta/meta', 'comment_count' ); ?>
		</p>
	</footer>

</article>