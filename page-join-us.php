<?php get_header(); ?>

	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!-- PAGE HEADER -->
			<header class="article-header hero_unit wrap cf">
				<div class="hero_unit__wrapper width--full cf">
					<div class="hero_unit__header cf">
						<h1 class="hero_unit__title text-center width--full" itemprop="headline">
							<!-- Main title -->
							<span class="hero_unit__title--main"><?php the_title(); ?><span id="join-us-easter-egg">?</span></span>
						</h1>
					</div>

					<div class="hero_unit__copy cf" itemprop="articleBody">
						<?php
						// Page Content
						the_content(); ?>
					</div><?php // end article section ?>
				</div>
			</header><?php // end article header ?>

			<?php endwhile; endif; ?>
			
			<!-- Featured Slider -->
			<?php
			$sticky_posts = get_option( 'sticky_posts' );
			$args = array(
				'posts_per_page' => -1,
				'category_name' => 'current-roles, graduates, insights',
				'post_type' => 'post',
				'post__in' => $sticky_posts,
				'ignore_sticky_posts' => 1
			);
			$sticky_post_query = new WP_Query( $args );

			if ( $sticky_post_query->have_posts() ) { ?>
				<section id="join-us__articles--featured" class="hentry__listing hentry__listing--slider hentry__listing--join-us cf fl width--full">
					<div class="js-slick--featured-posts">
					<?php while ( $sticky_post_query->have_posts() ) {
						$sticky_post_query->the_post();
						$post->fd_is_featured = true; ?>
						<?php get_template_part('partials/hentry/post/as', 'row'); ?>
					<?php } ?>
					</div>
					<button type="button" data-role="none" class="slider__control slider__control--next slider__control--global slider__control--global--next">
						<span class="slider__control__text">Next</span><span class="slider__control__icon icon-arrow--right"></span>
					</button>
					<button type="button" data-role="none" class="slider__control slider__control--prev slider__control--global slider__control--global--prev">
						<span class="slider__control__text">Prev</span><span class="slider__control__icon icon-arrow--left"></span>
					</button>
				</section>
			<?php } // endif; ?>

			<section id="join-us__articles" class="hentry__listing hentry__listing--rows hentry__listing--join-us cf fl width--full">
					<?php
					$sticky = get_option( 'sticky_posts' );
					$args = array(
						'posts_per_page' => 8,
						'post_type' => 'post',
						'category_name' => 'current-roles, graduates, insights',
						'post__not_in' => $sticky,
					);
					$the_query = new WP_Query( $args );
					if ($the_query->have_posts()) : 
						while ($the_query->have_posts()) : 
							$the_query->the_post();
							get_template_part('partials/hentry/post/as', 'row');
						endwhile; 
					endif; ?>

					<div class="viewmore viewmore--black cf" data-args='{"posts_per_page":"8","category_name":"[current-roles,graduates,insights]","post_status":"publish","orderby":"date","order":"desc"}'>
						<script>var sticky_posts = <?php echo json_encode($sticky); ?>;</script>
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

			

			<footer class="article-footer cf"></footer>

		</article>


		

	</main>

<?php get_footer(); ?>

