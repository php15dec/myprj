<?php get_template_part( 'content', 'before' ); ?>

<?php 
	global $do_not_duplicate;
	if (have_posts()) : while (have_posts()) : the_post(); 
	$do_not_duplicate[] = $post->ID; 
?>

						<div class="post" id="post-main-<?php the_ID(); ?>">

							<div class="entry">

								<div class="post-header">
									<h1 class="post-title single"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>
									<?php get_template_part( 'postinfo' ); ?>
								</div>

								<?php if ( get_post_meta( $post->ID, 'video_embed', true ) ) { ?>
									<div class="post-feature-video">
										<div class="single-video">
											<?php echo get_post_meta( $post->ID, 'video_embed', true ); ?>
										</div>
									</div>
								<?php } ?>

								<?php the_content(); ?>

								<div style="clear:both;"></div>

								<?php wp_link_pages(); ?>

								<?php the_tags('<p class="tags"><strong>'. __('Tags', "solostream"). ': </strong> ', ', ', '</p>'); ?>

							</div>

						</div>

						<?php get_template_part( 'auth-bio' ); ?>

						<?php get_template_part( 'mysubscribebox' ); ?>

						<?php comments_template('', true); ?>

						<?php get_template_part( 'bot-nav' ); ?>

<?php endwhile; endif; ?>

<?php get_template_part( 'content', 'after' ); ?>