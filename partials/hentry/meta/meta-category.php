<?php
if ($post->type = 'post') {
	$meta__post_title_prefix = "Our Thinking: ";
}else{
	$meta__post_title_prefix = "Case Study: ";
} ?>
<span class="hentry__meta__category">
	<span class="hentry__meta__entry_prefix"><?php echo $meta__post_type; ?></span>
	<?php echo get_the_category_list(', '); ?>
</span>