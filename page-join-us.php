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
				<?php while ( $sticky_post_query->have_posts() ) {
					$sticky_post_query->the_post();
					$post->fd_is_featured = true; ?>

					<section id="join-us__articles--featured" class="hentry__listing hentry__listing--rows hentry__listing--slider hentry__listing--join-us cf fl width--full">
					<?php get_template_part('partials/hentry/post/as', 'row'); ?>
					</section>

				<?php } // endwhile;
			} // endif; ?>


			<section id="join-us__articles" class="hentry__listing hentry__listing--rows hentry__listing--join-us cf fl width--full">
				<div class="wrap cf">
					<?php
					$args = array(
						'post_type' => 'post',
						'category_name' => 'current-roles, graduates, insights',
						'post__not_in' => $sticky,
					);
					$the_query = new WP_Query( $args );
					if ($the_query->have_posts()) : 
						while ($the_query->have_posts()) : 
							$the_query->the_post();
							//get_template_part('partials/hentry/post/as', 'row');
						endwhile; 
					endif; ?>
				</div>
			</section>

			<footer class="article-footer cf"></footer>

		</article>


		

	</main>

<?php get_footer(); ?>

