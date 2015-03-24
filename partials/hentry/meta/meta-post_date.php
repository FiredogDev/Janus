<?php /* the time the post was published */ ?>
<time class="hentry__meta__pubtime" datetime="<?php echo get_the_time('Y-m-d'); ?>" itemprop="datePublished">
<span class="hentry__meta__separator"> | </span><?php echo get_the_time(get_option('date_format')); ?> </time>