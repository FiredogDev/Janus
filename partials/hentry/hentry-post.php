<?php 
$post_type = $post->post_type;
$post_class_string = 'hentry--as-entry prel fl cf';
$show_byline = $post_type != "our_work"; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class_string ); ?> role="article">

	<header class="hentry__header">
		<p class="hentry__byline vcard">
			<span class="hentry__author">
				<span class="hentry__author__label"><?php echo get_the_category_list(','); ?> |</span>
				<span class="hentry__author__label">Words: </span>
				<span class="hentry__author__title" itemprop="author" itemscope itemptype="http://schema.org/Person">
					<?php the_author_posts_link() ?>, 
				</span>
				<span class="hentry__author__location">LDN.</span>
			</span>
			<?php /* the time the post was published */ ?>
			<time class="hentry__pub_time" datetime="<?php echo get_the_time('Y-m-d'); ?>" itemprop="datePublished"><?php echo get_the_time(get_option('date_format')); ?> </time>
		</p>
		<h3 class="hentry__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	</header>

	<section class="entry-content cf">
		<?php the_excerpt(); ?>
	</section>

	<footer class="article-footer cf">
		<p class="footer-comment-count">
			<?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) );?>
		</p>

	</footer>

	
</article>