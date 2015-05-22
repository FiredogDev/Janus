<?php get_header(); ?>

	<main id="main" class="main cf template--default" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'width--full cf article case_study' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
				<?php get_template_part('partials/case_study/part', 'header'); ?>
				
				<div class="article__body case_study__body wrap cf">
					<?php the_content(); ?>
				</div>

			</article>

		<?php endwhile; endif; ?>
		
	</main>

<?php get_footer(); ?>