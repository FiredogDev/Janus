<?php get_header(); ?>

	<main id="main" class="width--full fl" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<section id="intro" class="hero_unit wrap cf">

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'hero_unit__wrapper width--full fl cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
				<!-- Hentry Header -->
				<header class="hero_unit__header cf hide">

					<!-- Hentry Meta -->
					<p class="hentry__meta">
						<?php // CATEGORY & BYLINE
						get_template_part( 'partials/hentry/meta/meta', 'category' );
						echo "<span class=\"hentry__meta__separator\"> | </span>";
						get_template_part( "partials/hentry/meta/meta", 'byline' ); ?>
					</p>
					<h1 class="hero_unit__title" itemprop="headline">
						<!-- Super title -->
						<span class="hero_unit__title--super">Our Thinking:</span><br>
						<!-- Main title -->
						<span class="hero_unit__title--main"><?php the_title(); ?></span>
					</h1>
				</header>

				<div class="hero_unit__copy" itemprop="articleBody">
					<?php
					// the content
					the_content(); ?>
				</div>

				<footer class="hero_unit__footer cf">
					<!-- Sub navigation/filters -->
				</footer>

			</article>
			<!-- Background Image/Video -->
			<div class="hero_unit__bgmedia pabs pcover">
				<!-- <video autoplay loop muted class="hero_unit__bgmedia pabs pcover">
			        <source src="<?php echo get_template_directory_uri(); ?>/library/video/joinus.mp4" type="video/mp4">
			        <source src="<?php echo get_template_directory_uri(); ?>/library/video/joinus.ogv" type="video/ogg">
			    </video> -->
			</div>

		</section>

		<?php endwhile; endif; ?>
		
		<section id="latest" class="latest fl width--full">

			<?php get_template_part( 'loops/loop', 'latest' ); ?>

		</section>

	</main>

<?php get_footer(); ?>
