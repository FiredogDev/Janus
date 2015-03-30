<?php

$args = array(
	'post_type' => array('our_work'),
	'posts_per_page' => 5
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) { ?>

	<div class="showcase__wall hoverboard pabs full_height">
		<?php while ( $the_query->have_posts() ) {
			
			$the_query->the_post();
			get_template_part('partials/hentry/post/as' , 'showcase');

		} // endwhile; ?>
	</div>

<?php
} // endif; ?>