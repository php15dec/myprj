<div class="mysubscribebox clearfix">

	<div class="inner-mysubscribebox clearfix">

		<h2><span><?php _e("Subscribe", "solostream"); ?></span></h2>

		<p><?php _e("If you enjoyed this article, subscribe now to receive more just like it.", "solostream"); ?></p>

		<?php if ( get_option('solostream_subscribe_settings') == 'Use Google/FeedBurner Email' && get_option('solostream_fb_feed_id') ) { ?>

			<div class="email-form">

				<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('solostream_fb_feed_id'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">

					<input type="hidden" value="<?php echo get_option('solostream_fb_feed_id'); ?>" name="uri"/>

					<input type="hidden" name="loc" value="en_US"/>

					<input type="text" class="sub" name="email" value="<?php _e("email address", "solostream"); ?>" onfocus="if (this.value == '<?php _e("email address", "solostream"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("email address", "solostream"); ?>';}" />

					<input type="submit" value="<?php _e("submit", "solostream"); ?>" class="subbutton" />

					<div style="clear:both;"><small><?php _e("Privacy guaranteed. We never share your info.", "solostream"); ?></small></div>

				</form>

			</div>

		<?php } elseif ( get_option('solostream_subscribe_settings') == 'Use Alternate Email List Form' && get_option('solostream_alt_email_code') ) { ?>

			<div class="email-form">
				<?php echo stripslashes(get_option('solostream_alt_email_code')); ?>
			</div>

		<?php } ?>

		<?php include (TEMPLATEPATH . '/sub-icons.php'); ?>

	</div>

</div>