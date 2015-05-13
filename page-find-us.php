<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>

	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf prel' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			
			<div class="prel">

				<div class="white-box wrap">

					<header class="article-header hero_unit cf">
						<div class="hero_unit__wrapper width--full cf">
							<div class="hero_unit__header cf">
								<h1 class="hero_unit__title width--full" itemprop="headline">
									<!-- Main title -->
									<span class="hero_unit__title--main fl"><?php the_title(); ?></span>
								</h1>
							</div>
						</div>
					</header><?php // end article header ?>

					<section class="entry-content cf" itemprop="articleBody">

							<?php
							// the content
							the_content(); ?>
						
					</section><?php // end article section ?>

				</div>

				<!-- Street View -->
				<div id="street-view-canvas" class="street-view"></div>

			</div>

			<!-- Map View -->
			<div id="map-canvas" class="map-view" data-lng="-0.08073" data-lat="51.527284" data-title="Firedog Creative" data-marketiconurl="<?php echo get_template_directory_uri(); ?>/library/images/google-map-icon.jpg"></div>

		</article>

		<?php endwhile; ?>

	</main>

	<?php endif; ?>

<?php get_footer(); ?>
