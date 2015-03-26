<?php
// Retrieve post as blog entry or block entry.
global $frd_hentry_as;
$post_type_dir = 'partials/hentry/' . $frd_hentry_as;

$sticky = get_option( 'sticky_posts' );


print_r($sticky);

$args = array(
	'post_type' => array('post', 'learn', 'our_work'),
	'post__in' => $sticky
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) { ?>

	<div class="hentry__listing width--full cf">
		<?php while ( $the_query->have_posts() ) {
			
			$the_query->the_post();

		} // endwhile; ?>
	</div>

<?php
} // endif; ?>