<?php get_template_part( 'content', 'before' ); ?>

						<?php if (is_category()) { ?>			
							<h1 class="archive-title"><?php echo single_cat_title(); ?></h1>
							<?php if (category_description()) { ?>
								<div class="content">
									<?php echo category_description(); ?>
								</div>
							<?php } ?>		
						<?php } elseif (is_day()) { ?>
							<h1 class="archive-title"><?php _e("Archive for", "solostream"); ?> <?php the_time('F jS, Y'); ?></h1>
						<?php } elseif (is_search()) { ?>
							<h1 class="archive-title"><?php _e("Search Results for", "solostream"); ?> '<?php echo wp_specialchars($s, 1); ?>'</h1>		
						<?php } elseif (is_month()) { ?>
							<h1 class="archive-title"><?php _e("Archive for", "solostream"); ?> <?php the_time('F, Y'); ?></h1>
						<?php } elseif (is_year()) { ?>
							<h1 class="archive-title"><?php _e("Archive for", "solostream"); ?> <?php the_time('Y'); ?></h1>		
						<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							<h1 class="archive-title"><?php _e("Blog Archives", "solostream"); ?></h1>
						<?php } elseif (is_tag()) { ?>
							<h1 class="archive-title"><?php _e("Tag", "solostream"); ?>: <?php single_tag_title(); ?></h1>
						<?php } else { ?>
							<h1 class="archive-title"><?php _e("Archives", "solostream"); ?></h1>
						<?php } ?>

						<?php if ( get_option('solostream_archive_layout') == 'Option 2 - 2 Posts Aligned Side-by-Side') { ?>
							<?php get_template_part( 'index2' ); ?>
						<?php } else { ?>
							<?php get_template_part( 'index1' ); ?>
						<?php } ?>

<?php get_template_part( 'content', 'after' ); ?>