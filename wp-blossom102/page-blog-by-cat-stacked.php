<?php
/*
Template Name: Blog (Posts Arranged by Category Stacked)
*/
?>

<?php get_template_part( 'content', 'before' ); ?>

						<div class="post entry blog-page-template-4 clearfix">

							<?php the_post(); $content = get_the_content(); ?>

							<h1 class="page-title"><?php the_title(); ?></h1>

							<?php if ( ! empty( $content ) ) : ?>
								<div class="content">
									<?php the_content(); ?>
								</div>
							<?php endif; ?>

						</div>

						<?php get_template_part( 'index4' ); ?>

<?php get_template_part( 'content', 'after' ); ?>