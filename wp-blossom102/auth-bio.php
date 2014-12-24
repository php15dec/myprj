<?php if ( get_option('solostream_show_auth_bio') == 'yes' && get_post_meta( $post->ID, 'hide_auth_bio', true ) != 'Yes' ) { ?>

<div class="auth-bio clearfix">

	<div class="bio">

		<?php if (function_exists('get_avatar')) {
			$gravsize = get_option('solostream_grav_size'); 
			$author_email = get_the_author_email();
			echo get_avatar($author_email,$size=$gravsize); 
		} ?>

		<h2><span><?php _e("About the Author", "solostream"); ?></span></h2>

		<div><span><?php _e("About the Author", "solostream"); ?></span>: <?php echo get_the_author_meta('description'); ?> <a rel="author" href="<?php bloginfo('url'); ?>/?author=<?php the_author_ID(); ?>"><?php _e("More from this author", "solostream"); ?></a>.</div>

	</div>

</div>

<?php } ?>
