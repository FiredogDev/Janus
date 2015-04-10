<?php
/*
 * Template Name: Showcase
 *
**/
?>
<?php get_header(); ?>

	<main id="main" class="main cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'overlay_panel cf' ); ?> role="article">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!-- PAGE HEADER -->
			<header class="overlay_panel__header cf">
				<h1 class="overlay_panel__title width--full" itemprop="headline">
					<?php the_title(); ?>
				</h1>
			</header><?php // end article header ?>
			
			<div class="overlay_panel__copy cf" itemprop="articleBody">
				<?php
				// Page Content
				the_content(); ?>
			</div><?php // end article section ?>

			<?php endwhile; endif; ?>

		</article>

		<section id="showcase" class="showcase ovh">

			<?php get_template_part( 'loops/loop', 'showcase' ); ?>
			
		</section>


	</main>
			
		
<?php get_footer(); ?>