<?php

// Retrieve post as blog entry or block entry.
global $frd_hentry_as,
	   $number_of_posts;
$post_type_dir = 'partials/hentry/' . $frd_hentry_as;

$args = array(
	'post_type' => array('post', 'learn', 'our_work')
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) { ?>

	<div class="hentry__listing width--full cf">
		<?php while ( $the_query->have_posts() ) {
			
			$the_query->the_post();
			get_template_part( $post_type_dir , 'post' );

		} // endwhile; ?>
	</div>

<?php
} else {


} // endif; ?>