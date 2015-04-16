<!-- SHARE WIDGET -->
<?php $share_url = get_the_permalink(); ?>
<footer class="sharing">
	<ul class="sharing__icons">
		<li class="sharing__icon sharing__icon--twitter">
			<a target="_blank" href="https://twitter.com/intent/tweet/?text=Visit%20my%20website&amp;url=<?php echo $share_url; ?>&amp;via=firedogcreative" class="sharing__link"><span class="icon icon-twitter-with-circle"></span><span class="sharing__count"></span></a>
		</li>
		<li class="sharing__icon sharing__icon--facebook">
			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" class="sharing__link"><span class="icon icon-facebook-with-circle"></span><span class="sharing__count"></span></a>
		</li>
		<li class="sharing__icon sharing__icon--gplus">
			<a target="_blank" href="https://plus.google.com/share?url=<?php echo $share_url; ?>" class="sharing__link"><span class="icon icon-google-with-circle"></span><span class="sharing__count"></span></a>
		</li>
		<li class="sharing__icon sharing__icon--linkedin">
			<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https%3A%2F%2Fjonsuh.com%2F&amp;title=Jonathan%20Suh&amp;source=https%3A%2F%2Fjonsuh.com%2F&amp;summary=Short%20summary" class="sharing__link"><span class="icon icon-linkedin-with-circle"></span><span class="sharing__count"></span></a>
		</li>
	</ul>
</footer>