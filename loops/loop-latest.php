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
			get_template_part('partials/hentry/post/as', 'block');

		} // endwhile; ?>
	</div>

<?php } // endif; ?>