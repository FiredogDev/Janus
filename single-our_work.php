<?php get_header(); ?>

	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'width--full cf case_study' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				<?php get_template_part('partials/case_study/part', 'header'); ?>
				<?php //the_content(); ?>
			</article>

		<?php endwhile; endif; ?>
		
	</main>

<?php get_footer(); ?>
