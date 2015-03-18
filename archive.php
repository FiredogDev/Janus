<?php get_header(); ?>

<main id="main" class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

  <header class="article-header hero_unit wrap cf">
    <div class="hero_unit__wrapper width--full cf">
      <div class="hero_unit__header cf">
        <h1 class="hero_unit__title text-center width--full" itemprop="headline">
          <!-- Main title -->
          <span class="hero_unit__title--main"><?php single_cat_title(""); ?></span>
        </h1>
      </div>
      <div class="hero_unit__copy" itemprop="articleBody">
        <?php
        // the content
        the_archive_description(); ?>
      </div>
    </div>
  </header><?php // end article header ?>
              
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php get_template_part('partials/hentry/block', 'post'); ?>

  <?php endwhile; endif; ?>

</main>


<?php get_footer(); ?>
