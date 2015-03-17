<?php
// Template name: case studies
// ?>
<?php get_header(); ?>

	<main id="main" class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<header class="article-header hero_unit wrap cf">
				<div class="hero_unit__wrapper width--full cf">
					<div class="hero_unit__header cf">
						<h1 class="hero_unit__title text-center width--full" itemprop="headline">
							<!-- Main title -->
							<span class="hero_unit__title--main"><?php the_title(); ?></span>
						</h1>
					</div>
					<div class="hero_unit__copy" itemprop="articleBody">
						<?php
						// the content
						the_content(); ?>
					</div>
				</div>
			</header><?php // end article header ?>

			<section class="entry-content cf" itemprop="articleBody">

			</section><?php // end article section ?>

			<footer class="article-footer cf"></footer>

		</article>

		<?php endwhile; ?>

		<?php endif; ?>

	</main>

<?php get_footer(); ?>
