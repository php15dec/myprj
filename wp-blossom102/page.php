<?php get_template_part( 'content', 'before' ); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div class="post clearfix" id="post-main-<?php the_ID(); ?>">

							<div class="entry">

								<h1 class="page-title"><?php the_title(); ?></h1>

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

							</div>

						</div>

<?php endwhile; endif; ?>

<?php get_template_part( 'content', 'after' ); ?>