<?php global $curauth;  ?>

<div class="auth-icons">

	<a rel="external" title="<?php _e("RSS Feed for", "solostream"); ?> <?php echo $curauth->display_name; ?>" href="<?php bloginfo('url'); ?>/author/<?php echo $curauth->user_nicename; ?>/feed/"><img src="<?php bloginfo('template_directory'); ?>/images/feed.png" alt="<?php _e("rss feed", "solostream"); ?>" /></a>

	<?php if ( $curauth->facebook ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Facebook", "solostream"); ?>" href="http://www.facebook.com/<?php echo $curauth->facebook; ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="<?php _e("Facebook", "solostream"); ?>" /></a>
	<?php } ?>

	<?php if ( $curauth->instagram ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Instagram", "solostream"); ?>" href="http://www.instagram.com/<?php echo $curauth->instagram; ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/instagram.png" alt="<?php _e("Instagram", "solostream"); ?>" /></a>
	<?php } ?>

	<?php if ( $curauth->twitter ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Twitter", "solostream"); ?>" href="http://www.twitter.com/<?php echo $curauth->twitter; ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="<?php _e("Twitter", "solostream"); ?>" /></a>
	<?php } ?>

	<?php if ( $curauth->pinterest ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Pinterest", "solostream"); ?>" href="http://www.pinterest.com/<?php echo $curauth->pinterest; ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/pinterest.png" alt="<?php _e("Pinterest", "solostream"); ?>" /></a>
	<?php } ?>

	<?php if ( $curauth->googbuzz ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Google Plus", "solostream"); ?>" href="https://plus.google.com/<?php echo $curauth->googbuzz; ?>?rel=author"><img src="<?php bloginfo('template_directory'); ?>/images/google-plus.png" alt="<?php _e("Google Plus", "solostream"); ?>" /></a>
	<?php } ?>

	<?php if ( $curauth->flickr ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on Flickr", "solostream"); ?>" href="http://www.flickr.com/photos/<?php echo $curauth->flickr; ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/flickr.png" alt="<?php _e("Flickr", "solostream"); ?>r" /></a>
	<?php } ?>

	<?php if ( $curauth->linkedin ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on LinkedIn", "solostream"); ?>" href="http://www.linkedin.com/in/<?php echo $curauth->linkedin; ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/linkedin.png" alt="<?php _e("LinkedIn", "solostream"); ?>" /></a>
	<?php } ?>

	<?php if ( $curauth->youtube ) { ?>
		<a rel="external" title="<?php echo $curauth->display_name; ?> <?php _e("on YouTube", "solostream"); ?>" href="http://www.youtube.com/user/<?php echo $curauth->youtube; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/youtube.png" alt="<?php _e("YouTube", "solostream"); ?>" /></a>
	<?php } ?>

	<?php if ( $curauth->user_url ) { ?>
		<span class="auth-website"><a rel="external" title="<?php _e("Author Website", "solostream"); ?>" href="<?php echo $curauth->user_url; ?>"><?php _e("Author's Website", "solostream"); ?></a></span>
	<?php } ?>

</div>