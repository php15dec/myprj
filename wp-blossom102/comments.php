<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<div id="comments">

	<?php if ( have_comments() ) : ?>

		<!-- If there are comments, list them. -->
		<div class="allcomments">

			<h3 id="comments-title"><span><?php comments_number(__("No Reader Comments Yet", "solostream"), __("1 Reader Comment", "solostream"), __("% Reader Comments", "solostream")); ?></span></h3>

			<p class="comments-number clearfix">
				<span class="alignleft">
					<a href="<?php trackback_url(); ?>" title="<?php _e("Trackback URL", "solostream"); ?>"><?php _e("Trackback URL", "solostream"); ?></a>
				</span>
				<span class="alignright">
					<a title="<?php _e("Comments RSS Feed for This Entry", "solostream"); ?>" href="<?php the_permalink() ?>feed"><?php _e("Comments RSS Feed", "solostream"); ?></a>
				</span>
			</p>

			<div class="comments-navigation clearfix">
				<div class="alignleft"><?php previous_comments_link() ?></div>
				<div class="alignright"><?php next_comments_link() ?></div>
			</div> <!-- End .comments-navigation div. -->

			<?php // list pings/trackbacks separately
			if ( ! empty($comments_by_type['pings']) ) : ?>
				<div class="pings">
					<h3><?php _e("Sites That Link to this Post", "solostream"); ?></h3>
					<ol class="pinglist">
						<?php wp_list_comments('type=pings&callback=list_pings'); ?>
					</ol>
				</div>  <!-- End .pings div. -->
			<?php endif; ?>

			<ol class="commentlist">
				<?php 
					$avsize = 72;
					wp_list_comments('type=comment&avatar_size='.$avsize);
				?>
			</ol>  <!-- End .commentlist div. -->

		</div>   <!-- End .allcomments div. -->

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->

		 <?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<p class="nocomments"><?php _e("Comments are closed.", "solostream"); ?></p>

		<?php endif; ?>

	<?php endif; ?>

	<?php 
		$comments_args = array( 'comment_notes_after' => '' );
		comment_form($comments_args);
	?>

</div> <!-- End #comments div. -->