<div class="meta">

	<span class="meta-author">
		<span class="meta-bullet">
			<?php _e("Written by", "solostream"); ?>
		</span>
		<span class="meta-inner">
			<?php the_author_posts_link(); ?>
		</span>
	</span>

	<span class="meta-date">
		<span class="meta-bullet">
			<?php _e("on", "solostream"); ?>
		</span>
		<span class="meta-inner">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</span>
	</span>

	<?php if ( 'post' == get_post_type() ) { ?>
		<span class="meta-cats">
			<span class="meta-bullet">
				<?php _e("in", "solostream"); ?>
			</span>
			<span class="meta-inner">
				<?php the_category(', '); ?>
			</span>
		</span>
	<?php } ?>

	<?php if ('open' == $post->comment_status) { ?>
		<span class="meta-comments">
			 <span class="meta-bullet">
				<?php _e("with", "solostream"); ?>
			</span>
			<span class="meta-inner">
				<a href="<?php comments_link(); ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Comments for", "solostream"); ?> <?php the_title(); ?>"><?php comments_number(__("0 Comments", "solostream"), __("1 Comment", "solostream"), __("% Comments", "solostream")); ?></a>
			</span>
		</span>
	<?php } ?> 

</div>
