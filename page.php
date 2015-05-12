<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
		
	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<header class="article-header hero_unit wrap cf">
				<div class="hero_unit__wrapper width--full cf">
					<div class="hero_unit__header cf">
						<h1 class="hero_unit__title text-center width--full" itemprop="headline">
							<!-- Main title -->
							<span class="hero_unit__title--main"><?php the_title(); ?></span>
						</h1>
					</div>
				</div>
			</header><?php // end article header ?>

			<section class="entry-content cf" itemprop="articleBody">
				<?php
				// the content
				the_content(); ?>
			</section><?php // end article section ?>

		</article>

		<?php endwhile; ?>

	</main>

	<?php endif; ?>

<?php get_footer(); ?>
