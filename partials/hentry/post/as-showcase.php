<article id="post-<?php the_ID(); ?>" <?php post_class( "showcase__entry hoverboard__entry full_height prel fl" ); ?> role="article">
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="pabs pcover showcase__entry__permalink"></a>
	<header class="hentry__header showcase__entry__header pabs">
		<p class="hentry__meta">
			<?php // CATEGORY & BYLINE
			echo "Our Thinking: ";
			get_template_part( 'partials/hentry/meta/meta', 'category' ); ?>
		</p>
		<h3 class="hentry__title showcase__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	</header>
	
</article>
