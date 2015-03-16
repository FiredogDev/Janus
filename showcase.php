<?php
/*
 * Template Name: Showcase
 *
**/
?>
<?php get_header(); ?>
		
		<section id="showcase" class="showcase pabs pcover ovh">
	
			<?php
			global $frd_hentry_as;
			$frd_hentry_as = 'block';
			get_template_part( 'loops/loop', 'showcase' ); ?>
			
		</section>

<?php get_footer(); ?>
