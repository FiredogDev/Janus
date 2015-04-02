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
				</header><?php // end article header ?>
				
				<div class="hero_unit__copy cf" itemprop="articleBody">
					<?php
					// Page Content
					the_content(); ?>
				</div><?php // end article section ?>
			</div>

			<?php endwhile; endif; ?>
			

			<section id="join-us__articles" class="hentry__listing hentry__listing--rows hentry__listing--join-us cf fl width--full">
					<?php
					$args = array(
						'posts_per_page' => 1,
						'post_type' => 'post',
						'category_name' => 'current-roles, graduates, insights',
						'post__not_in' => $sticky,
					);
					$the_query = new WP_Query( $args );
					if ($the_query->have_posts()) : 
						while ($the_query->have_posts()) : 
							$the_query->the_post();
							print_r($post->fd_is_featured);
							get_template_part('partials/hentry/post/as', 'row');
						endwhile; 
					endif; ?>
			</section>

			<div class="viewmore">
				<div class="viewmore__fill"></div>
				<div class="viewmore__mask viewmore__mask--1"></div>
				<div class="viewmore__mask viewmore__mask--2"></div>
				<div class="viewmore__btn">
					<div class="viewmore__btn__label">MORE THOUGHTS</div>
				</div>
				<div class="viewmore__mask viewmore__mask--3"></div>
				<div class="viewmore__mask viewmore__mask--4"></div>
			</div>

			<footer class="article-footer cf"></footer>

		</article>


		

	</main>

<?php get_footer(); ?>

