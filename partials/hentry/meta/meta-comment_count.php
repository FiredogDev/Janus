<span class="hentry__meta__separator"> | </span>
<?php 
$comments_form_url = get_the_permalink() . '/#comments';
$leave_a_comment_link = '<a href="' . $comments_form_url . '">Leave a comment</a>'; ?>
<span class="hentry__meta__comment_count">
<?php comments_number( __($leave_a_comment_link, 'firedogtheme' ) ); ?></span>