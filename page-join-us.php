<?php get_header(); ?>

	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<header class="article-header hero_unit wrap cf">
				<div class="hero_unit__wrapper width--full cf">
					<div class="hero_unit__header cf">
						<h1 class="hero_unit__title text-center width--full" itemprop="headline">
							<!-- Main title -->
							<span class="hero_unit__title--main"><?php the_title(); ?><span id="join-us-easter-egg">?</span></span>
						</h1>
					</div>
					<div class="hero_unit__copy" itemprop="articleBody">
						<?php
						// the content
						the_content(); ?>
					</div>
				</div>

				<!-- Background Image/Video -->
				<div class="hero_unit__bgmedia pabs pcover">
					<video autoplay loop muted class="hero_unit__bgmedia__video pabs pcover">
				        <source src="<?php echo get_template_directory_uri(); ?>/library/video/joinus.mp4" type="video/mp4">
				        <source src="<?php echo get_template_directory_uri(); ?>/library/video/joinus.ogv" type="video/ogg">
				    </video>
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
