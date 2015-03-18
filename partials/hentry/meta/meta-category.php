<?php
if ($post->type = 'post') { $meta__post_type = "Our Thinking: "; }
else{ $meta__post_type = "Case Study: "; } ?>
<span class="hentry__meta__category">
	<span class="hentry__meta__post_type"><?php echo $meta__post_type; ?></span>
	<?php echo get_the_category_list(', '); ?>
</span>