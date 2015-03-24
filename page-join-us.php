<?php get_header(); ?>

	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!-- PAGE HEADER -->
			<div class="hero_unit wrap">
			
				<header class="article-header cf">
					<div class="hero_unit__wrapper width--full cf">
						<div class="hero_unit__header cf">
							<h1 class="hero_unit__title text-center width--full" itemprop="headline">
								<!-- Main title -->
								<span class="hero_unit__title--main"><?php the_title(); ?><span id="join-us-easter-egg">?</span></span>
							</h1>
						</div>
					</div>

					<!-- Background Image/Video -->
					<!-- <div class="hero_unit__bgmedia pabs pcover">
						<video autoplay loop muted class="hero_unit__bgmedia__video pabs pcover">
					        <source src="<?php echo get_template_directory_uri(); ?>/library/video/joinus.mp4" type="video/mp4">
					        <source src="<?php echo get_template_directory_uri(); ?>/library/video/joinus.ogv" type="video/ogg">
					    </video>
					</div> -->

				</header><?php // end article header ?>
				
				<div class="hero_unit__copy cf" itemprop="articleBody">
					<?php
					// Page Content
					the_content(); ?>
				</div><?php // end article section ?>
			
			</div>
			<?php endwhile; endif; ?>

			<section id="join-us__articles" class="hentry__listing hentry__listing--rows hentry__listing--join-us cf fl width--full">
				<div class="wrap cf">
					<?php
					$args = array(
						'post_type' => 'post',
						'category_name' => 'current-roles, graduates, insights'
					);
					$the_query = new WP_Query( $args );
					if ($the_query->have_posts()) : 
						while ($the_query->have_posts()) : 
							$the_query->the_post();
							get_template_part('partials/hentry/post/as', 'row');
						endwhile; 
					endif; ?>
				</div>
			</section>

			<footer class="article-footer cf"></footer>

		</article>


		

	</main>

<?php get_footer(); ?>

