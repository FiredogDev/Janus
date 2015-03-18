<span class="hentry__meta__author">
	<span class="hentry__meta__author__label">Words: </span>
	<span class="hentry__meta__author__title" itemprop="author" itemscope itemptype="http://schema.org/Person">
		<?php the_author_posts_link() ?>, 
	</span>
	<span class="hentry__meta__location">LDN.</span>
</span>
<?php /* the time the post was published */ ?>
<time class="hentry__meta__pubtime" datetime="<?php echo get_the_time('Y-m-d'); ?>" itemprop="datePublished"><?php echo get_the_time(get_option('date_format')); ?> </time>