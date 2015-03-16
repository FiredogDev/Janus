<?php get_header(); ?>

	<main id="main" class="width--full fl" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<section id="intro" class="hero_unit cf">

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'hero_unit__wrapper width--full fl cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			
				<header class="hero_unit__header cf hide">
					<!-- Categoriszation -->
					<div class="hero_unit__category_byline">
						<p class="hentry__byline vcard">
							<span class="hentry__author">
								<span class="hentry__author__label">Feature Article | </span>
								<span class="hentry__author__label">Words: </span>
								<span class="hentry__author__title" itemprop="author" itemscope itemptype="http://schema.org/Person">
									<?php the_author_posts_link() ?>, 
								</span>
								<span class="hentry__author__location">LDN.</span>
							</span>
							<?php /* the time the post was published */ ?>
							<time class="hentry__pub_time" datetime="<?php echo get_the_time('Y-m-d'); ?>" itemprop="datePublished"><?php echo get_the_time(get_option('date_format')); ?> </time>
						</p>
					</div>

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

			<?php
			// Retrieve post as blog entry or block entry.
			$args = array(
				'post_type' => array('post', 'learn', 'our_work'),
				'posts_per_page' => 4
			);
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) { ?>

				<div class="hentry__listing width--full cf">
					<?php while ( $the_query->have_posts() ) {
						
						$the_query->the_post();
						get_template_part('partials/hentry/block', 'post');

					} // endwhile; ?>
				</div>

			<?php } // endif; ?>

		</section>

	</main>

<?php get_footer(); ?>
