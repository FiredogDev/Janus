<?php get_header(); ?>
	
	<?php
	$thinking_space_id = 183;
	$thinking_space = get_post($thinking_space_id); ?>
	<main id="main" class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		
		<header class="article-header hero_unit wrap cf">
			<div class="hero_unit__wrapper width--full cf">
				<div class="hero_unit__header cf">
					<h1 class="hero_unit__title text-center width--full" itemprop="headline">
						<!-- Main title -->
						<span class="hero_unit__title--main width--full fl"><?php echo $thinking_space->post_title; ?></span>
					</h1>
				</div>
				<div class="hero_unit__copy" itemprop="articleBody">
					<?php echo apply_filters('the_content', $thinking_space->post_content); ?>
				</div>
			</div>
		</header><?php // end article header ?>

		<section id="thinking_space_articles" class="hentry_listing hentry_listing--thinking-space cf fl width--full">
			
			<?php
			$args = array(
				'post_type' => 'post',
				'category_name' => 'news, features, work'
			);
			$the_query = new WP_Query( $args );
			if ($the_query->have_posts()) : 
				while ($the_query->have_posts()) : 
					$the_query->the_post();
					get_template_part('partials/hentry/post/as', 'row');
			endwhile; 
			endif; ?>

		</section>

	</main>

<?php get_footer(); ?>
