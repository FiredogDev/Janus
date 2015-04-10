<?php get_header(); ?>
	
	<?php
	$thinking_space_id = 183;
	$thinking_space = get_post($thinking_space_id); ?>
	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		
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

		<section id="thinking-space__articles" class="hentry__listing hentry__listing--rows hentry__listing--thinking-space cf fl width--full">
			
			<?php
			$sticky = get_option( 'sticky_posts' );
			$args = array(
				'posts_per_page' => 8,
				'post_type' => 'post',
				'category_name' => 'news, features, work, learn, white-paper',
				'post__not_in' => $sticky,
			);
			$the_query = new WP_Query( $args );
			if ($the_query->have_posts()) : 
				while ($the_query->have_posts()) : 
					$the_query->the_post();
					get_template_part('partials/hentry/post/as', 'row');
				endwhile; 
			endif; ?>

			<div class="viewmore viewmore--white cf" data-args='{"posts_per_page":"8","category_name":"[news,features,work,learn,white-paper]","post_status":"publish","orderby":"date","order":"desc"}'>
				<script id="query_arguments">
					var sticky_posts = <?php echo json_encode($sticky); ?>;
				</script>
				<div class="viewmore__fill"></div>
				<div class="viewmore__mask viewmore__mask--1"></div>
				<div class="viewmore__mask viewmore__mask--2"></div>
				<div class="viewmore__btn">
					<div class="viewmore__btn__label">MORE THOUGHTS</div>
				</div>
				<div class="viewmore__mask viewmore__mask--3"></div>
				<div class="viewmore__mask viewmore__mask--4"></div>
			</div>

		</section>

	</main>

<?php get_footer(); ?>
