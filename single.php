<?php get_header(); ?>

	<main id="main" class="width--full fl" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'width--full cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			
				<header class="article-header hero_unit wrap cf">
					<div class="hero_unit__wrapper width--full cf">
						<div class="hero_unit__header cf">
							<!-- Hentry Meta -->
							<p class="hentry__meta">
								<?php // CATEGORY & BYLINE
								get_template_part( 'partials/hentry/meta/meta', 'category' );
								echo "<span class=\"hentry__meta__separator\"> | </span>";
								get_template_part( "partials/hentry/meta/meta", 'byline' ); ?>
							</p>
							<h1 class="hero_unit__title text-center width--full" itemprop="headline">
								<!-- Main title -->
								<span class="hero_unit__title--main width--full fl"><?php the_title(); ?></span>
							</h1>
						</div>
						<div class="hero_unit__copy text-center width--full">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</header>

			</article>

		<?php endwhile; endif; ?>
		
	</main>

<?php get_footer(); ?>
