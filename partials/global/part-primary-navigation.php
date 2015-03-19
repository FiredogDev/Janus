<nav id="primary_nav" class="navigation navigation--primary height--full pfix" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<?php wp_nav_menu(array(
		'container' => false,                           	// remove nav container
		'menu' => __( 'Primary Navigation', 'firedog' ),  	// nav name
		'menu_class' => 'navigation--list cf',              // adding custom nav class
		'theme_location' => 'primary-nav',                 	// where it's located in the theme
	)); ?>

	<p class="heading">Follow us</p>
	<ul class="list">
		<li class="item"><a href="#">Twitter</a></li>
		<li class="item"><a href="#">Facebook</a></li>
		<li class="item"><a href="#">Google+</a></li>
		<li class="item"><a href="#">Linkedin</a></li>
	</ul>
</nav>